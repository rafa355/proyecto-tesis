<?php

#Esta subclase agrupa la información general que describe el objeto educativo en su conjunto.
# Corresponde a la categoría 1 del standard LOM

namespace App;

use EasyRdf_Graph;
use EasyRdf_Resource;
use EasyRdf_Namespace;
use EasyRdf_TypeMapper;

class DBPedia_OA
{
    private $uri = null;
    private $resource = null;

    function __construct($uri)
    {   
        # Apertura el OA rdf
        $graph = new EasyRdf_Graph($uri);
        $graph->load();

        # Carga del recurso DBPedia
        $this->resource = $graph->resourcesMatching('dbo:abstract')[0];

    }

    public function getDescripcion($lang = null) {
        return $this->get('dbo:abstract', 'literal', $lang);
    }

    public function getFormato() {
        return get_headers($this->getLocalizacion(), 1)["Content-Type"];
    }

    public function getIdioma() {
        $data = array_column($this->getRescursos(), 'language');
        return $data;
    }

    public function getLocalizacion($lang = null) {
        $arraySearch = $this->getRescursos();
        $index = array_search(is_null($lang) ? 0:$lang, array_column($arraySearch, 'language'));
        return $arraySearch[$index];
    }

    public function getTitulo($lang = null) {
        return $this->get('skos:prefLabel|rdfs:label|foaf:name|rss:title|dc:title|dc11:title', 'literal', $lang);
    }

    protected function getRescursos() {
        $data = [];
        # Almacenar primero el recurso 'en' puesto que los resultados generados por la api están dados en idioma 'en'
        array_push($data, ['language' => 'en', 'value' => $this->uri]);

        # Buscar todos los recursos "copia"
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
    

    private function all($property, $type = null, $lang = null)
    {

        $data = [];
        $allProperty = $this->resource->all($property, $type, $lang);
        foreach ($allProperty as $key => $value) {
            array_push($data, strval($value));
        }
        return $data;
    }

    private function get($property, $type = null, $lang = null)
    {
        return strval( $this->resource->get($property, $type, $lang) );
    }

}

## Add namespaces
EasyRdf_Namespace::set('dbpedia', 'http://dbpedia.org/resource/');
EasyRdf_Namespace::set('dbo', 'http://dbpedia.org/ontology/');
EasyRdf_Namespace::set('ns5', 'http://dbpedia.org/datatype/');
EasyRdf_Namespace::set('ns1', 'http://dbpedia.org/class/yago/');
EasyRdf_Namespace::set('dbp', 'http://dbpedia.org/property/');
EasyRdf_TypeMapper::set('dboa:DBPediaOa', 'DBPedia_OA');
