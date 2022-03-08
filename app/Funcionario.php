<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Funcionario extends Model
{
    protected $fillable = [
        'nome_completo', 'sexo', 'estado_civil', 'data_nascimento', 'num_filhos', 'num_bi', 'data_emissao_bi', 'data_validade_bi', 'num_contribuinte', 'num_seguranca_social', 'nome_pai', 'nome_mai', 'provincia', 'municipio', 'nacionalidade',
        'salario_base', 'outras_remuneracoes', 'categoria_prof', 'categoria_ocupacional', 'tempo_exp_prof', 'data_admissao', 'data_demissao', 'tempo_empresa', 'alojamento', 'alimentacao', 'transporte_inst', 'telef1', 'telef2', 'provincia_morada', 'municipio_morada', 'zona_comuna'
    ];

    public function grupo()
    {
        return $this->belongsTo('App\Grupo_funcionario');
    }
    public function contrato()
    {
        return $this->belongsTo('App\Tipo_contrato');
    }

    public function subsidios()
    {
        return $this->belongsToMany('App\Subsidio', 'funcionario_subcidio', 'funcionario_id', 'subsidio_id')->withPivot('valor');
    }

    public function hab_literarias()
    {
        return $this->belongsToMany('App\Hab_literaria', 'funcionario_hab_literarias', 'funcionario_id', 'hab_literaria_id');
    }

    public function documentos()
    {
        return $this->belongsToMany('App\Documento_funcionario', 'funcionario_documento', 'funcionario_id', 'documento_id');
    }
    public function idiomas()
    {
        return $this->belongsToMany('App\Lingua', 'funcionario_idioma', 'funcionario_id', 'idioma_id');
    }

    public static  function toString($id)
    {

        $funcionario = Funcionario::find($id);
        if ($funcionario != null) {
            return $funcionario->nome_completo;
        } else {
            return "";
        }
    }
    public static  function toStringGrupo($grupo_id)
    {

        $grupo = Grupo_funcionario::find($grupo_id);
        if ($grupo != null) {
            return $grupo->nome;
        } else {
            return "";
        }
    }
    public static function getSalario($id)
    {
        $funcionario = Funcionario::find($id);
        return $funcionario->salario_base;
    }
    public static function calcular_salario_liquido($id)
    {
        $temp_salario = Temp_salario::find($id);
        $funcionario = Funcionario::find($temp_salario->funcionario_id);

        //descontos
        $desconto = $temp_salario->desconto_faltas;
        if ($desconto == null) {
            $desconto = 0;
        }
        $subsidios = Funcionario::calcular_total_subsidio($funcionario->id);
        $salario_result = ($funcionario->salario_base + $subsidios) - $desconto;

        //remuneraçoes

        $subsidioFuncao = $temp_salario->subcidio_funcao;
        $salario_result += $subsidioFuncao;

        $temp_salario->salario_liquido = $salario_result;
        $temp_salario->save();

        return $temp_salario->salario_liquido;
    }

    public static function calc_seg_social($id)
    {
        $temp_salario = Temp_salario::find($id);
        $funcionario = Funcionario::find($temp_salario->funcionario_id);
        $salario_liquido = Funcionario::calcular_salario_liquido($id);

        $valor_descontado =  ($salario_liquido / 100 * 3);
        $temp_salario->desconto_seguridad_social = $valor_descontado;
        $temp_salario->save();
        return $valor_descontado;
    }
    public static function calc_IRT($id)
    {
        $temp_salario = Temp_salario::find($id);
        $salario_liquido = Funcionario::calcular_salario_liquido($id);
        if($salario_liquido>70000){
            $funcionario = Funcionario::find($temp_salario->funcionario_id);
            $parcela_fixa = 0;
            $excesso = 0;
            $taxa = 0;
            $escalao = Funcionario::getEscalaoRendimento($funcionario->salario_base);
    
            switch ($escalao) {
                case 1:
                    $parecela_fixa = 0;
                    $excesso = 0;
                    $taxa = 0;
                    break;
                case 2:
                    $parecela_fixa = 3000;
                    $excesso = 70001;
                    $taxa = 0.10;
                    break;
                case 3:
                    $parecela_fixa = 6000;
                    $excesso = 100001;
                    $taxa = 0.13;
                    break;
                case 4:
                    $parecela_fixa = 12500;
                    $excesso = 150001;
                    $taxa = 0.16;
                    break;
                case 5:
                    $parecela_fixa = 31250;
                    $excesso = 200001;
                    $taxa = 0.18;
                    break;
                case 6:
                    $parecela_fixa = 49250;
                    $excesso = 300001;
                    $taxa = 0.19;
                    break;
                case 7:
                    $parecela_fixa = 87250;
                    $excesso = 500001;
                    $taxa = 0.20;
                    break;
                case 8:
                    $parecela_fixa = 187250;
                    $excesso = 1000001;
                    $taxa = 0.21;
                    break;
                case 9:
                    $parecela_fixa = 292250;
                    $excesso = 1500001;
                    $taxa = 0.22;
                    break;
                case 10:
                    $parecela_fixa = 402250;
                    $excesso = 2000001;
                    $taxa = 0.23;
                    break;
                case 11:
                    $parecela_fixa = 517250;
                    $excesso = 2500001;
                    $taxa = 0.24;
                    break;
                case 12:
                    $parecela_fixa = 1117250;
                    $excesso = 5000001;
                    $taxa = 0.25;
                    break;
                case 13:
                    $parecela_fixa = 2342250;
                    $excesso = 10000001;
                    $taxa = 0.25;
                    break;
            }
    
            $materia_coletavel = Funcionario::materia_coletavel($id);
            $parecela_fixa = Funcionario::obter_parcela_fixa($escalao);
            $resultadoTemp = $parecela_fixa + ($materia_coletavel - $excesso) * $taxa;
            $resultado= round($resultadoTemp, 0, PHP_ROUND_HALF_UP);
            $temp_salario->desconto_irt = $resultado;
            $temp_salario->save();
            return $resultado;
        }elseif($salario_liquido<=70000){
            return 0;
        }
  


    }

    public static function calc_desconto_total($id)
    {
        $temp_salario = Temp_salario::find($id);
        // $funcionario = Funcionario::find($temp_salario->funcionario_id);
        $desconto_totalTemp = Funcionario::calc_seg_social($id) + Funcionario::calc_IRT($id);
        $desconto_total= round($desconto_totalTemp, 0, PHP_ROUND_HALF_UP);
        $temp_salario->desconto_total = $desconto_total;
        $temp_salario->save();
        return $desconto_total;
    }

    public static function calc_salario_final($id)
    {
        $temp_salario = Temp_salario::find($id);
        // $funcionario = Funcionario::find($temp_salario->funcionario_id);
        $salario_finalTemp = Funcionario::calcular_salario_liquido($id) - ((Funcionario::calc_seg_social($id)) + (Funcionario::calc_IRT($id)));
        $salario_final= round($salario_finalTemp, 0, PHP_ROUND_HALF_UP);
        $temp_salario->salario_receber = $salario_final;
        $temp_salario->save();
        return $salario_final;
    }

    public static function getEscalaoRendimento($salario)
    {

        if ($salario > 0 && $salario <= 70000) {
            return 1;
        }
        if ($salario > 70000 && $salario <= 100000) {
            return 2;
        }
        if ($salario > 100000 && $salario <= 150000) {
            return 3;
        }
        if ($salario > 150000 && $salario <= 200000) {
            return 4;
        }
        if ($salario > 200000 && $salario <= 300000) {
            return 5;
        }
        if ($salario > 300000 && $salario <= 500000) {
            return 6;
        }
        if ($salario > 500000 && $salario <= 1000000) {
            return 7;
        }
        if ($salario > 1000000 && $salario <= 1500000) {
            return 8;
        }
        if ($salario > 1500000 && $salario <= 2000000) {
            return 9;
        }
        if ($salario > 2000000 && $salario <= 2500000) {
            return 10;
        }
        if ($salario > 2500000 && $salario <= 5000000) {
            return 11;
        }
        if ($salario > 5000000 && $salario <= 10000000) {
            return 12;
        }
        if ($salario > 10000000) {
            return 13;
        }
    }
    public static function obter_parcela_fixa($escalao)
    {

        switch ($escalao) {
            case 1:
                return 0;
                break;
            case 2:
                return 3000;
                break;
            case 3:
                return 6000;
                break;
            case 4:
                return 12500;
                break;
            case 5:
                return 31250;
                break;
            case 6:
                return 49250;
                break;
            case 7:
                return 87250;
                break;
            case 8:
                return 187250;
                break;
            case 9:
                return 292250;
                break;
            case 10:
                return 402250;
                break;
            case 11:
                return 517250;
                break;
            case 12:
                return 1117250;
                break;
            case 13:
                return 2342250;
                break;

            default:
                return 0;
                break;
        }
    }
    public static function materia_coletavel($id)
    {
        $temp_salario = Temp_salario::find($id);
        $salario_liquido = Funcionario::calcular_salario_liquido($id);
        $funcionario = Funcionario::find($temp_salario->funcionario_id);
        $ss = Funcionario::calc_seg_social($id);
        return $salario_liquido - $ss;

    }

    public static function calcular_valorHora($salario_base)
    {
        //  $funcionario=Funcionario::find($idFuncionario);
        // $salario=$funcionario->salario_base;

        return (($salario_base * 12) / 52) / 40;
    }

    public static function calcular_desconto_faltas($id, $cantHoras)
    {
        //  $temp_salario = Temp_salario::find($id);
        $funcionario = Funcionario::find($id);
        $valor_hora = Funcionario::calcular_valorHora($funcionario->salario_base);
        return $cantHoras * $valor_hora;
    }


    public static function obter_desconto_faltas($id)
    {
        $temp_salario = Temp_salario::find($id);

        return $temp_salario->desconto_faltas;
    }

    public static function obterFuncionariosFerias($dia, $mes)
    {
        $fecha = new Carbon('2021-' . $mes . '-' . $dia);
        $ferias = Feria::all();

        $resultadoTemp = [];

        foreach ($ferias as $i => $feria) {
            //  dd($feria->data_inicio);
            $fecha_inicio = new Carbon($feria->data_inicio);
            $fecha_fim = new Carbon($feria->data_fim);

            if (($fecha >= $fecha_inicio) && ($fecha <= $fecha_fim)) {

                $resultadoTemp[$i] = $feria;
            }
        }
        $resultado = collect($resultadoTemp);

        return $resultado;
    }

    /* Función */
    static function  check_in_range($fecha_inicio, $fecha_fin, $fecha)
    {

        $fecha_inicio = strtotime($fecha_inicio);
        $fecha_fin = strtotime($fecha_fin);
        $fecha = strtotime($fecha);

        if (($fecha >= $fecha_inicio) && ($fecha <= $fecha_fin)) {

            return true;
        } else {

            return false;
        }
    }
    public static  function primeiro_nome($id)
    {

        $funcionario = Funcionario::find($id);
        if ($funcionario != null) {
            $nome_completo = $funcionario->nome_completo;

            $nomes = explode(" ", $nome_completo);
            return $nomes[0];
        } else {
            return "";
        }
    }

    public static function total_desconto_faltas($id_mapa)
    {
        $mapa = Mapa_salario::find($id_mapa);

        // $temp_salarios = $mapa->temp_salarios();
        //  dd($temp_salarios);
        $total = 0;
        foreach ($mapa->temp_salarios as $tmp) {
            // dd("algo");
            $total += $tmp->desconto_faltas;
            //  }
        }

        return $total;
    }
    public static function total_desconto_faltas_mes($mes, $ano)
    {
        $mapas = Mapa_salario::where("mes", $mes)->where("ano", $ano)->get();


        // $temp_salarios = $mapa->temp_salarios();
        //  dd($temp_salarios);
        $total = 0;
        foreach ($mapas as $mapa) {
            foreach ($mapa->temp_salarios as $tmp) {
                // dd("algo");
                $total += $tmp->desconto_faltas;
                //  }
            }
        }

        return $total;
    }

    public static function total_salario_iliquido($id_mapa)
    {
        $mapa = Mapa_salario::find($id_mapa);

        // $temp_salarios = $mapa->temp_salarios();
        //  dd($temp_salarios);
        $total = 0;
        foreach ($mapa->temp_salarios as $tmp) {
            // dd("algo");
            $total += $tmp->salario_liquido;
            //  }
        }

        return $total;
    }

    public static function total_salario_iliquido_mes($mes, $ano)
    {
        $mapas = Mapa_salario::where("mes", $mes)->where("ano", $ano)->get();

        // $temp_salarios = $mapa->temp_salarios();
        //  dd($temp_salarios);
        $total = 0;
        foreach ($mapas as $mapa) {
            foreach ($mapa->temp_salarios as $tmp) {
                // dd("algo");
                $total += $tmp->salario_liquido;
                //  }
            }
        }

        return $total;
    }

    public static function total_desconto_seguridad_social($id_mapa)
    {
        $mapa = Mapa_salario::find($id_mapa);

        // $temp_salarios = $mapa->temp_salarios();
        //  dd($temp_salarios);
        $total = 0;
        foreach ($mapa->temp_salarios as $tmp) {
            // dd("algo");
            $total += $tmp->desconto_seguridad_social;
            //  }
        }

        return $total;
    }

    public static function total_desconto_seguridad_social_mes($mes, $ano)
    {
        $mapas = Mapa_salario::where("mes", $mes)->where("ano", $ano)->get();
        $total = 0;
        foreach ($mapas as $mapa) {
            foreach ($mapa->temp_salarios as $tmp) {
                $total += $tmp->desconto_seguridad_social;
            }
        }
        return $total;
    }
    public static function total_desconto_irt($id_mapa)
    {
        $mapa = Mapa_salario::find($id_mapa);

        // $temp_salarios = $mapa->temp_salarios();
        //  dd($temp_salarios);
        $total = 0;
        foreach ($mapa->temp_salarios as $tmp) {
            // dd("algo");
            $total += $tmp->desconto_irt;
            //  }
        }
        return $total;
       // return round($total, 0, PHP_ROUND_HALF_UP);
    }
    public static function total_desconto_irt_mes($mes, $ano)
    {
        $mapas = Mapa_salario::where("mes", $mes)->where("ano", $ano)->get();

        // $temp_salarios = $mapa->temp_salarios();
        //  dd($temp_salarios);
        $total = 0;
        foreach ($mapas as $mapa) {
            foreach ($mapa->temp_salarios as $tmp) {
                // dd("algo");
                $total += $tmp->desconto_irt;
                //  }
            }
        }
       

        return  round($total, 0, PHP_ROUND_HALF_UP);
    }

    public static function total_desconto($id_mapa)
    {
        $mapa = Mapa_salario::find($id_mapa);

        // $temp_salarios = $mapa->temp_salarios();
        //  dd($temp_salarios);
        $total = 0;
        foreach ($mapa->temp_salarios as $tmp) {
            // dd("algo");
            $total += $tmp->desconto_total;
            //  }
        }

        return $total;
    }
    public static function total_desconto_mes($mes, $ano)
    {
        $mapas = Mapa_salario::where("mes", $mes)->where("ano", $ano)->get();


        // $temp_salarios = $mapa->temp_salarios();
        //  dd($temp_salarios);
        $total = 0;
        foreach ($mapas as $mapa) {
            foreach ($mapa->temp_salarios as $tmp) {
                // dd("algo");
                $total += $tmp->desconto_total;
                //  }
            }
        }


        return $total;
    }

    public static function total_salario($id_mapa)
    {
        $mapa = Mapa_salario::find($id_mapa);

        // $temp_salarios = $mapa->temp_salarios();
        //  dd($temp_salarios);
        $total = 0;
        foreach ($mapa->temp_salarios as $tmp) {
            // dd("algo");
            $total += $tmp->salario_receber;
            //  }
        }

        return $total;
    }
    public static function total_salario_mes($mes, $ano)
    {
        $mapas = Mapa_salario::where("mes", $mes)->where("ano", $ano)->get();


        // $temp_salarios = $mapa->temp_salarios();
        //  dd($temp_salarios);
        $total = 0;
        foreach ($mapas as $mapa) {
            foreach ($mapa->temp_salarios as $tmp) {
                // dd("algo");
                $total += $tmp->salario_receber;
                //  }
            }
        }

       
        return  round($total, 0, PHP_ROUND_HALF_UP);
    }
    public static function total_salario_base($id_mapa)
    {
        $mapa = Mapa_salario::find($id_mapa);

        // $temp_salarios = $mapa->temp_salarios();
        //  dd($temp_salarios);
        $total = 0;
        foreach ($mapa->temp_salarios as $tmp) {
            $funcionario = Funcionario::find($tmp->funcionario->id);
            $total += $funcionario->salario_base;
            //  }
        }

        return $total;
    }
    public static function total_salario_base_mes($mes, $ano)
    {
        $mapas = Mapa_salario::where("mes", $mes)->where("ano", $ano)->get();

        // $temp_salarios = $mapa->temp_salarios();
        //  dd($temp_salarios);
        $total = 0;
        foreach ($mapas as $mapa) {
            foreach ($mapa->temp_salarios as $tmp) {
                $funcionario = Funcionario::find($tmp->funcionario->id);
                $total += $funcionario->salario_base;
                //  }
            }
        }

        return $total;
    }

    public  function tem_hab_literaria($id_func, $id_hab)
    {
        $funcionario = Funcionario::find($id_func);
        $habilitacoes = $funcionario->hab_literarias;
        foreach ($habilitacoes as $hab) {
            if ($hab->id == $id_hab) {
                return true;
            }
        }
        return false;
    }

    public  function tem_documento($id_func, $id_doc)
    {
        $funcionario = Funcionario::find($id_func);
        $documentos = $funcionario->documentos;
        foreach ($documentos as $doc) {
            if ($doc->id == $id_doc) {
                return true;
            }
        }
        return false;
    }

    public  function tem_idioma($id_func, $id_idioma)
    {
        $funcionario = Funcionario::find($id_func);
        $idiomas = $funcionario->idiomas;
        foreach ($idiomas as $idioma) {
            if ($idioma->id == $id_idioma) {
                return true;
            }
        }
        return false;
    }
    public static function calcular_total_subsidio($funcionario_id)
    {
        $funcionario = Funcionario::find($funcionario_id);
        $total = 0;
        foreach ($funcionario->subsidios as $subsidio) {
            $total += $subsidio->pivot->valor;
        }
        return $total;
    }
}
