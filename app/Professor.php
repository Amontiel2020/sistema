<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $fillable = [
        'nome', 'apelidos', 'BI', 'email', 'categoria', 'genero', 'estado', 'telefone1', 'telefone2', 'endereco', 'pathImage','inicio_contrato','fim_contrato'
    ];

    public function exames()
    {
        return $this->hasMany('App\ExameCandidatura');
    }

    public function pautasCandidatura()
    {
        return $this->belongsToMany('App\pautaCandidatura');
    }

    public static function toString($id)
    {
        if ($id!=null) {
            $prof = Professor::where("id", $id)->first();
            return $prof->nome." ".$prof->apelidos;
        }elseif($id==null)
        return "";
 
    }
}
