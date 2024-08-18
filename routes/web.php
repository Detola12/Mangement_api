<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    dd(\App\Models\Product::find(1));
});

Route::get('/d', [\App\Http\Controllers\ProductController::class, 'getAllProducts']);
