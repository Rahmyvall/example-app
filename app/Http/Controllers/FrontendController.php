<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ChartOfAccount;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB; // 🔥 FIX WAJIB

class FrontendController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();

        $accounts = ChartOfAccount::with('category')
            ->orderBy('code')
            ->get();

        $transactions = Transaction::with('coa')
            ->latest('transaction_date')
            ->take(10)
            ->get();

        return view('welcome', compact(
            'categories',
            'accounts',
            'transactions'
        ));
    }

    public function coaChart($id)
    {
        $account = ChartOfAccount::with('category')->findOrFail($id);

        // =========================
        // 🔥 REAL CHART DATA FIX
        // =========================
        $realData = Transaction::selectRaw('
                DATE_FORMAT(transaction_date, "%Y-%m") as month_key,
                DATE_FORMAT(transaction_date, "%b %Y") as month,
                SUM(debit) as total_debit,
                SUM(credit) as total_credit
            ')
            ->where('coa_id', $id)
            ->groupBy('month_key', 'month')
            ->orderBy('month_key')
            ->get()
            ->map(function ($item) {
                return [
                    'month' => $item->month,
                    'total' => (float) $item->total_debit - (float) $item->total_credit
                ];
            });

        // =========================
        // fallback dummy
        // =========================
        $dummyData = collect([
            ['month' => 'Jan', 'total' => rand(10, 100)],
            ['month' => 'Feb', 'total' => rand(10, 100)],
            ['month' => 'Mar', 'total' => rand(10, 100)],
            ['month' => 'Apr', 'total' => rand(10, 100)],
            ['month' => 'May', 'total' => rand(10, 100)],
            ['month' => 'Jun', 'total' => rand(10, 100)],
        ]);

        return response()->json([
            'account' => [
                'id' => $account->id,
                'name' => $account->name,
                'code' => $account->code,
                'category' => optional($account->category)->name,
            ],

            // 🔥 PRIORITAS REAL DATA
            'data' => $realData->count() > 0 ? $realData : $dummyData
        ]);
    }
}
