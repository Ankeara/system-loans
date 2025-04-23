<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Loan;
use App\Models\Profit;
use App\Models\ReturnLoan;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function clients()
    {
        $clientCount = Client::count();
        $activeClients = Client::where('status', 'active')->count();
        $inactiveClients = Client::where('status', 'inactive')->count();

        return view('application.pages.reports.clients', [
            'clientCount' => $clientCount,
            'activeClients' => $activeClients,
            'inactiveClients' => $inactiveClients
            ,'pageTitle' => 'អតិថិជនទាំងអស់់'
        ]);
    }

    public function loans()
    {
        $loanCount = Loan::count();
        $activeLoans = Loan::where('status', 0)->count();
        $inactiveLoans = Loan::where('status', 1)->count();

        // Adding new counts for currency fields
        $rielAmount = Loan::whereNotNull('loan_Amount_Riel')->sum('loan_Amount_Riel');
        $dollarAmount = Loan::whereNotNull('loan_Amount_Dollar')->sum('loan_Amount_Dollar');
        $bahtAmount = Loan::whereNotNull('loan_Amount_Baht')->sum('loan_Amount_Baht');

        return view('application.pages.reports.loans', [
            'loanCount' => $loanCount,
            'activeLoans' => $activeLoans,
            'inactiveLoans' => $inactiveLoans,
            'rielAmount' => $rielAmount,
            'dollarAmount' => $dollarAmount,
            'bahtAmount' => $bahtAmount
            ,'pageTitle' => 'អតិថិជនដែលបានចងការប្រាក់ទាំងអស់ទាំងអស់'
        ]);
    }

    public function loansHighRiel()
    {

        $highLoanRielCount = Client::whereHas('loans', function ($query) {
            $query->where('loan_Amount_Riel', '>=', 5000000); // Threshold for Riel
        })->count();

        return view('application.pages.reports.loan-high-riel', [
            'highLoanRielCount' => $highLoanRielCount,
            'pageTitle' => 'អតិថិជនដែលបានចងការប្រាក់ខ្ពស់បំផុតជាលុយរៀល'
        ]);
    }

     public function loansHighBaht()
    {
        $highLoanBahtCount = Client::whereHas('loans', function ($query) {
            $query->where('loan_Amount_Baht', '>=', 50000); // Threshold for Baht
        })->count();

        return view('application.pages.reports.loan-high-baht', [
            'highLoanBahtCount' => $highLoanBahtCount,
            'pageTitle' => 'អតិថិជនដែលបានចងការប្រាក់ខ្ពស់បំផុតជាលុយបាត'
        ]);
    }

     public function loansHighDollar()
    {

        $highLoanDollarCount = Client::whereHas('loans', function ($query) {
            $query->where('loan_Amount_Dollar', '>=', 5000000); // Threshold for Dollar
        })->count();

        return view('application.pages.reports.loan-high-dollar', [
            'highLoanDollarCount' => $highLoanDollarCount,
            'pageTitle' => 'អតិថិជនដែលបានចងការប្រាក់ខ្ពស់បំផុតជាលុយដុល្លា'
        ]);
    }

    public function returnLoan()
    {
        $returnLoanCount = ReturnLoan::count();
        $activeReturnLoans = ReturnLoan::where('status_return', 0)->count();
        $inactiveReturnLoans = ReturnLoan::where('status_return', 1)->count();

        // Separate variables for each currency
        $moneyLeftRiel = ReturnLoan::whereNotNull('money_left_Riel')->sum('money_left_Riel');
        $moneyLeftBaht = ReturnLoan::whereNotNull('money_left_Baht')->sum('money_left_Baht');
        $moneyLeftDollar = ReturnLoan::whereNotNull('money_left_Dollar')->sum('money_left_Dollar');

        $moreMoneyRiel = ReturnLoan::whereNotNull('more_money_Riel')->sum('more_money_Riel');
        $moreMoneyBaht = ReturnLoan::whereNotNull('more_money_Baht')->sum('more_money_Baht');
        $moreMoneyDollar = ReturnLoan::whereNotNull('more_money_Dollar')->sum('more_money_Dollar');

        return view('application.pages.reports.return-loan', [
            'returnLoanCount' => $returnLoanCount,
            'activeReturnLoans' => $activeReturnLoans,
            'inactiveReturnLoans' => $inactiveReturnLoans,
            'moneyLeftRiel' => $moneyLeftRiel,
            'moneyLeftBaht' => $moneyLeftBaht,
            'moneyLeftDollar' => $moneyLeftDollar,
            'moreMoneyRiel' => $moreMoneyRiel,
            'moreMoneyBaht' => $moreMoneyBaht,
            'moreMoneyDollar' => $moreMoneyDollar,
            'pageTitle' => 'អតិថិជនដែលបានបកប្រាក់ទាំងអស់ទាំងអស់'
        ]);
    }

    public function profits()
    {
        // Count total profit records
        $profitCount = Profit::count();

        // Sum profit amounts for each currency, excluding null values
        $rielProfit = Profit::whereNotNull('profit_Riel')->sum('profit_Riel');
        $dollarProfit = Profit::whereNotNull('profit_Dollar')->sum('profit_Dollar');
        $bahtProfit = Profit::whereNotNull('profit_Baht')->sum('profit_Baht');

        // Return the data to a view
        return view('application.pages.reports.profits', [
            'profitCount' => $profitCount,
            'rielProfit' => $rielProfit ?? 0,
            'dollarProfit' => $dollarProfit ?? 0,
            'bahtProfit' => $bahtProfit ?? 0
            ,'pageTitle' => 'ចំនួនប្រាក់ចំណេញសរុប',
        ]);
    }
}
