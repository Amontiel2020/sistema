<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Estudante;

class Pagamento extends Model
{
  protected $fillable = [
    'valor', 'taxa', 'mes', 'ano', 'emolumento_id', 'estudante_id', 'obs', 'descrip', 'cant_recibos','desconto'
  ];

  public function conta()
  {
    return $this->belongsTo('App\Conta');
  }


  public static function toStringEstudante($id)
  {
    if ($id == 0) {
      return "Candidato";
    } else {

      $estudante = Estudante::where('id', $id)->first();
    return $estudante!=null? $estudante->nome . " " . $estudante->apelido:"";
    }
  }

  public static function toStringCandidato($codigo)
  {

    $candidato = Candidato::where('codigo', $codigo)->first();
    if ($candidato != null) {
      return $candidato->nomeCompleto . "(Candidato)";
    } else {
      return "";
    }
  }
  /*public function estudante()
	    {
		   // return $this->belongsTo('Estudante');
		   return $this->belongsTo(Estudante::class);
	    }
*/


  public static function relatorioPagamentos2($id, $ano)
  {

    $resultado = DB::table('pagamentos')
      ->join('estudantes', function ($join) use ($id, $ano) {
        $join->on('estudantes.id', '=', 'pagamentos.estudante_id')
          ->where('estudantes.id', $id)
          ->where('estudantes.estado', 'activo')
          ->where('pagamentos.emolumento_id', 1)
          ->where('pagamentos.ano', $ano);
      })
      ->select('estudantes.id', 'estudantes.nome', 'estudantes.apelido', 'pagamentos.mes', 'pagamentos.valor', 'pagamentos.created_at', 'estudantes.pathImage', 'pagamentos.emolumento_id', 'pagamentos.obs')
      ->groupBy('estudantes.id', 'estudantes.nome', 'estudantes.apelido', 'pagamentos.mes', 'pagamentos.valor', 'pagamentos.created_at', 'estudantes.pathImage', 'pagamentos.emolumento_id', 'pagamentos.obs')
      ->get();





    return $resultado;
  }

  public static function estudanteConDivida($estudante)
  {
    $idEstudante = $estudante->id;
    $pagamento = Pagamento::where('estudante_id', $idEstudante)->where('mes', 3)->where('mes', 4)->get();

    if ($pagamento == null) {
      return true;
    } else {
      return false;
    }
  }

  public static function estudanteConDividaMes($estudante, $mes)
  {
    $idEstudante = $estudante->id;
    $pagamento = Pagamento::where('estudante_id', $idEstudante)->where('mes', $mes)->get();

    if ($pagamento == null) {
      return true;
    } else {
      return false;
    }
  }
  public static function estudanteSemDividaMes($estudante, $mes)
  {
    $idEstudante = $estudante->id;
    $pagamento = Pagamento::where('estudante_id', $idEstudante)->where('mes', $mes)->first();

    if ($pagamento == null) {
      return false;
    } else if ($pagamento != null) {
      return true;
    }
  }

  public static function estudanteSemDividas()
  {
    $estudantes = Estudante::where('estado', 'Activo')->get();
    $estudantes_sem_dividas = collect();

    foreach ($estudantes as $estudante) {
      if (Pagamento::estudanteSemDividaMes($estudante, 12) == true) {
        $estudantes_sem_dividas->push($estudante);
      }
    }
    return $estudantes_sem_dividas;
  }

  public static function pagamentoMesAno($estudante, $mes, $ano)
  {
    $pagamento = Pagamento::where('estudante_id', $estudante->id)->where('mes', $mes)->where('ano', $ano)->first();
    // $resultado=json_decode($pagamento);
    /*if($pagamento==null)
return false;
else 
return true;*/
    return $pagamento;
  }

  public static function totalPagamentosAno($estudante, $ano)
  {
    $total = Pagamento::where('estudante_id', $estudante->id)->where('mes', '<>', 1)->where('mes', '<>', 2)->where('ano', $ano)->sum('valor');
    return $total;
  }

