<?php

use Illuminate\Database\Seeder;

class LOM_GeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lom_general')->delete();

        DB::table('lom_general')->insert([
            'id' => 1,
            'oa_id' => 1,
            'ambito' => 'Siglo XVI en Francia', 
            'titulo' => 'La  vida  y  obra  de  Leonardo daVinci', 
            'idioma' => 'es', 
            'descripcion' => 'En este vídeo se presentan brevemente la vida y obra de Leonardo da Vinci. El elemento central es la producción artística, principalmente la Mona Lisa', 
            'palabra_clave' => 'Mona Lisa',
        ]);
    }
}
