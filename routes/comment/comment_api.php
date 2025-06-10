<?php

/*
--------------------------------------------------------------------------
| API Comment Routes
--------------------------------------------------------------------------
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

Route::middleware('auth:sanctum')->group(function () {

     Route::prefix('ticket')->group(function () {

          // 	Listar comentarios raíz de un ticket
          Route::get('{ticketId}/comments', [CommentController::class, 'getComments'])->name('ticket.comments.index');

          // 	Crear un nuevo comentario raíz
          Route::post('{ticketId}/comments', [CommentController::class, 'storeComment'])->name('ticket.comments.store');
     });

     Route::prefix('comment')->group(function () {
          // 	Responder a un comentario
          Route::post('{commentId}/reply', [CommentController::class, 'replyToComment'])->name('comment.reply');

          // Obtener detalle de un comentario (con replies)
          Route::get('{commentId}', [CommentController::class, 'showComment'])->name('comment.show');

          // 	Editar comentario propio
          Route::put('{commentId}', [CommentController::class, 'updateComment'])->name('comment.update');

          // 	Eliminar comentario propio (y sus replies)
          
          Route::delete('{commentId}', [CommentController::class, 'deleteComment'])->name('comment.delete');
     });
});
