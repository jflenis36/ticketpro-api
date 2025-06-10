<?php

/*
--------------------------------------------------------------------------
| API Ticket Routes
--------------------------------------------------------------------------
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

Route::prefix('ticket')->middleware('auth:sanctum')->group(function () {
    // Ruta para listar tickets
    Route::get('/', [TicketController::class, 'index']);

    // Ruta para crear un nuevo ticket
    Route::post('/', [TicketController::class, 'store']);

    // Ruta para mostrar un ticket específico
    Route::get('/{id}', [TicketController::class, 'show']);

    // Ruta para actualizar un ticket
    Route::put('/{id}', [TicketController::class, 'update']);

    // Ruta para eliminar un ticket
    Route::delete('/{id}', [TicketController::class, 'destroy']);
});