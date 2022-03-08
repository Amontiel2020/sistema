<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Turma;
use \App\Estudante;
use App\Pagamento;
use App\Emolumento;
use App\Curso;
use App\Inscricao;
use App\Disciplina;
use App\Factura;
use App\Candidato;
use App\Matricula;
use App\Sala;
use App\Conta;






use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Session;




class Pagamentos extends Controller
{


  public function index(Request $request)
  {
    $emolumentos = Emolumento::all();

    $pagamentos = Pagamento::all();

    if (isset($request->emolumento)) {
      $pagamentos = Pagamento::where('emolumento_id', $request->emolumento)->get();
    }


    return view('pagamentos.index', compact('pagamentos', 'emolumentos'));
  }

  public function propinas(Request $request)
  {
    $turmas = Turma::all();
    $estudantes = Estudante::paginate(10);

    $i = 1;
    /* 
     // $turmaSelecionada="";
     $buscar = $request->get('buscarpor');
      $tipo = $request->get('tipo');

    	if ($request->idTurma!=null) {
    		$idTurma=$request->idTurma;
    		$turmaSelecionada=Turma::where('id',$idTurma)->first();
    	    $estudantes=Estudante::where('turma_id',$idTurma)->paginate(100);
      }

      if (isset($request->buscarpor)) {
        // $lista=Estudante::where('nome','LIKE','%'.$request->nome.'%')->paginate(10);
         $estudantes=$this->buscarpor($tipo, $buscar)->paginate(100);
 
       }
 


    	if (isset($turmaSelecionada)) {
          return view('pagamentos.propinas',compact('turmas','estudantes','turmaSelecionada','i'));
      }else{*/
    return view('pagamentos.propinas', compact('turmas', 'estudantes', 'i'));
    // }


  }

  public static function pagamentos($ano, $id)
  {

    $pagamentos = Pagamento::where(['emolumento_id' => 1, 'ano' => $ano, 'estudante_id' => $id])->orderby('mes', 'asc')->get();
    //$pagamentos=Pagamento::where(['emolumento_id'=>1,'ano'=>$ano,'estudante_id'=>$this->id])->get();

    return $pagamentos;
  }
  public static function pagamentosJson(Request $request, $id, $ano)
  {




    $resultado = DB::table('pagamentos')
      ->join('estudantes', function ($join) use ($id, $ano) {
        $join->on('estudantes.id', '=', 'pagamentos.estudante_id')
          ->where('estudantes.id', $id)
          ->where('pagamentos.emolumento_id', 1)
          ->where('pagamentos.ano', $ano);
      })
      ->select('estudantes.id', 'estudantes.nome', 'estudantes.apelido', 'pagamentos.mes', 'pagamentos.valor', 'pagamentos.created_at', 'estudantes.pathImage', 'estudantes.curso', 'estudantes.BI', 'pagamentos.emolumento_id', 'pagamentos.obs')
      ->groupBy('estudantes.id', 'estudantes.nome', 'estudantes.apelido', 'pagamentos.mes', 'pagamentos.valor', 'pagamentos.created_at', 'estudantes.pathImage', 'estudantes.curso', 'estudantes.BI', 'pagamentos.emolumento_id', 'pagamentos.obs')
      ->get();



    if ($request->ajax()) {

      return response()->json($resultado);
    }
  }

  public static function cantidadMesesPagos($ano, $id)
  {
    $pagamentos = Pagamento::where(['ano' => $ano, 'estudante_id' => $id])->count();

    return $pagamentos;
  }

  public static function inpagos($ano, $id)
  {

    $total = 12;

    $pagos = Pagamento::where(['emolumento_id' => 1, 'ano' => $ano, 'estudante_id' => $id])->count();

    return $total - $pagos;
  }

  public function buscarpor($tipo, $buscar)
  {
    if (($tipo) && ($buscar)) {
      return Estudante::where($tipo, 'like', "%$buscar%");
    }
  }

  public function fazerPagamento(Request $request)
  {
    $meses = $request->mes;

    foreach ($meses as $mes) {
      Pagamento::create([
        'valor' => 20,
        'mes' => $mes,
        'ano' => '2020',
        'emolumento_id' => 1,
        'estudante_id' => $request->estudante
      ]);
    }

    return redirect()->route('confirmarPagamento');
  }

  public function fazerPagamentoTemporal(Request $request)
  {
    $mes1 = $request->valorMes1;
    $mes2 = $request->valorMes2;
    $mes3 = $request->valorMes3;

    //dd($mes1);

    $m1 = "1";
    $m1 = "2";
    $m1 = "";
    if ($mes1 != null) {
      Pagamento::create([
        'valor' => $mes1,
        'mes' => 1,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $request->estudante
      ]);
    }

    if ($mes2 != null) {

      Pagamento::create([
        'valor' => $mes2,
        'mes' => 2,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $request->estudante
      ]);
    }

    if ($mes3 != null) {
      Pagamento::create([
        'valor' => $mes3,
        'mes' => 3,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $request->estudante
      ]);
    }

    return redirect()->route('propinas');
  }


