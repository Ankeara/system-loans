<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\EndLoan;
use App\Models\Loan;
use App\Models\Profit;
use App\Models\ReturnLoan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Total number of clients
        $clientCount = Client::count();

        // Total number of loans
        $loanCount = Loan::count();

        $loanPaymentAmountRiel = Loan::whereNotNull('payment_Amount_Riel')->sum('payment_Amount_Riel');
        $loanPaymentAmountBaht = Loan::whereNotNull('payment_Amount_Baht')->sum('payment_Amount_Baht');
        $loanPaymentAmountDollar = Loan::whereNotNull('payment_Amount_Dollar')->sum('payment_Amount_Dollar');

        // Count of clients with high loans in Riel
        $highLoanRielCount = Client::whereHas('loans', function ($query) {
            $query->where('loan_Amount_Riel', '>=', 5000000); // Threshold for Riel
        })->count();

        // Count of clients with high loans in Baht
        $highLoanBahtCount = Client::whereHas('loans', function ($query) {
            $query->where('loan_Amount_Baht', '>=', 50000); // Threshold for Baht
        })->count();

        // Count of clients with high loans in Dollar
        $highLoanDollarCount = Client::whereHas('loans', function ($query) {
            $query->where('loan_Amount_Dollar', '>=', 3000); // Threshold for Dollar
        })->count();

        $returnLoans = ReturnLoan::count();
        $endLoans = EndLoan::count();
        $profitCount = Profit::count();

        // Sum profit amounts for each currency, excluding null values
        $rielProfit = Profit::whereNotNull('profit_Riel')->sum('profit_Riel');
        $dollarProfit = Profit::whereNotNull('profit_Dollar')->sum('profit_Dollar');
        $bahtProfit = Profit::whereNotNull('profit_Baht')->sum('profit_Baht');

        // Pass the counts to the view using compact()
        return view('application.pages.dashboard', compact(
            'clientCount',
            'loanCount',
            'loanPaymentAmountRiel',
            'loanPaymentAmountBaht',
            'loanPaymentAmountDollar',
            'highLoanRielCount',
            'highLoanBahtCount',
            'highLoanDollarCount',
            'returnLoans',
            'endLoans',
            'profitCount',
            'rielProfit',
            'dollarProfit',
            'bahtProfit'
        ));
    }
}