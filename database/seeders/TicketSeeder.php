<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
     /**
      * Run the database seeds.
      *
      * @return void
      */
     public function run()
     {
          Ticket::create([
               'user_id' => 1,
               'category_id' => 1,
               'title' => 'Creación proyecto inicial laravel.',
               'description' => 'Se requiere la creación de un proyecto inicial en Laravel para el sistema de gestión de tickets. El proyecto debe incluir las siguientes características:
                              1. Estructura básica de Laravel.
                              2. Configuración de base de datos.
                              3. Rutas y controladores básicos.
                              4. Vista de bienvenida.
                              5. Documentación inicial en el README.md.',
               'status' => 'open',
               'priority' => 'high'
          ]);
          Ticket::create([
               'user_id' => 2,
               'category_id' => 2,
               'title' => 'Problema con la facturación del mes de junio.',
               'description' => 'Se ha detectado un error en la facturación del mes de junio. El monto facturado es incorrecto y se requiere una revisión inmediata.',
               'status' => 'in_progress',
               'priority' => 'medium'
          ]);
          Ticket::create([
               'user_id' => 3,
               'category_id' => 3,
               'title' => 'Solicitud de reembolso por compra duplicada.',
               'description' => 'El cliente solicita un reembolso por una compra duplicada realizada el 15 de junio. Se requiere verificar la transacción y proceder con el reembolso si es válido.',
               'status' => 'open',
               'priority' => 'high'
          ]);
          Ticket::create([
               'user_id' => 4,
               'category_id' => 4,
               'title' => 'Error al cargar la página de inicio.',
               'description' => 'Los usuarios reportan que la página de inicio no carga correctamente. Se requiere investigar el problema y solucionarlo a la brevedad.',
               'status' => 'open',
               'priority' => 'high'
          ]);
          Ticket::create([
               'user_id' => 5,
               'category_id' => 5,
               'title' => 'Consulta sobre las nuevas funcionalidades del sistema.',
               'description' => 'El cliente tiene preguntas sobre las nuevas funcionalidades implementadas en el sistema. Se requiere una respuesta detallada y clara.',
               'status' => 'closed',
               'priority' => 'low'
          ]);
          Ticket::create([
               'user_id' => 6,
               'category_id' => 1,
               'title' => 'Problema de acceso al sistema.',
               'description' => 'El usuario no puede acceder al sistema debido a un error de autenticación. Se requiere investigar y solucionar el problema.',
               'status' => 'in_progress',
               'priority' => 'high'
          ]);
     }
}
