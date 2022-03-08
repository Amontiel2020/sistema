<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $fillable = [
        'nome','endereço','telefone'
    ];

    public $timestamps = false;
}
