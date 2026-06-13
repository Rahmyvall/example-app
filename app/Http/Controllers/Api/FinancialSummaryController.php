<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FinancialSummary;

class FinancialSummaryController extends Controller
{
    // =========================
    // GET ALL
    // =========================
    public function index()
    {
        $data = FinancialSummary::latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'List financial summary',
            'data' => $data
        ]);
    }

    // =========================
    // STORE
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'amount_2022_01' => 'nullable|integer',
            'amount_2022_02' => 'nullable|integer',
            'amount_2022_03' => 'nullable|integer',
        ]);

        $data = FinancialSummary::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data created successfully',
            'data' => $data
        ], 201);
    }

    // =========================
    // SHOW
    // =========================
    public function show($id)
    {
        $data = FinancialSummary::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    // =========================
    // UPDATE
    // =========================
    public function update(Request $request, $id)
    {
        $data = FinancialSummary::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found'
            ], 404);
        }

        $request->validate([
            'category' => 'required|string',
            'amount_2022_01' => 'nullable|integer',
            'amount_2022_02' => 'nullable|integer',
            'amount_2022_03' => 'nullable|integer',
        ]);

        $data->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data updated successfully',
            'data' => $data
        ]);
    }

    // =========================
    // DELETE
    // =========================
    public function destroy($id)
    {
        $data = FinancialSummary::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found'
            ], 404);
        }

        $data->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data deleted successfully'
        ]);
    }
}