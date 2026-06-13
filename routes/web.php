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
| HOME (LANDING PAGE)
|--------------------------------------------------------------------------
*/
Route::get('/', [FrontendController::class, 'index'])->name('welcome');
Route::get('/coa/chart/{id}', [FrontendController::class, 'coaChart']);
Route::get('/transactions/by-coa/{id}', [FrontendController::class, 'transactionsByCoa']);


/*
|--------------------------------------------------------------------------
| AJAX API ROUTES (FIX IMPORTANT)
|--------------------------------------------------------------------------
*/
Route::get('/api/categories/{id}', function ($id) {
    return \App\Models\Category::findOrFail($id);
})->name('api.categories.show');


/*
|--------------------------------------------------------------------------
| GUEST ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::post('/register', [AuthController::class, 'register'])->name('register');
});


/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
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

        /*
        | REPORTS
        */
        Route::get('/transactions-report', [TransactionController::class, 'report'])
            ->name('transactions.report');

        Route::get('/transactions-print', [TransactionController::class, 'report'])
            ->name('transactions.print');

        /*
        | EXPORTS
        */
        Route::get('/transactions/pdf', [TransactionController::class, 'exportPdf'])
            ->name('transactions.pdf');

        Route::get('/transactions/excel', [TransactionController::class, 'exportExcel'])
            ->name('transactions.excel');

        /*
        | FINANCIAL REPORTS
        */
        Route::resource('monthly-report', MonthlyReportController::class);

        Route::resource('financial-summary', FinancialSummaryController::class);
    });
