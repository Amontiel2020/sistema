<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operacao extends Model
{
    protected $fillable = [
        'descricao','nome', 'valor','conta_id'
    ];

  
}
