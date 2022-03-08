<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    protected $fillable = [
        'nome', 'curso_id', 'ano', 'semestre','nuclear', 'descricao', 'professor_id','T','TP','P','HS','HSem'
    ];

    /* public function professor()
    {
        return $this->belongsTo('App\Professor');
    }*/

    public function DisciplinaPrecedencia()
    {
        return $this->belongsTo('App\Disciplina', 'discPrec_id');
    }


    public static function toString($id)
    {
        $disc = Disciplina::where("id", $id)->first();
        if (isset($disc)) {
            return $disc->nome;
        } else {
            return "";
        }
    }
  
    public static function temPrecedencia($disciplina, $disciplinasAtrasso)
    {
        if ($disciplina->discPrec_id != null) {
            foreach ($disciplinasAtrasso as $discAtrasso) {
                if ($disciplina->discPrec_id == $discAtrasso) {
                    return true;
                }
            }
        }

        return false;
    }
    public static function getSemestre($id)
    {
        $disciplina=Disciplina::find($id);
        return $disciplina->semestre;
    }

    public static function isNuclear($idDisc)
    {
        $disciplina=Disciplina::find($idDisc);
        if ($disciplina->nuclear=="1") {
            return true;
        }
        if ($disciplina->nuclear=="0") {
            return false;
        }
    }

    public static function getAno($id)
    {
        $disciplina=Disciplina::find($id);
        return $disciplina->ano;
    }
}