  public static function totalDividaEstAno($estudante, $ano)
  {
    $total = Pagamento::where('estudante_id', $estudante->id)->where('mes', '<>', 1)->where('mes', '<>', 2)->where('ano', $ano)->count();
    $totalPagamentos = 10;
    // $pagamentoInscricao = Pagamento::where('estudante_id', $estudante->id)->where('mes', 1)->first();

    return ($totalPagamentos - $total) * 25000;
  }

  public static function totalPagoEstAno($estudante, $ano)
  {
    $total = Pagamento::where('estudante_id', $estudante->id)->where('mes', '<>', 1)->where('mes', '<>', 2)->where('ano', $ano)->count();
    //$totalPagamentos = 10;
    // $pagamentoInscricao = Pagamento::where('estudante_id', $estudante->id)->where('mes', 1)->first();

    return $total * 25000;
  }
  public static function totalTaxaEstAno($estudante, $ano)
  {
    $total = Pagamento::where('estudante_id', $estudante->id)->where('mes', '<>', 1)->where('mes', '<>', 2)->where('ano', $ano)->sum('taxa');
    //$totalPagamentos = 10;
    // $pagamentoInscricao = Pagamento::where('estudante_id', $estudante->id)->where('mes', 1)->first();

    return $total;
  }

  public static function totalDividaTurmaAno($idTurma, $ano)
  {
    $total = 0;
    // dd($idTurma);
    $estudantes = Estudante::where('estado', 'Activo')->where('turma_id', $idTurma)->get();
    foreach ($estudantes as $estudante) {
      $total += Pagamento::totalDividaEstAno($estudante, $ano);
    }


    return $total;
  }

  public static function totalPagoTurmaAno($idTurma, $ano)
  {
    $total = 0;
    // dd($idTurma);
    $estudantes = Estudante::where('estado', 'Activo')->where('turma_id', $idTurma)->get();
    foreach ($estudantes as $estudante) {
      $total += Pagamento::totalPagoEstAno($estudante, $ano);
    }


    return $total;
  }

  public static function totalTaxaTurmaAno($idTurma, $ano)
  {
    $total = 0;
    // dd($idTurma);
    $estudantes = Estudante::where('estado', 'Activo')->where('turma_id', $idTurma)->get();
    foreach ($estudantes as $estudante) {
      $total += Pagamento::totalTaxaEstAno($estudante, $ano);
    }


    return $total;
  }

  public static function totalDividaAno($ano)
  {
    $total = 0;
    // dd($idTurma);
    $estudantes = Estudante::where('estado', 'Activo')->get();
    foreach ($estudantes as $estudante) {
      $total += Pagamento::totalDividaEstAno($estudante, $ano);
    }


    return $total;
  }
  public static function pagamentoFeito($idEstudante, $mes, $ano)
  {


    $pago = Pagamento::where([
      'estudante_id' => $idEstudante,
      'mes' => $mes,
      'ano' => $ano
    ])->first();


    if ($pago == null) {
      return false;
    } else if ($pago != null) {
      return true;
    }
  }

  public static function totalDividaTurmaMesAno($turma, $mes, $ano)
  {
    $count = 0;

    $estudantes = Estudante::where('turma_id', $turma)->where('estado', 'Activo')->get();
    //dd($estudantes);
    foreach ($estudantes as  $estudante) {
      if (!Pagamento::pagamentoFeito($estudante->id, $mes, $ano)) {
        $count++; // 25000;
      }
    }
    // dd($count);
    return $count * 25000;
  }

  public static function totalDividaMesAno($mes, $ano)
  {
    $count = 0;

    $estudantes = Estudante::where('estado', 'Activo')->get();
    //dd($estudantes);
    foreach ($estudantes as  $estudante) {
      if (!Pagamento::pagamentoFeito($estudante->id, $mes, $ano)) {
        $count++; // 25000;
      }
    }
    // dd($count);
    return $count * 25000;
  }

  public static function totalPagamentosaxaAno($estudante, $ano)
  {
    $totalTaxa = Pagamento::where('estudante_id', $estudante->id)->where('mes', '<>', 1)->where('mes', '<>', 2)->where('ano', $ano)->sum('taxa');
    return $totalTaxa;
  }
}
