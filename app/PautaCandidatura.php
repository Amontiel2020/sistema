<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PautaCandidatura extends Model
{
    protected $fillable = ['nome'];


    public function processo()
    {
        return $this->belongsTo('App\ProcessoCandidatura');
    }

    public function exame()
    {
        return $this->belongsTo('App\ExameCandidatura');
    }


    public function professor()
    {
        return $this->belongsTo('App\Professor');
    }
    public function Curso()
    {
        return $this->belongsTo('App\Curso');
    }

    public function Avaliacoes()
    {
        return $this->hasMany('App\AvaliacaoCandidatura');
    }
}
