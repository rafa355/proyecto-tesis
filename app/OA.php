<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\LOM_General;
use App\LOM_Clasificacion;
use App\LOM_Educativo;
use App\LOM_Tecnica;
use App\ComponenteVirtual;

class OA extends Model
{
    protected $table = 'oa';

    protected $primaryKey = 'id';

    protected $fillable = [
        'componente_virtual_id', 
    ];

    public function lom_general()
    {
        return $this->hasOne('App\LOM_General');
    }

    public function lom_clasificacion()
    {
        return $this->hasOne('App\LOM_Clasificacion');
    }

    public function lom_educativo()
    {
        return $this->hasOne('App\LOM_Educativo');
    }

    public function lom_tecnica()
    {
        return $this->hasOne('App\LOM_Tecnica');
    }

    public function componente_virtual()
    {
        return $this->hasOne('App\ComponenteVirtual', 'componente_virtual_id', 'id');
    }

}
