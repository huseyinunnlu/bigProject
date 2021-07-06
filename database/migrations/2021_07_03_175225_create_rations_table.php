<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('rat_type_id');
            $table->longText('desc')->nullable();
            $table->string('energy')->nullable();
            $table->string('protein')->nullable();
            $table->string('drym')->nullable();
            $table->string('ca')->nullable();
            $table->string('p')->nullable();
            $table->string('nacl')->nullable();
            $table->string('sumfood')->nullable();
            $table->string('price')->nullable();
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('rat_type_id')->references('id')->on('ration_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rations');
    }
}
