<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChartOfAccount;
use Illuminate\Http\Request;

class ChartOfAccountApiController extends Controller
{
    // ======================
    // GET ALL COA
    // ======================
    public function index()
    {
        $data = ChartOfAccount::with('category')
            ->latest()
            ->paginate(10);

        return response()->json([
            'status' => true,
            'message' => 'List Chart of Accounts',
            'data' => $data
        ]);
    }

    // ======================
    // CREATE COA
    // ======================
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:chart_of_accounts,code',
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $coa = ChartOfAccount::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'COA created successfully',
            'data' => $coa->load('category')
        ]);
    }

    // ======================
    // SHOW COA
    // ======================
    public function show($id)
    {
        $coa = ChartOfAccount::with('category')->find($id);

        if (!$coa) {
            return response()->json([
                'status' => false,
                'message' => 'COA not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $coa
        ]);
    }

    // ======================
    // UPDATE COA
    // ======================
    public function update(Request $request, $id)
    {
        $coa = ChartOfAccount::find($id);

        if (!$coa) {
            return response()->json([
                'status' => false,
                'message' => 'COA not found'
            ], 404);
        }

        $request->validate([
            'code' => 'required|unique:chart_of_accounts,code,' . $id,
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $coa->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'COA updated successfully',
            'data' => $coa->load('category')
        ]);
    }

    // ======================
    // DELETE COA
    // ======================
    public function destroy($id)
    {
        $coa = ChartOfAccount::find($id);

        if (!$coa) {
            return response()->json([
                'status' => false,
                'message' => 'COA not found'
            ], 404);
        }

        $coa->delete();

        return response()->json([
            'status' => true,
            'message' => 'COA deleted successfully'
        ]);
    }
}