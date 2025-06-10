<?php

/*
--------------------------------------------------------------------------
| API Category Routes
--------------------------------------------------------------------------
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::prefix('category')->middleware('auth:sanctum')->group(function () {
    // Ruta para obtener todas las categorías
    Route::get('/', [CategoryController::class, 'index']);
    
    // Ruta para crear una nueva categoría
    Route::post('/', [CategoryController::class, 'store']); 

    // Ruta para obtener una categoría específica
    Route::get('/{id}', [CategoryController::class, 'show']);
    
    // Ruta para actualizar una categoría existente
    Route::put('/{id}', [CategoryController::class, 'update']);

    // Ruta para eliminar una categoría existente
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
});