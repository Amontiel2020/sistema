<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $fillable = ['nome'];

    public function provincia()
    {
        return $this->belongsTo('App\Provincia');
    }

    public static function toString($id)
    {
        $municipio = Municipio::where('id', $id)->first();
        if ($municipio != null) {
            return $municipio->nome;
        }else {
            return "";
        }
    }
}
