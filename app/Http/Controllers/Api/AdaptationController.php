<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Statickidz\GoogleTranslate;
use \BorderCloud\SPARQL\SparqlClient;
use App\OA;
use App\LOM_General;
use App\LOM_Clasificacion;
use App\LOM_Educativo;
use App\LOM_Tecnica;
use App\ComponenteVirtual;
use App\DBPedia_OA;
use App\Format;

use Illuminate\Support\Str;

class AdaptationController extends Controller
{
    public function adaptation(Request $request)
    {
        // $request->validate([
        //    'oa' => 'required',
        //    'requerimiento' => 'required',
        // ]);

        $request->oa = json_decode($request->oa);
        //$request->requerimientos = json_decode($request->requerimientos);

       // $dbpedia = $this->dbpedia();
        return $this->dbpediaToLom($request->oa->uri);

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

    // public functi

 //generamos contexto aleatorio
    public function generate_contexto()
    {
        $links = [];
        $usedApps = [];
        $urls = array("https: //www.udemy.com", "https: //styde.net/", "https: //www.juegos.com/", "https: //www.rincondelvago.com/", "https: //www.w3schools.com/", "https: //www.youtube.com/watch?v=", "https: //www.facebook.com", "https: //www.spotify.com/bo/", "https: //musicaeu.com/", "http: //www.fullvicio.com/", "https: //es.wikipedia.org/", "https: //gnula.me/");
        $apps = array("powerpoint", "market", "word", "vlc media player", "Adobe Photoshop", "virtualdj");
        $variacionurls = array_rand($urls, 8);
        $variacionApps = array_rand($apps, 2);

        //Para obtener apps usadas
        foreach ($variacionApps as $variacion) {
            array_push($usedApps, $apps[$variacion]);
        }

        //Para obtener urls visitados
        foreach ($variacionurls as $variacion) {
            $number = mt_rand(1, 100);
            for ($i = 0; $i < $number; $i++) {
                array_push($links, $urls[$variacion] . Str::random(32));
            }
        }
        //la posibles respuestas de una pregunta
        $test = array("a", "b", "c", "d");
        $respuestas = array();
        //generamos de manera aleatoria las respuestas 
        for ($i = 1; $i <= 16; $i++) {
             array_push($respuestas,$test[array_rand($test, 1)]);
        }

        return array([
            'links' => $links,
            'apps' => $usedApps,
            'respuestas' => $respuestas,
        ]);
    }

    //verificamos el estilo de apredizaje segun el contexto
    public function verificacionEstilo($Contexto)
    {
        $opciones = array(
            array("b", "a", "c", "d"),
            array("b", "a", "c", "d"),
            array("d", "a", "c", "b"),
            array("c", "d", "a", "b"),
            array("d", "c", "b", "a"),
            array("b", "d", "c", "a"),
            array("d", "b", "c", "a"),            
            array("b", "d", "a", "c"),
            array("a", "b", "c", "d"),            
            array("b", "a", "d", "c"),
            array("c", "a", "b", "d"),            
            array("d", "c", "b", "a"),
            array("d", "c", "b", "a"),
            array("c", "d", "b", "a"),   
            array("d", "c", "b", "a"),         
            array("d", "c", "a", "b"),         
        );
        $resultado = array();

        // verificamos las respuestas con el test
        foreach($Contexto[0]['respuestas'] as $index => $respuesta){
            if($respuesta == $opciones[$index][0]){
                array_push($resultado,'V');
            }elseif($respuesta == $opciones[$index][1]){
                array_push($resultado,'A');
            }elseif($respuesta == $opciones[$index][2]){
                array_push($resultado,'R');
            }elseif($respuesta == $opciones[$index][3]){
                array_push($resultado,'K');
            }
        }
        // contamos los valores
        $result = array();

        foreach($resultado as $t) {
            if(!empty($result[$t])){
                $result[$t] += 1;
            }else{
                $result[$t] = 1;
            }
        }

        response()->json([
            'respuestas' => $Contexto[0]['respuestas'],
            'resultados' => $resultado,
            'conteo' => $contador = array ("auditivo" => $result['A'], "visual" => $result['V'], "lectura y escritura" => $result['R'], "kinestesico" => $result['K']),
            'estilo' => array_search(max($contador),$contador)
        ]);
       $contador = array ("auditivo" => $result['A'], "visual" => $result['V'], "lectura y escritura" => $result['R'], "kinestesico" => $result['K']);
        $estilo = array_search(max($contador),$contador);

        return 'visual';
    }
    
    //segun el estilo llamamos a una funcion en especifico
    public function trasnformacion($OAA,$estilo)
    {
        if($estilo == 'visual'){
            return $this->transformacionToVisual($OAA);
        }
        elseif($estilo == 'kinestesico'){
            return $this->transformacionkinestesica($OAA);
        }
        elseif($estilo == 'lectura y escritura'){
            return $this->transformacionLectura($OAA);
        }
        elseif($estilo == 'auditivo'){
            return $this->transformacionAuditiva($OAA);
        }

        return 'formato no conocidop';
    }

    public function transformacionToVisual($OAA)
    { 
        //se compara el formato del objeto con los formatos guardados en la base de datos
        if(in_array($OAA['lom_tecnica']['formato'][0],Format::where('tipo','visual')->get()->pluck('formato')->toArray())){
            return response()->json(['msg'=>'era Visual Se Transformo a visual','oa'=>$OAA]);
        }
        elseif(in_array($OAA['lom_tecnica']['formato'][0],Format::where('tipo','lectura')->get()->pluck('formato')->toArray())){
            //aqui va un api que transforme
            //aaaaaaaaaaaaaaaaaaaaaaaquiiii
            //y aqui se debe llamara a una funcion constructor objeto
            //dkasjdlasldjaskldjas
            return response()->json(['msg'=>'era Lectura Se Transformo a visual','viejo_oa'=>$OAA,'nuevo_oa'=>'aqui va el nuevo']);
        }
        elseif(in_array($OAA['lom_tecnica']['formato'][0],Format::where('tipo','auditivo')->get()->pluck('formato')->toArray())){
            return response()->json('era auditivo Se Transformo a visual');
        }
        elseif(in_array($OAA['lom_tecnica']['formato'][0],Format::where('tipo','kinestesico')->get()->pluck('formato')->toArray())){
            return response()->json('era kinestesico Se Transformo a visual');
        }
        return response()->json(in_array($OAA['lom_tecnica']['formato'][0],Format::where('tipo','kinestesico')->get()->pluck('formato')->toArray()));

    }
    public function transformacionkinestesica($OAA)
    {
        if(in_array($OAA['lom_tecnica']['formato'][0],Format::where('tipo','visual')->get()->pluck('formato')->toArray())){
            return response()->json('era Visual Se Transformo a kinestesico');
        }
        elseif(in_array($OAA['lom_tecnica']['formato'][0],Format::where('tipo','lectura')->get()->pluck('formato')->toArray())){
            return response()->json('era Lectura Se Transformo a kinestesico');
        }
        elseif(in_array($OAA['lom_tecnica']['formato'][0],Format::where('tipo','auditivo')->get()->pluck('formato')->toArray())){
            return response()->json('era auditivo Se Transformo a kinestesico');
        }
        elseif(in_array($OAA['lom_tecnica']['formato'][0],Format::where('tipo','kinestesico')->get()->pluck('formato')->toArray())){
            return response()->json('era kinestesico Se Transformo a kinestesico');
        }
        return response()->json(in_array($OAA['lom_tecnica']['formato'][0],Format::where('tipo','kinestesico')->get()->pluck('formato')->toArray()));

    }
    public function transformacionLectura($OAA)
    {
        if(in_array($OAA['lom_tecnica']['formato'][0],Format::where('tipo','visual')->get()->pluck('formato')->toArray())){
            return response()->json('era Visual Se Transformo a Lectura');
        }
        elseif(in_array($OAA['lom_tecnica']['formato'][0],Format::where('tipo','lectura')->get()->pluck('formato')->toArray())){
            return response()->json('era Lectura Se Transformo a Lectura');
        }
        elseif(in_array($OAA['lom_tecnica']['formato'][0],Format::where('tipo','auditivo')->get()->pluck('formato')->toArray())){
            return response()->json('era auditivo Se Transformo a Lectura');
        }
        elseif(in_array($OAA['lom_tecnica']['formato'][0],Format::where('tipo','kinestesico')->get()->pluck('formato')->toArray())){
            return response()->json('era kinestesico Se Transformo a Lectura');
        }
        return response()->json(in_array($OAA['lom_tecnica']['formato'][0],Format::where('tipo','kinestesico')->get()->pluck('formato')->toArray()));

    }
    public function transformacionAuditiva($OAA)
    {
        if(in_array($OAA['lom_tecnica']['formato'][0],Format::where('tipo','visual')->get()->pluck('formato')->toArray())){
            return response()->json('era Visual Se Transformo a Auditivo');
        }
        elseif(in_array($OAA['lom_tecnica']['formato'][0],Format::where('tipo','lectura')->get()->pluck('formato')->toArray())){
            return response()->json('era Lectura Se Transformo a Auditivo');
        }
        elseif(in_array($OAA['lom_tecnica']['formato'][0],Format::where('tipo','auditivo')->get()->pluck('formato')->toArray())){
            return response()->json('era auditivo Se Transformo a Auditivo');
        }
        elseif(in_array($OAA['lom_tecnica']['formato'][0],Format::where('tipo','kinestesico')->get()->pluck('formato')->toArray())){
            return response()->json('era kinestesico Se Transformo a Auditivo');
        }    

        return response()->json(in_array($OAA['lom_tecnica']['formato'][0],Format::where('tipo','kinestesico')->get()->pluck('formato')->toArray()));
    }
    public function dbpediaToLom($uri)
    {
        //generamos el contexto
        $contexto = $this->generate_contexto();
        //generamos un estilo
        $estilo = $this->verificacionEstilo($contexto);

        // $OA = OA::with('lom_tecnica')->get()->toArray();
        
        $index = $uri;
        $oa = new OA();

        $graph = new DBPedia_OA($uri);
        $objeto = $graph->getLOM('en');
        return $this->trasnformacion($objeto,$estilo);

    }

}
