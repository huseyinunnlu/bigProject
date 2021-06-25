<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('earring')->nullable();
            $table->string('strap')->nullable();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('desc')->nullable();
            $table->enum('type', ['cattle','shandgo']);
            $table->enum('gender', ['male','female']);
            $table->date('birth');
            $table->date('death')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // quizzes daki id ile questions tablosundaki quiz_id yi bağla
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
}
