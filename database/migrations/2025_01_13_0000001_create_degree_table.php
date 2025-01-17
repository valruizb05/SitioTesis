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
        Schema::create('degree', function (Blueprint $table) {
            $table->id(); // Campo ID como llave primaria
            $table->string('name', 50); // Nombre del nivel educativo
            $table->text('description')->nullable(); // Descripción (opcional)
            $table->timestamps(); // created_at y updated_at
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('degree');
    }
};
