<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ChartOfAccountApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransactionApiController;
use App\Http\Controllers\Api\FinancialSummaryController;
use App\Http\Controllers\Api\UserApiController;

Route::prefix('v1')->group(function () {

    Route::apiResource('users', UserApiController::class);
    Route::apiResource('categories', CategoryController::class);
});
Route::prefix('coa')->group(function () {
    Route::get('/', [ChartOfAccountApiController::class, 'index']);
    Route::post('/', [ChartOfAccountApiController::class, 'store']);
    Route::get('/{id}', [ChartOfAccountApiController::class, 'show']);
    Route::put('/{id}', [ChartOfAccountApiController::class, 'update']);
    Route::delete('/{id}', [ChartOfAccountApiController::class, 'destroy']);
});

Route::prefix('transactions')->group(function () {
    Route::get('/', [TransactionApiController::class, 'index']);
    Route::post('/', [TransactionApiController::class, 'store']);
    Route::get('/{id}', [TransactionApiController::class, 'show']);
    Route::put('/{id}', [TransactionApiController::class, 'update']);
    Route::delete('/{id}', [TransactionApiController::class, 'destroy']);

    // report
    Route::get('/report/all', [TransactionApiController::class, 'report']);
});
Route::prefix('financial-summary')->group(function () {
    Route::get('/', [FinancialSummaryController::class, 'index']);
    Route::post('/', [FinancialSummaryController::class, 'store']);
    Route::get('/{id}', [FinancialSummaryController::class, 'show']);
    Route::put('/{id}', [FinancialSummaryController::class, 'update']);
    Route::delete('/{id}', [FinancialSummaryController::class, 'destroy']);
});