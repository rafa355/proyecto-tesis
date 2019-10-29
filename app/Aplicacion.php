<?php

# Identifica la plataforma de software disponible en el entorno virtual de aprendizaje

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ComponenteVirtual;

class Aplicacion extends Model
{
    protected $table = 'aplicacion';

    protected $primaryKey = 'id';

    protected $fillable = [
        'componente_virtual_id',
        'LMS',
        'SO',
    ];

    public function componente_virtual()
    {
        return $this->belongsTo('App\ComponenteVirtual', 'componente_virtual_id', 'id');
    }

}
