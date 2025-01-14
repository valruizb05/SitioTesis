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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('asignature_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('asignature_id')->references('id')->on('asignature')->onDelete('cascade');
            $table->boolean('original1');
            $table->boolean('original2');
            $table->boolean('original3');
            $table->boolean('original4');
            $table->boolean('original5');
            $table->boolean('humor1')->nullable();
            $table->boolean('humor2')->nullable();
            $table->boolean('humor3')->nullable();
            $table->boolean('humor4')->nullable();
            $table->boolean('humor5')->nullable();
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
        Schema::dropIfExists('results');
    }
};
