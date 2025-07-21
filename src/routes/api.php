<?php

use App\Http\Controllers\Api\TransactionApiController;

Route::get('/transactions', [TransactionApiController::class, 'index']);
Route::post('/transactions', [TransactionApiController::class, 'store']);
Route::get('/transactions/{id}', [TransactionApiController::class, 'show']);
Route::put('/transactions/{id}', [TransactionApiController::class, 'update']);
Route::delete('/transactions/{id}', [TransactionApiController::class, 'destroy']);
