<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleriaGbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galeria_gbs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('galeria');
            $table->string('path');
            $table->boolean('cover')->nullable();

            $table->timestamps();

            $table->foreign('galeria')->references('id')->on('galerias')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('galeria_gbs');
    }
}
