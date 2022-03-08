<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saida extends Model
{
    protected $fillable = [
        'id', 'consumivel_id','qtd','destinatario','responsavel','obs'
    ];

    public static function obterSaidas($idConsumivel){
        $qtd=Saida::where('consumivel_id',$idConsumivel)->sum('qtd');
    return $qtd;
    }
}
