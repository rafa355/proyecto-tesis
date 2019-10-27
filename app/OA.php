<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OA extends Model
{
    protected $table = 'oa';

    protected $primaryKey = 'id';

    protected $fillable = [
        'general_id', 
        'tecnica_id', 
        'clasificacion_id', 
        'educativo_id', 
        'componente_virtual_id', 
    ];

}
