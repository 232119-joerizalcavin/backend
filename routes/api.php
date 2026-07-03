<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GerbongController;
use App\Http\Controllers\BarangKargoController;
use App\Http\Controllers\TokenController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes (tidak perlu authentication)
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Protected routes (memerlukan authentication JWT)
Route::middleware('auth:api')->group(function () {
    // Auth routes
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/profile', [AuthController::class, 'profile']);
    Route::get('/auth/me', [AuthController::class, 'me']);

    // Token management routes
    Route::get('/tokens', [TokenController::class, 'index']);
    Route::get('/tokens/current', [TokenController::class, 'current']);
    Route::delete('/tokens/{tokenId}', [TokenController::class, 'revoke']);
    Route::post('/tokens/revoke-all', [TokenController::class, 'revokeAll']);

    // Gerbong routes - special routes harus sebelum resource routes
    Route::get('/gerbongs/with-cargo', [GerbongController::class, 'withCargo']);
    Route::get('/gerbongs/empty', [GerbongController::class, 'empty']);
    Route::apiResource('gerbongs', GerbongController::class);

    // Barang Kargo routes - special routes harus sebelum resource routes
    Route::get('/barang-kargos/by-gerbong/{gerbongId}', [BarangKargoController::class, 'byGerbong']);
    Route::get('/barang-kargos/by-status/{status}', [BarangKargoController::class, 'byStatus']);
    Route::apiResource('barang-kargos', BarangKargoController::class);
});

// Health check
Route::get('/health', function () {
    return response()->json(['status' => 'OK', 'timestamp' => now()], 200);
});
