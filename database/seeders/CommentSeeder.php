<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
     /**
      * Run the database seeds.
      *
      * @return void
      */
     public function run()
     {
          Comment::create([
               'user_id' => 1,
               'ticket_id' => 1,
               'content' => 'Comentario inicial del ticket de creación del proyecto.',
          ]);
          Comment::create([
               'user_id' => 2,
               'ticket_id' => 1,
               'content' => 'Comentario de respuesta al inicial.',
          ]);
          Comment::create([
               'user_id' => 1,
               'ticket_id' => 1,
               'content' => 'Comentario de ultima respuesta.',
          ]);
          Comment::create([
               'user_id' => 2,
               'ticket_id' => 2,
               'content' => 'Comentario sobre el problema de facturación del mes de junio.',
          ]);
          Comment::create([
               'user_id' => 3,
               'ticket_id' => 3,
               'content' => 'Comentario sobre la solicitud de reembolso por compra duplicada.',
          ]);
     }
}
