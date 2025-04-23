<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Loan;
use App\Models\Profit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
    public function loans()
    {
        $loans = Loan::with(['client'])->get();
        $client = Client::all();
        return view('./application/pages/loans/loan', ['loans' => $loans, 'client' => $client, 'pageTitle' => 'អតិថិជនចងការប្រាក់ទាំងអស់',]);
    }

    public function loansRiel()
    {
        $loans = Loan::with(['client'])->where('currency', 'riel')->get();
        $client = Client::all();
        return view('./application/pages/loans/loan-riel', ['loans' => $loans, 'client' => $client, 'pageTitle' => 'អតិថិជនចងការប្រាក់ជារៀលទាំងអស់',]);
    }

    public function loansBaht()
    {
        $loans = Loan::with(['client'])->where('currency', 'baht')->get();
        $client = Client::all();
        return view('./application/pages/loans/loan-baht', ['loans' => $loans, 'client' => $client, 'pageTitle' => 'អតិថិជនចងការប្រាក់ជាបាតទាំងអស់',]);
    }

    public function loansDollar()
    {
        $loans = Loan::with(['client'])->where('currency', 'dollar')->get();
        $client = Client::all();
        return view('./application/pages/loans/loan-dollar', ['loans' => $loans, 'client' => $client, 'pageTitle' => 'អតិថិជនចងការប្រាក់ជាដុល្លាទាំងអស់',]);
    }


    public function viewLoan($id)
    {
        $loans = Loan::find($id);
        return view('./application/pages/loans/view-loan', ['loans' => $loans,'pageTitle' => 'អតិថិជនឈ្មោះ'. $loans->client->full_Name,]);
    }

    public function addLoan()
    {
        $clients = Client::all();
        $loans = Loan::with(['client'])->get();
        return view('./application/pages/loans/add-loan', ['loans' => $loans, 'clients' => $clients,'pageTitle' => 'បន្ថែមអតិថិជន',]);
    }

    public function saveLoan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_client' => 'required',
            'currency' => 'required|in:riel,baht,dollar', // Added currency field
            'loan_Amount_Riel' => 'nullable|required_if:currency,riel', // Updated validation
            'loan_Amount_Dollar' => 'nullable|required_if:currency,dollar', // Updated validation
            'loan_Amount_Baht' => 'nullable|required_if:currency,baht', // Updated validation
            'interest_Rate_Riel' => 'nullable|required_if:currency,riel', // Updated validation
            'interest_Rate_Baht' => 'nullable|required_if:currency,baht', // Updated validation
            'interest_Rate_Dollar' => 'nullable|required_if:currency,dollar', // Updated validation
            'loan_Term' => 'required',
            'payment_Amount_Riel' => 'nullable|required_if:currency,riel', // Updated validation
            'payment_Amount_Baht' => 'nullable|required_if:currency,baht', // Updated validation
            'payment_Amount_Dollar' => 'nullable|required_if:currency,dollar', // Updated validation
            'start_Date' => 'required',
            'end_Date' => 'required',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:1536000',
        ], [
            'id_client' => 'សូមបញ្ចូលឈ្មោះអ្នកប្រើប្រាស់។',
            'currency' => 'សូមជ្រើសរើសរូបិយប័ណ្ណ។', // Added message
            'loan_Amount_Riel.required_if' => 'សូមបញ្ចូលចំនួនប្រាក់កម្ចីជារៀល។',
            'loan_Amount_Baht.required_if' => 'សូមបញ្ចូលចំនួនប្រាក់កម្ចីជាបាត។',
            'loan_Amount_Dollar.required_if' => 'សូមបញ្ចូលចំនួនប្រាក់កម្ចីជាដុល្លារ។',
            'interest_Rate_Riel.required_if' => 'សូមបញ្ចូលអត្រាការប្រាក់ជារៀល។',
            'interest_Rate_Baht.required_if' => 'សូមបញ្ចូលអត្រាការប្រាក់ជាបាត។',
            'interest_Rate_Dollar.required_if' => 'សូមបញ្ចូលអត្រាការប្រាក់ជាដុល្លារ។',
            'loan_Term' => 'សូមបញ្ចូលចំនួនខ្ចី។',
            'payment_Amount_Riel.required_if' => 'សូមបញ្ចូលទឹកប្រាក់ដែលត្រូវទូទាត់ជារៀល។',
            'payment_Amount_Baht.required_if' => 'សូមបញ្ចូលទឹកប្រាក់ដែលត្រូវទូទាត់ជាបាត។',
            'payment_Amount_Dollar.required_if' => 'សូមបញ្ចូលទឹកប្រាក់ដែលត្រូវទូទាត់ជាដុល្លារ។',
            'start_Date' => 'សូមបញ្ចូលកាលបរិច្ឆេទដែលចាប់ផ្ដើម។',
            'end_Date' => 'សូមបញ្ចូលកាលបរិច្ឆេទដែលចញ្ចប់។',
        ]);

        // Simplified check based on currency
        if (
            ($request->currency === 'riel' && (!$request->loan_Amount_Riel || !$request->interest_Rate_Riel || !$request->payment_Amount_Riel)) ||
            ($request->currency === 'baht' && (!$request->loan_Amount_Baht || !$request->interest_Rate_Baht || !$request->payment_Amount_Baht)) ||
            ($request->currency === 'dollar' && (!$request->loan_Amount_Dollar || !$request->interest_Rate_Dollar || !$request->payment_Amount_Dollar))
        ) {
            return response()->json([
                'status' => false,
                'errors' => ['loan_amount' => 'សូមបញ្ចូលចំនួនប្រាក់ អត្រាការប្រាក់ និងទឹកប្រាក់ត្រូវទូទាត់សម្រាប់រូបិយប័ណ្ណដែលបានជ្រើសរើស។']
            ]);
        }

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'redirect' => null,
                'errors' => $validator->errors(),
            ]);
        }

        $loans = new Loan();
        $loans->id_client = $request->id_client;
        $loans->currency = $request->currency; // Added currency field
        $loans->loan_Amount_Riel = $request->currency === 'riel' ? ($request->loan_Amount_Riel ?? 0) : 0;
        $loans->loan_Amount_Baht = $request->currency === 'baht' ? ($request->loan_Amount_Baht ?? 0) : 0;
        $loans->loan_Amount_Dollar = $request->currency === 'dollar' ? ($request->loan_Amount_Dollar ?? 0) : 0;
        $loans->interest_Rate_Riel = $request->currency === 'riel' ? $request->interest_Rate_Riel : null;
        $loans->interest_Rate_Baht = $request->currency === 'baht' ? $request->interest_Rate_Baht : null;
        $loans->interest_Rate_Dollar = $request->currency === 'dollar' ? $request->interest_Rate_Dollar : null;
        $loans->loan_Term = $request->loan_Term;
        $loans->payment_Amount_Riel = $request->currency === 'riel' ? $request->payment_Amount_Riel : null;
        $loans->payment_Amount_Baht = $request->currency === 'baht' ? $request->payment_Amount_Baht : null;
        $loans->payment_Amount_Dollar = $request->currency === 'dollar' ? $request->payment_Amount_Dollar : null;
        $loans->start_Date = $request->start_Date;
        $loans->end_Date = $request->end_Date;

        if ($request->hasFile('picture')) {
            $imgPicture = time() . '.' . $request->file('picture')->getClientOriginalExtension();
            $request->file('picture')->move(public_path('/src/assets/uploads/loans/pictures/'), $imgPicture);
            $loans->picture = $imgPicture;
        }

        if ($request->hasFile('video')) {
            $imgVideo = time() . '.' . $request->file('video')->getClientOriginalExtension();
            $request->file('video')->move(public_path('/src/assets/uploads/loans/videos/'), $imgVideo);
            $loans->video = $imgVideo;
        }

        $loans->save();

        // Calculate and save profit
        $loanTerm = $request->loan_Term;

        $profit = new Profit();
        $profit->id_loan = $loans->id;
        $profit->profit_Riel = $loans->payment_Amount_Riel * $loanTerm;
        $profit->profit_Dollar = $loans->payment_Amount_Dollar * $loanTerm;
        $profit->profit_Baht = $loans->payment_Amount_Baht * $loanTerm;
        $profit->save();

        session()->flash('success', 'ការចងការប្រាក់អតិថិជនរបស់អ្នកទទួលបានជោគជ័យ។');
        return response()->json([
            'status' => true,
            'redirect' => route('application.pages.loans.loan'),
            'errors' => [],
        ]);
    }

    public function editLoan($id)
    {
        $clients = Client::all();
        $loans = Loan::find($id);
        return view('./application/pages/loans/edit-loan', ['loans' => $loans, 'clients' => $clients,'pageTitle' => 'កែសម្រួលអតិថិជនឈ្មោះ' .$loans->client->full_Name,]);
    }

    public function updateLoan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_client' => 'required',
            'currency' => 'required|in:riel,baht,dollar', // Added currency field
            'loan_Amount_Riel' => 'nullable|required_if:currency,riel', // Updated validation
            'loan_Amount_Dollar' => 'nullable|required_if:currency,dollar', // Updated validation
            'loan_Amount_Baht' => 'nullable|required_if:currency,baht', // Updated validation
            'interest_Rate_Riel' => 'nullable|required_if:currency,riel', // Updated to match saveLoan
            'interest_Rate_Baht' => 'nullable|required_if:currency,baht', // Updated to match saveLoan
            'interest_Rate_Dollar' => 'nullable|required_if:currency,dollar', // Updated to match saveLoan
            'loan_Term' => 'required',
            'payment_Amount_Riel' => 'nullable|required_if:currency,riel', // Updated to match saveLoan
            'payment_Amount_Baht' => 'nullable|required_if:currency,baht', // Updated to match saveLoan
            'payment_Amount_Dollar' => 'nullable|required_if:currency,dollar', // Updated to match saveLoan
            'start_Date' => 'required',
            'end_Date' => 'required',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:1536000', // Made nullable if optional
        ], [
            'id_client' => 'សូមបញ្ចូលឈ្មោះអ្នកប្រើប្រាស់។',
            'currency' => 'សូមជ្រើសរើសរូបិយប័ណ្ណ។', // Added message
            'loan_Amount_Riel.required_if' => 'សូមបញ្ចូលចំនួនប្រាក់កម្ចីជារៀល។',
            'loan_Amount_Baht.required_if' => 'សូមបញ្ចូលចំនួនប្រាក់កម្ចីជាបាត។',
            'loan_Amount_Dollar.required_if' => 'សូមបញ្ចូលចំនួនប្រាក់កម្ចីជាដុល្លារ។',
            'interest_Rate_Riel.required_if' => 'សូមបញ្ចូលអត្រាការប្រាក់ជារៀល។',
            'interest_Rate_Baht.required_if' => 'សូមបញ្ចូលអត្រាការប្រាក់ជាបាត។',
            'interest_Rate_Dollar.required_if' => 'សូមបញ្ចូលអត្រាការប្រាក់ជាដុល្លារ។',
            'loan_Term' => 'សូមបញ្ចូលចំនួនខ្ចី។',
            'payment_Amount_Riel.required_if' => 'សូមបញ្ចូលទឹកប្រាក់ដែលត្រូវទូទាត់ជារៀល។',
            'payment_Amount_Baht.required_if' => 'សូមបញ្ចូលទឹកប្រាក់ដែលត្រូវទូទាត់ជាបាត។',
            'payment_Amount_Dollar.required_if' => 'សូមបញ្ចូលទឹកប្រាក់ដែលត្រូវទូទាត់ជាដុល្លារ។',
            'start_Date' => 'សូមបញ្ចូលកាលបរិច្ឆេទដែលចាប់ផ្ដើម។',
            'end_Date' => 'សូមបញ្ចូលកាលបរិច្ឆេទដែលចញ្ចប់។',
        ]);

        // Simplified check based on currency
        if (
            ($request->currency === 'riel' && (!$request->loan_Amount_Riel || !$request->interest_Rate_Riel || !$request->payment_Amount_Riel)) ||
            ($request->currency === 'baht' && (!$request->loan_Amount_Baht || !$request->interest_Rate_Baht || !$request->payment_Amount_Baht)) ||
            ($request->currency === 'dollar' && (!$request->loan_Amount_Dollar || !$request->interest_Rate_Dollar || !$request->payment_Amount_Dollar))
        ) {
            return response()->json([
                'status' => false,
                'errors' => ['loan_amount' => 'សូមបញ្ចូលចំនួនប្រាក់ អត្រាការប្រាក់ និងទឹកប្រាក់ត្រូវទូទាត់សម្រាប់រូបិយប័ណ្ណដែលបានជ្រើសរើស។']
            ]);
        }

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'redirect' => null,
                'errors' => $validator->errors(),
            ]);
        }

        $loans = Loan::find($id);
        if (!$loans) {
            return response()->json([
                'status' => false,
                'redirect' => null,
                'message' => 'មិនមានអតិថិជនក្នុងប្រព័ន្ធនេះ។',
            ], 422);
        }

        $loans->id_client = $request->id_client;
        $loans->currency = $request->currency; // Added currency field
        $loans->loan_Amount_Riel = $request->currency === 'riel' ? $request->loan_Amount_Riel : null;
        $loans->loan_Amount_Baht = $request->currency === 'baht' ? $request->loan_Amount_Baht : null;
        $loans->loan_Amount_Dollar = $request->currency === 'dollar' ? $request->loan_Amount_Dollar : null;
        $loans->interest_Rate_Riel = $request->currency === 'riel' ? $request->interest_Rate_Riel : null;
        $loans->interest_Rate_Baht = $request->currency === 'baht' ? $request->interest_Rate_Baht : null;
        $loans->interest_Rate_Dollar = $request->currency === 'dollar' ? $request->interest_Rate_Dollar : null;
        $loans->loan_Term = $request->loan_Term;
        $loans->payment_Amount_Riel = $request->currency === 'riel' ? $request->payment_Amount_Riel : null;
        $loans->payment_Amount_Baht = $request->currency === 'baht' ? $request->payment_Amount_Baht : null;
        $loans->payment_Amount_Dollar = $request->currency === 'dollar' ? $request->payment_Amount_Dollar : null;
        $loans->start_Date = $request->start_Date;
        $loans->end_Date = $request->end_Date;

        if ($request->hasFile('picture')) {
            $imgPicture = time() . '.' . $request->file('picture')->getClientOriginalExtension();
            $request->file('picture')->move(public_path('/src/assets/uploads/loans/pictures/'), $imgPicture);
            $loans->picture = $imgPicture;
        }

        if ($request->hasFile('video')) {
            $imgVideo = time() . '.' . $request->file('video')->getClientOriginalExtension();
            $request->file('video')->move(public_path('/src/assets/uploads/loans/videos/'), $imgVideo);
            $loans->video = $imgVideo;
        }

        $loans->save();

        // Calculate and save profit
        $loanTerm = $request->loan_Term;

        $profit = Profit::where('id_loan', $loans->id)->first() ?? new Profit();
        $profit->id_loan = $loans->id;
        $profit->profit_Riel = $loans->payment_Amount_Riel * $loanTerm;
        $profit->profit_Dollar = $loans->payment_Amount_Dollar * $loanTerm;
        $profit->profit_Baht = $loans->payment_Amount_Baht * $loanTerm;
        $profit->save();

        session()->flash('success', 'ការកែសម្រួលចងការប្រាក់អតិថិជនរបស់អ្នកទទួលបានជោគជ័យ។');
        return response()->json([
            'status' => true,
            'redirect' => route('application.pages.loans.loan'),
            'errors' => [],
        ]);
    }

    public function deleteLoan($id)
    {
        $loans = Loan::find($id);
        if (!$loans) {
            return redirect()->back()->with('error', 'អតិថិជនមិនមានក្នុងប្រព័ន្ធ។');
        }

        // Delete picture image if it exists
        if ($loans->picture && file_exists(public_path('/src/assets/uploads/loans/pictures/' . $loans->picture))) {
            unlink(public_path('/src/assets/uploads/loans/pictures/' . $loans->picture));
        }

        // Delete video ID image if it exists
        if ($loans->video && file_exists(public_path('/src/assets/uploads/loans/videos/' . $loans->video))) {
            unlink(public_path('/src/assets/uploads/loans/videos/' . $loans->video));
        }

        // Delete the loans record
        $loans->delete();

        return redirect()->back()->with('success', 'អតិថិជនត្រូវបានលុបដោយជោគជ័យ។');
    }

}