  public function fazerPagamentoMes(Request $request)
  {


    Pagamento::create([
      'valor' => $request->valor,
      'mes' => $request->mesX,
      'ano' => $request->anoX,
      'emolumento_id' => 1,
      'estudante_id' => $request->idEstudante
    ]);


    return redirect()->route('propinas');
  }

  public function fichaPagamento($id)
  {
    $estudante = Estudante::where('id', $id)->first();
    $mes1Pago = 0;
    $mes2Pago = 0;
    $mes3Pago = 0;
    $mes4Pago = 0;
    $mes5Pago = 0;
    $mes6Pago = 0;
    $mes7Pago = 0;
    $mes8Pago = 0;
    $mes9Pago = 0;
    $mes10Pago = 0;
    $mes11Pago = 0;
    $mes12Pago = 0;

    $pagamentoMes1 = Pagamento::where(['estudante_id' => $estudante->id, 'ano' => 2020, 'mes' => 1])->first();
    $pagamentoMes1 = Pagamento::where(['estudante_id' => $estudante->id, 'ano' => 2020, 'mes' => 1])->first();
    $pagamentoMes2 = Pagamento::where(['estudante_id' => $estudante->id, 'ano' => 2020, 'mes' => 2])->first();
    $pagamentoMes3 = Pagamento::where(['estudante_id' => $estudante->id, 'ano' => 2020, 'mes' => 3])->first();
    $pagamentoMes4 = Pagamento::where(['estudante_id' => $estudante->id, 'ano' => 2020, 'mes' => 4])->first();
    $pagamentoMes5 = Pagamento::where(['estudante_id' => $estudante->id, 'ano' => 2020, 'mes' => 5])->first();
    $pagamentoMes6 = Pagamento::where(['estudante_id' => $estudante->id, 'ano' => 2020, 'mes' => 6])->first();
    $pagamentoMes7 = Pagamento::where(['estudante_id' => $estudante->id, 'ano' => 2020, 'mes' => 7])->first();
    $pagamentoMes8 = Pagamento::where(['estudante_id' => $estudante->id, 'ano' => 2020, 'mes' => 8])->first();
    $pagamentoMes9 = Pagamento::where(['estudante_id' => $estudante->id, 'ano' => 2020, 'mes' => 9])->first();
    $pagamentoMes10 = Pagamento::where(['estudante_id' => $estudante->id, 'ano' => 2020, 'mes' => 10])->first();
    $pagamentoMes11 = Pagamento::where(['estudante_id' => $estudante->id, 'ano' => 2020, 'mes' => 11])->first();
    $pagamentoMes12 = Pagamento::where(['estudante_id' => $estudante->id, 'ano' => 2020, 'mes' => 12])->first();


    if ($pagamentoMes1 != null) {
      $mes1Pago = $pagamentoMes1;
    }

    if ($pagamentoMes2 != null) {
      $mes2Pago = $pagamentoMes2;
    }

    if ($pagamentoMes3 != null) {
      $mes3Pago = $pagamentoMes3;
    }
    if ($pagamentoMes4 != null) {
      $mes4Pago = $pagamentoMes4;
    }
    if ($pagamentoMes5 != null) {
      $mes5Pago = $pagamentoMes5;
    }

    if ($pagamentoMes6 != null) {
      $mes6Pago = $pagamentoMes6;
    }

    if ($pagamentoMes7 != null) {
      $mes7Pago = $pagamentoMes7;
    }

    if ($pagamentoMes8 != null) {
      $mes8Pago = $pagamentoMes8;
    }

    if ($pagamentoMes9 != null) {
      $mes9Pago = $pagamentoMes9;
    }

    if ($pagamentoMes10 != null) {
      $mes10Pago = $pagamentoMes10;
    }

    if ($pagamentoMes11 != null) {
      $mes11Pago = $pagamentoMes11;
    }

    if ($pagamentoMes12 != null) {
      $mes12Pago = $pagamentoMes12;
    }
    return view('pagamentos.fichaPagamentos', compact(
      'estudante',
      'mes1Pago',
      'mes2Pago',
      'mes3Pago',
      'mes4Pago',
      'mes5Pago',
      'mes6Pago',
      'mes7Pago',
      'mes8Pago',
      'mes9Pago',
      'mes10Pago',
      'mes11Pago',
      'mes12Pago'
    ));
  }

