<?php

namespace App\Http\Controllers;

use App\Models\Profit;
use Illuminate\Http\Request;

class ProfitController extends Controller
{
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
        ]);
    }
}