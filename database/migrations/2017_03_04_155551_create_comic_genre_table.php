<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComicGenreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comic_genre', function (Blueprint $table) {
            $table->integer('genre_id')->unsigned();
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
            $table->integer('comic_id')->unsigned();
            $table->foreign('comic_id')->references('id')->on('comics')->onDelete('cascade');
            $table->primary(['genre_id', 'comic_id']);

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
        Schema::dropIfExists('comic_genre'); 
        Schema::enableForeignKeyConstraints();
    }
}
