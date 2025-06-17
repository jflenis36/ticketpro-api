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
class ProjectController extends Controller
{
     use ApiResponse;

     public function information($project_id)
     {
          $tickets = Ticket::where('project_id', $project_id)->get();

          $project = Project::find($project_id);
          
          return $this->success([
               'tickets' => $tickets,
               'project' => $project
          ]);
     }
}
