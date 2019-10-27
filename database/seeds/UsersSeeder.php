<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert([
            'id' => 1,
            'nombre' => 'Aprendiz',
            'email' => 'aprendiz@oa.com',
            'password' => bcrypt('123456789'),
            'pregunta_seguridad' => '¿2+2?',
            'respuesta_seguridad' => '4',
            'sexo' => 'D', 
            'fecha_nacimiento' => Carbon::now(), 
            'lugar_nacimiento' => 'Desconocido', 
            'estatus' => true,
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);

        $this->call(LimitacionesSeeder::class);
        $this->call(PreferenciasSeeder::class);

    }
}
