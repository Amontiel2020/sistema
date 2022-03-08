<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{

    protected $fillable=['nome'];

    public function municipios(){
        return $this->hasMany('App\Municipio');
    }

    public static function toString($id)
    {
       $prov = Provincia::where('id', $id)->first();
      if ($prov!=null) {
        return $prov->nome;

      }else {
          return "";
      }
    }

    
}
