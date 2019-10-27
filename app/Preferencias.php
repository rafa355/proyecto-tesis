<?php

# Especifíca las preferencias del aprendiz

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Preferencias extends Model
{
    protected $table = 'preferencias';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id', 
        'contenido', 
        'formato', 
        'idioma', 
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
