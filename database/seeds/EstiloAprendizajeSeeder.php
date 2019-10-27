<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EstiloAprendizajeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estilo_aprendizaje')->delete();
        
        DB::table('estilo_aprendizaje')->insert([
            'id' => 1,
            'user_id' => 1,
            'estilo' => 'A', // VARK: V (Visual), A (Auditivo), R (Lectura/Escritura), K (Quinésico)
            'created_at' => Carbon::now(),
        ]);
    }
}
