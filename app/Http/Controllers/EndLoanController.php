<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\EndLoan;
use App\Models\Loan;
use Illuminate\Http\Request;

class EndLoanController extends Controller
{
    public function endLoan()
    {
        $loan = Loan::with(['client'])->get();
        $client = Client::all();
        $endLoans = EndLoan::with(['loan.client'])->get();
        return view('./application/pages/end-loans/end-loan', ['endLoans' => $endLoans,'loan' => $loan, 'client' => $client ,'pageTitle' => 'អតិថិជនដែលបានបង់បញ្ចប់ទាំងអស់',]);
    }

    public function endLoanPaid()
    {
        $loan = Loan::with(['client'])->get();
        $client = Client::all();
        $endLoans = EndLoan::with(['loan.client'])->where('status', 'Paid')->get();
        return view('./application/pages/end-loans/end-loan-paid', ['endLoans' => $endLoans,'loan' => $loan, 'client' => $client, 'pageTitle' => 'អតិថិជនបានបង់បញ្ចប់ដោយការបង់ប្រាក់']);
    }

    public function endLoanPending()
    {
        $loan = Loan::with(['client'])->get();
        $client = Client::all();
        $endLoans = EndLoan::with(['loan.client'])->where( 'status','Pending')->get();
        return view('./application/pages/end-loans/end-loan-pending', ['endLoans' => $endLoans,'loan' => $loan, 'client' => $client, 'pageTitle' => 'អតិថិជនបានបង់បញ្ចប់ដោយចងការប្រាក់']);
    }

    public function viewendLoan($id)
    {
        $endLoanView = endLoan::with(['loan.client'])->find($id);
        $loan = Loan::with(['client'])->get();
        $client = Client::all();
        if($endLoanView == null) {
            abort(404);
        }
        return view('./application/pages/end-loans/view-end-loan', ['endLoanView' => $endLoanView, 'loan' => $loan, 'client' => $client , 'pageTitle' => 'កែសម្រួលអតិថិជនឈ្មោះ '. $endLoanView->loan->client->full_Name,]);
    }
}
