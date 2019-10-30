<?php

use Illuminate\Database\Seeder;

class LOM_ClasificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lom_clasificacion')->delete();

        DB::table('lom_clasificacion')->insert([
            'id' => 1,
            'oa_id' => 1,
            'descripcion' => 'Un instrumento médico para escuchar llamado estetoscopio.',
            'palabras_claves' => 'instrumento de diagnóstico',
            'proposito' => 'objetivo educativo',
            'ruta_tax_entrada' => 'Médecine',
            'ruta_tax_fuente' => 'ARIADNE',
            'ruta_tax_identificador' => 'BF180',
        ]);
    }
}
