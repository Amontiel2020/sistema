<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sumario extends Model
{
    protected $fillable=['titulo','resumo','data'];

    public function professor(){
        return $this->belongsTo('App\Professor');

    }
    public function disciplina(){
        return $this->belongsTo('App\Disciplina');

    }
}
