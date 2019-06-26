<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura_compra extends Model
{
	protected $table = 'factura_compra';
    protected $fillable = [
    	'codigo_Provedor'
    ];

    public function __construct()
{
    parent::__construct();
}
   
}
