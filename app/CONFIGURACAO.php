<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CONFIGURACAO extends Model
{
    public static function getAnoAcademico(){
        return "2022";
    }
}
