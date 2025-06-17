<?php

/*
--------------------------------------------------------------------------
| API Ticket Routes
--------------------------------------------------------------------------
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::prefix('dashboard')->middleware('auth:sanctum')->group(function () {
    // Ruta para listar tickets
    Route::get('/', [DashboardController::class, 'information']);
});