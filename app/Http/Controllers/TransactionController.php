<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\ChartOfAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// EXPORT (FIXED)
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionExport;


class TransactionController extends Controller
{
    /* =========================
       INDEX
    ========================= */
    public function index()
    {
        $transactions = Transaction::with(['chartOfAccount', 'user'])
            ->latest()
            ->paginate(10);

        return view('admin.transactions.index', compact('transactions'));
    }

    /* =========================
       CREATE
    ========================= */
    public function create()
    {
        $coas = ChartOfAccount::all();

        return view('admin.transactions.create', compact('coas'));
    }

    /* =========================
       STORE
    ========================= */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'coa_id' => 'required|exists:chart_of_accounts,id',
            'description' => 'nullable|string|max:255',
            'debit' => 'required|numeric|min:0',
            'credit' => 'required|numeric|min:0',
        ]);

        Transaction::create([
            'date' => $validated['date'],
            'coa_id' => $validated['coa_id'],
            'description' => $validated['description'] ?? null,
            'debit' => $validated['debit'],
            'credit' => $validated['credit'],
            'user_id' => auth()->id(),
        ]);

        return redirect()
            ->route('admin.transactions.index')
            ->with('success', 'Transaction berhasil ditambahkan');
    }

    /* =========================
       SHOW
    ========================= */
    public function show(Transaction $transaction)
    {
        $transaction->load(['chartOfAccount', 'user']);

        return view('admin.transactions.show', compact('transaction'));
    }

    /* =========================
       EDIT
    ========================= */
    public function edit(Transaction $transaction)
    {
        $coas = ChartOfAccount::all();

        return view('admin.transactions.edit', compact('transaction', 'coas'));
    }

    /* =========================
       UPDATE
    ========================= */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'coa_id' => 'required|exists:chart_of_accounts,id',
            'description' => 'nullable|string|max:255',
            'debit' => 'required|numeric|min:0',
            'credit' => 'required|numeric|min:0',
        ]);

        $transaction->update($validated);

        return redirect()
            ->route('admin.transactions.index')
            ->with('success', 'Transaction berhasil diupdate');
    }

    /* =========================
       DELETE
    ========================= */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()
            ->route('admin.transactions.index')
            ->with('success', 'Transaction berhasil dihapus');
    }

   /* =========================
   REPORT (MONTHLY + P&L)
========================= */
public function report(Request $request)
{
    $month = $request->input('month', now()->month);
    $year  = $request->input('year', now()->year);

    // Base query (dipakai ulang biar lebih efisien)
    $baseQuery = Transaction::with('chartOfAccount')
        ->whereMonth('date', $month)
        ->whereYear('date', $year);

    $transactions = (clone $baseQuery)
        ->orderBy('date', 'desc')
        ->get();

    /*
    |--------------------------------------------------------------------------
    | INCOME
    |--------------------------------------------------------------------------
    | Ambil semua transaksi dengan COA type = Income
    */
    $income = (clone $baseQuery)
        ->whereHas('chartOfAccount', function ($q) {
            $q->where('type', 'Income');
        })
        ->sum('credit');

    /*
    |--------------------------------------------------------------------------
    | EXPENSE
    |--------------------------------------------------------------------------
    | Ambil semua transaksi dengan COA type = Expense
    */
    $expense = (clone $baseQuery)
        ->whereHas('chartOfAccount', function ($q) {
            $q->where('type', 'Expense');
        })
        ->sum('debit');

    /*
    |--------------------------------------------------------------------------
    | PROFIT / LOSS
    |--------------------------------------------------------------------------
    */
    $profit = $income - $expense;

    /*
    |--------------------------------------------------------------------------
    | MONTHLY SUMMARY (opsional tambahan)
    |--------------------------------------------------------------------------
    | Bisa dipakai untuk grafik atau summary bulanan
    */
    $monthlySummary = Transaction::select(
            DB::raw('MONTH(date) as month'),
            DB::raw('SUM(credit) as total_income'),
            DB::raw('SUM(debit) as total_expense')
        )
        ->whereYear('date', $year)
        ->groupBy(DB::raw('MONTH(date)'))
        ->orderBy('month')
        ->get()
        ->map(function ($item) {
            $item->profit = $item->total_income - $item->total_expense;
            return $item;
        });

    return view('admin.transactions.report', compact(
        'transactions',
        'month',
        'year',
        'income',
        'expense',
        'profit',
        'monthlySummary'
    ));
}
}