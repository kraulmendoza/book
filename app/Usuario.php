<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
	protected $table = 'usuario';
    protected $fillable = ['id','nombre', 'apellido', 'correo', 'numeroTelefono', 'direccion', 'user', 'password'
    ];
}
