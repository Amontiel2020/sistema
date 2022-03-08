<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $fillable=['numero','estado'];



    public function Seccao()
    {
        return $this->belongsTo('App\Seccao');
    }
}
