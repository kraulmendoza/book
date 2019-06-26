<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura_venta extends Model
{
	protected $table = 'factura_venta';
    protected $fillable = [
    	'codigo_Usuario'
    ];

    public function __construct()
{
    parent::__construct();
}
   
}
