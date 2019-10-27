<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContenidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contenido', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('recurso_id')->unsigned();            
            $table->foreign('recurso_id')->references('id')->on('recurso_instruccional')->onDelete('cascade');
            $table->string('formato');
            $table->string('idioma');
            $table->string('tema');
            $table->string('tipo');
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
        Schema::dropIfExists('contenido');
    }
}
