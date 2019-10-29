<?php

# Caracteriza la capacidad instalada de computo (memoria, procesador), redes, dispositivos
# de entrada y salida, y ubicación del punto de acceso al Entorno Virtual de Aprendizaje

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Equipamento;
use App\Localizacion;

class ComponenteFisico extends Model
{
    protected $table = 'componente_fisico';

    protected $primaryKey = 'id';


    public function equipamento()
    {
        return $this->hasOne('App\Equipamento');
    }

    public function localizacion()
    {
        return $this->hasOne('App\Localizacion');
    }
}
