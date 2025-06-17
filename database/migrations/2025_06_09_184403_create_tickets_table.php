<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
     /**
      * Run the migrations.
      *
      * @return void
      */
     public function up()
     {
          Schema::create('tickets', function (Blueprint $table) {
               $table->id();
               $table->foreignId('user_id')->constrained()->onDelete('cascade');
               $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
               $table->foreignId('project_id')->constrained()->onDelete('cascade');
               $table->string('title');
               $table->text('description');
               $table->enum('status', ['open', 'in_progress', 'closed'])->default('open');
               $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
               $table->timestamps();
          });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
          Schema::dropIfExists('tickets');
     }
}
