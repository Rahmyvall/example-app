<?php

namespace App\Http\Controllers;

use App\Models\FinancialSummary;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FinancialSummaryExport;

class FinancialSummaryController extends Controller
{
    public function index()
    {
        $reports = FinancialSummary::paginate(10);

        $chartData = $reports->map(function ($item) {
            return [
                'category' => $item->category,
                'amount_2022_01' => (int) $item->amount_2022_01,
                'amount_2022_02' => (int) $item->amount_2022_02,
                'amount_2022_03' => (int) $item->amount_2022_03,
            ];
        });

        return view('admin.financial-summary.index', compact('reports', 'chartData'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'amount_2022_01' => 'nullable|numeric',
            'amount_2022_02' => 'nullable|numeric',
            'amount_2022_03' => 'nullable|numeric',
        ]);

        FinancialSummary::create([
            'category' => $validated['category'],
            'amount_2022_01' => $validated['amount_2022_01'] ?? 0,
            'amount_2022_02' => $validated['amount_2022_02'] ?? 0,
            'amount_2022_03' => $validated['amount_2022_03'] ?? 0,
        ]);

        return redirect()
            ->route('admin.financial-summary.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function show(FinancialSummary $financialSummary)
    {
        return view('admin.financial-summary.show', [
            'report' => $financialSummary
        ]);
    }

    public function update(Request $request, FinancialSummary $financialSummary)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'amount_2022_01' => 'nullable|numeric',
            'amount_2022_02' => 'nullable|numeric',
            'amount_2022_03' => 'nullable|numeric',
        ]);

        $financialSummary->update([
            'category' => $validated['category'],
            'amount_2022_01' => $validated['amount_2022_01'] ?? 0,
            'amount_2022_02' => $validated['amount_2022_02'] ?? 0,
            'amount_2022_03' => $validated['amount_2022_03'] ?? 0,
        ]);

        return redirect()
            ->route('admin.financial-summary.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy(FinancialSummary $financialSummary)
    {
        $financialSummary->delete();

        return redirect()
            ->route('admin.financial-summary.index')
            ->with('success', 'Data berhasil dihapus');
    }

    public function exportPdf()
    {
        $reports = FinancialSummary::all();

        $pdf = Pdf::loadView('admin.financial-summary.pdf', compact('reports'));

        return $pdf->download('financial-summary.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(
            new FinancialSummaryExport(),
            'financial-summary.xlsx'
        );
    }
}
