<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel as Excel;
use App\Estudante;
use App\Pagamento;
use App\Dispesa;
use App\Fornecedor;
use App\Conta;
use App\Pagamento_tmp;
use App\NaturezaDispesas;
use App\Departamento;
use App\Emolumento;
use Carbon\Carbon;

class Caixa extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }


  public function index()
  {

    return view('caixa.index');
  }

  public function busqueda(Request $request, $valor)
  {
    $nome = $valor;



    $resultado = DB::table('pagamentos')
      ->join('estudantes', function ($join) use ($nome) {
        $join->on('estudantes.id', '=', 'pagamentos.estudante_id')
          ->where('estudantes.nome', 'LIKE', '%' . $nome . '%');
      })
      ->select('estudantes.id', 'estudantes.nome', 'pagamentos.mes', 'pagamentos.valor')
      ->groupBy('estudantes.id', 'estudantes.nome', 'pagamentos.mes', 'pagamentos.valor')
      ->get();
    //  $resultado=Estudante::where('estudantes.nome','LIKE','%'.$nome.'%')->get();

    // dd($resultado);

    if ($request->ajax()) {

      return response()->json($resultado);
    }
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
    return view("caixa.fichapagamentos", compact(
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


  public function indexDispesas()
  {
    $dispesas = Dispesa::orderBy('created_at', 'desc')->paginate(20);
    return view("caixa.indexDispesas", compact('dispesas'));
  }

  public function registrarDispesas()
  {
    $naturezas = NaturezaDispesas::all();
    $fornecedores = Fornecedor::all();
    $departamentos = Departamento::all();

    return view("caixa.registrarDispesas", compact('naturezas', 'departamentos', 'fornecedores'));
  }

  public function storeDispesas(Request $request)
  {

    $textNatureza = $request['natureza'];
    $dispesa = Dispesa::create(
      [
        // 'created_at' => $request['data'],
        'descricao' => $request['descricao'],
        'fornecedor' => $request['fornecedor'],
        'valor' => $request['valor'],
        'numFactura' => $request['numFactura'],
        'meioPagamento' => $request['meioPagamento'],
        'natureza' => $request['natureza'],
        'departamento_id' => $request['area']

      ]


    );
    $dispesa->created_at = $request['data'];
    $dispesa->save();
    $natureza = NaturezaDispesas::where('descricao', $textNatureza)->first();
    if ($natureza == null) {
      NaturezaDispesas::create(['descricao' => $textNatureza]);
    }
    // dd($request->all());
    //$request->file('image')->store('images');

    return redirect()->route('indexDispesas');
  }
  public function editarDispesas($id)
  {
    $dispesa = Dispesa::where('id', $id)->first();
    return view("caixa.editarDispesas", compact('dispesa'));
  }


  public function updateDispesas(Request $request, $id)
  {
    $dispesa = Dispesa::where('id', $id)->first();
    // $estudante->fill($request);

    $data = $request->data;
    $descricao = $request->descricao;
    $fornecedor = $request->fornecedor;
    $valor = $request->valor;
    $meioPagamento = $request->meioPagamento;
    $numFactura = $request->numFactura;

    $dispesa->created_at = $data;
    $dispesa->descricao = $descricao;
    $dispesa->valor = $valor;
    $dispesa->fornecedor = $fornecedor;
    $dispesa->meioPagamento = $meioPagamento;
    $dispesa->numFactura = $numFactura;


    $dispesa->save();
    return redirect()->route('indexDispesas');
  }

  public function deleteDispesas($id)
  {
    // dd($id);
    $dispesa = Dispesa::where('id', $id)->first();
    $dispesa->delete();
    return redirect()->route('indexDispesas');
  }

  public function filtrarDispesasMes(Request $request)
  {
    $data = "";
    $mes = "";
    $ano = "";
    $total = 0;
    if ($request->data == null) {
      $fecha = explode('-', $request->fecha);
      $ano = $fecha[0];
      $mes = $fecha[1];
      $dispesas = Dispesa::whereMonth('created_at', $mes)->whereYear('created_at', $ano)->orderBy('created_at', 'desc')->get();
      $total = Dispesa::whereMonth('created_at', $mes)->whereYear('created_at', $ano)->sum('valor');
      $totalPagamentos = Pagamento::whereMonth('created_at', $mes)->whereYear('created_at', $ano)->sum('valor');
    } else {
      $data = $request->data;
      $dispesas = Dispesa::whereDate('created_at', $data)->orderBy('created_at', 'desc')->get();
      $total = Dispesa::whereDate('created_at', $data)->sum('valor');
      $totalPagamentos = Pagamento::whereDate('created_at', $data)->sum('valor');
    }

    return view("caixa.diarioDispesasMes", compact('dispesas', 'data', 'mes', 'ano', 'total', 'totalPagamentos'));
  }


  public static function propinas()
  {
  }

  public function pagamentoEmolumento()
  {
    $emolumentos = Emolumento::all();
    // $estudante = Estudante::where('estado', 'activo')->pluck('nome', 'id'); //->prepend('selecciona');

    $estudante = Estudante::select(
      DB::raw("CONCAT(nome,' ',apelido) AS nome"),
      'id'
    )
      ->where('estado', 'activo')
      ->pluck('nome', 'id');

    return view("caixa.fazerPagamentoEmolumento", compact('emolumentos', 'estudante'));
  }

  public function storePagamentoEmolumento(Request $request)
  {
    $estudante_id = $request['estudante'];
    $anoAcademico = $request['anoAcademico'];

    $estudante = Estudante::find($estudante_id);
    //     $mes=$request['mes'];
    //     $ano=$request['ano'];
    $idEmolumentos = [];
    $idEmolumentos = $request['emolumento'];
    // dd($estudante,$idEmolumentos);
    $pagamentos = collect();
    $total = 0;

    foreach ($idEmolumentos as $emolumento) {
      $emolumento = Emolumento::where('id', $emolumento)->first();
      $pagamento = new Pagamento();

      $pagamento->valor = $emolumento->valor;
      $pagamento->emolumento_id = $emolumento->id;
      $pagamento->estudante_id = $estudante_id;
      $pagamento->ano = $emolumento->anoAcademico;

      $pagamento->save();
      $pagamentos->push($pagamento);
      /* Pagamento::create(
        [
          'valor' => $emolumento->valor,
          'emolumento_id' => $emolumento->id,
          'estudante_id' => $estudante,
          'ano' => $anoAcademico
        ]
      );*/
      $total += $emolumento->valor;
    }

    Session::flash('flash_message', 'Emolumento(s) inserido correctamente');

    $pdf = PDF::loadView('caixa.pdfComprovativoEmolumento', compact("pagamentos", "estudante", "total", "anoAcademico", "dataPagamento"))->setPaper('a5-R');
    return $pdf->download('comprovativo.pdf');
    //  return redirect()->route('pagamentoEmolumento');
    // return "OK";

  }

  public function pagamentosDia(Request $request)
  {
    $date = Carbon::now();
    $date = $date->format('y-m-d');

    $totalTaxa = 0;


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
    $totalDinheiro =  Pagamento::whereDate('created_at', $date)
      ->where("obs", "like", "%" . "Dinheiro" . "%")->where("obs", "not like", "%" . "-->" . "%")->sum('valor');
    $totalTransf =  Pagamento::whereDate('created_at', $date)
      ->where("obs", "like", "%" . "Transf" . "%")->where("obs", "not like", "%" . "-->" . "%")->sum('valor');


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

    //Temporal para grafico
    $inscricoes = [];
    for ($i = 1; $i < 13; $i++) {
      $inscricoes[$i] = $this->obtenerTotalInscricao($i, 2020);
    }
    $matriculas = [];
    for ($i = 1; $i < 13; $i++) {
      $matriculas[$i] = $this->obtenerTotalMatricula($i, 2020);
    }
    $propinas = [];
    for ($i = 1; $i < 13; $i++) {
      $propinas[$i] = $this->obtenerTotalPropina($i, 2020);
    }

    $ingresos = [];
    for ($i = 1; $i < 13; $i++) {
      $ingresos[$i] = $this->obtenerTotalIngresos($i, 2020);
    }

    $egresos = [];
    for ($i = 1; $i < 13; $i++) {
      $egresos[$i] = $this->obtenerTotalEgresos($i, 2020);
    }

    // dd($inscricoes,$matriculas,$propinas);
    // 
    //Temporal para grafico por dias
    $inscricoesDia = [];
    // for($i=1;$i<13;$i++){
    //  for($j=1;$j<31;$j++){
    $i = 0;
    $valor = $this->obtenerTotalInscricaoDia(24, 11, 2020);
    if ($valor != null) {
      $inscricoesDia[$i++] = $valor;
      //  }
      //  }
    }


    $matriculasDia = [];
    // for($i=1;$i<13;$i++){
    //   for($j=1;$j<31;$j++){
    $j = 0;
    $valor = $this->obtenerTotalMatriculaDia(24, 11, 2020);
    if ($valor != null) {
      $matriculasDia[$j++] = $valor;
    }
    //   }
    //  }

    $propinasDia = [];
    // for($i=1;$i<13;$i++){
    //  for($j=1;$j<31;$j++){
    $k = 0;
    $valor = $this->obtenerTotalPropinaDia(11, 2020);
    //dd($valor);
    if ($valor != null) {
      $propinasDia[$k++] = $valor;
      //    }
      //  }
    }

    //  dd($inscricoesDia,$matriculasDia,$propinasDia);




    return view("caixa.pagamentosDia", compact(
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
      'totalTransf',
      'inscricoes',
      'matriculas',
      'propinas',
      'ingresos',
      'egresos',
      'inscricoesDia',
      'matriculasDia',
      'propinasDia'
    ));
  }

  public function obtenerTotalInscricao($mes, $ano)
  {
    $total = Pagamento::where('mes', 1)->where('ano', $ano)->where('emolumento_id', 1)->whereMonth('created_at', $mes)->whereYear('created_at', 2020)->sum('valor');
    return $total;
  }

  public function obtenerTotalMatricula($mes, $ano)
  {
    $total = Pagamento::where('mes', 2)->where('ano', $ano)->where('emolumento_id', 1)->whereMonth('created_at', $mes)->whereYear('created_at', 2020)->sum('valor');
    return $total;
  }

  public function obtenerTotalPropina($mes, $ano)
  {
    $total = Pagamento::where('mes', '<>', 1)->where('mes', '<>', 2)->where('ano', $ano)->where('emolumento_id', 1)->whereMonth('created_at', $mes)->whereYear('created_at', 2020)->sum('valor');
    return $total;
  }

  public function obtenerTotalIngresos($mes, $ano)
  {
    $total = Pagamento::whereMonth('created_at', $mes)->whereYear('created_at', 2020)->sum('valor');
    return $total;
  }

  public function obtenerTotalEgresos($mes, $ano)
  {
    $total = Dispesa::whereMonth('created_at', $mes)->whereYear('created_at', 2020)->sum('valor');
    return $total;
  }

  //Datos por dia
  //
  public function obtenerTotalInscricaoDia($dia, $mes, $ano)
  {
    $total = Pagamento::where('mes', 1)->where('ano', $ano)->where('emolumento_id', 1)->whereDay('created_at', $dia)->whereMonth('created_at', $mes)->whereYear('created_at', 2020)->sum('valor');
    return $total;
  }

  public function obtenerTotalMatriculaDia($dia, $mes, $ano)
  {
    $total = Pagamento::where('mes', 2)->where('ano', $ano)->where('emolumento_id', 1)->whereDay('created_at', $dia)->whereMonth('created_at', $mes)->whereYear('created_at', 2020)->sum('valor');
    return $total;
  }

  public function obtenerTotalPropinaDia($mes, $ano)
  {
    $total = Pagamento::select(DB::raw('SUM(valor) as suma'))->where('mes', '<>', 1)->where('mes', '<>', 2)->where('ano', $ano)->where('emolumento_id', 1)->whereMonth('created_at', 11)->whereYear('created_at', 2020)->pluck('suma', 'created_at');
    //$total = Pagamento::where('mes','<>',1)->where('mes','<>',2)->where('ano', $ano)->where('emolumento_id',1)->whereMonth('created_at',11)->whereYear('created_at',2020)->pluck('valor','created_at');

    return $total;
  }

  public function obtenerTotalIngresosDia($dia, $mes, $ano)
  {
    $total = Pagamento::whereDay('created_at', $dia)->whereMonth('created_at', $mes)->whereYear('created_at', 2020)->sum('valor');
    return $total;
  }

  public function obtenerTotalEgresosDia($dia, $mes, $ano)
  {
    $total = Dispesa::whereDay('created_at', $dia)->whereMonth('created_at', $mes)->whereYear('created_at', 2020)->sum('valor');
    return $total;
  }



  public function filtrarPagamentosMes(Request $request)
  {
    $data = "";
    $date = "";
    $mes = "";
    $ano = "";
    $totalInscricao = "";
    $totalMatricula = "";
    $totalPropinas = "";

    //todos
    $todos = $request->todos;
    if ($todos) {

      $pagamentos = Pagamento::all();

      $totalInscricao =  Pagamento::where("mes", 1)->sum('valor');
      $totalMatricula =  Pagamento::where("mes", 2)->sum('valor');
      $totalPropinas =  Pagamento::where("mes", '<>', 1)
        ->where("mes", '<>', 2)
        ->sum('valor');
      $totalEmolumentos =  Pagamento::where("emolumento_id", "<>", 1)->sum('valor');

      $totalTPA =  Pagamento::where("obs", "like", "%" . "TPA" . "%")->where("obs", "not like", "%" . "-->" . "%")->sum('valor');
      $totalDinheiro =  Pagamento::where("obs", "like", "%" . "Dinheiro" . "%")->where("obs", "not like", "%" . "-->" . "%")->sum('valor');
      $totalTransf =  Pagamento::where("obs", "like", "%" . "Transf" . "%")->where("obs", "not like", "%" . "-->" . "%")->sum('valor');

      //pagamentos mixtos
      $pagamentosMixtos = DB::table('pagamentos')->select('obs')
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
    }

    //Pagamentos por mes
    if ($request->data == null && $request->todos == null) {

      $fecha = explode('-', $request->fecha);
      $date = $fecha;
      $ano = $fecha[0];
      $mes = $fecha[1];


      $pagamentos = Pagamento::whereMonth('created_at', $mes)->whereYear('created_at', $ano)->get();


      // $pagamentos = Pagamento::whereMonth('created_at', $mes)->whereYear('created_at', $ano)->get();



      $totalInscricao =  Pagamento::whereMonth('created_at', $mes)->whereYear('created_at', $ano)
        ->where("mes", 1)->sum('valor');
      $totalMatricula =  Pagamento::whereMonth('created_at', $mes)->whereYear('created_at', $ano)
        ->where("mes", 2)->sum('valor');
      $totalPropinas =  Pagamento::whereMonth('created_at', $mes)->whereYear('created_at', $ano)
        ->where("mes", '<>', 1)
        ->where("mes", '<>', 2)
        ->sum('valor');
      $totalEmolumentos =  Pagamento::whereMonth('created_at', $mes)->whereYear('created_at', $ano)
        ->where("emolumento_id", "<>", 1)->sum('valor');

      $totalTPA =  Pagamento::whereMonth('created_at', $mes)->whereYear('created_at', $ano)
        ->where("obs", "like", "%" . "TPA" . "%")->where("obs", "not like", "%" . "-->" . "%")->sum('valor');
      $totalDinheiro =  Pagamento::whereMonth('created_at', $mes)->whereYear('created_at', $ano)
        ->where("obs", "like", "%" . "Dinheiro" . "%")->where("obs", "not like", "%" . "-->" . "%")->sum('valor');
      $totalTransf =  Pagamento::whereMonth('created_at', $mes)->whereYear('created_at', $ano)
        ->where("obs", "like", "%" . "Transf" . "%")->where("obs", "not like", "%" . "-->" . "%")->sum('valor');

      //pagamentos mixtos
      $pagamentosMixtos = DB::table('pagamentos')->select('obs')
        ->whereMonth('created_at', $mes)->whereYear('created_at', $ano)
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
      //pagamentos data
    } elseif ($request->todos == null && $request->month == null) {
      $data = $request->data;
      $date = $request->data;
      $pagamentos = Pagamento::whereDate('created_at', $data)->get();
      $totalInscricao =  Pagamento::whereDate('created_at', $data)
        ->where("mes", 1)->sum('valor');
      $totalMatricula =  Pagamento::whereDate('created_at', $data)
        ->where("mes", 2)->sum('valor');
      $totalPropinas =  Pagamento::whereDate('created_at', $data)
        ->where("mes", '<>', 1)
        ->where("mes", '<>', 2)
        ->sum('valor');
      $totalEmolumentos =  Pagamento::whereDate('created_at', $data)
        ->where("emolumento_id", "<>", 1)->sum('valor');

      $totalTPA =  Pagamento::whereDate('created_at', $data)
        ->where("obs", "like", "%" . "TPA" . "%")->where("obs", "not like", "%" . "-->" . "%")->sum('valor');
      $totalDinheiro =  Pagamento::whereDate('created_at', $data)
        ->where("obs", "like", "%" . "Dinheiro" . "%")->where("obs", "not like", "%" . "-->" . "%")->sum('valor');
      $totalTransf = Pagamento::whereDate('created_at', $data)
        ->where("obs", "like", "%" . "Transf" . "%")->where("obs", "not like", "%" . "-->" . "%")->sum('valor');

      //pagamentos mixtos
      $pagamentosMixtos = DB::table('pagamentos')->select('obs')
        ->whereDate('created_at', $data)
        ->where("obs", "like", "%" . "-->" . "%")->get();
      // $tempPagamentos=explode("-->",$pagamentosMixtos);

      foreach ($pagamentosMixtos as $key => $value) {
        $tempPagamentos = $value->obs;
        $splitPagamentos = explode("-->", $tempPagamentos);
        $formasPagos = $splitPagamentos[0];
        $pagos = $splitPagamentos[1];

        $splitFormasPagos = explode(",", $formasPagos);
        $splitPagos = explode(",", $pagos);

        //dd($splitFormasPagos,$splitPagos);


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
    }
    $total = $pagamentos->sum('valor');
    $totalTaxa = $pagamentos->sum('taxa');



    return view("caixa.pagamentosDia", compact('pagamentos', 'total', 'totalTaxa', 'totalInscricao', 'totalMatricula', 'totalPropinas', 'totalEmolumentos', 'totalTPA', 'totalDinheiro', 'totalTransf', 'date'));
  }

  public function editarPagamento($id)
  {
    $pagamento = Pagamento::where('id', $id)->first();
    return view("caixa.editarPagamento", compact('pagamento'));
  }

  public function updatePagamento(Request $request, $id)
  {
    $pagamento = Pagamento::where('id', $id)->first();
    // $estudante->fill($request);

    $data = $request->data;
    $valor = $request->valor;
    $mes = $request->mes;
    $ano = $request->ano;
    $meioPagamento = $request->obs;
    $descrip = $request->descrip;


    $pagamento = Pagamento::where('id', $id)->first();

    $pagamento->created_at = $data;
    $pagamento->valor = $valor;
    $pagamento->mes = $mes;
    $pagamento->ano = $ano;
    $pagamento->obs = $meioPagamento;
    $pagamento->descrip = $descrip;


    $pagamento->save();
    return redirect()->route('pagamentosDia');
  }

  public function diarioCaixaNovo(Request $request)
  {

    // $data = "";
    $mes = "";
    $ano = "";
    $data = $request->data;
    $dispesas = "";
    $stringMes = "";
    //  $totalPagamentosPropinas = 0;
    //   $totalPagamentosEmolumentos = 0;
    $propinas = "";
    $totalDispesas = 0;
    $totalPagamentos = 0;

    $collection = collect([]);

    if ($data != null) {
      $fecha = explode('-', $data);
      $ano = $fecha[0];
      $mes = $fecha[1];

      $collection = Caixa::obtenerEntradaSalida($mes, $ano);

      foreach ($collection as $item) {
        if ($item->descricao == "Propinas e Emolumentos") {
          $totalPagamentos += $item->valor;
          $totalPagamentos += $item->taxa;
        } elseif ($item->descricao != "Propinas e Emolumentos") {
          $totalDispesas += $item->valor;
        }
      }

      $stringMes = Caixa::convertirMes($mes);

      return view("caixa.diarioNovo", compact('collection', 'mes', 'stringMes', 'ano', 'totalDispesas', 'totalPagamentos'));
    } else {
      return view("caixa.diarioNovo", compact('collection', 'mes', 'stringMes', 'ano', 'totalDispesas', 'totalPagamentos'));
    }
  }

  public static  function  obtenerEntradaSalida($mes, $ano)
  {
    $collection = collect([]);

    for ($i = 1; $i <= 31; $i++) {
      $data = Carbon::parse('2021/' . $mes . "/" . $i);
      $dispesas = Dispesa::whereMonth('created_at', $mes)->whereYear('created_at', $ano)->whereDay('created_at', $i)->get();
      $totalProp = Pagamento::whereMonth('created_at', $mes)->whereYear('created_at', $ano)->whereDay('created_at', $i)->sum("valor");
      $totalTaxas = Pagamento::whereMonth('created_at', $mes)->whereYear('created_at', $ano)->whereDay('created_at', $i)->sum("taxa");


      if ($totalProp > 0) {
        $pagamento = new Pagamento();
        $total = 0;
        $pagamento->created_at = $data;
        $pagamento->descricao = "Propinas e Emolumentos";
        $total = $totalProp + $totalTaxas;
        $pagamento->valor = $total;
        //  $pagamento->valor+= $totalTaxas;

        $collection->push($pagamento);
      }
      foreach ($dispesas as $dispesa) {
        $collection->push($dispesa);
      }
    }

    $collection->sortBy("created_at");




    return $collection;
  }

  function pdfEntradaSalida($mes, $ano)
  {
    $totalDispesas = 0;
    $totalPagamentos = 0;
    $collection = Caixa::obtenerEntradaSalida($mes, $ano);
    foreach ($collection as $item) {
      if ($item->descricao == "Propinas e Emolumentos") {
        $totalPagamentos += $item->valor;
        $totalPagamentos += $item->taxa;
      } elseif ($item->descricao != "Propinas e Emolumentos") {
        $totalDispesas += $item->valor;
      }
    }
    $stringMes = Caixa::convertirMes($mes);


    $pdf = PDF::loadView('caixa.pdfEntradasSaidas', compact('collection', 'totalDispesas', 'totalPagamentos', 'stringMes', 'ano'))->setPaper('a4', 'landscape');
    // $pdf->set_paper('A4', 'landscape');
    return $pdf->download('EntradaSalida.pdf');
  }

  public static function convertirMes($mes)
  {
    $stringMes = "";
    switch ($mes) {
      case 1:
        $stringMes = "Janeiro";
        break;
      case 2:
        $stringMes = "Fevereiro";
        break;
      case 3:
        $stringMes = "Março";
        break;
      case 4:
        $stringMes = "Abril";
        break;
      case 5:
        $stringMes = "Maio";
        break;
      case 6:
        $stringMes = "Junho";
        break;
      case 7:
        $stringMes = "Julho";
        break;
      case 8:
        $stringMes = "Agosto";
        break;
      case 9:
        $stringMes = "Setembro";
        break;
      case 10:
        $stringMes = "Outubro";
        break;
      case 11:
        $stringMes = "Novembro";
        break;
      case 12:
        $stringMes = "Dezembro";
        break;


      default:
        # code...
        break;
    }

    return $stringMes;
  }

  /////////////////////////////////////////////////////////////////////

  public function exportDiarioBanco($mes, $ano)
  {
    return Excel::download(new \App\Exports\DiarioBancoExport(), 'diarioBanco.xlsx');
  }

  ///////////////////////////////////////////////////////////////////////////////


  public function buscarConta(Request $request)
  {
    $id = $request->estudanteConta;
    $listaEstudantes = Estudante::where('estado', 'activo')->pluck('nome', 'id'); //->prepend('selecciona');
    $listaEmolumentos = Emolumento::all()->pluck('nome', 'id'); //->prepend('selecciona');
    $ano = $request->ano;

    $conta = null;
    $estudante = null;
    $pagamentosTemp = null;
    if ($id != null) {
      $conta = Conta::where('estudante_id', $id)->first();
      $estudante = Estudante::where('id', $id)->first();
      // dd($conta);
      $pagamentosTemp = Pagamento_tmp::where('conta_id', $conta->id)->get();
    }
    return view('caixa.buscarConta', compact('ano', 'listaEstudantes', 'conta', 'estudante', 'pagamentosTemp', 'listaEmolumentos'));
  }




  //////////////////////////////////////////////////////////////////////////////////////


  public function registrarPagamentoTemp(Request $request)
  {
    $conta_id = $request->conta_id;

    $conta = Conta::find($conta_id);
    $estudante_id = $conta->estudante_id;
    $emolumento_id = $request->emolumento_id;

    $mes = $request->mes;
    $ano = $request->ano;
    $valor = $request->valor;
    $taxa = $request->taxa;
    $desconto = $request->desconto;

    $formas_pagamento = $request->formas_pagamento;
    $obs = $request->obs;

    $pagamentoTemp = new Pagamento_tmp();
    $pagamentoTemp->designacao = "Propinas";
    $pagamentoTemp->conta_id = $conta_id;
    $pagamentoTemp->estudante_id = $estudante_id;
    $pagamentoTemp->emolumento_id = $emolumento_id;
    $pagamentoTemp->valor = $valor;


    $pagarSemMulta = $request->naoPagar;

    if ($pagarSemMulta) {
      $conta->totalTaxas += $taxa;
      $conta->save();
    } else {
      if ($request->somente) {
        $prestacao = $request->somente;
        $pagamentoTemp->taxa = $prestacao;
        $valor_divida = $taxa - $prestacao;
        $conta->totalTaxas += $valor_divida;
        $conta->save();
      } else {
        $pagamentoTemp->taxa = $taxa;
      }
    }



    $pagamentoTemp->mes = $mes;
    $pagamentoTemp->ano = $ano;
    $pagamentoTemp->obs = $formas_pagamento;
    $pagamentoTemp->descrip = $obs;
    $pagamentoTemp->desconto = $desconto;



    $pagamentoTemp->save();

    $pagamentos = Pagamentos_tmp::all();

    $resultado = "OK";
    if ($request->ajax()) {

      return response()->json($pagamentos);
    }
  }
  public function save_pagamentoTemp(Request $request)
  {
    $pagamento = new Pagamento_tmp();
    $pagamento->designacao = "Propinas";
    $pagamento->estudante_id = $request->estudante_id;
    $pagamento->valor = 25000;
    $pagamento->emolumento_id = 1;
    $pagamento->ano = 2022;
    $pagamento->mes = $request->mes;
    $pagamento->taxa = 0;

    $pagamento->save();


  }
  /////////////////////////////////////////////////////////////////////
  public function eliminar_pagamento_tmp($id)
  {
    $pag = Pagamento_tmp::find($id);
    $pag->delete();
  }
  public function eliminarPagamentoTemp($id)
  {
  
    $pag = Pagamento_tmp::find($id);
    $pag->delete();
  }
  public function updatePagamentoTemp($id,$taxa)
  {
    $valor=$id->get("id");
    $pag = Pagamento_tmp::find($valor);
    $pag->taxa=$taxa;

    $pag->save();
  }

  ////////////////////////////////////////////////////////////

  public function registrarEmolumentoPagamentoTemp(Request $request)
  {
    $conta_id = $request->conta_id;

    $conta = Conta::find($conta_id);
    $estudante_id = $conta->estudante_id;
    $emolumento_id = $request->emolumento_id;
    $emolumento = Emolumento::find($emolumento_id);
    $mes = "-";
    $ano = "-";
    $valor = $emolumento->valor;
    $formas_pagamento = $request->formas_pagamento;
    $obs = $request->obs;



    $pagamentoTemp = new Pagamento_tmp();
    $pagamentoTemp->designacao = $emolumento->nome;
    $pagamentoTemp->conta_id = $conta_id;
    $pagamentoTemp->estudante_id = $estudante_id;
    $pagamentoTemp->emolumento_id = $emolumento_id;
    $pagamentoTemp->valor = $valor;
    $pagamentoTemp->taxa = 0;
    $pagamentoTemp->mes = $mes;
    $pagamentoTemp->ano = $ano;
    $pagamentoTemp->obs = $formas_pagamento;
    $pagamentoTemp->descrip = $obs;


    $pagamentoTemp->save();

    //$pagamentos=Pagamentos_tmp::all();

    $resultado = "OK";
    if ($request->ajax()) {

      return response()->json($resultado);
    }
  }

  ////////////////////////////////////////////////////////////////////////

  ////////////////////////////////////////////////////////////////////////
  public function getJsonPagamentosTemp(Request $request, $id)
  {
    $pagamentos = Pagamento_tmp::where('conta_id', $id)->get();

    if ($request->ajax()) {

      return response()->json($pagamentos);
    }
  }
  public function getJsonPagamentosTemp2(Request $request, $estudante_id)
  {
    $pagamentos = Pagamento_tmp::where('estudante_id', $estudante_id)->get();

      return $pagamentos;
 
  }

  public static function calcularTaxa($mes, $anoAcad)
  {
    $dataActual = Carbon::now();
    // $dataActual = $dataActual->format('y-m-d');
    $dataFim = Carbon::createFromDate($anoAcad, $mes + 1, 5);
    // $dataFim = $dataFim->format('y-m-d');
    $valor = 0;

    $diferencia = $dataFim->diffInDays($dataActual);
    // dd($diferencia);
    $valor = 0;

    if ($diferencia > 0 && $diferencia <= 7) {
      $valor = 1250;
    }
    if ($diferencia > 7 && $diferencia <= 14) {
      $valor = 2500;
    }
    if ($diferencia > 14 && $diferencia <= 21) {
      $valor = 3750;
    }
    if ($diferencia > 21) {
      $valor = 5000;
    }
    if ($dataActual < $dataFim) {
      $valor = 0;
    }

    return $valor;
  }


  public function confirmar_pagamentos_tmp($id)
  {

    $pagamentos = Pagamento_tmp::where('conta_id', $id)->get();

    $pagamentos_comprovativo = [];
    foreach ($pagamentos as $i => $pagamento) {
      $pagamentoFinal = new Pagamento();
      $pagamentoFinal->valor = $pagamento->valor;
      $pagamentoFinal->taxa = $pagamento->taxa;
      $pagamentoFinal->mes = $pagamento->mes;
      $pagamentoFinal->ano = $pagamento->ano;
      $pagamentoFinal->emolumento_id = $pagamento->emolumento_id;
      $pagamentoFinal->estudante_id = $pagamento->estudante_id;
      $pagamentoFinal->conta_id = $pagamento->conta_id;
      $pagamentoFinal->obs = $pagamento->obs;
      $pagamentoFinal->descrip = $pagamento->descrip;
      $pagamentoFinal->desconto = $pagamento->desconto;


      //$pagamentoFinal->descrip=$pagamento->descrip;

      $pagamentoFinal->save();
      $pagamentos_comprovativo[$i + 1] = $pagamentoFinal;
      $pagamento->delete();
    }

    $array = collect($pagamentos_comprovativo);
    $conta = Conta::find($id);
    $estudante = Estudante::where('id', $conta->estudante_id)->first();
    $total = $array->sum('valor');
    $totalTaxa = $array->sum('taxa');
    $totalDesconto = $array->sum('desconto');




    $pdf = PDF::loadView('pagamentos.pdfComprovativoNovo', compact("array", "estudante", "total", "totalTaxa","totalDesconto"))->setPaper('a5-R');
    return $pdf->download('comprovativo.pdf');
    //return redirect()->route('buscarConta')->with('id',$id);



  }
}
