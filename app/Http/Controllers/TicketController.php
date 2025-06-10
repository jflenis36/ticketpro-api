<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Controlador para gestionar los tickets del sistema
 * 
 * Este controlador maneja todas las operaciones CRUD relacionadas con los tickets
 * incluyendo su creación, lectura, actualización y eliminación.
 */
class TicketController extends Controller
{
     use ApiResponse;

     /**
      * Obtiene la lista de tickets del usuario autenticado
      *
      * @return \Illuminate\Http\JsonResponse
      */
     // public function index()
     // {
     //      $user = auth()->user();

     //      $tickets = Ticket::where('user_id', $user->id)
     //           ->orderBy('created_at', 'desc')
     //           ->get();

     //      return $this->success($tickets);
     // }
     public function index(Request $request)
     {
          $user = auth()->user();

          $query = Ticket::where('user_id', $user->id);

          if ($request->has('status')) {
               $query = $query->where('status', $request->input('status'));
          }

          if ($request->has('priority')) {
               $query = $query->where('priority', $request->input('priority'));
          }

          if ($request->has('q')) {
               $query = $query->where(function ($q) use ($request) {
                    $q->where('title', 'like', '%' . $request->q . '%')
                         ->orWhere('description', 'like', '%' . $request->q . '%');
               });
          }

          if ($request->has('category_id')) {
               $query = $query->where('category_id', $request->input('category_id'));
          }

          if ($request->has('from')) {
               $query = $query->where('created_at', '>=', $request->input('from'));
          }

          if ($request->has('to')) {
               $query = $query->where('created_at', '<=', $request->input('to'));
          }

          if ($request->has('sort_by')) {
               $sortBy = $request->input('sort_by');
               $sortOrder = $request->input('sort_order', 'asc');
               $query = $query->orderBy($sortBy, $sortOrder);
          } else {
               $query = $query->orderBy('created_at', 'desc');
          }

          // dd($query->toSql(), $query->getBindings(), $query->get());

          if ($request->has('per_page')) {
               $tickets = $query->paginate($request->input('per_page'));
          } else {
               $tickets = $query->get();
          }

          return $this->success($tickets);
     }



     /**
      * Crea un nuevo ticket en el sistema
      *
      * @param Request $request
      * @return \Illuminate\Http\JsonResponse
      * @throws ValidationException
      */
     public function store(Request $request)
     {
          $fields = $request->validate([
               'title' => 'required|string|max:255',
               'description' => 'required|string',
               'priority' => 'required|in:low,medium,high',
               'category_id' => 'required|exists:categories,id',
          ]);

          $ticket = Ticket::create([
               'title' => $fields['title'],
               'description' => $fields['description'],
               'status' => 'open', // Estado por defecto
               'priority' => $fields['priority'],
               'user_id' => auth()->id(),
               'category_id' => $fields['category_id'],
          ]);

          return $this->success($ticket, 'Ticket creado correctamente', 201);
     }

     /**
      * Muestra los detalles de un ticket específico
      *
      * @param int $id
      * @return \Illuminate\Http\JsonResponse
      */
     public function show($id)
     {
          $ticket = Ticket::with(['user', 'category', 'comments'])
               ->where('id', $id)
               ->where('user_id', auth()->id())
               ->first();

          if (!$ticket) {
               return $this->error('Ticket no encontrado', 404);
          }

          return $this->success($ticket);
     }

     /**
      * Actualiza un ticket existente
      *
      * @param Request $request
      * @param int $id
      * @return \Illuminate\Http\JsonResponse
      * @throws ValidationException
      */
     public function update(Request $request, $id)
     {
          $fields = $request->validate([
               'title' => 'sometimes|required|string|max:255',
               'description' => 'sometimes|required|string',
               'priority' => 'sometimes|required|in:low,medium,high',
               'status' => 'sometimes|required|in:open,closed,in_progress',
               'category_id' => 'sometimes|exists:categories,id'
          ]);

          $ticket = Ticket::where('id', $id)
               ->where('user_id', auth()->id())
               ->first();

          if (!$ticket) {
               return $this->error('Ticket no encontrado', 404);
          }

          $ticket->update($fields);

          return $this->success($ticket, 'Ticket actualizado correctamente');
     }

     /**
      * Elimina un ticket del sistema
      *
      * @param int $id
      * @return \Illuminate\Http\JsonResponse
      */
     public function destroy($id)
     {
          $ticket = Ticket::where('id', $id)
               ->where('user_id', auth()->id())
               ->first();

          if (!$ticket) {
               return $this->error('Ticket no encontrado', 404);
          }

          $ticket->delete();

          return $this->success(null, 'Ticket eliminado correctamente');
     }
}
