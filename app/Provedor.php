<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provedor extends Model
{
	protected $table = 'provedor';
    protected $fillable = ['id','nombre', 'tipo', 'correo', 'direccion', 'telefono'
    ];
}