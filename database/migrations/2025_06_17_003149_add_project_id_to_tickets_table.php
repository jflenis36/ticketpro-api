<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProjectIdToTicketsTable extends Migration
{
     /**
      * Run the migrations.
      *
      * @return void
      */
     public function up()
     {
          Schema::table('tickets', function (Blueprint $table) {
               $table->foreignId('project_id')->nullable()->constrained()->onDelete('set null');
          });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
          Schema::table('tickets', function (Blueprint $table) {
               //
          });
     }
}
