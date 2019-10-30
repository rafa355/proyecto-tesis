<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Statickidz\GoogleTranslate;


class AdaptationController extends Controller
{
    public function adaptation(Request $request)
    {
        //$request->validate([
        //    'oa' => 'required',
        //    'requerimiento' => 'required',
        //]);

        $request->oa = json_decode($request->oa);
        $request->requerimientos = json_decode($request->requerimientos);
        foreach ($request->requerimientos as $key => $value) {
            switch ($key) {
                case 'idioma':
                    $formato = $request->oa->lom_tecnica->formato;
                    $idioma_origen = $request->oa->lom_general->idioma;
                    $idioma_salida = $value;
                    
                    switch ($formato) {
                        case 'text/ html':
                            $text = $request->oa->lom_general->descripcion;
                            $trans = new GoogleTranslate();
                            $result = $trans->translate('es', $idioma_salida, $text);
                            return response()->json([ 'idioma' => $result ]);
                            break;
                        case 'contenido':
                            break;
                    }
                    return "idioma";
                    break;
                case 'contenido':
                    return "contenido";
                    break;
            }
        }

        return $request->all();
    }
}
