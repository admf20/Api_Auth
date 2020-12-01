<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios'; //Definimos la tabla que vamos a utilizar

    protected  $fillable = [  //Definimos los campos de la tabla que vamos a utilizar
        'nombre',
        'email',
        'password',
        'api_token'
    ];

    protected  $hidden = [
        'created_at', 'updated_at'
    ];

}