  public function salvarFicha(Request $request)
  {
    $id = $request->id;
    $estudante = Estudante::where('id', $id)->first();
    global  $pagamentos;
    $pagamentos = collect();

    $mes1 = $request->mes1;
    $mes2 = $request->mes2;
    $mes3 = $request->mes3;
    $mes4 = $request->mes4;
    $mes5 = $request->mes5;
    $mes6 = $request->mes6;
    $mes7 = $request->mes7;
    $mes8 = $request->mes8;
    $mes9 = $request->mes9;
    $mes10 = $request->mes10;
    $mes11 = $request->mes11;
    $mes12 = $request->mes12;


    if ($mes1 != null) {
      $pagamento1 = new Pagamento;
      $pagamento1->valor = $mes1;
      $pagamento1->mes = 1;
      $pagamento1->ano = 2020;
      $pagamento1->emolumento_id = 1;
      $pagamento1->estudante_id = $id;

      $pagamentos->push($pagamento1);
      Pagamento::create([
        'valor' => $mes1,
        'mes' => 1,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $id
      ]);
    }

    if ($mes2 != null) {
      $pagamento2 = new Pagamento;
      $pagamento2->valor = $mes2;
      $pagamento2->mes = 2;
      $pagamento2->ano = 2020;
      $pagamento2->emolumento_id = 1;
      $pagamento2->estudante_id = $id;
      $pagamentos->push($pagamento2);
      Pagamento::create([
        'valor' => $mes2,
        'mes' => 2,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $id
      ]);
    }

    if ($mes3 != null) {
      $pagamento3 = new Pagamento;
      $pagamento3->valor = $mes3;
      $pagamento3->mes = 3;
      $pagamento3->ano = 2020;
      $pagamento3->emolumento_id = 1;
      $pagamento3->estudante_id = $id;
      $pagamentos->push($pagamento3);
      Pagamento::create([
        'valor' => $mes3,
        'mes' => 3,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $id
      ]);
    }

    if ($mes4 != null) {
      //  $pagamentos->add($pagamento4);
      Pagamento::create([
        'valor' => $mes4,
        'mes' => 4,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $id
      ]);
    }

    if ($mes5 != null) {
      //  $pagamentos->add($pagamento5);
      Pagamento::create([
        'valor' => $mes5,
        'mes' => 5,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $id
      ]);
    }

    if ($mes6 != null) {
      // $pagamentos->add($pagamento6);
      Pagamento::create([
        'valor' => $mes6,
        'mes' => 6,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $id
      ]);
    }

    if ($mes7 != null) {
      // $pagamentos->add($pagamento7);
      Pagamento::create([
        'valor' => $mes7,
        'mes' => 7,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $id
      ]);
    }

    if ($mes8 != null) {
      // $pagamentos->add($pagamento8);
      Pagamento::create([
        'valor' => $mes8,
        'mes' => 8,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $id
      ]);
    }

    if ($mes9 != null) {
      // $pagamentos->add($pagamento9);
      Pagamento::create([
        'valor' => $mes9,
        'mes' => 9,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $id
      ]);
    }

    if ($mes10 != null) {
      // $pagamentos->add($pagamento10);
      Pagamento::create([
        'valor' => $mes10,
        'mes' => 10,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $id
      ]);
    }

    if ($mes11 != null) {
      // $pagamentos->add($pagamento11);
      Pagamento::create([
        'valor' => $mes11,
        'mes' => 11,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $id
      ]);
    }

    if ($mes12 != null) {
      //$pagamentos->add($pagamento12);
      Pagamento::create([
        'valor' => $mes12,
        'mes' => 12,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $id
      ]);
    }

    if ($request->checkMes != null) {
      $valores = $request->checkMes;
      foreach ($valores as $valor) {
        $pagamento = Pagamento::where('id', $valor)->first();
        $pagamento->delete();
      }
    }
    //dd($pagamentos);

    return view('pagamentos.gerarComprovativo', compact('pagamentos'));
  }

  public function confirmarPagamento()
  {

    return view('pagamentos.confirmarPagamento');
  }


  public function eliminarPagamento($id)
  {
    $pagamento = Pagamento::where('id', $id)->first();
    $pagamento->delete();
    return redirect()->route('pagamentosDia');
  }



  public function pagarEmolumento()
  {
    $estudantes = Estudante::all();
    $emolumentos = Emolumento::all();
    $turmas = Turma::all();

    $pagamentos = Pagamento::all();

    return view('pagamentos.pagarEmolumento', compact('estudantes', 'emolumentos', 'pagamentos', 'turmas'));
  }

  public function pagarEmolumentoGeral(Request $request)
  {

    $estudante = $request['estudante'];
    $mes = $request['mes'];
    $ano = $request['ano'];
    $idEmolumento = $request['emolumento'];
    $emolumento = Emolumento::where('id', $idEmolumento)->first();

    Pagamento::create(
      [
        'valor' => $emolumento->valor,
        'mes' => $mes,
        'ano' => $ano,
        'emolumento_id' => $emolumento->id,
        'estudante_id' => $estudante


      ]
    );
    return redirect()->route('pagarEmolumento');
    // return "OK";



  }

