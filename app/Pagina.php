<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RecursoiInstruccional;

class Pagina extends Model
{

    protected $table = 'pagina';

    protected $primaryKey = 'id';

    protected $fillable = [
        'recurso_id',
        'descripcion',
        'formato',
        'idioma',
        'tipo',
        'redes_sociales',
    ];

    public function recurso_instruccional()
    {
        return $this->belongsTo('App\RecursoiInstruccional', 'recurso_id', 'id');
    }

}
