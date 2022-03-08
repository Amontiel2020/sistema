<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = [
        'id','semestre','anoAcademico'
    ];

    public function turma(){
        return $this->belongsTo('App\Turma');

    }
}
