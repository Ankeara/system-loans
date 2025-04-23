<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EndLoanController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ReturnLoanController;
use App\Models\Payment;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['admin'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/application/admin/register', [AuthController::class, 'registation'])->name('application.pages.auth.register');
        Route::post('/application/admin/process-registration', [AuthController::class, 'processRegistration'])->name('application.pages.auth.process-registration');
        Route::get('/', [AuthController::class, 'login'])->name('application.pages.auth.login');
        Route::post('/application/admin/authenticate', [AuthController::class, 'authenticate'])->name('application.pages.auth.authenticate');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/application/admin/dashboard', [DashboardController::class, 'dashboard'])->name('application.pages.dashboard');
        Route::get('/application/admin/logout', [AuthController::class, 'logout'])->name('application.admin.logout');
        // Clients
        Route::get('/application/admin/client', [ClientController::class, 'clients'])->name('application.pages.clients.clients');
        Route::get('/application/admin/client/add', [ClientController::class, 'addClient'])->name('application.pages.clients.add-client');
        Route::post('/application/admin/client/save', [ClientController::class, 'saveClient'])->name('application.pages.clients.save-client');
        Route::get('/application/admin/client/view/{id}', [ClientController::class, 'viewClient'])->name('application.pages.clients.view-client');
        Route::get('/application/admin/client/edit/{id}', [ClientController::class, 'editClient'])->name('application.pages.clients.edit-client');
        Route::post('/application/admin/client/update/{id}', [ClientController::class, 'updateClient'])->name('application.pages.clients.update-client');
        Route::post('/application/admin/client/delete/{id}', [ClientController::class, 'deleteClient'])->name('application.pages.clients.delete-client');

        // Loans
        Route::get('/application/admin/loan', [LoanController::class, 'loans'])->name('application.pages.loans.loan');
        Route::get('/application/admin/loan-riel', [LoanController::class, 'loansRiel'])->name('application.pages.loans.loan-riel');
        Route::get('/application/admin/loan-baht', [LoanController::class, 'loansBaht'])->name('application.pages.loans.loan-baht');
        Route::get('/application/admin/loan-dollar', [LoanController::class, 'loansDollar'])->name('application.pages.loans.loan-dollar');
        Route::get('/application/admin/loan/add', [LoanController::class, 'addLoan'])->name('application.pages.loans.add-loan');
        Route::post('/application/admin/loan/save', [LoanController::class, 'saveLoan'])->name('application.pages.loans.save-loan');
        Route::get('/application/admin/loan/view/{id}', [LoanController::class, 'viewLoan'])->name('application.pages.loans.view-loan');
        Route::get('/application/admin/loan/edit/{id}', [LoanController::class, 'editLoan'])->name('application.pages.loans.edit-loan');
        Route::post('/application/admin/loan/update/{id}', [LoanController::class, 'updateLoan'])->name('application.pages.loans.update-loan');
        Route::post('/application/admin/loan/delete/{id}', [LoanController::class, 'deleteLoan'])->name('application.pages.loans.delete-loan');

        // Payment
        Route::get('/application/admin/payment', [PaymentController::class, 'payment'])->name('application.pages.payments.payment-loan');
        Route::post('/application/admin/save-payment', [PaymentController::class, 'savePayment'])->name('application.pages.payments.save-payment');
        Route::get('/application/admin/payments/loan-detail/{loan}', [PaymentController::class, 'loanDetail'])->name('application.pages.payments.loan-detail');
        Route::get('/application/admin/paid-payment-loans', [PaymentController::class, 'paidPaymentLoans'])->name('paid.payment.loans');
        Route::get('/application/admin/not-paid-payment-loans', [PaymentController::class, 'notPaidPaymentLoans'])->name('not.paid.payment.loans');
        Route::post('/application/admin/payments/loan-detail-update/{loan}', [PaymentController::class, 'updatePaymentSchedule'])->name('application.pages.payments.update-schedule');

        // Return
        Route::get('/application/admin/return/return-loan', [ReturnLoanController::class, 'returnLoan'])->name('application.pages.return-loans.return-loan');
        Route::get('/application/admin/return/return-loan-riel', [ReturnLoanController::class, 'returnLoanRiel'])->name('application.pages.return-loans.return-loan-riel');
        Route::get('/application/admin/return/return-loan-baht', [ReturnLoanController::class, 'returnLoanBaht'])->name('application.pages.return-loans.return-loan-baht');
        Route::get('/application/admin/return/return-loan-dollar', [ReturnLoanController::class, 'returnLoanDollar'])->name('application.pages.return-loans.return-loan-dollar');
        Route::get('/application/admin/return/add-return-loan', [ReturnLoanController::class, 'addReturnLoan'])->name('application.pages.return-loans.add-return-loan');
        Route::get('/application/admin/return/view-return-loan/{id}', [ReturnLoanController::class, 'viewReturnLoan'])->name('application.pages.return-loans.view-loan');
        Route::post('/save-return-loan', [ReturnLoanController::class, 'saveReturnLoan'])->name('save.return.loan');

        // End Loan
        Route::get('/application/admin/end/end-loan', [EndLoanController::class, 'endLoan'])->name('application.pages.end-loans.end-loan');
        Route::get('/application/admin/end/end-loan-paid', [EndLoanController::class, 'endLoanPaid'])->name('application.pages.end-loans.end-loan-paid');
        Route::get('/application/admin/end/end-loan-pending', [EndLoanController::class, 'endLoanPending'])->name('application.pages.end-loans.end-loan-pending');
        Route::get('/application/admin/end/view-end-loan/{id}', [EndLoanController::class, 'viewEndLoan'])->name('application.pages.end-loans.view-end-loan');

        // Reports
        Route::get('/application/admin/reports/profits', [ReportsController::class, 'profits'])->name('application.pages.reports.profits');
        Route::get('/application/admin/reports/clients', [ReportsController::class, 'clients'])->name('application.pages.reports.clients');
        Route::get('/application/admin/reports/loans', [ReportsController::class, 'loans'])->name('application.pages.reports.loans');
        Route::get('/application/admin/reports/loan-high-riel', [ReportsController::class, 'loansHighRiel'])->name('application.pages.reports.loan-high-riel');
        Route::get('/application/admin/reports/loan-high-baht', [ReportsController::class, 'loansHighBaht'])->name('application.pages.reports.loan-high-baht');
        Route::get('/application/admin/reports/loan-high-dollar', [ReportsController::class, 'loansHighDollar'])->name('application.pages.reports.loan-high-dollar');
        Route::get('/application/admin/reports/return-loan', [ReportsController::class, 'returnLoan'])->name('application.pages.reports.return-loan');
    });

});