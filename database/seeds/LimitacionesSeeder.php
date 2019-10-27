<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LimitacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('limitaciones')->delete();
        
        DB::table('limitaciones')->insert([
            'id' => 1,
            'user_id' => 1,
            'lectura' => false,
            'auditiva' => false,
            'motriz' => false,
            'verbal' => false,
            'visual' => false,
            'created_at' => Carbon::now(),
        ]);
    }
}
