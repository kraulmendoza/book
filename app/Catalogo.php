<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
	protected $table = 'catalogo';
    protected $fillable = ['id','categoria'];
}