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
        Schema::create('experimentation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Relación con la tabla users
            $table->unsignedBigInteger('asignature_id'); // Relación con la tabla asignature
            $table->string('type_text'); // Tipo de texto (humorístico/original)
            $table->integer('question1')->nullable();
            $table->integer('question2')->nullable();
            $table->integer('question3')->nullable();
            $table->integer('question4')->nullable();
            $table->integer('question5')->nullable();
            $table->integer('humoristic')->nullable(); // Evaluación de humor
            $table->integer('compression')->nullable(); // Facilidad de comprensión
            $table->string('preference')->nullable(); // Preferencia (humor/original)
            $table->timestamps();
    
            $table->foreign('user_id')
                  ->references('id')
                  ->on('user')
                  ->onDelete('cascade');
    
                  $table->foreign('asignature_id')
                  ->references('id')
                  ->on('asignature')
                  ->onDelete('set null');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experimentation');
    }
};
