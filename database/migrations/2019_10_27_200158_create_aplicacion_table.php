<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAplicacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplicacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('componente_virtual_id')->unsigned();            
            $table->foreign('componente_virtual_id')->references('id')->on('componente_virtual')->onDelete('cascade');
            $table->string('LMS'); // Entorno Virtual de Aprendizaje (EVA)
            $table->string('SO'); // Sistema Operativo
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
        Schema::dropIfExists('aplicacion');
    }
}
