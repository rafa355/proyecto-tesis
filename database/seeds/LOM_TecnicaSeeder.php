<?php

use Illuminate\Database\Seeder;

class LOM_TecnicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lom_tecnica')->delete();

        DB::table('lom_tecnica')->insert([
            'id' => 1,
            'oa_id' => 1,
            'duracion' => 'PT1H30M', 
            'formato' => 'video/ mpeg', 
            'localizacion' => 'https://www.youtube.com/watch?v=S82Vfp7oMGo', 
            'otros_requisitos' => 'No', 
            'pautas_instalacion' => 'Descomprima  el  fichero  zip  y  abrael fichero index.html en su navegador.', 
            'tamano' => '4200',
        ]);
    }
}
