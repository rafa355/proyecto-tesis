<?php

# Identifica la capacidad disponible de los dispositivos del entorno virtual

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ComponenteVirtual;

class DispositivoDisponible extends Model
{
    protected $table = 'dispositivo_disponible';

    protected $primaryKey = 'id';

    protected $fillable = [
        'componente_virtual_id',
        'audio',
        'memoria_ram',
        'memoria_secundaria',
        'resolucion_pantalla',
        'uso_procesador',
    ];

    public function componente_virtual()
    {
        return $this->belongsTo('App\ComponenteVirtual', 'componente_virtual_id', 'id');
    }

}
