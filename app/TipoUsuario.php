<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
           protected $fillable = [
        'nome'
    ];


    public static function toString($id){
      $tipo=TipoUsuario::where('id',$id)->first();
      return $tipo->nome;
    }
}
