<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
           protected $fillable = [
        'nome', 'tipo_usuario_id'
    ];
}
