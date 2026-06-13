<?php

namespace App\Http\Controllers;

use App\Models\ChartOfAccount;
use App\Models\Category;
use Illuminate\Http\Request;

class ChartOfAccountController extends Controller
{
    /**
     * LIST COA
     */
    public function index()
    {
        $coas = ChartOfAccount::with('category')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.chart_of_accounts.index', [
            'coas' => $coas,
            'title' => 'Chart of Accounts'
        ]);
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        // ambil code terakhir
        $lastCode = ChartOfAccount::max('code');

        // kalau belum ada data
        $nextCode = $lastCode ? intval($lastCode) + 1 : 101;

        return view('admin.chart_of_accounts.create', [
            'categories' => $categories,
            'title' => 'Tambah COA',
            'nextCode' => $nextCode
        ]);
    }

    /**
     * STORE COA
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:20|unique:chart_of_accounts,code',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        ChartOfAccount::create($validated);

        return redirect()
            ->route('admin.chart-of-accounts.index')
            ->with('success', 'Chart of Account berhasil ditambahkan');
    }

    /**
     * DETAIL COA
     */
    public function show(ChartOfAccount $chartOfAccount)
    {
        $chartOfAccount->load('category');

        return view('admin.chart_of_accounts.show', [
            'coa' => $chartOfAccount,
            'title' => 'Detail COA'
        ]);
    }

    /**
     * FORM EDIT
     */
    public function edit(ChartOfAccount $chartOfAccount)
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.chart_of_accounts.edit', [
            'coa' => $chartOfAccount,
            'categories' => $categories,
            'title' => 'Edit COA'
        ]);
    }

    /**
     * UPDATE COA
     */
    public function update(Request $request, ChartOfAccount $chartOfAccount)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:20|unique:chart_of_accounts,code,' . $chartOfAccount->id,
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $chartOfAccount->update($validated);

        return redirect()
            ->route('admin.chart-of-accounts.index')
            ->with('success', 'Chart of Account berhasil diupdate');
    }

    /**
     * DELETE COA (SAFE VERSION)
     */
    public function destroy(ChartOfAccount $chartOfAccount)
    {
        // optional safety check
        if (!$chartOfAccount) {
            return redirect()
                ->back()
                ->with('error', 'Data COA tidak ditemukan');
        }

        // delete
        $chartOfAccount->delete();

        return redirect()
            ->route('admin.chart-of-accounts.index')
            ->with('success', 'Chart of Account berhasil dihapus');
    }
}
