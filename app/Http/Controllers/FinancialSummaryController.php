<?php

namespace App\Http\Controllers;

use App\Models\FinancialSummary;
use Illuminate\Http\Request;

class FinancialSummaryController extends Controller
{
    /**
     * =========================
     * INDEX
     * =========================
     */
    public function index()
    {
        $reports = FinancialSummary::orderBy('category', 'asc')
            ->paginate(12);

        return view('admin.financial-summary.index', compact('reports'));
    }

    /**
     * =========================
     * STORE
     * =========================
     */
    public function store(Request $request)
    {
        $request->validate([
            'category'        => 'required|string',
            'amount_2022_01'  => 'nullable|integer',
            'amount_2022_02'  => 'nullable|integer',
            'amount_2022_03'  => 'nullable|integer',
        ]);

        FinancialSummary::create([
            'category'        => $request->category,
            'amount_2022_01'  => $request->amount_2022_01 ?? 0,
            'amount_2022_02'  => $request->amount_2022_02 ?? 0,
            'amount_2022_03'  => $request->amount_2022_03 ?? 0,
        ]);

        return redirect()
            ->route('admin.financial-summary.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * =========================
     * SHOW
     * =========================
     */
    public function show(FinancialSummary $financialSummary)
    {
        return view('admin.financial-summary.show', [
            'report' => $financialSummary
        ]);
    }

    /**
     * =========================
     * UPDATE
     * =========================
     */
    public function update(Request $request, FinancialSummary $financialSummary)
    {
        $request->validate([
            'category'        => 'nullable|string',
            'amount_2022_01'  => 'nullable|integer',
            'amount_2022_02'  => 'nullable|integer',
            'amount_2022_03'  => 'nullable|integer',
        ]);

        $financialSummary->update($request->only([
            'category',
            'amount_2022_01',
            'amount_2022_02',
            'amount_2022_03',
        ]));

        return back()->with('success', 'Data berhasil diupdate');
    }

    /**
     * =========================
     * DELETE
     * =========================
     */
    public function destroy(FinancialSummary $financialSummary)
    {
        $financialSummary->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}