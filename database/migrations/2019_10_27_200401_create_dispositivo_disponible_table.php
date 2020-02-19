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
            $table->bigInteger('componente_virtual_id')->unsigned();            
            $table->foreign('componente_virtual_id')->references('id')->on('componente_virtual')->onDelete('cascade');
            $table->bigInteger('ancho_banda')->unsigned();
            $table->boolean('audio');
            $table->bigInteger('memoria_ram')->unsigned();
            $table->bigInteger('memoria_secundaria')->unsigned();
            $table->string('resolucion_pantalla');
            $table->bigInteger('uso_procesador')->unsigned();
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