  public function propinasGeral()
  {
    $turmas = Turma::all();
    return view('pagamentos.propinasGeral', compact('turmas'));
  }



  public function busqueda(Request $request, $valor)
  {
    $nome = $valor;



    $resultado = DB::table('pagamentos')
      ->join('estudantes', function ($join) use ($nome) {
        $join->on('estudantes.id', '=', 'pagamentos.estudante_id')
          ->where('estudantes.nome', 'LIKE', '%' . $nome . '%')
          ->where('pagamentos.emolumento_id', 1);
      })
      ->select('estudantes.id', 'estudantes.nome', 'estudantes.apelido', 'pagamentos.mes', 'pagamentos.valor', 'estudantes.pathImage', 'estudantes.curso')
      ->groupBy('estudantes.id', 'estudantes.nome', 'estudantes.apelido', 'pagamentos.mes', 'pagamentos.valor', 'estudantes.pathImage', 'estudantes.curso')
      ->get();
    //  $resultado=Estudante::where('estudantes.nome','LIKE','%'.$nome.'%')->get();

    if ($request->ajax()) {

      return response()->json($resultado);
    }
  }



  public function busquedaPorTurma(Request $request, $valor)
  {
    $turma = $valor;



    $resultado = DB::table('estudantes')
      ->join('pagamentos', function ($join) use ($turma) {
        $join->on('estudantes.id', '=', 'pagamentos.estudante_id')
          ->where('estudantes.turma_id', '=', $turma)
          ->where('estudantes.estado', '=', "Activo")
          ->where('pagamentos.emolumento_id', 1);
      })
      ->select('estudantes.id', 'estudantes.nome', 'estudantes.pathImage', 'pagamentos.mes', 'pagamentos.valor')
      ->groupBy('estudantes.id', 'estudantes.nome', 'estudantes.pathImage', 'pagamentos.mes', 'pagamentos.valor')
      ->get();

    if ($request->ajax()) {

      return response()->json($resultado);
    }
  }


  public function gerarComprovativo(Request $request, $id)
  {

    $estudante = Estudante::where('id', $id)->first();

    $mes1 = $request->mes1Modal;
    $mes2 = $request->mes2Modal;
    $mes3 = $request->mes3Modal;
    $mes4 = $request->mes4;
    $mes5 = $request->mes5;
    $mes6 = $request->mes6;
    $mes7 = $request->mes7;
    $mes8 = $request->mes8;
    $mes9 = $request->mes9;
    $mes10 = $request->mes10;
    $mes11 = $request->mes11;
    $mes12 = $request->mes12;


    if ($mes1 != null) {

      Pagamento::create([
        'valor' => $mes1,
        'mes' => 1,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $id
      ]);
    }

    if ($mes2 != null) {

      Pagamento::create([
        'valor' => $mes2,
        'mes' => 2,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $id
      ]);
    }

    if ($mes3 != null) {
      Pagamento::create([
        'valor' => $mes3,
        'mes' => 3,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $id
      ]);
    }

    if ($mes4 != null) {
      Pagamento::create([
        'valor' => $mes4,
        'mes' => 4,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $id
      ]);
    }

    if ($mes5 != null) {
      Pagamento::create([
        'valor' => $mes5,
        'mes' => 5,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $id
      ]);
    }

    if ($mes6 != null) {
      Pagamento::create([
        'valor' => $mes6,
        'mes' => 6,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $id
      ]);
    }

    if ($mes7 != null) {
      Pagamento::create([
        'valor' => $mes7,
        'mes' => 7,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $id
      ]);
    }

    if ($mes8 != null) {
      Pagamento::create([
        'valor' => $mes8,
        'mes' => 8,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $id
      ]);
    }

    if ($mes9 != null) {
      Pagamento::create([
        'valor' => $mes9,
        'mes' => 9,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $id
      ]);
    }

    if ($mes10 != null) {
      Pagamento::create([
        'valor' => $mes10,
        'mes' => 10,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $id
      ]);
    }

    if ($mes11 != null) {
      Pagamento::create([
        'valor' => $mes11,
        'mes' => 11,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $id
      ]);
    }

    if ($mes12 != null) {
      Pagamento::create([
        'valor' => $mes12,
        'mes' => 12,
        'ano' => 2020,
        'emolumento_id' => 1,
        'estudante_id' => $id
      ]);
    }

    $pdf = PDF::loadView('relatorios.comprovativo', compact('estudante'))->setPaper("letter", "landscape");
    return $pdf->download('comprovativo.pdf');

    //return redirect()->route('fichaPagamento',$id);

  }

  public function mesesSinPagar($id, $ano)
  {
    return Pagamento::where(['emolumento_id' => 1, 'ano' => $ano, 'estudante_id' => $id])->pluck('mes', 'id');
  }

