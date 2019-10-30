<?php

#Esta subclase agrupa la información general que describe el objeto educativo en su conjunto.
# Corresponde a la categoría 1 del standard LOM

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OA;

class LOM_General extends Model
{
    protected $table = 'lom_general';

    protected $primaryKey = 'id';

    protected $fillable = [
        'oa_id',
        'ambito', 
        'titulo', 
        'idioma', 
        'descripcion', 
        'palabra_clave',
    ];

    public function oa()
    {
        return $this->belongsTo('App\OA', 'oa_id', 'id');
    }
    
}
