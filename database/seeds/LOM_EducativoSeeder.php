<?php

use Illuminate\Database\Seeder;

class LOM_EducativoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lom_educativo')->delete();

        DB::table('lom_educativo')->insert([
            'id' => 1,
            'oa_id' => 1,
            'contexto_uso' => 'educación secundaria', 
            'densidad_semantica' => 'alta', 
            'destinatario' => 'aprendiz', 
            'edad' => '15', 
            'nivel_interactividad' => 'medio', 
            'tiempo_aprendizaje' => '',
            'tipo_interactividad' => 'video',
            'tipo_recurso_educativo' => 'diapositiva',
        ]);
    }
}
