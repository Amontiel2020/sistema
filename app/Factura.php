<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    public $incrementing = false;
    
    protected $fillable = [
             'numFactura','tipo','codEst','estado','ano','formaPagamento'
    ];

    public function getKeyName(){
        return "numFactura";
    }
}
