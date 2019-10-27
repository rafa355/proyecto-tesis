<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalizacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localizacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('componente_fisico_id')->unsigned();            
            $table->foreign('componente_fisico_id')->references('id')->on('componente_fisico')->onDelete('cascade');
            $table->string('ciudad');
            $table->string('idioma');
            $table->string('pais');
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
        Schema::dropIfExists('localizacion');
    }
}
