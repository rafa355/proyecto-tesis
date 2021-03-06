<?php

# Esta clase hace la lectura de un OA del repositorio educativo DBPedia
# Interpreta los metadatos de DBPedia dentro de un OA
# Permite la creación de metadados LOM a partir de metadatos DBPedia

namespace App;

use EasyRdf_Graph;
use EasyRdf_Resource;
use EasyRdf_Namespace;
use EasyRdf_TypeMapper;

use App\OA;
use App\LOM_General;
use App\LOM_Clasificacion;
use App\LOM_Educativo;
use App\LOM_Tecnica;

use Storage;

class DBPedia_OA
{
    private $uri = null;
    private $resource = null;
    private $resources = [];
    private $langs = [];
    private $storage = [];

    # Constructor de la clase
    function __construct($uri)
    {

        # Apertura el OA rdf
        $graph = new EasyRdf_Graph($uri);
        $graph->load();

        # Carga del recurso DBPedia
        $this->resource = $graph->resourcesMatching('dbo:abstract')[0];
        $this->uri = $this->resource->getUri();    

    }

    public function getRedirectUri($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Must be set to true so that PHP follows any "Location:" header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $a = curl_exec($ch); // $a will contain all headers
        $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); // This is what you need, it will return you the last effective URL
        return $url;
    }

    public function storage ($uri) {
        try {
            $contents = file_get_contents($uri);
            $name = substr($uri, strrpos($uri, '/') + 1).'.rdf';
            Storage::put($name, $contents);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function open($resource) {
        $graph = new EasyRdf_Graph($resource['value']);
        $graph->load();
        return response()->json([
            $resource['language'] = $graph->resourcesMatching('dbo:abstract')[0]
        ]);
    }

    public function getRDFUri($url) {
        $rdf_uri = "";
        $rdf_uri = str_replace("resource/","data/", $url);
        $rdf_uri = $rdf_uri.'.rdf';
        return $rdf_uri;
    }

    # Descripción del recurso OA
    public function getDescripcion($lang = null) {
        return $this->get('dbo:abstract', 'literal', $lang);
    }

    # Formato(s) del recurso
    public function getFormato() {
        try {
            $standar_resource = $this->getLocalizacion('en');
            return array_unique(get_headers($standar_resource['value'], 1)["Content-Type"]);
        } catch (\Throwable $th) {
            
        }
        return [];
    }

    # Idiomas en los que se encuentra el recurso
    public function getIdioma($lang = null) {
        if (is_null($lang)) {
            $data = array_column($this->getRescursos(), 'language');
            return $data;
        } else {
            return $lang;
        }
    }

    # URI donde se encuentra el recurso al que se hace referencia
    public function getLocalizacion($lang = null) {
        $arraySearch = $this->getRescursos();
        if (is_null($lang)) {
            return  $arraySearch;
        } else {
            $index = array_search($lang, array_column($arraySearch, 'language'));
            return $arraySearch[$index];
        }
    }

    # Título del OA
    public function getTitulo($lang = null) {
        if (is_null($lang)) {
            $labels = [];
            foreach ($this->resources as $key => $resource) {
                $labels[$key] = strval($resource->get('skos:prefLabel|rdfs:label|foaf:name|rss:title|dc:title|dc11:title', 'literal', $lang));
            }
            return $this->resources;
        } else {
            return $this->get('skos:prefLabel|rdfs:label|foaf:name|rss:title|dc:title|dc11:title', 'literal', $lang);
        }
    }

    # Obtener LOM OBJECT
    public function getLOM($lang = null) {

        # Nuevo OA
        $oa = new OA();

        # LOM General
        $oa->lom_general = new LOM_General();
        $oa->lom_general->ambito = null;
        $oa->lom_general->titulo = $this->getTitulo($lang);
        $oa->lom_general->idioma = $this->getIdioma($lang);
        $oa->lom_general->descripcion = $this->getDescripcion($lang);
        $oa->lom_general->palabra_clave = null;

        # LOM Clasificación
        $oa->lom_clasificacion = new LOM_Clasificacion();
        $oa->lom_clasificacion->descripcion = $this->getDescripcion($lang);
        $oa->lom_clasificacion->palabras_claves = null;
        $oa->lom_clasificacion->proposito = null;
        $oa->lom_clasificacion->ruta_tax_entrada = null;
        $oa->lom_clasificacion->ruta_tax_fuente = null;
        $oa->lom_clasificacion->ruta_tax_identificador = null;

        # LOM Educativo
        $oa->lom_educativo = new LOM_Educativo();
        $oa->lom_educativo->contexto_uso = null;
        $oa->lom_educativo->densidad_semantica = null;
        $oa->lom_educativo->destinatario = null;
        $oa->lom_educativo->edad = null;
        $oa->lom_educativo->nivel_interactividad = null;
        $oa->lom_educativo->tiempo_aprendizaje = null;
        $oa->lom_educativo->tipo_interactividad = null;
        $oa->lom_educativo->tipo_recurso_educativo = null;

        # LOM Técnica
        $oa->lom_tecnica = new LOM_Tecnica();
        $oa->lom_tecnica->duracion = null;
        $oa->lom_tecnica->formato = $this->getFormato();
        $oa->lom_tecnica->localizacion = $this->getLocalizacion($lang);
        $oa->lom_tecnica->otros_requisitos = null;
        $oa->lom_tecnica->pautas_instalacion = null;
        $oa->lom_tecnica->tamano = null;

        return $oa;

    }

    # URI del recurso según el idioma en elque puede presentarse
    protected function getRescursos() {
        $data = [];
        # Almacenar primero el recurso 'en' puesto que los resultados generados por la api están dados en idioma 'en'
        array_push($data, ['language' => 'en', 'value' => $this->uri]);

        # Buscar todos los recursos "copia" en otros idiomas manejados
        $allSameAs = $this->resource->all('owl:sameAs');
        foreach ($allSameAs as $key => $value) {

            # Válidar que sean recursos exclusivamente del repositorio DBPedia
            if (strpos($value, '.dbpedia.org/resource/') !== false && strpos($value, 'wikidata') == false) {
                $lang = explode('.' , parse_url( strval($value), PHP_URL_HOST ))[0];
                $url = strval($value);

                # Adjuntar idioma y uri del recurso
                array_push($data, ['language' => $lang, 'value' => $url]);
            }
        }
        return $data;
    }

    # Obtener todos los resultados según la propiedad...
    private function all($property, $type = null, $lang = null)
    {

        $data = [];
        $allProperty = $this->resource->all($property, $type, $lang);
        foreach ($allProperty as $key => $value) {
            array_push($data, strval($value));
        }
        return $data;
    }

    # Obtener dato según la propiedad...
    private function get($property, $type = null, $lang = null)
    {
        return strval( $this->resource->get($property, $type, $lang) );
    }

}

## Add namespaces
EasyRdf_Namespace::set('dbpedia', 'http://dbpedia.org/resource/');
EasyRdf_Namespace::set('dbpedia-owl', 'http://dbpedia.org/ontology/');
EasyRdf_Namespace::set('dbo', 'http://dbpedia.org/ontology/');
EasyRdf_Namespace::set('ns5', 'http://dbpedia.org/datatype/');
EasyRdf_Namespace::set('ns1', 'http://dbpedia.org/class/yago/');
EasyRdf_Namespace::set('dbp', 'http://dbpedia.org/property/');
EasyRdf_TypeMapper::set('dboa:DBPediaOa', 'DBPedia_OA');
