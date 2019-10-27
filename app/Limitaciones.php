<?php

# Especifíca si el aprendiz presenta limitaciones de tipo verbal, visual, motriz, auditiva o de lectura

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Limitaciones extends Model
{
    protected $table = 'limitaciones';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'lectura', 
        'auditiva', 
        'motriz', 
        'verbal', 
        'visual', 
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
