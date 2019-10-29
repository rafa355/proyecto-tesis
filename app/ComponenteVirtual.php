<?php

# Caracteriza la capacidad disponible de los dispositivos utilizados
# en el punto de acceso al EVA, así como la plataforma (hardware y software)
# y requerimientos de las aplicaciones utilizadas por el usuario

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Aplicacion;
use App\DispositivoDisponible;

class ComponenteVirtual extends Model
{
    protected $table = 'componente_virtual';

    protected $primaryKey = 'id';


    public function aplicacion()
    {
        return $this->hasOne('App\Aplicacion');
    }

    public function dispositivo_disponible()
    {
        return $this->hasOne('App\DispositivoDisponible');
    }

}
