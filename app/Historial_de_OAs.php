<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historial_de_OAs extends Model
{
    protected $table = 'historial_oa';

    protected $primaryKey = 'id';

    protected $fillable = [
        'oa_id', 
        'titulo', 
        'idioma', 
        'descripcion', 
        'palabra_clave',
    ];
}
