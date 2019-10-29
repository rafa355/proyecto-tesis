<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Contenido;
use App\Pagina;

class RecursoiInstruccional extends Model
{
    protected $table = 'recurso_instruccional';

    protected $primaryKey = 'id';

    public function contenido()
    {
        return $this->hasOne('App\Contenido');
    }

    public function pagina()
    {
        return $this->hasOne('App\Pagina');
    }

}
