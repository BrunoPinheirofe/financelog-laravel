<?php

use App\Http\Controllers\Api\V1\TransactionController;
use Illuminate\Support\Facades\Route;


Route::resource('transactions', TransactionController::class);
