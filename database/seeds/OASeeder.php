<?php

use Illuminate\Database\Seeder;

class OASeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oa')->delete();

        DB::table('oa')->insert([
            'id' => 1,
        ]);

        $this->call(LOM_GeneralSeeder::class);
        $this->call(LOM_ClasificacionSeeder::class);
        $this->call(LOM_EducativoSeeder::class);
        $this->call(LOM_TecnicaSeeder::class);

    }
}
