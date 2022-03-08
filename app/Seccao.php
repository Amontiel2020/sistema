<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seccao extends Model
{
    protected $fillable=['nome'];

    public static function toString($id){
        $seccao=Seccao::find($id);
        return $seccao->nome;
    }

    public function salas(){
        return $this->hasMany('App\Sala');
    }





}
