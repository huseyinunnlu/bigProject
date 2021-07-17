<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAltCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alt_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_cat_id');
            $table->string('title');
            $table->enum('status',['active','inactive']);
            $table->foreign('main_cat_id')->references('id')->on('main_categories')->onDelete('cascade');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alt_categories');
    }
}
