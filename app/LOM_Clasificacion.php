<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LOM_Clasificacion extends Model
{
    protected $table = 'clasificacion';

    protected $primaryKey = 'id';

    protected $fillable = [
        'descripcion', 
        'palabras_claves', 
        'proposito', 
        'ruta_tax_entrada', 
        'ruta_tax_fuente', 
        'ruta_tax_identificador',
    ];
}
