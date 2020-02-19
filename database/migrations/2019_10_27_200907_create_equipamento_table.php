<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipamento', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('componente_fisico_id')->unsigned();            
            $table->foreign('componente_fisico_id')->references('id')->on('componente_fisico')->onDelete('cascade');
            $table->boolean('audio');
            $table->boolean('gps');
            $table->bigInteger('memoria_ram')->unsigned();
            $table->bigInteger('memoria_secundaria')->unsigned();
            $table->string('pantalla');
            $table->string('procesador');
            $table->string('tipo_disponible_acceso');
            $table->string('tipo_red');
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
        Schema::dropIfExists('equipamento');
    }
}
