<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LOM_General extends Model
{
    protected $table = 'general';

    protected $primaryKey = 'id';

    protected $fillable = [
        'ambito', 
        'titulo', 
        'idioma', 
        'descripcion', 
        'palabra_clave',
    ];

}
