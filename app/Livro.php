<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Livro extends Model
{
    protected $fillable = [
        'codigo','titulo','edicao','editora','ano','pais','qtd','codBarra','categoria'
    ];

    public static function toStringPais($codigo){
        $pais = DB::table('pais')->where("paisId",$codigo)->first();
        return $pais->paisNome;
    }

    public function Curso()
    {
       return $this->belongsTo('App\Curso');
    }
    public function Categoria()
    {
       return $this->belongsTo('App\Cat_livro');
    }
}
