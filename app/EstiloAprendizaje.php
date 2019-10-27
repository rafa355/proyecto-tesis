<?php

# Especifíca el estilo de aprendizaje del aprendiz en cuestion

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class EstiloAprendizaje extends Model
{
    protected $table = 'estilo_aprendizaje';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id', 
        'estilo',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
