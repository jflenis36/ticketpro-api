<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
     /**
      * Run the database seeds.
      *
      * @return void
      */
     public function run()
     {
          User::create([
               'name' => 'Super Admin',
               'email' => 'admin@email.com',
               'password' => bcrypt('admin'),
               'role' => 'admin'
          ]);
          User::create([
               'name' => 'Abel Castilla Iriarte',
               'email' => 'francooctavio@hotmail.com',
               'password' => bcrypt('admin'),
               'role' => 'admin'
          ]);
          User::create([
               'name' => 'Modesto Cid Coello',
               'email' => 'toni27@gmail.com',
               'password' => bcrypt('admin'),
               'role' => 'agent'
          ]);
          User::create([
               'name' => 'Miriam Nuñez Gárate',
               'email' => 'unino@hernando-villar.es',
               'password' => bcrypt('admin'),
               'role' => 'agent'
          ]);
          User::create([
               'name' => 'Fortunato Cabañas Cortes',
               'email' => 'amayaferrera@hotmail.com',
               'password' => bcrypt('admin'),
               'role' => 'admin'
          ]);
          User::create([
               'name' => 'Rufino del Huguet',
               'email' => 'dmorera@gmail.com',
               'password' => bcrypt('admin'),
               'role' => 'agent'
          ]);
     }
}
