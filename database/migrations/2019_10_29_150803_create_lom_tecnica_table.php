<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLomTecnicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lom_tecnica', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('oa_id')->unsigned();            
            $table->foreign('oa_id')->references('id')->on('oa')->onDelete('cascade');
            $table->string('duracion');
            $table->string('formato');
            $table->string('localizacion');
            $table->string('otros_requisitos');
            $table->string('pautas_instalacion');
            $table->string('tamano');
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
        Schema::dropIfExists('lom_tecnica');
    }
}
