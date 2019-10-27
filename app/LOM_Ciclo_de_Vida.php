<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LOM_Ciclo_de_Vida extends Model
{
    protected $table = 'ciclo_de_vida';

    protected $primaryKey = 'id';

    protected $fillable = [
        'fecha', 
    ];
}
