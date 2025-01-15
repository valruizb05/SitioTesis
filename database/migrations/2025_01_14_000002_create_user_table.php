<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

     public function up()
     {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del usuario
            $table->string('lastname'); // Apellido del usuario
            $table->integer('age'); // Edad
            $table->string('gender'); // Género
            $table->unsignedBigInteger('education')->nullable(); // Relación con la tabla degree
            $table->foreign('education')
                  ->references('id')
                  ->on('degree')
                  ->onDelete('set null'); // Si el grado se elimina, establece NULL
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
        Schema::dropIfExists('user');

    }
};
