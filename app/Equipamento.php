<?php

# Identifica el equipamiento o dispositivos instalados y su capacidad fisica

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ComponenteFisico;

class Equipamento extends Model
{
    protected $table = 'equipamento';

    protected $primaryKey = 'id';

    protected $fillable = [
        'componente_fisico_id',
        'audio',
        'gps',
        'memoria_ram',
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
