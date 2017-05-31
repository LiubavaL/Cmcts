<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraCoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra-covers', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('comic_id')->unsigned();
            $table->foreign('comic_id')->references('id')->on('comics')->onDelete('cascade');

            $table->string('image', 255);

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
        Schema::dropIfExists('extra-covers');
        Schema::enableForeignKeyConstraints();
    }
}