  public function pagamentoDadoUmMes()
  {
    $turmas = Turma::all();
    $estudante = Estudante::where('estado', 'activo')->pluck('nome', 'id'); //->prepend('selecciona');
    $emolumentos = Emolumento::pluck('nome', 'id'); //->prepend('selecciona');
    // $mesesSinPagar = $this->mesesSinPagar($estudante->id,'2020');
    //$emolumentos->push($mesesSinPagar);

    return view('pagamentos.pagamentoDadoUmMes', ['turmas' => $turmas, 'estudante' => $estudante, 'emolumentos' => $emolumentos]);
  }

  public function novoStore(Request $request)
  {

    $array = $request->valores; //valores es el array que envió con el ajax
    //$formasDePago[] = $request->formasDePago;
    //$obs[] = $request->obs;
    //dd($formasDePago);

    $descricao = "";

    $array = json_decode($array);

    //dd($array);
    //dd("algo");

    $max = sizeof($array);  //Me devuelve el tamaño del array

    // $fecha = $array[0]->fecha; // la fecha de mi posición 0 en el array
    $estudante = "";
    $anoLectivo = "";
    $datos = false;
    foreach ($array as $clave => $valor) {
      // dd($valor->valortaxa);
      if ($datos == false) {
        $estudante = Estudante::where("id", $valor->idEst)->first();
        $anoLectivo = $valor->ano;
        $datos = true;
        break;
      }
    }
    $total = 0;
    $taxa = 0;
    $totalTaxa = 0;

    foreach ($array as $clave => $valor) {
      $descricao = "";
      $claveFormasPago = "formasDePago" . $valor->mes;
      $formasPago = $request[$claveFormasPago];
      $obs = $request->obs;
      $obsGeral = $request->obsGeral;
      $claveObs = "obs" . $valor->mes;
      foreach ($formasPago as $clave2 => $valor2) {
        if ($descricao != "") {
          $descricao = $descricao . "," . $valor2;
        } else {
          $descricao = $valor2;
        }
      }
      if ($obs[$clave] != null) {
        $descricao = $descricao . "-->" . $obs[$clave];
      }
      //dd($valor->valortaxa);
      /*  if ($valor->valortaxa !=0) {
        $taxa = $valor->valortaxa * 2500;
      }*/

      // $valorFinal= $valor->valor+$taxa;
      $pagamentoTest =  Pagamento::create([
        'valor' => \App\Emolumento::valorEmolumento($valor->idEmolumento),
        'taxa' => $valor->valortaxa,
        'mes' => $valor->mes,
        'ano' => $valor->ano,
        'emolumento_id' => $valor->idEmolumento,
        'estudante_id' => $valor->idEst,
        'obs' => $descricao,
        'descrip' => $obsGeral
      ]);

      //novo das contas
      $conta = Conta::where('estudante_id', $estudante->id)->first();
      $pagamentoTest->conta_id = $conta->id;
      $pagamentoTest->save();
      //**************************************************************************Contencioso temporal */
      if ($pagamentoTest->mes == 12) {
        $conta->is_contencioso = 0;
        $conta->save();
      }
      //********************************************************************************************************** */

      $total += \App\Emolumento::valorEmolumento($valor->idEmolumento);
      $totalTaxa += $valor->valortaxa;
    }
    $dataPagamento = $pagamentoTest->created_at;

    \Log::info('Registro do pagamento numero ' . $pagamentoTest->id . ' valor: ' . $pagamentoTest->valor . ' a favor de : ' . $estudante->nome . ' Data: ' . $pagamentoTest->created_at);

    Session::flash('flash_message', 'Pagamento(s) inseridos correctamente');



    $pdf = PDF::loadView('pagamentos.pdfComprovativo', compact("array", "estudante", "total", "totalTaxa", "anoLectivo", "dataPagamento"))->setPaper('a5-R');
    return $pdf->download('comprovativo.pdf');
  }


  public function relatoriosPagamentos(Request $request)
  {


    $turmas = Turma::all();
    if ($request->idTurma == "todos") {
      $turmaSelected = "todos";
      $estudantes = Estudante::where('estado', 'activo')->orderby('turma_id', 'asc')->get();
    } else if ($request->idTurma != "todos") {
      $turmaSelected = $request->idTurma;
      $estudantes = Estudante::where('estado', 'activo')->where('turma_id', $request->idTurma)->orderby('turma_id', 'asc')->get();
    }
    $ano = $request->ano;
    $i = 1;
    $y = 1;
    // dd($estudantes);
    //$turmaSelected = Turma::where('id', 3)->first();
    return view('pagamentos.relatoriosPagamentos', compact('turmaSelected', 'turmas', 'estudantes', 'i', 'y', 'ano'));
  }

