<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexTransactionRequest;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexTransactionRequest $request)
    {
        $query = Transaction::query();

        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }
        if($request->filled('year')){
            $query->whereYear('created_at', $request->input('year'));
        }
        if($request->filled('month')){
            $query->whereMonth('created_at', $request->input('month'));
        }
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->input('start_date'));
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->input('end_date'));
        }
        if($request->filled('search')){
            $searchTerm = $request->input('search');
            $query->where('title', 'like', '%' . $searchTerm . '%');
        }
        $transactions = $query->paginate(10);   
        return response()->json($transactions);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        $transaction = Transaction::create(array_merge($request->all(), ['user_id' => "1"]));
        return response()->json($transaction, 201);

    }

    public function show(Transaction $transaction)
    {
        return Transaction::find($transaction->id)?? abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->all());
        return response()->json($transaction)->status(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return response()->json(null, 204);
    }

    public function resume(){
        $income = Transaction::where('type', 'income')->sum('amount');
        $expense = Transaction::where('type', 'expense')->sum('amount');
        $balance = $income - $expense;

        return response()->json([
            'income' => $income,
            'expense' => $expense,
            'balance' => $balance,
        ]);
    }
}
