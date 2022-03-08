<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class Curso extends Model
{
    protected $fillable = [
        'id', 'codigo', 'nome', 'duracao'
    ];

    public function ProcessosCandidatura()
    {
        return $this->belongsToMany('App\ProcessoCandidatura');
    }

    public function Seccao()
    {
        return $this->belongsTo('App\Seccao');
    }

    /*  public function ExamesCandidaturas()
    {
        return $this->belongsToMany('App\ExameCandidatura');
    }*/
    public function ExamesCandidaturas()
    {
        return $this->belongsToMany('App\Curso', 'curso_exame', 'curso_id', 'exame_id')->withPivot('professor_id', 'peso');
    }

    public static function toString($id)
    {
        if ($id != null) {
            $curso = Curso::where('id', $id)->first();
            return $curso->nome;
        } else if ($id == null)
            return "Null";
    }
    public static function duracao($id)
    {
        if ($id != null) {
            $curso = Curso::where('id', $id)->first();
            return $curso->duracao;
        } else if ($id == null)
            return 0;
    }

    public static function matriculados($id)
    {
        $matriculados = Estudante::where(['curso_id' => $id])->where('estado', '<>', 'candidato')->count();
        return $matriculados;
    }

    public static function desistidos($id)
    {
        $desistidos = Estudante::where(['curso_id' => $id])->where(['estado' => "Desistente"])->where('estado', '<>', 'candidato')->count();
        return $desistidos;
    }
    public static function activos($id)
    {
        $activos = Estudante::where(['curso_id' => $id])->where(['estado' => "Activo"])->where('estado', '<>', 'candidato')->count();
        return $activos;
    }

    public static function cantidadPagamentosMes($mes, $curso)
    {
        $cantidad = DB::table('pagamentos')
            ->join('estudantes', function ($join) use ($mes, $curso) {
                $join->on('estudantes.id', '=', 'pagamentos.estudante_id')
                    //   ->where('estudantes.id', $id)
                    ->where('estado', '<>', 'candidato')
                    ->where('estudantes.curso_id', $curso)
                    ->where('pagamentos.emolumento_id', 1)
                    ->where('pagamentos.mes', $mes);
                // ->where('pagamentos.ano', $ano);
            })->count();
        return $cantidad;
    }

    public static function cantidadImpagosMes($mes, $curso)
    {
        $cant = 0;
        $estudantes = Estudante::where("curso_id", $curso)->where("estado", "Activo")->get();
        foreach ($estudantes as $estudante) {
            $pagamento = Pagamento::where("estudante_id", $estudante->id)->where("mes", $mes)->first();
            if ($pagamento == null)
                $cant++;
        }
        return $cant;
    }


    public static function valorArecadado($curso)
    {
        $cantidad = DB::table('pagamentos')
            ->join('estudantes', function ($join) use ($curso) {
                $join->on('estudantes.id', '=', 'pagamentos.estudante_id')
                    //   ->where('estudantes.id', $id)
                    ->where('estado', '<>', 'candidato')
                    ->where('estudantes.curso_id', $curso)
                    ->where('pagamentos.emolumento_id', 1)
                    ->where('pagamentos.mes', "<>", 1)
                    ->where('pagamentos.mes', "<>", 2);

                // ->where('pagamentos.ano', $ano);
            })->sum('valor');
        return $cantidad;
    }

    public static function valorPorArecadar($curso)
    {
        $cant = 0;
        for ($i = 3; $i <= 12; $i++) {
            $cant += Curso::cantidadImpagosMes($i, $curso) * 25000;
        }

        return $cant;
    }

    public static function convertirAnoCurricular($ano)
    {

        switch ($ano) {
            case 1:
                $anoCurricular = "1º";
                break;
            case 2:
                $anoCurricular = "2º";
                break;
            case 3:
                $anoCurricular = "3º";
                break;
            case 4:
                $anoCurricular = "4º";
                break;
            case 5:
                $anoCurricular = "5º";
                break;
            default:
                $anoCurricular = "";
                break;
        }
        return $anoCurricular;
    }

    public static function convertirSemestre($sem)
    {

        switch ($sem) {
            case 1:
                $semestre = "I";
                break;
            case 2:
                $semestre = "II";
                break;
            default:
                $semestre = "";
                break;
        }
        return $semestre;
    }

    public static function qtdCandidatos($curso_id)
    {
        $qtd = 0;
        $processo = ProcessoCandidatura::where("actual", "1")->first();
        $qtd = Candidato::where("processo_id", $processo->id)->where("curso_id", $curso_id)->count();

        return $qtd;
    }
    public static function qtdCandidatosSegCh($curso_id)
    {
        $data_segCh = Carbon::parse("2021-09-16");
        $qtd = 0;
        $processo = ProcessoCandidatura::where("actual", "1")->first();
        $qtd = Candidato::where("processo_id", $processo->id)->where("curso_id", $curso_id)->where("created_at", ">=", $data_segCh)->count();

        return $qtd;
    }


    public static function qtdMatriculados($curso_id)
    {
        $qtd = 0;
        $qtd_1 = 0;
        $qtd_2 = 0;

        $pagamentoMatriculas = Pagamento::where("emolumento_id", 13)->orWhere("emolumento_id", 14)->get();
        foreach ($pagamentoMatriculas as  $pagamento) {
            $estudante = Estudante::find($pagamento->estudante_id);
            if ($estudante->curso_id == $curso_id) {
                $qtd++;

                if ($pagamento->emolumento_id == 13) {
                    $qtd_1++;
                }
                if ($pagamento->emolumento_id == 14) {
                    $qtd_2++;
                }
            }
        }

        return $qtd;
    }

    
    public static function qtdMatriculadosPrimeiroAno($curso_id)
    {

        $qtd_1 = 0;

        $pagamentoMatriculas = Pagamento::where("emolumento_id", 14)->get();
        foreach ($pagamentoMatriculas as  $pagamento) {
            $estudante = Estudante::find($pagamento->estudante_id);
            if ($estudante->curso_id == $curso_id) {
              $qtd_1++;

            }
        }

        return $qtd_1;
    }
    
    public static function qtdMatriculadosSegundoAno($curso_id)
    {

        $qtd_2 = 0;

        $pagamentoMatriculas = Pagamento::where("emolumento_id", 13)->get();
        foreach ($pagamentoMatriculas as  $pagamento) {
            $estudante = Estudante::find($pagamento->estudante_id);
            if ($estudante->curso_id == $curso_id) {
              $qtd_2++;

            }
        }

        return $qtd_2;
    }
}
