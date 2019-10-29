<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RecursoiInstruccional;

class Contenido extends Model
{
    protected $table = 'contenido';

    protected $primaryKey = 'id';

    protected $fillable = [
        'recurso_id',
        'formato',
        'idioma',
        'tema',
        'tipo',
    ];

    public function recurso_instruccional()
    {
        return $this->belongsTo('App\RecursoiInstruccional', 'recurso_id', 'id');
    }

}
