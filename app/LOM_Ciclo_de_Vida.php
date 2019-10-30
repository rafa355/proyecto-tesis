<?php

namespace App;
use App\OA;

use Illuminate\Database\Eloquent\Model;

class LOM_Ciclo_de_Vida extends Model
{
    protected $table = 'lom_ciclo_de_vida';

    protected $primaryKey = 'id';

    protected $fillable = [
        'oa_id',
        'fecha', 
    ];
}
