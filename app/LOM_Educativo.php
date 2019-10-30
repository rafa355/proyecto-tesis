<?php

namespace App;

# Esta subclase describe las características educativas o pedagógicas fundamentales del objeto educativo.
# Corresponde a la categpria 5 del standard LOM
use Illuminate\Database\Eloquent\Model;
use App\OA;

class LOM_Educativo extends Model
{
    protected $table = 'lom_educativo';

    protected $primaryKey = 'id';

    protected $fillable = [
        'oa_id',
        'contexto_uso', 
        'densidad_semantica', 
        'destinatario', 
        'edad', 
        'nivel_interactividad', 
        'tiempo_aprendizaje',
        'tipo_interactividad',
        'tipo_recurso_educativo',
    ];

    public function oa()
    {
        return $this->belongsTo('App\OA', 'oa_id', 'id');
    }
        
}
