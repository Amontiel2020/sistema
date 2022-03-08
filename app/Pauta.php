<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pauta extends Model
{

    protected $fillable = [
        'nome', 'disciplina_id', 'ano', 'semestre', 'turma_id', 'professor_id', 'anoAcademico', 'estado', 'url'
    ];

    public function avaliacoes()
    {
        return $this->hasMany('App\Avaliacao');
    }

    public function estudantes()
    {
        return $this->belongsToMany('App\Estudante', 'pauta_estudante', 'pauta_id', 'estudante_id', 'resultado');
    }

    public function curso()
    {
        return $this->belongsTo('App\Curso');
    }


    public static function obterAvaliacao($est, $disc, $tipo, $anoAcad)
    {
        //dd($est);
        $aval = Avaliacao::where("estudante_id", $est)
            ->where("disciplina_id", $disc)
            ->where("tipo", $tipo)
            ->where("anoAcad", $anoAcad)->first();
        if ($aval != null) {
         //  $valor= floatval($aval->valor);
        
            return $aval->valor;
        } else {
            return "";
        }
        // return 5;
    }

    public static function obterMedia($est, $disc, $anoAcad)
    {
        $F1 = Pauta::obterAvaliacao($est, $disc, 'F1', $anoAcad);
        $F2 = Pauta::obterAvaliacao($est, $disc, 'F2', $anoAcad);
        $MAC = Pauta::obterAvaliacao($est, $disc, 'MAC', $anoAcad);

        if ($F1 == null) {
            $F1 = 0;
        }
        if ($F2 == null) {
            $F2 = 0;
        }
        if ($MAC == null) {
            $MAC = 0;
        }


        // if ($F1 != null && $F2 != null && $MAC != null) {
        $media = (float)(($F1 + $F2 + $MAC) / 3);
        //return round($media, 1);
        return round($media, 0, PHP_ROUND_HALF_UP);
        //    return ($F1 + $F2 + $MAC) / 3;

        /* if ($F1 == 0 && $F2 == 0 && $MAC == 0) {
            return 0;
        }*/
    }

    public static function obterMediaFinal($est, $disc, $anoAcad)
    {
        $Media = Pauta::obterMedia($est, $disc, $anoAcad);
        $resultado = "";

        if (!\App\Disciplina::isNuclear($disc) && $Media >= 14) {
            $resultado = $Media;
        }

        if (!\App\Disciplina::isNuclear($disc) && $Media < 14) {
            // $Media = Pauta::obterMedia($est, $disc, $anoAcad);
            $Ex1 = Pauta::obterAvaliacao($est, $disc, 'Ex1', $anoAcad);
            $Ex2 = Pauta::obterAvaliacao($est, $disc, 'Ex2', $anoAcad);
            $Ex3 = Pauta::obterAvaliacao($est, $disc, 'Ex3', $anoAcad);
            if ($Ex1 != null) {
                $resultado = $Media * 0.4 + $Ex1 * 0.6;
                if (($resultado != null) && ($resultado >= 10)) {
                    Pauta::actulizarEstado($est, $disc, $anoAcad, "Aprovado");
                    Pauta::actulizarClassif($est, $disc, $anoAcad, $resultado);
                }
                if (($resultado != null) && ($resultado < 10)) {
                    Pauta::actulizarEstado($est, $disc, $anoAcad, "Reprovado");
                    Pauta::actulizarClassif($est, $disc, $anoAcad, $resultado);
                }
            } else {
                $resultado = "";
            }

            //$resultado = round((((double)($Media * 0.4) + (double)($Ex1 * 0.6))), 2);
            if ($Ex2 != null) {
                $resultado = $Ex2;
            }
            if ($Ex3 != null) {
                $resultado = $Ex3;
            }
        }

        if (\App\Disciplina::isNuclear($disc)) {
            // $Media = Pauta::obterMedia($est, $disc, $anoAcad);
            $Ex1 = Pauta::obterAvaliacao($est, $disc, 'Ex1', $anoAcad);
            $Ex2 = Pauta::obterAvaliacao($est, $disc, 'Ex2', $anoAcad);
            $Ex3 = Pauta::obterAvaliacao($est, $disc, 'Ex3', $anoAcad);
            if ($Ex1 != null) {
                $resultado = $Media * 0.4 + $Ex1 * 0.6;
                if (($resultado != null) && ($resultado >= 10)) {
                    Pauta::actulizarEstado($est, $disc, $anoAcad, "Aprovado");
                    Pauta::actulizarClassif($est, $disc, $anoAcad, $resultado);
                }
                if (($resultado != null) && ($resultado < 10)) {
                    Pauta::actulizarEstado($est, $disc, $anoAcad, "Reprovado");
                    Pauta::actulizarClassif($est, $disc, $anoAcad, $resultado);
                }
            } else {
                $resultado = "";
            }

            //$resultado = round((((double)($Media * 0.4) + (double)($Ex1 * 0.6))), 2);
            if ($Ex2 != null) {
                $resultado = $Ex2;
            }
            if ($Ex3 != null) {
                $resultado = $Ex3;
            }
        }
        return round($resultado, 0, PHP_ROUND_HALF_UP);
    }

    public static function obterPautasProfessor($id)
    {

        $pautas = Pauta::where('professor_id', $id)->get();
        return $pautas;
    }

    public static function actulizarEstado($est, $disc, $anoAcad, $estado)
    {
        $inscricoes = Inscricao::where('estudante_id', $est)->where('anoAcademico', $anoAcad)->get();

        foreach ($inscricoes as $inscricao) {
            //  foreach ($inscricao->disciplinas as  $disciplina) {
            //    if ($disciplina->pivot->disciplina_id == $disc) {
            $inscricao->disciplinas()->updateExistingPivot($disc, ['estado' => $estado]);

            $inscricao->save();
            //   }
            // }
        }
    }


    public static function actulizarClassif($est, $disc, $anoAcad, $classif)
    {
        $inscricoes = Inscricao::where('estudante_id', $est)->where('anoAcademico', $anoAcad)->get();

        foreach ($inscricoes as $inscricao) {
            ///  foreach ($inscricao->disciplinas as  $disciplina) {
            //      if ($disciplina->pivot->disciplina_id == $disc) {
            $inscricao->disciplinas()->updateExistingPivot($disc, ['classif' => $classif]);
            $inscricao->save();

            //    }
            //  }
        }
    }

    public static function obterResultadoEstudante($est, $disc, $anoAcad)
    {
        $inscricoes = Inscricao::where('estudante_id', $est)->where('anoAcademico', $anoAcad)->get();

        $resultado = "";
        foreach ($inscricoes as $inscricao) {
            if ($inscricao != null) {
                foreach ($inscricao->disciplinas as  $disciplina) {
                    $resultado = $disciplina->pivot->resultado;
                }
            }
        }
        if ($resultado != null) {
            return $resultado;
        } else {
            return "";
        }
    }

    public static function obter_aprovados($lista, $disc, $ano_acad)
    {

        $count = 0;

        foreach ($lista as  $estudante) {
            if (Pauta::obterMediaFinal($estudante->id, $disc, $ano_acad) >= 10) {
                $count++;
            }
        }
        return $count;
    }
    public static function obter_reprovados($lista, $disc, $ano_acad)
    {

        $count = 0;

        foreach ($lista as  $estudante) {
            if ((Pauta::obterMediaFinal($estudante->id, $disc, $ano_acad) < 10)
            && (
                 Pauta::obterAvaliacao($estudante->id, $disc,"F1",$ano_acad)!=""
                || Pauta::obterAvaliacao($estudante->id, $disc,"F2",$ano_acad)!=""
                || Pauta::obterAvaliacao($estudante->id, $disc,"Ex1",$ano_acad)!=""
                || Pauta::obterAvaliacao($estudante->id, $disc,"Ex2",$ano_acad)!=""
                || Pauta::obterAvaliacao($estudante->id, $disc,"Ex3",$ano_acad)!=""
            )
           
            ) {
                $count++;
            }
        }
        return $count;
    }
    public static function obter_nao_avaliados($lista, $disc, $ano_acad)
    {

        $count = 0;

        foreach ($lista as  $estudante) {
            if (Pauta::obterMedia($estudante->id, $disc, $ano_acad) == 0 
            && Pauta::obterAvaliacao($estudante->id, $disc,"F1",$ano_acad)==""
            && Pauta::obterAvaliacao($estudante->id, $disc,"F2",$ano_acad)==""
            && Pauta::obterAvaliacao($estudante->id, $disc,"Ex1",$ano_acad)==""
            && Pauta::obterAvaliacao($estudante->id, $disc,"Ex2",$ano_acad)==""
            && Pauta::obterAvaliacao($estudante->id, $disc,"Ex3",$ano_acad)==""
           
            ) {
                $count++;
            }
        }
        return $count;
    }
    public static function obter_avaliados($lista, $disc, $ano_acad)
    {

        $count = 0;

        foreach ($lista as  $estudante) {
            if (Pauta::obterMedia($estudante->id, $disc, $ano_acad) > 0) {
                $count++;
            }
        }
        return $count;
    }

   
    
}
