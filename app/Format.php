<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    protected $table = 'formats';

    protected $fillable = [
         'formato', 'tipo',
    ];
}
