<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhatsappsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whatsapps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('status')->default(1);
            $table->integer('autorizacao')->nullable();
            $table->unsignedInteger('categoria');
            $table->string('numero')->nullable();
            $table->bigInteger('count')->default(0);
            
            $table->timestamps();
            
            $table->foreign('categoria')->references('id')->on('whatsapp_cats')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('whatsapps');
    }
}
