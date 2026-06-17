<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\ChartOfAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['chartOfAccount', 'user'])
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('admin.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $coas = ChartOfAccount::orderBy('code', 'asc')->get();

        return view('admin.transactions.create', compact('coas'));
    }

    /* =========================
       STORE (FIXED)
    ========================= */
    public function store(Request $request)
{
    $request->validate([
        'date'        => 'required|date',
        'coa_id'      => 'required|exists:chart_of_accounts,id',
        'description' => 'nullable|string',
        'debit'       => 'nullable|numeric|min:0',
        'credit'      => 'nullable|numeric|min:0',
    ]);

    $debit  = (float) ($request->debit ?? 0);
    $credit = (float) ($request->credit ?? 0);

    // ❗ minimal salah satu harus diisi
    if ($debit == 0 && $credit == 0) {
        return back()->withErrors([
            'debit' => 'Debit atau credit wajib diisi minimal salah satu'
        ])->withInput();
    }

    Transaction::create([
        'date'        => $request->date,
        'coa_id'      => $request->coa_id,
        'description' => $request->description,
        'debit'       => $debit,
        'credit'      => $credit,
        'user_id'     => auth()->id(),
    ]);

    return redirect()->route('admin.transactions.index')
        ->with('success', 'Transaksi berhasil disimpan');
}

    public function show(Transaction $transaction)
    {
        $transaction->load(['chartOfAccount', 'user']);

        return view('admin.transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $coas = ChartOfAccount::orderBy('code', 'asc')->get();

        return view('admin.transactions.edit', compact('transaction', 'coas'));
    }

    /* =========================
       UPDATE (FIXED)
    ========================= */
    public function update(Request $request, Transaction $transaction)
{
    $request->validate([
        'date'        => 'required|date',
        'coa_id'      => 'required|exists:chart_of_accounts,id',
        'description' => 'nullable|string',
        'debit'       => 'nullable|numeric|min:0',
        'credit'      => 'nullable|numeric|min:0',
    ]);

    $debit  = (float) ($request->debit ?? 0);
    $credit = (float) ($request->credit ?? 0);

    if ($debit == 0 && $credit == 0) {
        return back()->withErrors([
            'debit' => 'Debit atau credit wajib diisi minimal salah satu'
        ])->withInput();
    }

    $transaction->update([
        'date'        => $request->date,
        'coa_id'      => $request->coa_id,
        'description' => $request->description,
        'debit'       => $debit,
        'credit'      => $credit,
    ]);

    return redirect()->route('admin.transactions.index')
        ->with('success', 'Transaksi berhasil diupdate');
}

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()
            ->route('admin.transactions.index')
            ->with('success', 'Transaksi berhasil dihapus');
    }

    public function report(Request $request)
    {
        $month = $request->month ?? now()->month;
        $year  = $request->year ?? now()->year;

        $transactions = Transaction::with('chartOfAccount')
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->orderBy('date', 'desc')
            ->get();

        $totalDebit = $transactions->sum('debit');
        $totalCredit = $transactions->sum('credit');

        $monthlySummary = Transaction::select(
                DB::raw('MONTH(date) as month'),
                DB::raw('SUM(debit) as total_debit'),
                DB::raw('SUM(credit) as total_credit')
            )
            ->whereYear('date', $year)
            ->groupBy(DB::raw('MONTH(date)'))
            ->orderBy('month')
            ->get();

        return view('admin.transactions.report', compact(
            'transactions',
            'month',
            'year',
            'totalDebit',
            'totalCredit',
            'monthlySummary'
        ));
    }
}
