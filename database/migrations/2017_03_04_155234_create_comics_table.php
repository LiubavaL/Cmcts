<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comics', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title', 255);
            $table->string('slug');
            $table->longText('description');
            $table->string('cover');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('comic_statuses')->onDelete('cascade');
            $table->boolean('adult_content');
            $table->integer('rating');
            $table->integer('view_count')->default(0)->unsigned();

            $table->softDeletes();
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('comics');
        Schema::enableForeignKeyConstraints();
    }
}
