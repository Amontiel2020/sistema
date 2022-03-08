<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Estudante;

class Turma extends Model
{
  protected $fillable = [
    'identificador','curso_id','curso', 'periodo', 'anoLectivo', 'anoAcademico'
  ];
  public function Sala()
  {
      return $this->belongsTo('App\Sala');
  }

  public static function toString($id)
  {
    $turma = Turma::where('id', $id)->first();
    if ($turma !=null) {
      return $turma->identificador;
    }else 
    return "";
   
  }
  public static function getDescricao($identifcador)
  {
    $turma = Turma::where('identificador', $identifcador)->first();
    if ($turma !=null) {
      return $turma->curso;
    }else 
    return "";
   
  }

  public static function getCurso($id)
  {
    $turma = Turma::where('id', $id)->first();
    if ($turma !=null) {
      $curso=Curso::toString($turma->curso_id);
      return $curso;
    }
  
  }

  public static  function cantidadEstudantes($id)
  {
    $total = Estudante::where('turma_id', $id)->where('estado', 'activo')->count();
    return $total;
  }

  public static function listaEstudantes($id)
  {
    $estudantes = Estudante::where('turma_id', $id)
      ->where('estado', 'activo') ->orderby('nome', 'asc')
      ->get();
    return $estudantes;
  }



  public function test()
  {
    echo "OK";
  }
}
