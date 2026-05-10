<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

// Public
Route::post('/login', [ApiController::class, 'login']);
Route::post('/register', [ApiController::class, 'register']);

// Protégées
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout',   [ApiController::class, 'logout']);
    Route::get('/dashboard', [ApiController::class, 'dashboard']);
});