<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdaptationController extends Controller
{
    public function adaptation(Request $request)
    {
        //$request->validate([
        //    'oa' => 'required',
        //    'requerimiento' => 'required',
        //]);

        $requerimiento = [
            'idioma' => 'en',
            'contenido' => 'noticias',
        ];
    }
}
