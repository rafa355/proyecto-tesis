<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Carbon\Carbon;

class AddQuestionColumnAndAnswerColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('pregunta_seguridad');
            $table->string('respuesta_seguridad');
            $table->string('sexo');
            $table->timestamp('fecha_nacimiento')->default(Carbon::now());
            $table->string('lugar_nacimiento');
            $table->boolean('estatus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('pregunta_seguridad');
            $table->dropColumn('respuesta_seguridad');
            $table->dropColumn('sexo');
            $table->dropColumn('fecha_nacimiento');
            $table->dropColumn('lugar_nacimiento');
            $table->dropColumn('estatus');
        });
    }
}
