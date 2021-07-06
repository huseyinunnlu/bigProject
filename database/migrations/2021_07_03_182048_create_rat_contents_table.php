<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rat_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ration_id');
            $table->unsignedBigInteger('food_id');
            $table->string('amount');
            $table->string('price');
            $table->foreign('ration_id')->references('id')->on('rations')->onDelete('cascade');
            $table->foreign('food_id')->references('id')->on('rat_food')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rat_contents');
    }
}
