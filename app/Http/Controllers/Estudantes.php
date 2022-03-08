<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Estudante;
use \App\Turma;
use \App\Curso;
use \App\Candidato;
use App\Inscricao;
use App\Disciplina;
use App\Matricula;
use App\Factura;
use App\Provincia;
use App\Municipio;
use App\Ficha;
use App\Conta;
use App\Pagamento;
use App\Avaliacao;

use Maatwebsite\Excel\Facades\Excel as Excel;
use App\Exports\DiarioBancoExport;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use File;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;


class Estudantes extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index(Request $request)
  {


    $buscar = $request->get('buscarpor');
    $buscarEstado = $request->get('buscarporEstado');

    $tipo = $request->get('tipo');

    // $lista;

    //$lista2;
    if (isset($request->buscarpor)) {
      $lista = Estudante::where('nome', 'LIKE', '%' . $buscar . '%')->paginate(10);
      // $lista=Estudante::buscarpor($tipo, $buscar)->paginate(10);

    } else if (!isset($request->buscarpor) && isset($request->buscarporEstado)) {
      $lista = Estudante::where('estado', 'LIKE', '%' . $buscarEstado . '%')->paginate(100);
      // $lista=Estudante::buscarpor($tipo, $buscar)->paginate(10);

    } else if (!isset($request->buscarpor) && !isset($request->buscarporEstado)) {
      $lista = Estudante::where('estado', 'activo')->orderby('turma_id', 'asc')->paginate(10);
      // $lista = Estudante::where('estado','activo')->get();

    }






  /*  $todos = Estudante::where('estado', 'activo')->get();
=======
    /* $todos = Estudante::where('estado', 'activo')->get();
>>>>>>> 2f10c0f0213555a8c28eb53a02b93b1788025610
=======
    /* $todos = Estudante::where('estado', 'activo')->get();
>>>>>>> 2f10c0f0213555a8c28eb53a02b93b1788025610
=======
    /* $todos = Estudante::where('estado', 'activo')->get();
>>>>>>> 4a2ab24dc83a8f2e00db8775aae8265117757d38
    foreach ($todos as $estudante) {
     // dd('OK');
      if ($estudante->has_conta($estudante->id) == false) {
        
        $conta = new Conta();
        $conta->estudante_id = $estudante->id;
        if ($estudante->codigo != null) {
          $conta->numero = $estudante->codigo;
        } else {
          $conta->numero = "sem numero";
        }
        $conta->saldo = 0;
        $conta->totalPagar = 250000;
        $conta->totalTaxas = 0;

        $conta->save();

        $pagamentos = Pagamento::where('estudante_id', $estudante->id)->get();


        foreach ($pagamentos as $pagamento) {
          $pagamento->conta_id = $conta->id;

          $pagamento->save();
        }
      }
    }*/

    /*$pagamentos = Pagamento::all();
    $totalTaxasCI = 0;
    $totalTaxasAE = 0;
    $totalTaxasCA = 0;
    $totalTaxasEP = 0;

    foreach ($pagamentos as $pagamento) {
      if ($pagamento->emolumento_id==7 
      || $pagamento->emolumento_id==19 
      || $pagamento->emolumento_id==25
      || $pagamento->emolumento_id==26
      || $pagamento->emolumento_id==35
      || $pagamento->emolumento_id==36
      || $pagamento->emolumento_id==37
      || $pagamento->emolumento_id==38

      ) {
          if ($pagamento->estudante_id != null) {
              $estudante = Estudante::find($pagamento->estudante_id);
              if ($estudante != null) {
                  if ($estudante->curso_id == 2) {
                      $totalTaxasCI += $pagamento->valor;
                  }
                  if ($estudante->curso_id == 1) {
                      $totalTaxasAE += $pagamento->valor;
                  }
                  if ($estudante->curso_id == 3) {
                      $totalTaxasCA += $pagamento->valor;
                  }
                  if ($estudante->curso_id == 4) {
                      $totalTaxasEP += $pagamento->valor;
                  }
              }
          }
      }
    }*/
    /* $todos = Estudante::all();
    foreach($todos as $estudante){

      $curso=Curso::find($estudante->curso_id);
      if($curso!=null){
        do {
          $numero = mt_rand(100, 999);
          if($estudante->anoAdmissao==1){
            $estudante->anoAdmissao=2020;
            $estudante->save();
          }
          $strAno = strval($estudante->anoAdmissao);

          $ano = substr($strAno, -2);
          $codigo = $ano . $curso->codigo . $numero;
        } while ($this->codigoExistente($codigo));
    
        $estudante->codigo = $codigo;
        $estudante->save();
      }
    }*/
    /*  $disciplina=Disciplina::find(79);
    $inscricoes = Inscricao::where('curso_id', 1)->where('anoAcademico',2022)->where("anoCurricular","2º")->where("semestre","I")->get();
    foreach ($inscricoes as $inscricao) {
      $inscricao->disciplinas()->attach($disciplina);

    }*/
    /* $lista = collect();
    $estudantes = Estudante::where("estado", "activo")->get();
    foreach ($estudantes as $estudante) {
      $inscricao = Inscricao::where("estudante_id",$estudante->id)->where('anoAcademico', 2022)->where("anoCurricular", "1º")->where("semestre", "I")->first();
      if ($inscricao!=null) {
        if($estudante->curso_id !== $inscricao->curso_id)
          $lista->push($estudante->id);
      }
    }
   dd($lista);
   */

   
    return view('Estudantes.index', compact('lista'));
  }

  public function inserir()
  {
    $turmas = Turma::all();
    $cursos = Curso::all();

    $pais = DB::table('pais')->pluck('paisNome', 'paisId');
    // ->select('pais.paisId','pais.paisNome')
    //  ->groupBy('pais.paisId','pais.paisNome')


    return view('Estudantes.inserir', compact('turmas', 'cursos', 'pais'));
  }

  public function store(Request $request)
  {


    /* $input=$request;
      $validator = Validator::make($input::all(), [
        'nome' => 'required|min:10',
        'apelido' => 'required|min:10',
        'email' => 'required|mail',


    ]);*/


    /* if ($validator->fails()) {
        return redirect('/estudantes/inserir')
                    ->withErrors($validator)
                    ->withInput();
    }*/

    /* $image = $request->file('image');
    $filename = date('Y-m-d-H:i:s')."-".$image->getClientOriginalName();
    Image::make($image->getRealPath())->resize(100, 100)->save('public/images/estudantes/'.$filename);
    //$product->image = 'img/products/'.$filename;
    //$product->save();*/

    // $test = 'img/estudantes/'.$filename;
    //comentario  fdfdfdf
    $estudante = new Estudante();

    $file = $request->file('imagenperfil');
    //$image = $request->file('imagenperfil'); //image_file is the name of the file field used in the form in blade
    //obtenemos el nombre del archivo
    $nombre =  time() . "_" . $file->getClientOriginalName();
    //indicamos que queremos guardar un nuevo archivo en el disco local
    //$test=\Storage::disk('imagenperfil');
    //dd($file);
    $img = Image::make($file->path());

    // \Storage::disk('imagenperfil')->put($nombre,  \File::get($file));
    \Storage::disk('imagenperfil')->put($nombre,  $img);
    $estudante->pathImage = $nombre;
    // $archivo = new Archivos;
    //$archivo->nombre_archivo = $nombre;
    //$archivo->save();

    //dd($request->curso);
    //$foto=Estudante::setImagen($request->image);

    //dd($request['estado']);

    $nome = $request->nomeCompleto;
    //$apelido = $request->apelido;
    // $email = $request->email;
    //$turma = $request->turma;
    $anoAdmissao = $request->anoAdmissao;
    $anoAcademico = $request->anoAcademico;

    //$curso = $request->curso;
    $cursoId = $request->curso; //cambios curso
    $estado = $request->estado;
    $dataNac = $request->dataNac;
    $BI = $request->BI;
    $dataBI = $request->dataEmissaoBI;

    $genero = $request->genero;
    //$naturalDe = $request->naturalDe;
    $nacionalidade = $request->nacionalidade;
    // $paisOrigem = $request->paisOrigem;
    $nomePai = $request->nomePai;
    $nomeMai = $request->nomeMai;

    //$provRecidencia = $request->provRecidencia;
    $provincia_id = $request->provRecidencia;
    $municipio_id = $request->munRecidencia;
    $telefone1 = $request->telefone1;
    $telefone2 = $request->telefone2;
    $telefoneEmergencia = $request->telefoneEmergencia;

    $endereco = $request->endereco;
    $provinciaEndereco_id = $request->provEndereco;
    $municipioEndereco_id = $request->munEndereco;
    $trabalhador = $request->trabalhador;
    $email = $request->email;





    $estudante->nome = $nome;
    //$estudante->apelido = $apelido;
    //$estudante->curso = $curso;
    $estudante->curso_id = $cursoId; //cambio curso
    $estudante->email = $email;
    // $estudante->turma_id = $turma;
    $estudante->anoAdmissao = $anoAdmissao;
    $estudante->anoAcademico = $anoAcademico;
    $estudante->estado = $estado;
    $estudante->dataNac = $dataNac;
    $estudante->BI = $BI;
    $estudante->dataEmissaoBI = $dataBI;
    $estudante->genero = $genero;
    //$estudante->naturalDe = $naturalDe;
    $estudante->nacionalidade = $nacionalidade;
    // $estudante->paisOrigem = $paisOrigem;
    $estudante->nomePai = $nomePai;
    $estudante->nomeMai = $nomeMai;

    $estudante->provincia_id = $provincia_id;
    $estudante->municipio_id = $municipio_id;
    $estudante->telefone1 = $telefone1;
    $estudante->telefone2 = $telefone2;
    $estudante->telefoneEmergencia = $telefoneEmergencia;

    $estudante->endereco = $endereco;
    $estudante->provinciaEndereco_id = $provinciaEndereco_id;
    $estudante->municipioEndereco_id = $municipioEndereco_id;

    $estudante->trabalhador = $trabalhador;







    $estudante->save();

    /*   Estudante::create(
      [
        'nome' => $request['nome'],
        'apelido' => $request['apelido'],
        'email' => $request['email'],
        'curso' => $request['curso'],
        'turma_id' => $request['turma'],
        'anoAdmissao' => $request['anoAdmissao'],
        'anoAcademico' => $request['anoAcademico'],
        'estado' => $request['estado'],
        'BI' => $request['BI'],
        'genero' => $request['genero'],
        'naturalDe' => $request['naturalDe'],
        'nacionalidade' => $request['nacionalidade'],
        'paisOrigem' => $request['paisOrigem'],
        'nomePai' => $request['nomePai'],
        'provRecidencia' => $request['provRecidencia'],
        'munRecidencia' => $request['munRecidencia'],
        'telefone1' => $request['telefone1'],
        'telefone2' => $request['telefone2'],
        'endereco' => $request['endereco'],



        'pathImage' => $nombre,

      ]

    );
    */
    /*  $codigoCandidato = $request->codigoCandidato;
    $candidato = Candidato::where('codigo', $codigoCandidato);
    $candidato->delete();*/


    /* do {
      $numero = mt_rand(1, 9999);
      $codigo = "MAT" . $anoAcademico . $numero;
    } while ($this->codigoExistente($codigo));

    $estudante->codigo = $codigo;
    $estudante->save();*/

    $documentos = $request->documentos;

    // foreach ($documentos as $documento) {
    $estudante->documentos()->sync($documentos);
    //  }
    $estudante->save();




    $pdf = PDF::loadView('estudantes.pdfFacturaMatricula', compact("estudante"));
    // return $pdf->download('facturaCandidatura.pdf');
    // redirect()->route('listarCandidatos',1);
    return $pdf->stream();
    // return redirect()->route('listarEstudantes');
  }

  public static function registrarEstudante(Candidato $request)
  {


    $estudante = new Estudante();
    $nome = $request->nomeCompleto;
    $anoAcademico = "1º"; //$request->anoAcademico;
    $anoAdmissao = $request->anoAcademico;
    $cursoId = $request->curso_id; //cambios curso
    $estado = "Activo";
    $dataNac = $request->dataNac;
    $BI = $request->BI;
    $dataBI = $request->dataEmissaoBI;
    $dataValidadeBI = $request->dataValidadeBI;
    $genero = $request->genero;
    $nacionalidade = $request->nacionalidade;
    $nomePai = $request->nomePai;
    $nomeMai = $request->nomeMai;
    $provincia_id = $request->provincia_id;
    $municipio_id = $request->municipio_id;
    $telefone1 = $request->telefone1;
    $telefone2 = $request->telefone2;
    $telefoneEmergencia = $request->telefoneEmergencia;
    $endereco = $request->endereco;
    $provinciaEndereco_id = $request->provinciaEndereco_id;
    $municipioEndereco_id = $request->municipioEndereco_id;
    $trabalhador = $request->trabalhador;
    $email = $request->email;

    $estudante->nome = $nome;
    $estudante->curso_id = $cursoId; //cambio curso
    // $estudante->email = $email;
    // $estudante->turma_id = $turma;
    //  $estudante->anoAdmissao = $anoAdmissao;
    $estudante->anoAcademico = $anoAcademico;
    $estudante->anoAdmissao = $anoAdmissao;
    $estudante->estado = $estado;
    $estudante->dataNac = $dataNac;
    $estudante->BI = $BI;
    $estudante->dataEmissaoBI = $dataBI;
    $estudante->dataValidadeBI = $dataValidadeBI;
    $estudante->genero = $genero;
    //$estudante->naturalDe = $naturalDe;
    $estudante->nacionalidade = $nacionalidade;
    // $estudante->paisOrigem = $paisOrigem;
    $estudante->nomePai = $nomePai;
    $estudante->nomeMai = $nomeMai;

    $estudante->provincia_id = $provincia_id;
    $estudante->municipio_id = $municipio_id;
    $estudante->telefone1 = $telefone1;
    $estudante->telefone2 = $telefone2;
    $estudante->telefoneEmergencia = $telefoneEmergencia;

    $estudante->endereco = $endereco;
    $estudante->provinciaEndereco_id = $provinciaEndereco_id;
    $estudante->municipioEndereco_id = $municipioEndereco_id;
    // $estudante->pathImage = $nombre;
    $estudante->trabalhador = $trabalhador;
    $estudante->email = $email;


    $estudante->save();

    $documentos = $request->documentos;

    // foreach ($documentos as $documento) {
    $estudante->documentos()->sync($documentos);
    //  }
    $estudante->save();

    return $estudante;


    //  $pdf = PDF::loadView('estudantes.pdfFacturaMatricula', compact("estudante"));
    // return $pdf->download('facturaCandidatura.pdf');
    // redirect()->route('listarCandidatos',1);
    // return $pdf->stream();
    // return redirect()->route('listarEstudantes');
  }




  public function codigoMatriculaExistente($codigo)
  {
    $matricula = Matricula::where('codigo', $codigo)->first();
    if ($matricula != null) {
      return true;
    } else {
      return false;
    }
  }

  public function guardar(Request $request)
  {
    if ($foto = Estudante::setImagen($request->imagen)) {
      $request->request->add(['pathImage' => $foto]);
    }
  }

  public function editar($id)
  {
    $estudante = Estudante::where('id', $id)->first();
    $turmas = Turma::all();
    $cursos = Curso::all();
    $date = Carbon::now();
    $date = $date->format('20y-m-d');
    $provincias = Provincia::all(); //pluck('nome', 'id');
    $municipios = Municipio::all(); //pluck('nome', 'id');
    return view('Estudantes.editar', compact('estudante', 'turmas', 'cursos', 'date', 'provincias', 'municipios'));
  }

  public function update(Request $request, $id)
  {

    $estudante = Estudante::where('id', $id)->first();
    // $estudante->fill($request);

    $file = $request->file('imagenperfil');
    //obtenemos el nombre del archivo
    if ($file != null) {
      $nombre =  time() . "_" . $file->getClientOriginalName();
      File::delete(\Storage::disk('imagenperfil'), $estudante->pathImage); // Delete
      \Storage::disk('imagenperfil')->put($nombre,  \File::get($file));
      $estudante->pathImage = $nombre;
    }




    $estudante->nome = $request->nome_completo;
    $estudante->apelido = $request->apelido;
    $estudante->curso_id = $request->curso_id; //cambios curso
    $estudante->dataNac = $request->data_nac;
    $estudante->BI = $request->BI;
    $estudante->dataEmissaoBI = $request->data_emissao_BI;
    $estudante->dataValidadeBI = $request->data_validade_BI;
    $estudante->genero = $request->genero;
    $estudante->nomePai = $request->nome_pai;
    $estudante->nomeMai = $request->nome_mai;
    $estudante->provincia_id = $request->provincia_residencia;
    $estudante->municipio_id = $request->municipio_residencia;
    $estudante->nacionalidade = $request->nacionalidade;
    $estudante->trabalhador = $request->trabalhador;

    //telefones
    $estudante->telefone1 = $request->telefone1;
    $estudante->telefone2 = $request->telefone2;
    $estudante->telefoneEmergencia = $request->telefoneEmergencia;

    //morada
    $estudante->provinciaEndereco_id = $request->prov_endereco;
    $estudante->municipioEndereco_id = $request->mun_endereco;
    $estudante->endereco = $request->morada;

    //email da instituicao
    $estudante->email = $request->email;

    //turma do estudante
    $estudante->turma_id = $request->turma;

    // Estado do estudante
    $estudante->estado = $request->estado;





    // $estudante->pathImage = $nombre;



    // $documentos = $request->documentos;

    // foreach ($documentos as $documento) {
    // $estudante->documentos()->sync($documentos);
    //  }
    // $estudante->save();



    $estudante->save();
    return redirect()->route('listarEstudantes');
  }

  public function delete($id)
  {
    $estudante = Estudante::where('id', $id)->first();
    $estudante->delete();
    return redirect()->route('listarEstudantes');
  }

  public function getMesesValidos(Request $request, $id, $ano)
  {

    $estudante = Estudante::where('id', $id)->first();
    // $pagamentos=$estudante->pagamentos($ano)->get();
    //$ano2="'"+$ano+"'";
    if ($request->ajax()) {
      $pagamentos = $estudante->pagamentos($ano);
      return response()->json($pagamentos);
    }
  }

  public function pdf()
  {
    /**
     * toma en cuenta que para ver los mismos 
     * datos debemos hacer la misma consulta
     **/
    $estudantes = Estudante::all();

    $pdf = PDF::loadView('estudantes.pdfEstudantes', compact('estudantes'));

    return $pdf->download('listado.pdf');
  }

  public function pdfTurma($id)
  {

    $estudantes = Estudante::where("turma_id", $id)->where("estado", 'activo')->get();
    $turma = Turma::where('id', $id)->first();

    $pdf = PDF::loadView('Estudantes.pdfEstudantes-Turmas', compact('estudantes', 'turma'));

    return $pdf->download('listadoEstudantesTurma.pdf');
  }

  public function pdfTurmaCartao($id)
  {

    $estudantes = Estudante::where("turma_id", $id)->where("estado", 'activo')->orderby('nome', 'asc')->get();
    $turma = Turma::where('id', $id)->first();

    $pdf = PDF::loadView('Estudantes.pdfEstudantes-TurmasCartao', compact('estudantes', 'turma'));

    return $pdf->download('listadoEstudantesTurmaCartao.pdf');
  }
  public function exportListaCartao($id)
  {

    return Excel::download(new \App\Exports\ListaCartaoExport($id), 'ListaCartao.xlsx');
  }

  public function fichaEstudante($id)
  {
    $estudante = Estudante::where('id', $id)->first();
    $matricula = Matricula::where('codEstudante', $estudante->codigo)->first();
    // $numMatricula=$matricula->codigo;
    return view('Estudantes.ficha', compact('estudante'));
  }

  public function estudantesTurma(Request $request, $id)
  {
    // $turma=$valor;

    $resultado = Estudante::where("turma_id", $id)
      ->where('estado', 'activo')
      ->get();

    /*  $resultado=DB::table('estudantes')
                  ->join('pagamentos', function ($join) use($turma) {
                      $join->on('estudantes.id', '=', 'pagamentos.estudante_id')
                           ->where('estudantes.turma_id','=',$turma)
                           ->where('pagamentos.emolumento_id',1);
                  })
                  ->select('estudantes.id','estudantes.nome','estudantes.pathImage', 'pagamentos.mes', 'pagamentos.valor')
                  ->groupBy('estudantes.id','estudantes.nome','estudantes.pathImage','pagamentos.mes','pagamentos.valor')
                  ->get();*/

    if ($request->ajax()) {

      return response()->json($resultado);
    }
  }

  public function estudanteDadoID(Request $request, $id)
  {
    // $turma=$valor;

    $resultado = Estudante::where("id", $id)->get();

    /*  $resultado=DB::table('estudantes')
                     ->join('pagamentos', function ($join) use($turma) {
                         $join->on('estudantes.id', '=', 'pagamentos.estudante_id')
                              ->where('estudantes.turma_id','=',$turma)
                              ->where('pagamentos.emolumento_id',1);
                     })
                     ->select('estudantes.id','estudantes.nome','estudantes.pathImage', 'pagamentos.mes', 'pagamentos.valor')
                     ->groupBy('estudantes.id','estudantes.nome','estudantes.pathImage','pagamentos.mes','pagamentos.valor')
                     ->get();*/

    if ($request->ajax()) {

      return response()->json($resultado);
    }
  }

  public  function toString($id)
  {
    $estudante = Estudante::where('id', $id)->first();
    return $estudante->nome;
  }

  public function pdfActaAvaliacao($id)
  {
    $estudantes = Estudante::where("turma_id", $id)->where("estado", 'Activo')->orderby('nome', 'asc')->get();
    $turma = Turma::where('id', $id)->first();
    $i = 1;
    //  (App\Pagamento::pagamentoMesAno($estudante,3,$ano)
    $pdf = PDF::loadView('Estudantes.pdfActaExame', compact('estudantes', 'turma', 'i'));

    return $pdf->download('listadoEstudantesTurma.pdf');
  }

  public function registrarMatricula(Request $request)
  {

    $candidato = Candidato::where('codigo', $request->codigoCandidato)->first();
    $candidato->matriculado = true;
    $candidato->save();
    //$anoAcademico = $candidato->anoAcademico;
    /* $matricula = new Matricula();

    do {
      $numero = mt_rand(1, 9999);
      $strAno = strval($candidato->anoAcademico);
      $ano = substr($strAno, -2);
      $codigoMatricula = "MAT-" . $ano . $numero;
    } while ($this->codigoMatriculaExistente($codigoMatricula));

    $matricula->codigo = $codigoMatricula;
    $matricula->codCandidato = $candidato->codigo;
    $matricula->periodo = $request->periodo;
    $matricula->email = $request->email;

    $file = $request->file('imagenperfil');
    //obtenemos el nombre del archivo
    $nombre =  time() . "_" . $file->getClientOriginalName();
    //indicamos que queremos guardar un nuevo archivo en el disco local
    //$test=\Storage::disk('imagenperfil');
    //dd($file);
    \Storage::disk('imagenperfil')->put($nombre,  \File::get($file));
    $matricula->url = $nombre;

    $factura = new Factura();

    do {
      $numeroF = mt_rand(1, 99999);
      $strAnoF = strval($candidato->anoAcademico);
      $anoF = substr($strAnoF, -2);
      $codigoFactura = "FT-" . $anoF . $numeroF;
    } while ($this->codigoFacturaExistente($codigoFactura, $candidato->anoAcademico));


    $factura->numFactura = $codigoFactura;
    $factura->tipo = "Matricula";
    $factura->codEst = $candidato->codigo;
    $factura->ano = $candidato->anoAcademico;
    $factura->estado = "Emitida";
    $factura->save();

    $numFactura = $factura->numFactura;

    $matricula->codFactura = $numFactura;
    $matricula->estado = "Emitida";
    $matricula->save();*/

    // $estudante = $candidato;
    // $valorMatricula = 15000; //buscar nos emolumentos

    // $pdf = PDF::loadView('Estudantes.pdfFacturaMatricula', compact("estudante", 'valorMatricula', 'numFactura'));
    // return $pdf->download('facturaCandidatura.pdf');
    // redirect()->route('listarCandidatos',1);
    $estudante = Estudantes::registrarEstudante($candidato);
    $estudante->turma_id = $request->turma;
    $estudante->email = $request->email;

    //imagem perfil
    $file = $request->file('imagenperfil');
    $nombre =  time() . "_" . $file->getClientOriginalName();
    // $img = Image::make($file->path());
    \Storage::disk('imagenperfil')->put($nombre,  \File::get($file));
    $estudante->pathImage = $nombre;

    $estudante->estado = "Activo";


    $curso = Curso::find($estudante->curso_id);
    do {
      $numero = mt_rand(100, 999);
      $strAno = strval($estudante->anoAdmissao);
      $ano = substr($strAno, -2);
      $codigo = $ano . $curso->codigo . $numero;
    } while ($this->codigoExistente($codigo));

    $estudante->codigo = $codigo;
    $estudante->save();

    //inscriçao
    $inscricao = new Inscricao();
    $inscricao->estudante_id = $estudante->id;
    $inscricao->curso_id = $estudante->curso_id;
    $inscricao->anoCurricular = "1º";
    $inscricao->anoAcademico = $estudante->anoAdmissao;
    $inscricao->semestre = "I";
    $inscricao->save();

    $disciplinas = Disciplina::where("curso_id", $estudante->curso_id)->where("ano", "1º")->where("semestre", "I")->get();

    foreach ($disciplinas as  $disciplina) {
      $inscricao->disciplinas()->attach($disciplina);
    }
    $inscricao->save();

    $conta = new Conta();
    $conta->estudante_id = $estudante->id;
    $conta->numero = $estudante->codigo;

    $conta->save();

    $pdf = PDF::loadView('Estudantes.pdf_comp_matricula', compact("inscricao"));

    return $pdf->stream();
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


  public function codigoFacturaExistente($codigo, $ano)
  {
    $factura = Factura::where('numFactura', $codigo)->where('ano', $ano)->first();
    if ($factura != null) {
      return true;
    } else {
      return false;
    }
  }


  public function listarMatriculas()
  {
    $facturas = Factura::where('tipo', 'Matricula')->get();

    $matriculas = Estudante::where('estado', 'Matriculado con factura emitida')->get();

    return view('caixa.matriculas', compact('matriculas', 'facturas'));
  }


  public function estudantesMatriculados(Request $request)
  {
    $cursos = Curso::all();

    //$curso_id=$request->curso;

    //dd($curso_id);
    if (isset($request->curso)) {
      $estudantes = Estudante::where('anoAcademico', 2021)
        ->where('curso_id', $request->curso)->get();
    } else if (!isset($request->curso)) {
      $estudantes = Estudante::where('anoAcademico', 2021)->where('estado', 'Matriculado')->get();
      //$estudantes = Estudante::where('estado', 'Matriculado')->orWhere('estado','Activo')->where('anoAcademico',2021)->get();
    }

    return view('Estudantes.estudantesMatriculados', compact('estudantes', 'cursos'));
  }

  public function mostrarDiscInscricao(Request $request)
  {
    // dd($request->ano);
    $idEst = $request->idEst;

    $ano = $request->ano;
    $sem = $request->sem;
    $anoAcademico = $request->anoAcademico;
    $turmas = "";
    if ($sem == "I") {
      $turmas = Turma::all();
    }

    $estudante = Estudante::where('id', $idEst)->first();

    $disciplinasAtrasso = collect();
    $inscricoes = Inscricao::where('estudante_id', $estudante->id)->get();
    foreach ($inscricoes as $inscricao) {
      foreach ($inscricao->disciplinas as $disciplina) {
        if (\App\Pauta::obterMediaFinal($estudante->id, $disciplina->id, $inscricao->anoAcademico) < 10) {
          // if ($disciplina->pivot->estado == "Reprovado") {
          $disciplinasAtrasso->push($disciplina->pivot->disciplina_id);
        }
      }
    }
    // dd($inscricoes);

    $disciplinas = Disciplina::where('curso_id', $estudante->curso_id)->where('ano', $ano)->where('semestre', $sem)->get();
    return view('Estudantes.fazerInscricao', compact('estudante', 'disciplinas', 'ano', 'sem', 'anoAcademico', 'disciplinasAtrasso', 'turmas'));
  }

  public function fazerInscricao(Request $request)
  {
    $idEst = $request->idEst;
    $ano = $request->ano;
    $sem = $request->sem;
    $anoAcademico = $request->anoAcademico;

    $estudante = Estudante::where('id', $idEst)->first();


    $verificar_insc = Inscricao::where("estudante_id", $estudante->id)->where("anoCurricular", $ano)->where("semestre", $sem)->where("anoAcademico", $anoAcademico)->first();

    if ($verificar_insc != null) {
      return redirect()->route('estudantesMatriculados');
    } else {
      //inscriçao


      $inscricao = new Inscricao();
      $inscricao->estudante_id = $estudante->id;
      $inscricao->curso_id = $estudante->curso_id;
      $inscricao->anoCurricular = $ano;
      $inscricao->anoAcademico = $anoAcademico;
      $inscricao->semestre = $sem;
      $inscricao->save();

      $idDisciplinas = [];
      $idDisciplinas = $request['disciplina'];
      $idDisciplinasAtraso = [];
      $idDisciplinasAtraso = $request['disciplinaAtraso'];

      // dd($estudante,$idEmolumentos);
      $disciplinasInscricao = collect();


      foreach ($idDisciplinas as $idDisc) {
        $disciplina = Disciplina::where('id', $idDisc)->first();
        $inscricao->disciplinas()->attach($disciplina);
        //  $disciplinasInscricao->push($disciplina);
      }
      if ($idDisciplinasAtraso != null) {
        foreach ($idDisciplinasAtraso as $idDisc) {
          $disciplina = Disciplina::where('id', $idDisc)->first();
          $inscricao->disciplinasAtraso()->attach($disciplina);
          //  $disciplinasInscricao->push($disciplina);
        }
      }

      if ($sem == "I") {
        $turma = $request->turmaInsc;
        $estudante->turma_id = $turma;
        $estudante->estado = "Activo";
        $estudante->save();
      }

      $inscricao->save();


      $pdf = PDF::loadView('Estudantes.comp_confirmacao_matricula', compact("inscricao"));
      // return $pdf->download('facturaCandidatura.pdf');
      // redirect()->route('listarCandidatos',1);
      return $pdf->stream();
      //return redirect()->route('estudantesMatriculados');
    }
  }



  public function inscricaoLoad(Request $request)
  {
    //$id= $request->id;
    // $curso=$request->input('curso');
    //$disciplinas = Disciplina::where('curso_id',$request->input('pk'))->where('semestre',1)->where('ano',1)->pluck('nome', 'id'); //->prepend('selecciona');
    //return $disciplinas;
    /*  if ($request->ajax) {
    return response()->json($disciplinas);*/
    //}
    $disciplina = Disciplina::find($request->input('pk'));
    $disciplinas = Disciplina::where('curso_id', $disciplina->curso_id)->pluck('nome', 'id');
    return $disciplinas;
  }

  public function inscricoesPrincipal()
  {
    $estudante = Estudante::where('estado', 'activo')->pluck('nome', 'id'); //->prepend('selecciona');

    //Teste
    // $inscricoes = Inscricao::where('estudante_id', $estudante->id)->get();

    return view('Estudantes.inscricoesPrincipal', compact('estudante'));
  }
  public function inscricoesEstudante(Request $request, $id)
  {
    // $inscricoes=Inscricao::where('estudante_id',$id)->get();
    $resultado = DB::table('inscricaos')
      ->join('estudantes', function ($join) use ($id) {
        $join->on('estudantes.id', '=', 'inscricaos.estudante_id')
          ->where('estudantes.id', $id);
      })->join('cursos', 'cursos.id', '=', 'inscricaos.curso_id')
      ->join('inscricao_disciplina', 'inscricao_disciplina.inscricao_id', '=', 'inscricaos.id')

      //  ->join('fichas', 'fichas.estudante_id', '=', 'estudantes.id')
      ->join('disciplinas', 'disciplinas.id', '=', 'inscricao_disciplina.disciplina_id')
      ->select(
        'estudantes.id',
        'estudantes.codigo',
        'estudantes.nome',
        'estudantes.apelido',
        'estudantes.pathImage',
        'estudantes.curso',
        'estudantes.BI',
        'disciplinas.ano as anoCurricular',
        'disciplinas.semestre',
        'inscricaos.anoAcademico',
        'cursos.nome as nomeCurso',
        'disciplinas.nome as nomeDisciplina',
        'inscricao_disciplina.estado',



      )
      ->groupBy(
        'estudantes.id',
        'estudantes.nome',
        'estudantes.codigo',
        'estudantes.apelido',
        'estudantes.pathImage',
        'estudantes.curso',
        'estudantes.BI',
        'disciplinas.ano',
        'disciplinas.semestre',
        'inscricaos.anoAcademico',
        'cursos.nome',
        'disciplinas.nome',
        'inscricao_disciplina.estado',

      )
      ->get();

    if ($resultado == null) {
      $resultado = Estudante::where('id', $id)->get();
    }

    if ($request->ajax()) {


      return response()->json($resultado);
    }
  }

  public function inscricoesAtrasoEstudante(Request $request, $id)
  {
    // $inscricoes=Inscricao::where('estudante_id',$id)->get();
    $resultado = DB::table('inscricaos')
      ->join('estudantes', function ($join) use ($id) {
        $join->on('estudantes.id', '=', 'inscricaos.estudante_id')
          ->where('estudantes.id', $id);
      })->join('cursos', 'cursos.id', '=', 'inscricaos.curso_id')
      ->join('disciplinasatraso', 'disciplinasatraso.inscricao_id', '=', 'inscricaos.id')
      // ->join('disciplinasatraso', 'disciplinasatraso.inscricao_id', '=', 'inscricaos.id')
      ->join('disciplinas', 'disciplinas.id', '=', 'disciplinasatraso.disciplina_id')
      ->select(
        'estudantes.id',
        'estudantes.codigo',
        'estudantes.nome',
        'estudantes.apelido',
        'estudantes.pathImage',
        'estudantes.curso',
        'estudantes.BI',
        'disciplinas.ano as anoCurricular',
        'disciplinas.semestre',
        'inscricaos.anoAcademico',
        'cursos.nome as nomeCurso',
        'disciplinas.nome as nomeDisciplina',
        'disciplinasatraso.estado'
      )
      ->groupBy(
        'estudantes.id',
        'estudantes.nome',
        'estudantes.codigo',
        'estudantes.apelido',
        'estudantes.pathImage',
        'estudantes.curso',
        'estudantes.BI',
        'disciplinas.ano',
        'disciplinas.semestre',
        'inscricaos.anoAcademico',
        'cursos.nome',
        'disciplinas.nome',
        'disciplinasatraso.estado'
      )
      ->get();

    if ($resultado == null) {
      $resultado = Estudante::where('id', $id)->get();
    }

    if ($request->ajax()) {


      return response()->json($resultado);
    }
  }
  public  function getJsonEstudante(Request $request, $id)
  {
    //$estudante=Estudante::where('id',$id)->get();
    $resultado = DB::table('estudantes')->where('estudantes.id', $id)
      ->join('cursos', 'cursos.id', '=', 'estudantes.curso_id')
      ->join('fichas', 'fichas.estudante_id', '=', 'estudantes.id')
      ->where('estudantes.id', $id)
      ->select(
        'estudantes.id',
        'estudantes.codigo',
        'estudantes.nome',
        'estudantes.apelido',
        'estudantes.pathImage',
        'estudantes.curso',
        'estudantes.BI',
        'cursos.nome as nomeCurso',
        'fichas.anoCurricular as anoCurricular',
        'fichas.semestre as semestre'


      )
      ->groupBy(
        'estudantes.id',
        'estudantes.codigo',
        'estudantes.nome',
        'estudantes.apelido',
        'estudantes.pathImage',
        'estudantes.curso',
        'estudantes.BI',
        'cursos.nome',
        'fichas.anoCurricular',
        'fichas.semestre'
      )->get();

    if ($request->ajax()) {
      return response()->json($resultado);
    }
  }

  public function buscarFicha(Request $request)
  {
    $id = $request->estudanteFicha;
    $listaEstudantes = Estudante::where('estado', 'activo')->pluck('nome', 'id'); //->prepend('selecciona');
    $estudante = null;
    if (isset($id)) {
      $estudante = Estudante::where('id', $id)->first();
    }
    return view('Estudantes.buscarFicha', compact('listaEstudantes', 'estudante'));
  }

  public function mostrarFichaEstudante($email)
  {
    $estudante = Estudante::where('email', $email)->first();

    return view('Estudantes.ficha', compact('estudante'));
  }

  public static function obterDisciplinasAtraso($curso_id)
  {

    $listaEstudantes = Estudante::where('estado', 'activo')->get(); //->where('curso_id',$curso_id)->get();

    $lista = collect();
    foreach ($listaEstudantes as  $estudante) {
      if (count(Estudante::obterDisciplinasAtrasoDadoEstudante($estudante->id)) > 0) {
        $lista->push($estudante);
      }
    }

    $i = 0;
    return view('Estudantes.disciplinas_atraso', compact('lista', 'i'));
  }

  public function pdfFichaEstudante($id)
  {

    $estudante = Estudante::find($id);

    $pdf = PDF::loadView('Estudantes.pdfFichaEstudante', compact('estudante'))->setPaper('a4', 'landscape');


    return $pdf->download('Ficha_estudante.pdf');
  }

  public function relatorios()
  {
    return view('EStudantes.relatorios');
  }

  public  function pdfEstRecEx3()
  {


    // $avals = Avaliacao::where('tipo','Ex2')->orWhere('tipo','Ex3')->get();
    $lista = Estudante::where('estado', 'Activo')->get();
    $estudantes = collect();
    foreach ($lista as $estudante) {
      if (Estudante::listaRecursos($estudante->id) != null || Estudante::listaEx3($estudante->id, "II") != null) {
        $estudantes->push($estudante);
      }
    }



    $pdf = PDF::loadView('Estudantes.pdfEstRecursoExEspecial', compact('estudantes'));


    return $pdf->download('relatorio.pdf');
  }

  public function indexDeclaracao()
  {
    $listaEstudantes = Estudante::where('estado', 'activo')->pluck('nome', 'id'); //->prepend('selecciona');

    return view("Estudantes.indexDeclaracao", compact("listaEstudantes"));
  }
  public function gerarDeclaracao(Request $request)
  {
    $estudante = Estudante::find($request->estudanteDeclaracao);
    $pdf = PDF::loadView('Estudantes.pdfDeclaracao', compact('estudante'));


    return $pdf->download('declaracao.pdf');
  }


  public function exportAproveitamento()
  {
    return Excel::download(new \App\Exports\AproveitamentoExport(), 'Aproveitamento.xlsx');
  }
  public function cartao($id)
  {
    $estudantes = Estudante::where("estado", "Activo")->get();
    $item = Estudante::find($id);
    return view("Estudantes.cartaoTest", compact('item', "estudantes"));
  }

  public function pdfListaDiscAtrasso($curso)
  {
    $estudantes = Estudante::where("estado", "Activo")->where("anoAdmissao", 2020)->where("curso_id", $curso)->get();
    $pdf = PDF::loadView('Estudantes.pdfListaDiscAtrasso', compact("estudantes", "curso"));

    return $pdf->stream();
  }

  public function updateAnoInscricoes(Request $request)
  {
    if ($request->ajax()) {

      $insc = Inscricao::find($request->input('pk'));
      $insc->anoAcademico = $request->input('value');
      $insc->save();
      return response()->json(['success' => true]);
    }
  }

  public function moduloMatriculas()
  {
    return view("Estudantes.moduloMatriculas");
  }

  public function teste()
  {
    $teste = Estudante::find(3)->inscricoes;
    return view("Estudantes.teste", compact("teste"));
  }



  public function pdfPagamentoCartao($id)
  {
    $estudantes = Estudante::where("turma_id", $id)->where("estado", 'Activo')->orderby('nome', 'asc')->get();
    $turma = Turma::where('id', $id)->first();
    $i = 1;
    //  (App\Pagamento::pagamentoMesAno($estudante,3,$ano)
    $pdf = PDF::loadView('Estudantes.pdfPagamentoCartao', compact('estudantes', 'turma', 'i'));

    return $pdf->download('listadoPagamentoCartao.pdf');
  }
}
