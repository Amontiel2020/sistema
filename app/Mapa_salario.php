<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapa_salario extends Model
{
    protected $fillable=['titulo','mes','ano','descricao'];


    public function temp_salarios(){
        return $this->hasMany('App\Temp_salario');
    }

    public function grupo()
    {
        return $this->belongsTo('App\Grupo_funcionario');
    }
}
