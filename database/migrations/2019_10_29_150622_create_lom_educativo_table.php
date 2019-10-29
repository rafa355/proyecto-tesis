<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLomEducativoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lom_educativo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('oa_id')->unsigned();            
            $table->foreign('oa_id')->references('id')->on('oa')->onDelete('cascade');
            $table->string('contexto_uso');
            $table->string('densidad_semantica');
            $table->string('destinatario');
            $table->string('edad');
            $table->string('nivel_interactividad');
            $table->string('tiempo_aprendizaje');
            $table->string('tipo_recurso_educativo');
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
        Schema::dropIfExists('lom_educativo');
    }
}
