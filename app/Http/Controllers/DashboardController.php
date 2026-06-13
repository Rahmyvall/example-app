<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\ChartOfAccount;
use App\Models\MonthlyReport;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // =========================
        // USERS
        // =========================
        $latestUsers = User::latest()->take(5)->get();

        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalActive = User::where('is_active', 1)->count();
        $totalInactive = User::where('is_active', 0)->count();

        // =========================
        // CATEGORY
        // =========================
        $latestCategories = Category::latest()->take(5)->get();
        $totalCategories = Category::count();

        // =========================
        // CHART OF ACCOUNTS (COA)
        // =========================
        $latestCoa = ChartOfAccount::with('category')
            ->latest()
            ->take(5)
            ->get();

        $totalCoa = ChartOfAccount::count();

        // =========================
        // COA BREAKDOWN
        // =========================
        $coaByCategory = ChartOfAccount::selectRaw('categories.name as category_name, COUNT(*) as total')
            ->join('categories', 'categories.id', '=', 'chart_of_accounts.category_id')
            ->groupBy('categories.name')
            ->pluck('total', 'category_name');

        $totalAssets = $coaByCategory['Assets'] ?? 0;
        $totalExpenses = $coaByCategory['Expenses'] ?? 0;
        $totalIncome = $coaByCategory['Income'] ?? 0;
        $totalLiabilities = $coaByCategory['Liabilities'] ?? 0;

        // =========================
        // MONTHLY REPORT (NEW)
        // =========================
        $monthlyReports = MonthlyReport::orderBy('year')
            ->orderBy('month')
            ->get();

        $revenueChart = $monthlyReports->map(function ($r) {
            return [
                'month' => \DateTime::createFromFormat('!m', $r->month)->format('M') . ' ' . $r->year,
                'revenue' => (int) $r->total_income,
                'expense' => (int) $r->total_expense,
                'profit' => (int) $r->profit,
            ];
        });

        $totalRevenueAll = $monthlyReports->sum('total_income');
        $totalExpenseAll = $monthlyReports->sum('total_expense');
        $totalProfitAll = $monthlyReports->sum('profit');

        // =========================
        // RETURN VIEW
        // =========================
        return view('dashboard', [
            'title' => 'Keuangan | Dashboard',

            // users
            'users' => $latestUsers,
            'totalUsers' => $totalUsers,
            'totalAdmins' => $totalAdmins,
            'totalActive' => $totalActive,
            'totalInactive' => $totalInactive,

            // categories
            'categories' => $latestCategories,
            'totalCategories' => $totalCategories,

            // COA
            'coa' => $latestCoa,
            'totalCoa' => $totalCoa,

            // breakdown
            'totalAssets' => $totalAssets,
            'totalExpenses' => $totalExpenses,
            'totalIncome' => $totalIncome,
            'totalLiabilities' => $totalLiabilities,

            // =========================
            // MONTHLY REPORT (NEW)
            // =========================
            'monthlyReports' => $monthlyReports,
            'revenueChart' => $revenueChart,
            'totalRevenueAll' => $totalRevenueAll,
            'totalExpenseAll' => $totalExpenseAll,
            'totalProfitAll' => $totalProfitAll,
        ]);
    }
}