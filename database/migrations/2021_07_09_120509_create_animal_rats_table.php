<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalRatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_rats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('animal_id');
            $table->unsignedBigInteger('ration_id');
            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
            $table->foreign('ration_id')->references('id')->on('rations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animal_rats');
    }
}