  public function relatoriosPagamentos2(Request $request)
  {

    $turmas = Turma::all();
    $turmaSelected = Turma::where('id', $request->idTurma)->first();
    $estudantes = $turmaSelected->listaEstudantes($turmaSelected->id);
    $i = 1;
    $y = 1;

    return view('pagamentos.relatoriosPagamentos', compact('turmaSelected', 'turmas', 'estudantes', 'i', 'y'));
  }

  public function resultRelatoriosPagamentos(Request $request)
  {

    /* $fecha = explode('-', $request->fecha);
    $ano = $fecha[0];
    $mes = $fecha[1];*/

    $ano = $request->ano;



    $idTurma = $request->idTurma;
    $turma = Turma::where("id", $idTurma)->first();
    $estudantes = Estudante::where('turma_id', $idTurma)->where('estado', 'activo')->get();


    return view('pagamentos.mapaPagamentos', compact('estudantes', 'ano', 'turma'));
  }

  public function pdfMapaPagamentos($idTurma, $ano)
  {
    $estudantes = Estudante::where('estado', 'activo')->where('turma_id', $idTurma)->get();
    $turmaSelected = Turma::where("id", $idTurma)->first();
    $i = 1;
    $pdf = PDF::loadView('pagamentos.pdfMapaPagamentos', compact("estudantes", "ano", "turmaSelected", 'i'))->setPaper('a4', 'landscape');
    // $pdf->set_paper('A4', 'landscape');
    return $pdf->download('mapaPagamentos.pdf');
  }

  public function pdfMapaCompletoPagamentos()
  {
    $estudantes = Estudante::where('estado', 'activo')->get();
    //  $turmaSelected = Turma::where("id", $idTurma)->first();
    $i = 1;
    $ano = 2021;
    $pdf = PDF::loadView('pagamentos.pdfMapaPagamentosCompleto', compact("estudantes", 'i', 'ano'))->setPaper('a4', 'landscape');
    // $pdf->set_paper('A4', 'landscape');
    return $pdf->download('mapaPagamentosCompleto.pdf');
  }

  public function pdfDiarioCaixa($date)
  {

    $pagamentos = Pagamento::whereDate('created_at', $date)->get();
    $totalInscricao =  Pagamento::whereDate('created_at', $date)
      ->where("mes", 1)->sum('valor');
    $totalMatricula =  Pagamento::whereDate('created_at', $date)
      ->where("mes", 2)->sum('valor');
    $totalPropinas =  Pagamento::whereDate('created_at', $date)
      ->where("emolumento_id", 1)
      ->sum('valor');
    $totalEmolumentos =  Pagamento::whereDate('created_at', $date)
      ->where("emolumento_id", "<>", 1)->sum('valor');

    $total = $pagamentos->sum('valor');
    $totalTaxa = $pagamentos->sum('taxa');
    // dd($total);

    $totalTPA =  Pagamento::whereDate('created_at', $date)
      ->where("obs", "like", "%" . "TPA" . "%")->where("obs", "not like", "%" . "-->" . "%")->sum('valor');
    $totalTaxaTPA =  Pagamento::whereDate('created_at', $date)
      ->where("obs", "like", "%" . "TPA" . "%")->sum('taxa');
    $totalTPA += $totalTaxaTPA;

    $totalDinheiro =  Pagamento::whereDate('created_at', $date)
      ->where("obs", "like", "%" . "Dinheiro" . "%")->where("obs", "not like", "%" . "-->" . "%")->sum('valor');
    $totalTransf =  Pagamento::whereDate('created_at', $date)
      ->where("obs", "like", "%" . "Transf" . "%")->where("obs", "not like", "%" . "-->" . "%")->sum('valor');
    $totalTaxaTransf =  Pagamento::whereDate('created_at', $date)
      ->where("obs", "like", "%" . "Transf" . "%")->sum('taxa');
    $totalTransf += $totalTaxaTransf;


    //pagamentos mixtos
    $pagamentosMixtos = DB::table('pagamentos')->select('obs')
      ->whereDate('created_at', $date)
      ->where("obs", "like", "%" . "-->" . "%")->get();
    // $tempPagamentos=explode("-->",$pagamentosMixtos);

    foreach ($pagamentosMixtos as $key => $value) {
      $tempPagamentos = $value->obs;
      $splitPagamentos = explode("-->", $tempPagamentos);
      $formasPagos = $splitPagamentos[0];
      $pagos = $splitPagamentos[1];

      $splitFormasPagos = explode(",", $formasPagos);
      $splitPagos = explode(",", $pagos);

      // dd($splitFormasPagos,$splitPagos);


      for ($i = 0; $i < 2; $i++) {

        if ($splitFormasPagos[$i] == "TPA") {
          $totalTPA += $splitPagos[$i];
        }
        if ($splitFormasPagos[$i] == "Dinheiro") {
          $totalDinheiro += $splitPagos[$i];
        }
        if ($splitFormasPagos[$i] == "Transferência") {
          $totalTransf += $splitPagos[$i];
        }
      }
    }

    $pdf = PDF::loadView('pagamentos.pdfDiarioCaixa', compact(
      'pagamentos',
      'total',
      'totalTaxa',
      'totalInscricao',
      'totalMatricula',
      'totalPropinas',
      'totalEmolumentos',
      'totalTPA',
      'totalDinheiro',
      'date',
      'totalTransf'
    ))->setPaper('a4', 'landscape');
    // $pdf->set_paper('A4', 'landscape');
    return $pdf->download('diarioCaixa.pdf');
  }



