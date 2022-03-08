<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    public $incrementing = false;
    
    protected $fillable = [
             'numEstudante','anoCurricular','semestre'
    ];

    public function getKeyName(){
        return "estudante_id";
    }
    public function Estudante()
    {
        return $this->belongsTo('App\Estudante');
    }
    public function Curso()
    {
        return $this->belongsTo('App\Curso');
    }
}
