<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title','start','end','horario_id','unidade'
    ];

    
    public function horario(){
        return $this->belongsTo('App\Horario');

    }
}