  public function estadoConta($id, $ano)
  {
    $estudante = Estudante::where('id', $id)->first();
    $pagamentos = Pagamento::where("estudante_id", $id)->where("ano", $ano)
      ->where("emolumento_id", 1)
      ->where("mes", '<>', 1)
      ->where("mes", '<>', 2)
      ->get();
    $pagamentosPropinas = Pagamento::where("estudante_id", $id)
      ->where("ano", $ano)
      ->where("emolumento_id", 1)
      ->where("mes", '<>', 1)
      ->where("mes", '<>', 2)
      ->get();

    $total = $pagamentos->sum('valor');
    $totalTaxas = $pagamentos->sum('taxa');

    $totalPropinas = $pagamentosPropinas->sum('valor');

    $valorTotal = 250000;
    $resto = (int)$valorTotal - (int)$totalPropinas;

    $pdf = PDF::loadView('pagamentos.pdfEstadoConta', compact("pagamentos", "estudante", "total", "resto", "totalPropinas", "totalTaxas"));


    return $pdf->download('estadoDeConta.pdf');
  }


  public static function relatorioPagamentos()
  {
    $estudantes = Estudante::where('estado', 'activo')->get();

    $cantidadEstudantes = $estudantes->count();
    $cantPagamentosMar = Pagamento::where('mes', 3)->count();
    $cantPagamentosOut = Pagamento::where('mes', 4)->count();
    $cantPagamentosNov = Pagamento::where('mes', 5)->count();
    $cantPagamentosDez = Pagamento::where('mes', 6)->count();

    $resultado = DB::table('pagamentos')
      ->join('estudantes', function ($join) {
        $join->on('estudantes.id', '=', 'pagamentos.estudante_id')
          //   ->where('estudantes.id', $id)
          ->where('estudantes.estado', 'activo')
          ->where('pagamentos.emolumento_id', 1)
          ->where('pagamentos.mes', '<>', 1)
          ->where('pagamentos.mes', '<>', 2);
        // ->where('pagamentos.ano', $ano);
      })
      ->select('estudantes.id as estudante_id', 'estudantes.nome', 'estudantes.apelido', 'pagamentos.mes', 'pagamentos.valor', 'pagamentos.created_at', 'estudantes.pathImage', 'pagamentos.emolumento_id', 'pagamentos.obs')
      ->groupBy('estudantes.id', 'estudantes.nome', 'estudantes.apelido', 'pagamentos.mes', 'pagamentos.valor', 'pagamentos.created_at', 'estudantes.pathImage', 'pagamentos.emolumento_id', 'pagamentos.obs')
      ->get();

    return view('pagamentos.relatorioPagamentos', compact('estudantes', 'resultado', 'cantidadEstudantes', 'cantPagamentosMar', 'cantPagamentosOut', 'cantPagamentosNov', 'cantPagamentosDez'));
  }

  public function pagamentoInscricao($numFactura)
  {
    $factura = Factura::find($numFactura);
    $candidato = Candidato::where('codigo', $factura->codEst)->first();

    $pagamento = new Pagamento();
    $emolumentoInsc = Emolumento::find(27);
    $pagamento->valor = $emolumentoInsc->valor;
    $pagamento->emolumento_id = 27;
    $pagamento->estudante_id = 0; //Candidato
    $pagamento->ano = $factura->ano;
    $pagamento->obs = $factura->formaPagamento;
    $pagamento->descrip = $candidato->codigo;
    $pagamento->save();
    $candidato->estado = "Inscrito";
    $candidato->save();

    // $factura=Factura::where('codEst',$candidato->codigo)->first();
    $factura->estado = "Paga";
    $factura->save();

    $pdf = PDF::loadView('candidatos.pdfComprovativoInscricao', compact("pagamento", "candidato"))->setPaper('a5-R');
    return $pdf->stream();
  }

