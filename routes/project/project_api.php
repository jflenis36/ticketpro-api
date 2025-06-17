<?php

/*
--------------------------------------------------------------------------
| API Ticket Routes
--------------------------------------------------------------------------
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

Route::prefix('project')->middleware('auth:sanctum')->group(function () {
    // Ruta para listar tickets
    Route::get('/{project_id}', [ProjectController::class, 'information']);
});