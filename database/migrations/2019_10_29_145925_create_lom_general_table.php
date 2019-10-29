<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLomGeneralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lom_general', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('oa_id')->unsigned();            
            $table->foreign('oa_id')->references('id')->on('oa')->onDelete('cascade');
            $table->string('ambito');
            $table->string('titulo');
            $table->string('idioma');
            $table->string('descripcion');
            $table->string('palabra_clave');
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
        Schema::dropIfExists('lom_general');
    }
}
