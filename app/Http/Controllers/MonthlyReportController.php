<?php

namespace App\Http\Controllers;

use App\Models\MonthlyReport;
use App\Models\Transaction;
use Illuminate\Http\Request;

class MonthlyReportController extends Controller
{
    /**
     * =========================
     * INDEX
     * =========================
     */
    public function index()
    {
        $reports = MonthlyReport::orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(12);

        return view('admin.monthly-report.index', compact('reports'));
    }

    /**
     * =========================
     * STORE / GENERATE REPORT
     * =========================
     */
    public function store(Request $request)
    {
        $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year'  => 'required|integer|min:2000',
        ]);

        $month = $request->month;
        $year  = $request->year;

        $transactions = Transaction::with('chartOfAccount')
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get();

        // =========================
        // INCOME (credit)
        // =========================
        $income = $transactions->filter(function ($trx) {
            return optional($trx->chartOfAccount)->type === 'income'
                || $trx->credit > 0;
        })->sum('credit');

        // =========================
        // EXPENSE (debit)
        // =========================
        $expense = $transactions->filter(function ($trx) {
            return optional($trx->chartOfAccount)->type === 'expense'
                || $trx->debit > 0;
        })->sum('debit');

        $profit = $income - $expense;

        // =========================
        // SAVE / UPDATE REPORT
        // =========================
        MonthlyReport::updateOrCreate(
            [
                'month' => $month,
                'year'  => $year,
            ],
            [
                'total_income'  => $income,
                'total_expense' => $expense,
                'profit'        => $profit,
                'title'         => "Report {$month}-{$year}",
            ]
        );

        return redirect()
            ->route('admin.monthly-report.index')
            ->with('success', 'Monthly report berhasil digenerate');
    }

    /**
     * =========================
     * SHOW
     * =========================
     */
    public function show(MonthlyReport $monthlyReport)
    {
        $report = $monthlyReport;

        $transactions = Transaction::with('chartOfAccount')
            ->whereMonth('date', $report->month)
            ->whereYear('date', $report->year)
            ->get();

        $incomeTransactions = $transactions->filter(fn ($trx) =>
            optional($trx->chartOfAccount)->type === 'income'
            || $trx->credit > 0
        );

        $expenseTransactions = $transactions->filter(fn ($trx) =>
            optional($trx->chartOfAccount)->type === 'expense'
            || $trx->debit > 0
        );

        return view('admin.monthly-report.show', [
            'report' => $report,
            'transactions' => $transactions,
            'incomeTransactions' => $incomeTransactions,
            'expenseTransactions' => $expenseTransactions,
        ]);
    }

    /**
     * =========================
     * DELETE
     * =========================
     */
    public function destroy(MonthlyReport $monthlyReport)
    {
        $monthlyReport->delete();

        return back()->with('success', 'Report berhasil dihapus');
    }

    /**
     * =========================
     * REGENERATE
     * =========================
     */
    public function regenerate(MonthlyReport $monthlyReport)
    {
        $transactions = Transaction::with('chartOfAccount')
            ->whereMonth('date', $monthlyReport->month)
            ->whereYear('date', $monthlyReport->year)
            ->get();

        $income = $transactions->filter(fn ($trx) =>
            optional($trx->chartOfAccount)->type === 'income'
            || $trx->credit > 0
        )->sum('credit');

        $expense = $transactions->filter(fn ($trx) =>
            optional($trx->chartOfAccount)->type === 'expense'
            || $trx->debit > 0
        )->sum('debit');

        $monthlyReport->update([
            'total_income'  => $income,
            'total_expense' => $expense,
            'profit'        => $income - $expense,
        ]);

        return back()->with('success', 'Report berhasil diregenerate');
    }
}