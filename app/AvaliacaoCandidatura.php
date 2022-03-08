<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvaliacaoCandidatura extends Model
{
    protected $fillable = ['valor','peso'];

    public function processo()
    {
        return $this->belongsTo('App\ProcessoCandidatura');
    }

    public function exame()
    {
        return $this->belongsTo('App\ExameCandidatura');
    }

    public function Candidato()
    {
        return $this->belongsTo('App\Candidato');
    }

    public function Pauta()
    {
        return $this->belongsTo('App\PautaCandidatura');
    }


}
