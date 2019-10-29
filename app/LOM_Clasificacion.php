<?php

# Esta  subclase descrribe dónde se sitúa el objeto educativo dentro de un sistema de clasificación concreto.
# Corresponde a la categoría 9 del standard LOM

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OA;

class LOM_Clasificacion extends Model
{
    protected $table = 'lom_clasificacion';

    protected $primaryKey = 'id';

    protected $fillable = [
        'descripcion', 
        'palabras_claves', 
        'proposito', 
        'ruta_tax_entrada', 
        'ruta_tax_fuente', 
        'ruta_tax_identificador',
    ];
    
    public function oa()
    {
        return $this->belongsTo('App\OA', 'oa_id', 'id');
    }
    
}
