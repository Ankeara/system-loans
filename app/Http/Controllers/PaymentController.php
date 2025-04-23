<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\EndLoan;
use App\Models\Loan;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function payment()
    {
        // Get loans that aren't completed
        $loans = Loan::with(['client', 'payments'])
            ->whereDoesntHave('endPaid', function ($query) {
                $query->where('status', 'Paid');
            })
            ->get();

        $clients = Client::all();

        // Calculate paid today
        $paidTodayCount = Loan::whereDoesntHave('endPaid', function ($query) {
                $query->where('status', 'Paid');
            })
            ->whereHas('payments', function ($query) {
                $query->whereDate('payment_date', Carbon::today())
                      ->where('payment_Status', 1);
            })
            ->count();

        // Calculate not paid today (active loans minus paid today)
        $totalActiveLoans = $loans->count();
        $notPaidTodayCount = $totalActiveLoans - $paidTodayCount;

        return view('./application/pages/payments/payment-loan', [
            'loans' => $loans,
            'clients' => $clients,
            'paidTodayCount' => $paidTodayCount,
            'notPaidTodayCount' => $notPaidTodayCount,
            'pageTitle' => 'អតិថិជនដែលត្រូវទូទាត់ប្រាក់ទាំងអស់',
        ]);
    }

    public function savePayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_amount' => 'required|numeric|min:0',
            'not_paid' => 'nullable|numeric|min:0',
            'payment_date' => 'nullable|date',
            'id_loan' => 'required|exists:loans,id',
            'payment_Status' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
                'message' => 'បញ្ចូលទិន្នន័យមិនត្រឹមត្រូវ!', // Invalid input
                'type' => 'error'
            ]);
        }

        try {
            $loan = Loan::findOrFail($request->id_loan);
            $paymentCount = $loan->payments()->count() + 1;

            if ($paymentCount > $loan->loan_Term) {
                session()->flash('error', 'ការបង់បានលើសរយៈពេលកម្ចី!'); // Payment exceeds loan term
                return response()->json(['status' => false]);
            }

            $payment = new Payment();
            $payment->payment_Amount = $request->payment_amount;
            $payment->not_paid = $request->not_paid ?? 0;
            $payment->payment_date = $request->payment_date ?? now();
            $payment->id_loan = $request->id_loan;
            $payment->payment_Status = $request->payment_Status;
            $payment->save();

            $responseData = [
                'status' => true,
                'payment_count' => $paymentCount,
                'total_terms' => $loan->loan_Term,
                'is_completed' => false
            ];

            if ($paymentCount == $loan->loan_Term) {
                EndLoan::create([
                    'id_loan' => $loan->id,
                    'status' => 'Paid'
                ]);
                $responseData['is_completed'] = true;
                session()->flash('success', 'កម្ចីបានបង់រួចរាល់ទាំងស្រុង!'); // Loan fully paid
            } else {
                session()->flash('success', 'ការបង់ប្រាក់បានរក្សាទុកដោយជោគជ័យ!'); // Payment recorded successfully
            }

            return response()->json($responseData);
        } catch (\Exception $e) {
            session()->flash('error', 'មានបញ្ហាក្នុងការរក្សាទុកទិន្នន័យ!'); // Error saving data
            return response()->json(['status' => false, 'error' => $e->getMessage()]);
        }
    }

    public function loanDetail(Loan $loan)
    {
        // Order payments by payment_order instead of payment_date
        $payments = $loan->payments()->orderBy('payment_order')->get();
        $dailyStatus = [];

        // Require start_Date; throw an error or use a fallback if not set
        if (!$loan->start_Date) {
            throw new \Exception('Loan start_Date is required to generate payment schedule.');
            // Alternative: Use created_at or another fallback
            // $startDate = $loan->created_at ?? \Carbon\Carbon::now();
        }
        $startDate = $loan->start_Date;
        $startCarbon = \Carbon\Carbon::parse($startDate);

        // Set end_date, default to start_Date + loan_Term - 1 if not provided
        $endDate = $loan->end_date ?? $startCarbon->copy()->addDays($loan->loan_Term - 1);
        $endCarbon = \Carbon\Carbon::parse($endDate);

        // Calculate the number of days between start_Date and end_date (inclusive)
        $totalDays = $startCarbon->diffInDays($endCarbon) + 1;

        // Ensure totalDays matches loan_Term for consistency
        if ($totalDays != $loan->loan_Term) {
            // Adjust end_date to match loan_Term
            $endCarbon = $startCarbon->copy()->addDays($loan->loan_Term - 1);
            $totalDays = $loan->loan_Term;
        }

        // Create array of payment status for each day between start_Date and end_date
        for ($day = 1; $day <= $totalDays; $day++) {
            $currentDate = $startCarbon->copy()->addDays($day - 1);
            $dailyStatus[$day] = [
                'paid' => false,
                'date' => null,
                'scheduled_date' => $currentDate->format('Y-m-d'),
                'amount' => 0,
                'not_paid' => 0
            ];
        }

        // Fill in actual payment data
        foreach ($payments as $index => $payment) {
            $dayNumber = $payment->payment_order ?? $index + 1;
            if ($dayNumber <= $totalDays) {
                $dailyStatus[$dayNumber] = [
                    'paid' => $payment->payment_Status == 1,
                    'date' => $payment->payment_date,
                    'scheduled_date' => $startCarbon->copy()->addDays($dayNumber - 1)->format('Y-m-d'),
                    'amount' => $payment->payment_Amount,
                    'not_paid' => $payment->not_paid,
                    'pageTitle' => 'ព័ត៍មានលម្អិតអតិថិជន'
                ];
            }
        }

        return view('application.pages.payments.loan-detail', [
            'loan' => $loan,
            'dailyStatus' => $dailyStatus,
            'client' => $loan->client,
            'pageTitle' => 'ព័ត៏មានអតិថិជនបានឡើង',
        ]);
    }

    public function updatePaymentSchedule(Request $request, Loan $loan)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'id_loan' => 'required|exists:loans,id',
            'payment_day' => 'required|integer|min:1',
            'payment_amount' => 'required|numeric|min:0',
            'not_paid' => 'nullable|numeric|min:0',
            'payment_Status' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
                'message' => 'បញ្ចូលទិន្នន័យមិនត្រឹមត្រូវ!', // Invalid input
            ], 422);
        }

        try {
            $day = $request->input('payment_day');
            $status = $request->input('payment_Status');
            $paymentAmount = $request->input('payment_amount');
            $notPaid = $request->input('not_paid', 0);

            // Check if the payment day exceeds the loan term
            if ($day > $loan->loan_Term) {
                return response()->json([
                    'status' => false,
                    'message' => 'ការបង់បានលើសរយៈពេលកម្ចី!', // Payment exceeds loan term
                ], 400);
            }

            // Check for existing payment for the given day
            $existingPayment = Payment::where('id_loan', $loan->id)
                ->where('payment_order', $day)
                ->first();

            if ($status == 1) {
                if ($existingPayment) {
                    // Update existing payment
                    $existingPayment->payment_Amount = $paymentAmount;
                    $existingPayment->not_paid = $notPaid;
                    $existingPayment->payment_date = now();
                    $existingPayment->payment_Status = 1;
                    $existingPayment->save();
                } else {
                    // Create new payment
                    $payment = new Payment();
                    $payment->id_loan = $loan->id;
                    $payment->payment_Amount = $paymentAmount;
                    $payment->not_paid = $notPaid;
                    $payment->payment_date = now();
                    $payment->payment_Status = 1;
                    $payment->payment_order = $day;
                    $payment->save();
                }
            } elseif ($status == 0 && $existingPayment) {
                // Delete payment if status is 0 (unchecked)
                $existingPayment->delete();
            }

            // Check payment count and loan completion
            $paymentCount = $loan->payments()->count();
            $completed = $paymentCount >= $loan->loan_Term;

            if ($completed && !$loan->endPaid) {
                EndLoan::create([
                    'id_loan' => $loan->id,
                    'status' => 'Paid'
                ]);
                session()->flash('success', 'កម្ចីបានបង់រួចរាល់ទាំងស្រុង!'); // Loan fully paid
            } else {
                session()->flash('success', 'ការបង់ប្រាក់បានរក្សាទុកដោយជោគជ័យ!'); // Payment recorded successfully
            }

            return response()->json([
                'status' => true,
                'completed' => $completed,
                'payment_count' => $paymentCount,
                'total_terms' => $loan->loan_Term,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'មានបញ្ហាក្នុងការរក្សាទុកទិន្នន័យ!', // Error saving data
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function paidPaymentLoans()
    {
        $loans = Loan::with(['client', 'payments'])
            ->whereDoesntHave('endPaid', function ($query) {
                $query->where('status', 'Paid');
            })
            ->whereHas('payments', function ($query) {
                $query->whereDate('payment_date', Carbon::today())
                    ->where('payment_Status', 1);
            })
            ->get();

        return view('./application/pages/payments/paid-payment-loan', ['loans' => $loans, 'pageTitle' => 'អតិថិជនដែលបានទូរទាត់',]);
    }

    public function notPaidPaymentLoans()
    {
        $loans = Loan::with(['client', 'payments'])
            ->whereDoesntHave('endPaid', function ($query) {
                $query->where('status', 'Paid');
            })
            ->whereDoesntHave('payments', function ($query) {
                $query->whereDate('payment_date', Carbon::today())
                    ->where('payment_Status', 1);
            })
            ->get();

        return view('./application/pages/payments/not-paid-payment-loan', ['loans' => $loans,'pageTitle' => 'អតិថិជនដែលមិនបានទូរទាត់',]);
    }
}