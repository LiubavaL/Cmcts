<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVolumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volumes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('sequence')->unsigned()->default(0);

            $table->integer('comic_id')->unsigned();
            $table->foreign('comic_id')->references('id')->on('comics')->onDelete('cascade');

            $table->string('title', 255);

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
        Schema::dropIfExists('volumes');
        Schema::enableForeignKeyConstraints();
    }
}
