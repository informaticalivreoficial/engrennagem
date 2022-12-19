<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->text('content')->nullable();
            $table->string('link')->nullable();
            $table->string('url')->nullable();
            $table->string('thumb')->nullable();
            $table->string('endereco')->nullable();
            $table->string('time')->nullable();
            $table->date('data')->nullable();
            $table->integer('status')->nullable();
            $table->bigInteger('cliques')->default(0);
            
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
        Schema::dropIfExists('agenda');
    }
}
