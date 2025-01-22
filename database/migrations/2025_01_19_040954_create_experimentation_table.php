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
            $table->unsignedBigInteger('user_id')->index(); // Relación con users
            $table->unsignedBigInteger('asignature_id')->nullable()->index(); // Relación con asignature
            $table->tinyInteger('type_text')->nullable()->comment('1: Humoristic, 2: Original'); // Tipo de texto
            $table->integer('question1')->nullable();
            $table->integer('question2')->nullable();
            $table->integer('question3')->nullable();
            $table->integer('question4')->nullable();
            $table->integer('question5')->nullable();
            $table->integer('humoristic')->nullable(); // Evaluación de humor
            $table->integer('compression')->nullable(); // Facilidad de comprensión
            $table->string('preference')->nullable(); // Preferencia (humor/original)
            $table->timestamps();

            // Llave foránea para user_id
            $table->foreign('user_id')
                  ->references('id')
                  ->on('user') // Asegúrate de que sea 'users'
                  ->onDelete('cascade');

            // Llave foránea para asignature_id
            $table->foreign('asignature_id')
                  ->references('id')
                  ->on('asignature') // Asegúrate de que sea 'asignatures'
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
