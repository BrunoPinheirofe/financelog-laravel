<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
// Register explicit routes before the resource to avoid collisions with
// the `{transaction}` route-model-binding parameter (e.g. 'resume').
Route::get('/transactions/resume', [TransactionController::class, 'resume'])->name('transactions.resume');
Route::resource('transactions', TransactionController::class);