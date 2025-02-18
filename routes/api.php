<?php

use App\Http\Controllers\ApiWaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/wa/{target}/{message}',[ ApiWaController::class, 'sendWa'])->name('sendWa');
