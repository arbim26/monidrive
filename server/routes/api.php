<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PerjalananController;
use App\Http\Controllers\DetailPerjalananController;
use App\Http\Controllers\EmergencyContactController;

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});

Route::apiResource('users', UserController::class);
Route::apiResource('perjalanan', PerjalananController::class);
Route::apiResource('detail-perjalanan', DetailPerjalananController::class);
Route::apiResource('emergency-contact', EmergencyContactController::class);
