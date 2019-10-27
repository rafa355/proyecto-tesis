<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDispositivoDisponibleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispositivo_disponible', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('componente_virtual_id')->unsigned();            
            $table->foreign('componente_virtual_id')->references('id')->on('componente_virtual')->onDelete('cascade');
            $table->integer('ancho_banda')->unsigned();
            $table->boolean('audio');
            $table->integer('memoria_ram')->unsigned();
            $table->integer('memoria_secundaria')->unsigned();
            $table->string('resolucion_pantalla');
            $table->integer('uso_procesador')->unsigned();
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
        Schema::dropIfExists('dispositivo_disponible');
    }
}
