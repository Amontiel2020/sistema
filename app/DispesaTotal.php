<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DispesaTotal extends Model
{
             protected $fillable = [
        'mes', 'ano','valor','valorDistribuido'
    ];
}
