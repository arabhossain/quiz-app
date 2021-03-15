<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->string('title')->nullable();
            $table->string('meta_key')->nullable();
            $table->text('meta_description')->nullable();
            $table->longText('body')->nullable();
            $table->string('featured_photo')->nullable();
            $table->boolean('visible')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
