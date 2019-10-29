<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLomClasificacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lom_clasificacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('oa_id')->unsigned();            
            $table->foreign('oa_id')->references('id')->on('oa')->onDelete('cascade');
            $table->string('descripcion');
            $table->string('palabras_claves');
            $table->string('proposito');
            $table->string('ruta_tax_entrada');
            $table->string('ruta_tax_fuente');
            $table->string('ruta_tax_identificador');
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
        Schema::dropIfExists('lom_clasificacion');
    }
}
