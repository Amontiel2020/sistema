<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quarto extends Model
{
    protected $fillable=['descricao'];

    public function Base()
    {
        return $this->belongsTo('App\Base');
    }
}
