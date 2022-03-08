<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NaturezaDispesas extends Model
{
    protected $fillable = [
        'descricao'
    ];

    public $timestamps = false;
}
