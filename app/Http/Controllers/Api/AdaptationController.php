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

class AdaptationController extends Controller
{
    public function adaptation(Request $request)
    {
        //$request->validate([
        //    'oa' => 'required',
        //    'requerimiento' => 'required',
        //]);

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

    public function dbpedia() {
        $endpoint = "http://es.dbpedia.org/sparql";
        $sc = new SparqlClient();
        $sc->setEndpointRead($endpoint);
        //$sc->setMethodHTTPRead("GET");
        // $q = "select *  where {?x ?y ?z.} LIMIT 5";
        // $q = "select distinct ?Concept where {[] a ?Concept} LIMIT 100";
        $q =    "PREFIX dbpedia-owl: <http://dbpedia.org/ontology/>
                PREFIX dcterms: <http://purl.org/dc/terms/>
                SELECT ?torero ?cantante WHERE{
                ?torero rdf:type dbpedia-owl:BullFighter .
                ?torero dbpedia-owl:spouse ?cantante .
                ?cantante dcterms:subject <http://es.dbpedia.org/resource/Categoría:Cantantes_de_coplas>
                }";
        return $rows = $sc->query($q, 'rows');
        $err = $sc->getErrors();
        if ($err) {
            print_r($err);
            throw new Exception(print_r($err, true));
        }

        foreach ($rows["result"]["variables"] as $variable) {
            printf("%-20.20s", $variable);
            echo '|';
        }
        echo "\n";

        foreach ($rows["result"]["rows"] as $row) {
            foreach ($rows["result"]["variables"] as $variable) {
                printf("%-20.20s", $row[$variable]);
                echo '|';
            }
            echo "\n";
        }
    }

    public function rdf($uri)
    {
        $foaf = new \EasyRdf_Graph($uri);
        //$foaf = new \EasyRdf_Graph("http://njh.me/foaf.rdf");
        $foafe =  $foaf;
        $foaf->load();

        return response()->json([
            '0' => $oa,
            '2' => json_decode($foaf->serialise('json'),true)[$uri],
            'titulo' => strval($foaf->label()),
        ]);
    }

    public function dbpediaToLom($uri)
    {
        $index = $uri;
        //$uri = 'http://127.0.0.1:9000/images/prueba.rdf';
        //$foaf = new \EasyRdf_Graph($uri);
        //$foaf->load();
        $oa = new OA();

        $graph = new DBPedia_OA($uri);
        return response()->json([$graph->getLOM('en')]);

    }

}
