<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumPostCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_post_cats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_cat_id');
            $table->unsignedBigInteger('alt_cat_id');
            $table->unsignedBigInteger('post_id');
            $table->foreign('main_cat_id')->references('id')->on('main_categories')->onDelete('cascade');
            $table->foreign('alt_cat_id')->references('id')->on('alt_categories')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('forum_posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forum_post_cats');
    }
}
