<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MonthlyReport;
use Illuminate\Http\Request;

class MonthlyReportController extends Controller
{
    /**
     * GET /api/monthly-reports
     */
    public function index()
    {
        $reports = MonthlyReport::orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Data laporan bulanan',
            'data' => $reports
        ]);
    }

    /**
     * POST /api/monthly-reports
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer',
            'total_income' => 'required|numeric|min:0',
            'total_expense' => 'required|numeric|min:0',
        ]);

        $validated['profit'] =
            $validated['total_income']
            - $validated['total_expense'];

        $report = MonthlyReport::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil dibuat',
            'data' => $report
        ], 201);
    }

    /**
     * GET /api/monthly-reports/{id}
     */
    public function show($id)
    {
        $report = MonthlyReport::find($id);

        if (!$report) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $report
        ]);
    }

    /**
     * PUT /api/monthly-reports/{id}
     */
    public function update(Request $request, $id)
    {
        $report = MonthlyReport::find($id);

        if (!$report) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer',
            'total_income' => 'required|numeric|min:0',
            'total_expense' => 'required|numeric|min:0',
        ]);

        $validated['profit'] =
            $validated['total_income']
            - $validated['total_expense'];

        $report->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil diperbarui',
            'data' => $report
        ]);
    }

    /**
     * DELETE /api/monthly-reports/{id}
     */
    public function destroy($id)
    {
        $report = MonthlyReport::find($id);

        if (!$report) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $report->delete();

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil dihapus'
        ]);
    }
}
