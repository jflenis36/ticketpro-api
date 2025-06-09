<?php

/*
--------------------------------------------------------------------------
| API Authentication Routes
--------------------------------------------------------------------------
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::prefix('auth')->group(function () {
    // Ruta para registrar nuevos usuarios
    Route::post('/register', [AuthController::class, 'register']);
    
    // Ruta para iniciar sesión
    Route::post('/login', [AuthController::class, 'login']);
    
    // Ruta para cerrar sesión (requiere autenticación)
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
});