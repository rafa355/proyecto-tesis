<?php

#Esta subclase agrupa la información general que describe el objeto educativo en su conjunto.
# Corresponde a la categoría 1 del standard LOM

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
