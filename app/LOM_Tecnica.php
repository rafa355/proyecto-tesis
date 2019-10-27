<?php

# Esta subclase describe los requisitos y características técnicas del objeto educativo.
# Corresponde a la categoría 4 del standard LOM

namespace App;

use Illuminate\Database\Eloquent\Model;

class LOM_Tecnica extends Model
{
    protected $table = 'tecnica';

    protected $primaryKey = 'id';

    protected $fillable = [
        'duracion', 
        'formato', 
        'localizacion', 
        'otros_requisitos', 
        'pautas_instalacion', 
        'tamano',
    ];

}
