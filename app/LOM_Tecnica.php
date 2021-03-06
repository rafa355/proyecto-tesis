<?php

# Esta subclase describe los requisitos y características técnicas del objeto educativo.
# Corresponde a la categoría 4 del standard LOM

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OA;

class LOM_Tecnica extends Model
{
    protected $table = 'lom_tecnica';

    protected $primaryKey = 'id';

    protected $fillable = [
        'oa_id',
        'duracion', 
        'formato', 
        'localizacion', 
        'otros_requisitos', 
        'pautas_instalacion', 
        'tamano',
    ];

    public function oa()
    {
        return $this->belongsTo('App\OA', 'oa_id', 'id');
    }

}
