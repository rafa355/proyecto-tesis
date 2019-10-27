<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PreferenciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('preferencias')->delete();
 
        DB::table('preferencias')->insert([
            'id' => 1,
            'user_id' => 1,
            'contenido' => 'Deportes',
            'formato' => 'text',
            'idioma' => 'en',
            'created_at' => Carbon::now(),
        ]);

    }
}
