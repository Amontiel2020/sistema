<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $fillable = [
        'estudante_id', 'disciplina_id', 'anoAcad', 'tipo', 'valor','pauta_id'
    ];
}
