<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image-comments', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('image_id')->unsigned();
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('content');

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
        Schema::table('image-comments', function (Blueprint $table) {
            Schema::dropIfExists('image-comments');
        });
    }
}
