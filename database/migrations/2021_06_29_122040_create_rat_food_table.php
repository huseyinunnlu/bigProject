<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rat_food', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('drym');
            $table->string('energy');
            $table->string('protein');
            $table->string('dp');
            $table->string('bp');
            $table->string('cel');
            $table->string('fat');
            $table->string('ash');
            $table->string('ca');
            $table->string('p');
            $table->string('na');
            $table->string('k');
            $table->string('s');
            $table->string('cl');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rat_food');
    }
}
