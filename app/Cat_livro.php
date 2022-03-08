<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat_livro extends Model
{
    protected $fillable = ["nome", "descricao"];


    public static function toString($id)
    {
        $cat = Cat_livro::find($id);
        if ($cat != null) {
            return  $cat->nome;
        }
        return " ";
    }
}
