<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ExameCandidatura extends Model
{
    protected $fillable = ['nome','local','data'];


    public function Processo()
    {
        return $this->belongsTo('App\ProcessoCandidatura', 'processo_id');
    }
    public function Professor()
    {
        return $this->belongsTo('App\Professor');
    }

    public function curso()
    {
       /* return $this->belongsToMany('App\Curso', 'exame_curso', 'exame_id', 'curso_id')->withPivot('professor_id', 'peso');*/
       return $this->belongsTo('App\Curso', 'curso_id');
        
    }

    public static function toString($id)
    {
        $exame = ExameCandidatura::find($id);
        if($exame!=null)
        return $exame->nome;
        else{
            return "";
        }
    }

    public  function esta($idCurso, $coleccion)
    {
        //  dd($coleccion);
        $curso = Curso::find($idCurso);
        //   $proc = ProcessoCandidatura::find($idProc);
        if ($coleccion !=null && $coleccion->contains($curso)) {
            return true;
        } else {
            return false;
        }
    }

    public static function listaExamesCurso($idProc,$idCurso)
    {

        $exames = ExameCandidatura::where('processo_id', $idProc)->get();
        $registro = DB::table('curso_exame')->select('peso')->where('exame_id', $exame_id)->where('curso_id', $curso_id)->first();

        return $exames;
    }
    public static function obter_peso($exame_id, $curso_id)
    {
        $registro = DB::table('curso_exame')->select('peso')->where('exame_id', $exame_id)->where('curso_id', $curso_id)->first();
        $array = json_decode(json_encode($registro), true);



        return $array["peso"];
    }
    public static function obter_profe($exame_id, $curso_id)
    {
        $registro = DB::table('curso_exame')->select('professor_id')->where('exame_id', $exame_id)->where('curso_id', $curso_id)->first();
        $array = json_decode(json_encode($registro), true);
        return Professor::toString($array["professor_id"]);

        //return $array["professor_id"];

    }
}
