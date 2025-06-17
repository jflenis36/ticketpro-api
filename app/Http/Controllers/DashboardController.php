<?php

namespace App\Http\Controllers;

use App\Models\Project;
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
class DashboardController extends Controller
{
     use ApiResponse;

     public function information()
     {
          $recent_tickets = Ticket::with('user', 'project')
                    ->orderBy('updated_at', 'desc')
                    ->limit(6)
                    ->get();

          $active_projects = Project::withCount('tickets')
                    ->orderBy('tickets_count', 'desc')
                    ->limit(6)
                    ->get();

          $total = Ticket::count();
          $open = Ticket::where('status', 'open')->count();
          $closed = Ticket::where('status', 'closed')->count();
          $inProgress = Ticket::where('status', 'in_progress')->count();
          
          return $this->success([
               'recent_tickets' => $recent_tickets,
               'active_projects' => $active_projects,
               'ticket_summary' => [
                    'total' => $total,
                    'open' => $open,
                    'closed' => $closed,
                    'inProgress' => $inProgress
               ]
          ]);
     }
}
