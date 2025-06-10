<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
     use ApiResponse;

     /**
      * Listar comentarios raíz de un ticket.
      * Incluye replies de cada comentario raíz.
      *
      * @param int $ticketId
      * @return \Illuminate\Http\JsonResponse
      */
     public function getComments($ticketId)
     {
          $comments = Comment::where('ticket_id', $ticketId)
               ->whereNull('parent_id')
               ->with('replies')
               ->get();

          return $this->success($comments);
     }

     /**
      * Crear un nuevo comentario raíz.
      * Este comentario no debe tener parent_id.
      * @param Request $request
      * @param int $ticketId
      * @return \Illuminate\Http\JsonResponse
      */
     public function storeComment(Request $request, $ticketId)
     {
          $request->validate([
               'content' => 'required|string|max:1000|min:1',
          ]);

          $comment = Comment::create([
               'ticket_id' => $ticketId,
               'user_id' => auth()->id(),
               'content' => $request->content,
          ]);

          return $this->success($comment, 'Comentario creado exitosamente.');
     }

     /**
      * Responder a un comentario.
      * Este comentario debe tener parent_id que referencia al comentario padre.
      * @param Request $request
      * @param int $commentId
      * @return \Illuminate\Http\JsonResponse
      */
     public function replyToComment(Request $request, $commentId)
     {
          $request->validate([
               'content' => 'required|string|max:1000|min:1',
          ]);

          $comment = Comment::findOrFail($commentId);

          $reply = Comment::create([
               'ticket_id' => $comment->ticket_id,
               'user_id' => auth()->id(),
               'content' => $request->content,
               'parent_id' => $commentId,
          ]);

          return $this->success($reply, 'Respuesta creada exitosamente.');
     }

     /**
      * Obtener detalle de un comentario (con replies).
      * @param int $commentId
      * @return \Illuminate\Http\JsonResponse
      */
     public function showComment($commentId)
     {
          $comment = Comment::with('replies')->find($commentId);

          if (!$comment) {
               return $this->error('Comentario no encontrado.', 404);
          }

          return $this->success($comment);
     }

     /**
      * Editar comentario propio.
      * Solo el propietario del comentario puede editarlo.
      * @param Request $request
      * @param int $commentId
      * @return \Illuminate\Http\JsonResponse
      */
     public function updateComment(Request $request, $commentId)
     {
          $request->validate([
               'content' => 'required|string|max:1000|min:1',
          ]);

          $comment = Comment::findOrFail($commentId);

          // Verificar que el usuario sea el propietario del comentario
          if ($comment->user_id !== auth()->id()) {
               return $this->errorResponse('No tienes permiso para editar este comentario.', 403);
          }

          $comment->update(['content' => $request->content]);

          return $this->success($comment, 'Comentario actualizado exitosamente.');
     }

     /**
      * Eliminar comentario propio (y sus replies).
      * Solo el propietario del comentario puede eliminarlo.
      * @param int $commentId
      * @return \Illuminate\Http\JsonResponse
      */
     public function deleteComment($commentId)
     {
          $comment = Comment::find($commentId);

          if (!$comment) {
               return $this->error('Comentario no encontrado.', 404);
          }

          // Verificar que el usuario sea el propietario del comentario
          if ($comment->user_id !== auth()->id()) {
               return $this->error('No tienes permiso para eliminar este comentario.', 403);
          }

          // Eliminar el comentario y sus replies
          $comment->replies()->delete();
          $comment->delete();

          return $this->success(null, 'Comentario eliminado exitosamente.');
     }
}
