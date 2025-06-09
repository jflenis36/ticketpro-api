<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
     /**
      * Run the database seeds.
      *
      * @return void
      */
     public function run()
     {
          Category::create(['name' => 'Soporte Técnico']);
          Category::create(['name' => 'Facturación']);
          Category::create(['name' => 'Reembolsos']);
          Category::create(['name' => 'Problemas Técnicos']);
          Category::create(['name' => 'Consultas Generales']);
     }
}
