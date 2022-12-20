<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscografiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discografia', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->bigInteger('views')->default(0);
            $table->text('ficha_tecnica')->nullable();
            $table->string('slug')->nullable();
            $table->text('tags')->nullable();
            $table->integer('status')->nullable();
            $table->string('link')->nullable();
            $table->string('thumb')->nullable();
            $table->text('letras')->nullable();
            $table->string('apple_music')->nullable();
            $table->string('itunes')->nullable();
            $table->string('music')->nullable();
            $table->string('deezer')->nullable();
            $table->string('spotify')->nullable();

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
        Schema::dropIfExists('discografia');
    }
}
