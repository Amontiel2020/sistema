<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumivel extends Model
{
    protected $fillable = [
        'id', 'nome','tipo','stockMin','fornecedor','obs'
    ];
}