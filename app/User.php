<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Preferencias;
use App\Limitaciones;
use App\EstiloAprendizaje;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 
        'email', 
        'password', 
        'pregunta_seguridad', 
        'respuesta_seguridad',
        'sexo', 
        'fecha_nacimiento', 
        'lugar_nacimiento', 
        'estatus',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function limitaciones()
    {
        return $this->hasOne('App\Limitaciones');
    }

    public function preferencias()
    {
        return $this->hasOne('App\Preferencias');
    }

    public function estilo_aprendizaje()
    {
        return $this->hasOne('App\EstiloAprendizaje');
    }

}
