<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\IndexTransactionRequest;
use App\Http\Requests\V1\StoreTransactionRequest;
use App\Http\Requests\V1\UpdateTransactionRequest;
use App\Http\Resources\TransactionCollection;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexTransactionRequest $request)
    {
       $transactions = Transaction::where('user_id', '=', '2')->get();
       return new TransactionCollection($transactions);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        

        $transaction = Transaction::create(array_merge($request->all(), ['user_id' => '1', 'account_id' => '1']));

        return response()->json($transaction, 201);

    }

    public function show(Transaction $transaction)
    {
        return Transaction::find($transaction->id) ?? abort(404);
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

}
