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
        //'componente_virtual_id', 
    ];

    public function lom_general()
    {
        return $this->hasOne('App\LOM_General', 'oa_id');
    }

    public function lom_clasificacion()
    {
        return $this->hasOne('App\LOM_Clasificacion', 'oa_id');
    }

    public function lom_educativo()
    {
        return $this->hasOne('App\LOM_Educativo', 'oa_id');
    }

    public function lom_tecnica()
    {
        return $this->hasOne('App\LOM_Tecnica', 'oa_id');
    }

}
