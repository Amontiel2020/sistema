<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $fillable = [
        'id', 'consumivel_id','precoUnitario','qtd','factura','fornecedor'
    ];

    public static function obterEntradas($idConsumivel){
        $qtd=Entrada::where('consumivel_id',$idConsumivel)->sum('qtd');
    return $qtd;
    }
}
