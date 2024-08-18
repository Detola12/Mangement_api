<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function (){
    $test = \App\Models\Transaction::with('customer')->get();

    foreach ($test as $key => $item){
        dd($key);
    }

});

Route::post('/initiateTransaction', [\App\Http\Controllers\TransactionController::class, 'initiateTransaction']);
Route::post('/makePayment', [\App\Http\Controllers\TransactionController::class, 'makePayment']);

Route::post('/getCustomerTransaction', [\App\Http\Controllers\TransactionController::class, 'getAllCustomerTransaction']);
