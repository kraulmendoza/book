<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
	protected $table = 'libro';
    protected $fillable = [
    	'id','titulo','autor','precioCompra', 'precioVenta', 'fechaPublicacion'
    ];

    public function __construct()
{
    parent::__construct();
}
   
}
