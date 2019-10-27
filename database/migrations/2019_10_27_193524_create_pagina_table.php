<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaginaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagina', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('recurso_id')->unsigned();            
            $table->foreign('recurso_id')->references('id')->on('recurso_instruccional')->onDelete('cascade');
            $table->string('descripcion');
            $table->string('formato');
            $table->string('idioma');
            $table->string('tipo');
            $table->string('redes_sociales');
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
        Schema::dropIfExists('pagina');
    }
}
