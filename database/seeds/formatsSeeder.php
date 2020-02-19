<?php

use Illuminate\Database\Seeder;
use App\Format;
class formatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('formats')->delete();

        Format::create([
            'formato' => 'mpg4',
            'tipo' => 'visual',
        ]);
        Format::create([
            'formato' => 'png',
            'tipo' => 'visual',
        ]);
        Format::create([
            'formato' => 'mp4',
            'tipo' => 'visual',
        ]);
        Format::create([
            'formato' => 'pdf',
            'tipo' => 'lectura',
        ]);
        Format::create([
            'formato' => 'doc',
            'tipo' => 'lectura',
        ]);
        Format::create([
            'formato' => 'docx',
            'tipo' => 'lectura',
        ]);
        Format::create([
            'formato' => 'mp3',
            'tipo' => 'auditivo',
        ]);
        Format::create([
            'formato' => 'ppt',
            'tipo' => 'kinestesico',
        ]);
        Format::create([
            'formato' => 'pptx',
            'tipo' => 'kinestesico',
        ]);
        Format::create([
            'formato' => 'text/ html',
            'tipo' => 'lectura',
        ]);
        Format::create([
            'formato' => 'text/html; charset=UTF-8',
            'tipo' => 'lectura',
        ]);
    }
}
