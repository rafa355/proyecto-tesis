<?php

namespace App;

# Esta subclase describe las características educativas o pedagógicas fundamentales del objeto educativo.
# Corresponde a la categpria 5 del standard LOM
use Illuminate\Database\Eloquent\Model;

class LOM_Educativo extends Model
{
    protected $table = 'educativo';

    protected $primaryKey = 'id';

    protected $fillable = [
        'contexto_uso', 
        'densidad_semantica', 
        'destinatario', 
        'edad', 
        'nivel_interactividad', 
        'tiempo_aprendizaje',
        'tipo_interactividad',
        'tipo_recurso_educativo',
    ];
    
}
