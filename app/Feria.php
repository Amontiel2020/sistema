<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feria extends Model
{
    protected $fillable = [
        'data_inicio', 'data_fim'
    ];

    public function funcionario()
    {
        return $this->belongsTo('App\Funcionario');
    }
}
