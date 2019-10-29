<?php

# Identifica la ubicacion del equipo desde donde se realiza el acceso al entorno virtual de aprendizaje

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ComponenteFisico;

class Localizacion extends Model
{
    protected $table = 'localizacion';

    protected $primaryKey = 'id';

    protected $fillable = [
        'componente_fisico_id',
        'ciudad',
        'idioma',
        'pais',
        'memoria_secundaria',
        'pantalla',
        'procesador',
        'tipo_disponible_acceso',
        'tipo_red',
    ];

    public function componente_fisico()
    {
        return $this->belongsTo('App\ComponenteFisico', 'componente_fisico_id', 'id');
    }

}
