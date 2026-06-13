<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionApiController extends Controller
{
    // ======================
    // GET ALL
    // ======================
    public function index()
    {
        $data = Transaction::with(['chartOfAccount', 'user'])
            ->orderBy('date', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'List transactions',
            'data' => $data
        ]);
    }

    // ======================
    // STORE
    // ======================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'coa_id' => 'required|exists:chart_of_accounts,id',
            'description' => 'nullable|string',
            'debit' => 'required|numeric',
            'credit' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $transaction = Transaction::create([
            'date' => $request->date,
            'coa_id' => $request->coa_id,
            'description' => $request->description,
            'debit' => $request->debit,
            'credit' => $request->credit,
            'user_id' => $request->user_id ?? null,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Transaction created',
            'data' => $transaction
        ]);
    }

    // ======================
    // SHOW
    // ======================
    public function show($id)
    {
        $transaction = Transaction::with(['chartOfAccount', 'user'])->find($id);

        if (!$transaction) {
            return response()->json([
                'status' => false,
                'message' => 'Not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $transaction
        ]);
    }

    // ======================
    // UPDATE
    // ======================
    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'status' => false,
                'message' => 'Not found'
            ], 404);
        }

        $transaction->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Updated successfully',
            'data' => $transaction
        ]);
    }

    // ======================
    // DELETE
    // ======================
    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'status' => false,
                'message' => 'Not found'
            ], 404);
        }

        $transaction->delete();

        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully'
        ]);
    }

    // ======================
    // REPORT
    // ======================
    public function report()
    {
        $data = Transaction::with('chartOfAccount')
            ->orderBy('date', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'total_debit' => $data->sum('debit'),
            'total_credit' => $data->sum('credit'),
            'data' => $data
        ]);
    }
}