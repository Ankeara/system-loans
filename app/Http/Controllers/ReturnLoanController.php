<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\EndLoan;
use App\Models\Loan;
use App\Models\Profit;
use App\Models\ReturnLoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class ReturnLoanController extends Controller
{
    public function returnLoan()
    {
        $loans = Loan::with(['client'])->get();
        $clients = Client::all();
        $ReturnLoans = ReturnLoan::with(['loan.client'])->get();
        return view('./application/pages/return-loans/return-loan', ['ReturnLoans' => $ReturnLoans,'loans' => $loans, 'clients' => $clients, 'pageTitle' => 'ការបកប្រាក់កម្ចី',]);
    }

    public function returnLoanRiel()
    {
        $loans = Loan::with(['client'])->get();
        $clients = Client::all();
        $ReturnLoans = ReturnLoan::with(['loan.client'])
            ->whereHas('loan', function ($query) {
                $query->where('currency', 'riel');
            })
            ->get();
        return view('./application/pages/return-loans/return-loan-riel', [
            'ReturnLoans' => $ReturnLoans,
            'loans' => $loans,
            'clients' => $clients,
            'pageTitle' => 'ការបកប្រាក់កម្ចីជាសាច់ប្រាក់រៀល',
        ]);
    }

    public function returnLoanBaht()
    {
        $loans = Loan::with(['client'])->get();
        $clients = Client::all();
        $ReturnLoans = ReturnLoan::with(['loan.client'])
            ->whereHas('loan', function ($query) {
                $query->where('currency', 'baht');
            })
            ->get();
        return view('./application/pages/return-loans/return-loan-baht', [
            'ReturnLoans' => $ReturnLoans,
            'loans' => $loans,
            'clients' => $clients,
            'pageTitle' => 'ការបកប្រាក់កម្ចីជាសាច់ប្រាក់បាត',
        ]);
    }

    public function returnLoanDollar()
    {
        $loans = Loan::with(['client'])->get();
        $clients = Client::all();
        $ReturnLoans = ReturnLoan::with(['loan.client'])
            ->whereHas('loan', function ($query) {
                $query->where('currency', 'dollar');
            })
            ->get();
        return view('./application/pages/return-loans/return-loan-dollar', [
            'ReturnLoans' => $ReturnLoans,
            'loans' => $loans,
            'clients' => $clients,
            'pageTitle' => 'ការបកប្រាក់កម្ចីជាសាច់ប្រាក់ដុល្លា',
        ]);
    }

    public function viewReturnLoan($id)
    {
        $returnLoanView = ReturnLoan::with(['loan.client'])->find($id);
        $loans = Loan::with(['client'])->get();
        $clients = Client::all();
        if ($returnLoanView == null) {
            abort(404);
        }
        return view('./application/pages/return-loans/view-return', ['returnLoanView' => $returnLoanView, 'loans' => $loans, 'clients' => $clients, 'pageTitle' => 'មើលព័ត៍មានលម្អឹតនៃការបកប្រាក់កម្ចី'. $returnLoanView->loan->client->full_Name,]);
    }

    public function addReturnLoan()
    {
        $loans = Loan::with(['client'])->get();
        $clients = Client::all();
        return view('./application/pages/return-loans/add-return-loan', ['loans' => $loans, 'clients' => $clients,'pageTitle' => 'បន្ថែមការបកប្រាក់កម្ចី']);
    }

    public function saveReturnLoan(Request $request)
    {
        // Define base validation rules
        $rules = [
            'id_client' => 'required|exists:clients,id',
            'currency' => 'required|in:riel,baht,dollar',
            'loan_Term' => 'required|integer|min:1',
            'day_left' => 'required|integer|min:0',
            'start_Date' => 'required|date',
            'end_Date' => 'required|date|after_or_equal:start_Date',
            'status' => 'nullable|in:0,1,2',
            'status_return' => 'required|in:0,1',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1536000',
            'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:1536000',
            'existing_picture' => 'nullable|string',
            'existing_video' => 'nullable|string',
        ];

        // Add currency-specific rules dynamically
        $currency = $request->input('currency');
        if ($currency === 'riel') {
            $rules['loan_Amount_Riel'] = 'required|numeric|min:0';
            $rules['interest_Rate_Riel'] = 'required|numeric|min:0';
            $rules['payment_Amount_Riel'] = 'required|numeric|min:0';
            $rules['money_left_Riel'] = 'required|numeric|min:0';
            $rules['more_money_Riel'] = 'required|numeric|min:0';
            // Other currencies are optional
            $rules['loan_Amount_Baht'] = 'nullable|numeric|min:0';
            $rules['loan_Amount_Dollar'] = 'nullable|numeric|min:0';
            $rules['interest_Rate_Baht'] = 'nullable|numeric|min:0';
            $rules['interest_Rate_Dollar'] = 'nullable|numeric|min:0';
            $rules['payment_Amount_Baht'] = 'nullable|numeric|min:0';
            $rules['payment_Amount_Dollar'] = 'nullable|numeric|min:0';
            $rules['money_left_Baht'] = 'nullable|numeric|min:0';
            $rules['money_left_Dollar'] = 'nullable|numeric|min:0';
            $rules['more_money_Baht'] = 'nullable|numeric|min:0';
            $rules['more_money_Dollar'] = 'nullable|numeric|min:0';
        } elseif ($currency === 'baht') {
            $rules['loan_Amount_Baht'] = 'required|numeric|min:0';
            $rules['interest_Rate_Baht'] = 'required|numeric|min:0';
            $rules['payment_Amount_Baht'] = 'required|numeric|min:0';
            $rules['money_left_Baht'] = 'required|numeric|min:0';
            $rules['more_money_Baht'] = 'required|numeric|min:0';
            // Other currencies are optional
            $rules['loan_Amount_Riel'] = 'nullable|numeric|min:0';
            $rules['loan_Amount_Dollar'] = 'nullable|numeric|min:0';
            $rules['interest_Rate_Riel'] = 'nullable|numeric|min:0';
            $rules['interest_Rate_Dollar'] = 'nullable|numeric|min:0';
            $rules['payment_Amount_Riel'] = 'nullable|numeric|min:0';
            $rules['payment_Amount_Dollar'] = 'nullable|numeric|min:0';
            $rules['money_left_Riel'] = 'nullable|numeric|min:0';
            $rules['money_left_Dollar'] = 'nullable|numeric|min:0';
            $rules['more_money_Riel'] = 'nullable|numeric|min:0';
            $rules['more_money_Dollar'] = 'nullable|numeric|min:0';
        } elseif ($currency === 'dollar') {
            $rules['loan_Amount_Dollar'] = 'required|numeric|min:0';
            $rules['interest_Rate_Dollar'] = 'required|numeric|min:0';
            $rules['payment_Amount_Dollar'] = 'required|numeric|min:0';
            $rules['money_left_Dollar'] = 'required|numeric|min:0';
            $rules['more_money_Dollar'] = 'required|numeric|min:0';
            // Other currencies are optional
            $rules['loan_Amount_Riel'] = 'nullable|numeric|min:0';
            $rules['loan_Amount_Baht'] = 'nullable|numeric|min:0';
            $rules['interest_Rate_Riel'] = 'nullable|numeric|min:0';
            $rules['interest_Rate_Baht'] = 'nullable|numeric|min:0';
            $rules['payment_Amount_Riel'] = 'nullable|numeric|min:0';
            $rules['payment_Amount_Baht'] = 'nullable|numeric|min:0';
            $rules['money_left_Riel'] = 'nullable|numeric|min:0';
            $rules['money_left_Baht'] = 'nullable|numeric|min:0';
            $rules['more_money_Riel'] = 'nullable|numeric|min:0';
            $rules['more_money_Baht'] = 'nullable|numeric|min:0';
        }

        // Custom error messages
        $messages = [
            'id_client.required' => 'សូមបញ្ចូលឈ្មោះអ្នកប្រើប្រាស់។',
            'currency.required' => 'សូមជ្រើសរើសរូបិយប័ណ្ណ។',
            'loan_Amount_Riel.required' => 'សូមបញ្ចូលចំនួនប្រាក់កម្ចីជារៀល។',
            'loan_Amount_Baht.required' => 'សូមបញ្ចូលចំនួនប្រាក់កម្ចីជាបាត។',
            'loan_Amount_Dollar.required' => 'សូមបញ្ចូលចំនួនប្រាក់កម្ចីជាដុល្លារ។',
            'interest_Rate_Riel.required' => 'សូមបញ្ចូលអត្រាការប្រាក់ជារៀល។',
            'interest_Rate_Baht.required' => 'សូមបញ្ចូលអត្រាការប្រាក់ជាបាត។',
            'interest_Rate_Dollar.required' => 'សូមបញ្ចូលអត្រាការប្រាក់ជាដុល្លារ។',
            'payment_Amount_Riel.required' => 'សូមបញ្ចូលទឹកប្រាក់ដែលត្រូវទូទាត់ជារៀល។',
            'payment_Amount_Baht.required' => 'សូមបញ្ចូលទឹកប្រាក់ដែលត្រូវទូទាត់ជាបាត។',
            'payment_Amount_Dollar.required' => 'សូមបញ្ចូលទឹកប្រាក់ដែលត្រូវទូទាត់ជាដុល្លារ។',
            'money_left_Riel.required' => 'សូមបញ្ចូលចំនួនលុយនៅសល់ជារៀល។',
            'money_left_Baht.required' => 'សូមបញ្ចូលចំនួនលុយនៅសល់ជាបាត។',
            'money_left_Dollar.required' => 'សូមបញ្ចូលចំនួនលុយនៅសល់ជាដុល្លារ។',
            'more_money_Riel.required' => 'សូមបញ្ចូលចំនួនបង្កុបលុយជារៀល។',
            'more_money_Baht.required' => 'សូមបញ្ចូលចំនួនបង្កុបលុយជាបាត។',
            'more_money_Dollar.required' => 'សូមបញ្ចូលចំនួនបង្កុបលុយជាដុល្លារ។',
            'loan_Term.required' => 'សូមបញ្ចូលរយៈពេលខ្ចី។',
            'day_left.required' => 'សូមបញ្ចូលចំនួនថ្ងៃនៅសល់។',
            'start_Date.required' => 'សូមបញ្ចូលកាលបរិច្ឆេទចាប់ផ្តើម។',
            'end_Date.required' => 'សូមបញ្ចូលកាលបរិច្ឆេទបញ្ចប់។',
            'status_return.required' => 'សូមជ្រើសរើសស្ថានភាព។',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
                'message' => 'បញ្ចូលទិន្នន័យមិនត្រឹមត្រូវ!',
                'type' => 'error'
            ]);
        }

        try {
            DB::beginTransaction();

            // Handle old loans
            $oldLoans = Loan::where('id_client', $request->id_client)->get();
            foreach ($oldLoans as $oldLoan) {
                $endLoanOld = new EndLoan();
                $endLoanOld->id_loan = $oldLoan->id;
                $endLoanOld->save();
                $oldLoan->delete();
            }

            // Create new Loan record
            $loan = new Loan();
            $loan->id_client = $request->id_client;
            $loan->currency = $currency;
            $loan->loan_Amount_Riel = $currency === 'riel' ? ($request->loan_Amount_Riel ?? 0) : 0;
            $loan->loan_Amount_Baht = $currency === 'baht' ? ($request->loan_Amount_Baht ?? 0) : 0;
            $loan->loan_Amount_Dollar = $currency === 'dollar' ? ($request->loan_Amount_Dollar ?? 0) : 0;
            $loan->interest_Rate_Riel = $currency === 'riel' ? ($request->interest_Rate_Riel ?? 0) : 0;
            $loan->interest_Rate_Baht = $currency === 'baht' ? ($request->interest_Rate_Baht ?? 0) : 0;
            $loan->interest_Rate_Dollar = $currency === 'dollar' ? ($request->interest_Rate_Dollar ?? 0) : 0;
            $loan->payment_Amount_Riel = $currency === 'riel' ? ($request->payment_Amount_Riel ?? 0) : 0;
            $loan->payment_Amount_Baht = $currency === 'baht' ? ($request->payment_Amount_Baht ?? 0) : 0;
            $loan->payment_Amount_Dollar = $currency === 'dollar' ? ($request->payment_Amount_Dollar ?? 0) : 0;
            $loan->loan_Term = $request->loan_Term;
            $loan->start_Date = $request->start_Date;
            $loan->end_Date = $request->end_Date;
            $loan->status = $request->status;

            if ($request->hasFile('picture')) {
                $imgPicture = time() . '.' . $request->file('picture')->getClientOriginalExtension();
                $request->file('picture')->move(public_path('/src/assets/uploads/loans/pictures/'), $imgPicture);
                $loan->picture = $imgPicture;
            } else {
                $loan->picture = $request->input('existing_picture');
            }

            if ($request->hasFile('video')) {
                $imgVideo = time() . '.' . $request->file('video')->getClientOriginalExtension();
                $request->file('video')->move(public_path('/src/assets/uploads/loans/videos/'), $imgVideo);
                $loan->video = $imgVideo;
            } else {
                $loan->video = $request->input('existing_video');
            }

            $loan->save();

            // Create new ReturnLoan record
            $returnLoan = new ReturnLoan();
            $returnLoan->id_loan = $loan->id;
            $returnLoan->day_left = $request->day_left;
            $returnLoan->money_left_Riel = $currency === 'riel' ? ($request->money_left_Riel ?? 0) : 0;
            $returnLoan->money_left_Baht = $currency === 'baht' ? ($request->money_left_Baht ?? 0) : 0;
            $returnLoan->money_left_Dollar = $currency === 'dollar' ? ($request->money_left_Dollar ?? 0) : 0;
            $returnLoan->more_money_Riel = $currency === 'riel' ? ($request->more_money_Riel ?? 0) : 0;
            $returnLoan->more_money_Baht = $currency === 'baht' ? ($request->more_money_Baht ?? 0) : 0;
            $returnLoan->more_money_Dollar = $currency === 'dollar' ? ($request->more_money_Dollar ?? 0) : 0;
            $returnLoan->start_Date = $request->start_Date;
            $returnLoan->status_return = $request->status_return;
            $returnLoan->save();

            // Create new EndLoan record
            $endLoan = new EndLoan();
            $endLoan->id_loan = $loan->id;
            $endLoan->save();

            // Calculate and save profit
            $interestRateRiel = $currency === 'riel' && $request->interest_Rate_Riel ? $request->interest_Rate_Riel / 100 : 0;
            $interestRateBaht = $currency === 'baht' && $request->interest_Rate_Baht ? $request->interest_Rate_Baht / 100 : 0;
            $interestRateDollar = $currency === 'dollar' && $request->interest_Rate_Dollar ? $request->interest_Rate_Dollar / 100 : 0;
            $loanTerm = $request->loan_Term;

            $profit = new Profit();
            $profit->id_loan = $loan->id;
            $profit->profit_Riel = $loan->loan_Amount_Riel * $interestRateRiel * $loanTerm;
            $profit->profit_Dollar = $loan->loan_Amount_Dollar * $interestRateDollar * $loanTerm;
            $profit->profit_Baht = $loan->loan_Amount_Baht * $interestRateBaht * $loanTerm;
            $profit->save();

            DB::commit();

            session()->flash('success', 'ការបកប្រាក់កម្ចីបានរក្សាទុកដោយជោគជ័យ!');
            return response()->json([
                'status' => true,
                'redirect' => route('application.pages.return-loans.return-loan'),
                'errors' => [],
                'message' => 'ការបកប្រាក់កម្ចីបានរក្សាទុកដោយជោគជ័យ!',
                'type' => 'success'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'មានបញ្ហាក្នុងការរក្សាទុកទិន្នន័យ!');
            return response()->json([
                'status' => false,
                'errors' => ['exception' => $e->getMessage()],
                'message' => 'មានបញ្ហាក្នុងការរក្សាទុកទិន្នន័យ!',
                'type' => 'error'
            ]);
        }
    }
}
