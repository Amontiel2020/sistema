<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo_funcionario extends Model
{
    protected $fillable = [
        'nome', 'descricao'
    ];

    public static function toString($id){
        $grupo=Grupo_funcionario::find($id);
        if($grupo !=null){
            return $grupo->nome;

        }else{
            return "";
        }
    }

}
