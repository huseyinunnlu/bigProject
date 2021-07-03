<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRationTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ration_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('energy');
            $table->string('protein');
            $table->string('drym');
            $table->string('ca');
            $table->string('p');
            $table->string('nacl');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ration_types');
    }
}
