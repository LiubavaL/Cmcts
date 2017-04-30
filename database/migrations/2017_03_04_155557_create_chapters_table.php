<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('sequence')->unsigned()->default(0);

            $table->integer('volume_id')->unsigned();
            $table->foreign('volume_id')->references('id')->on('volumes')->onDelete('cascade');
            
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
        Schema::dropIfExists('chapters');
        Schema::enableForeignKeyConstraints();
    }
}
