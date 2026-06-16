<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChartOfAccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FinancialSummaryController;
use App\Http\Controllers\MonthlyReportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontendController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', [FrontendController::class, 'index'])->name('welcome');
Route::get('/coa/chart/{id}', [FrontendController::class, 'coaChart']);
Route::get('/transactions/by-coa/{id}', [FrontendController::class, 'transactionsByCoa']);

/*
|--------------------------------------------------------------------------
| API
|--------------------------------------------------------------------------
*/
Route::get('/api/categories/{id}', function ($id) {
    return \App\Models\Category::findOrFail($id);
})->name('api.categories.show');

/*
|--------------------------------------------------------------------------
| GUEST
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        /*
        | MASTER DATA
        */
        Route::resource('users', UserController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('chart-of-accounts', ChartOfAccountController::class);

        /*
        | TRANSACTIONS
        */
        Route::resource('transactions', TransactionController::class);

        Route::get('/transactions-report', [TransactionController::class, 'report'])
            ->name('transactions.report');

        Route::get('/transactions-print', [TransactionController::class, 'report'])
            ->name('transactions.print');

        Route::get('/transactions/pdf', [TransactionController::class, 'exportPdf'])
            ->name('transactions.pdf');

        Route::get('/transactions/excel', [TransactionController::class, 'exportExcel'])
            ->name('transactions.excel');

        /*
        | MONTHLY REPORT
        */
        Route::resource('monthly-report', MonthlyReportController::class);

        // ✅ FIX: pakai prefix lengkap + name grouping aman
        Route::get('monthly-report/{monthlyReport}/print',
            [MonthlyReportController::class, 'print']
        )->name('monthly-report.print');

        Route::get('monthly-report/{monthlyReport}/pdf',
            [MonthlyReportController::class, 'pdf']
        )->name('monthly-report.pdf');

        Route::get('monthly-report/{monthlyReport}/excel',
            [MonthlyReportController::class, 'excel']
        )->name('monthly-report.excel');


        /*
        | FINANCIAL SUMMARY
        */
        Route::resource('financial-summary', FinancialSummaryController::class);
         Route::get(
            'financial-summary/export/pdf',
            [FinancialSummaryController::class, 'exportPdf']
        )->name('financial-summary.export.pdf');

        Route::get(
            'financial-summary/export/excel',
            [FinancialSummaryController::class, 'exportExcel']
        )->name('financial-summary.export.excel');
        Route::put('/financial-summary/{id}', [FinancialSummaryController::class, 'update'])
    ->name('admin.financial-summary.update');

    });