  public function pagamentoMatricula($codigo)
  {

    $factura = Factura::find($codigo);
    $factura->estado = "Paga";
    $factura->save();

    $matricula = Matricula::where('codFactura', $factura->numFactura)->first();
    //dd($matricula);
    $matricula->estado = "Realizada";

    $candidato = Candidato::where('codigo', $matricula->codCandidato)->first();

    $estudante = Estudantes::registrarEstudante($candidato);
    $estudante->email = $matricula->email;
    $estudante->pathImage = $matricula->url;
    $estudante->estado = "Matriculado";
    $estudante->save();

    $candidato->estado = "Matriculado";
    $candidato->save();

    $pagamento = new Pagamento();
    $emolumento = Emolumento::find(14);
    $valorMatricula = $emolumento->valor;
    $pagamento->valor = $valorMatricula;
    $pagamento->emolumento_id = 14;
    $pagamento->estudante_id = $estudante->id;
    $pagamento->ano = $factura->ano;

    $pagamento->save();
    $curso = Curso::find($estudante->curso_id);
    //dd($estudante->curso_id);
    do {
      $numero = mt_rand(1, 9999);
      $strAno = strval($estudante->anoAdmissao);
      $ano = substr($strAno, -2);
      $codigo = $ano . $curso->codigo . $numero;
    } while ($this->codigoExistente($codigo));

    $estudante->codigo = $codigo;

    $estudante->save();

    $matricula->codEstudante = $estudante->codigo;
    $matricula->save();

    //inscriçao 

    /* $inscricao = new Inscricao();
    $inscricao->estudante_id = $estudante->id;
    $inscricao->curso_id = $estudante->curso_id;
    $inscricao->anoCurricular = 1;
    $inscricao->anoAcademico = $estudante->anoAcademico;
    $inscricao->save();

    $disciplinas = Disciplina::where('curso_id', $estudante->curso_id)->where('ano', 1)->get();
    $inscricao->disciplinas()->sync($disciplinas);
    $inscricao->save();
*/


    //registro en la turma

    //verificar si existe turma para ese curso en primer ano
    //$turmas = Turma::where('curso_id', $estudante->curso_id)->where('anoLectivo', 1)->where('periodo', $matricula->periodo)->where('anoAcademico', 2021)->get();



    // $turma = $this->turmaComCapacidade($turmas);

    /* if ($turma != null) {
      $estudante->turma_id = $turma->id;
      $estudante->save();
    } else if ($turma == null) {
    
      $turma2 = new Turma();
      $curso = Curso::find($estudante->curso_id);
      $sala = Sala::where('seccao_id', $curso->seccao_id)->where('estado', 'Disponivel')->first();
      $turma2->identificador = $curso->codigo . "1" . $matricula->periodo . $sala->id;
      $turma2->curso_id = $estudante->curso_id;
      $turma2->anoAcademico = $estudante->anoAcademico;
      $turma2->anoLectivo = 1;
      $turma2->sala_id = $sala->id;
      $turma2->periodo = $matricula->periodo;
      $turma2->save();
      $estudante->turma_id = $turma2->id;
      $estudante->save();
      $sala->estado = "Ocupada";
      $sala->save();
    }*/

    $pdf = PDF::loadView('Estudantes.pdfComprovativoMatricula', compact("pagamento", "estudante"))->setPaper('a5-R');
    return $pdf->stream();
  }

  public function turmaComCapacidade($turmas)
  {
    foreach ($turmas as  $turma) {
      $estudantes = Estudante::where('turma_id', $turma->id)->get();
      $cantidad = $estudantes->count();
      if ($cantidad < 40) {
        return $turma;
      }
    }
    return null;
  }

  public function codigoExistente($codigo)
  {
    $estudante = Estudante::where('codigo', $codigo)->first();
    if ($estudante != null) {
      return true;
    } else {
      return false;
    }
  }


  public function recibo_segundaVia($id)
  {
    $item = Pagamento::find($id);
    $total = $item->valor;
    $totalTaxa = $item->taxa;

    $estudante = Estudante::where('id', $item->estudante_id)->first();
    $item->cant_recibos++;
    $item->save();
    $pdf = PDF::loadView('pagamentos.pdfReciboSegundaVia', compact("item", "estudante", "total", "totalTaxa"))->setPaper('a5-R');
    return $pdf->stream();
  }

  public function pagamentosResidencia()
  {
    return view("pagamentos.pagamentos_residencia");
  }
  public function save_pagamento(Request $request)
  {
    $pagamentoTemp = new Pagamento();

    $pagamentoTemp->estudante_id = $request->estudante_id;
    $pagamentoTemp->valor = $request->punit;
    $pagamentoTemp->taxa = $request->taxa;
    $pagamentoTemp->obs = $request->obs;
    $pagamentoTemp->emolumento_id = $request->emolumento_id;
    $pagamentoTemp->descrip = $request->descrip;

    if ($request->mes != null) {
      $pagamentoTemp->mes = $request->mes;
     
    }
    $pagamentoTemp->save();
    if ($request->ajax()) {
 $resultado="OK";
      return response()->json($resultado);
    }
  }

}
