<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    
           protected $fillable = [
        'identificador'
    ];

    public static function toString($id){
      $departamento=Departamento::where('id',$id)->first();
      if ($departamento!=null) {
        return $departamento->identificador;
      }else{
        return "-";
      }
     
    }

    public function dispesas(){
    	//$departamento=Departamento::where('id',$id)->first();

    	$dispesas=Dispesa::where('departamento_id',$this->id)->get();

    	return $dispesas;
    }

    public function TemDispesas(){
    	//$departamento=Departamento::where('id',$id)->first();

    	$dispesas=$this->dispesas();

    	if (!$dispesas->isEmpty()) {
    	
    		return true;
    	}else{
    		echo false;
    		return false;
    	}

    
    }
}
