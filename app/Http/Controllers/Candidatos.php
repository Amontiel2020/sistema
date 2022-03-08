<?php

namespace App\Http\Controllers;

use App\AvaliacaoCandidatura;
use Illuminate\Support\Facades\DB;
use App\Curso;
use App\Candidato;
use App\Emolumento;
use App\Turma;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel as Excel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Municipio;
use App\ProcessoCandidatura;
use App\Pagamento;
use App\Provincia;
use App\Factura;




class Candidatos extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $date = Carbon::now();
        $date = $date->format('20y-m-d');
        $cursos = Curso::all();
        //   $pais = DB::table('pais')->pluck('paisNome', 'paisId');
        $provincias = Provincia::all(); //pluck('nome', 'id');
        $municipios = Municipio::all(); //pluck('nome', 'id');


        // dd($provincias);

        $processoActual = ProcessoCandidatura::where('actual', true)->first();

        /*$candidatos=Candidato::all();
        $actual = Carbon::now();
        foreach ($candidatos as $candidato) {
            $dataNac=$candidato->dataNac;
            $edad=$actual->diffForHumans($dataNac, $actual);
          
            $edad2 = (int) filter_var($edad, FILTER_SANITIZE_NUMBER_INT);  
            $candidato->idade=$edad2;
            $candidato->save();
        }*/

      

        return view('candidatos.index', compact('cursos', 'date', 'processoActual', 'provincias', 'municipios'));
    }

    public function listarResultadosProcesso(Request $request, $idProc)
    {
        //dd($request->curso);
        $data_segCh = Carbon::parse("2021-09-16");
       //->whereDate('created_at', '<=', $data_segCh)
        if ($request->curso == null) {
            $candidatos = Candidato::orderBy('nomeCompleto', 'asc')->get();
        }
        if ($request->curso != null) {

            $candidatos = Candidato::where("curso_id", $request->curso)->orderBy('nomeCompleto', 'asc')->get();
        }


        $cursos = Curso::all();

        $nome = $request->nome;
        $idCurso = $request->curso;

        $anoAcademico = $request->ano;

        $curso_id = $request->curso;
        $data_segCh = Carbon::parse("2021-09-16");
        if ($request->curso == null) {
            $candidatos = Candidato::orderBy('nomeCompleto', 'asc')->get();
        }
        if ($request->curso != null) {

            $candidatos = Candidato::where("curso_id", $curso_id)->orderBy('nomeCompleto', 'asc')->get();
            //dd($candidatos);
        }


        // $lista;

        //$lista2;

        /* if (isset($nome)) {
            $candidatos = Candidato::where('nomeCompleto', 'LIKE', '%' . $nome . '%')->where('processo_id', $idProc)->whereDate('created_at', '<=', $data_segCh)->orderBy('nomeCompleto', 'asc')->get();
            // $lista=Estudante::buscarpor($tipo, $buscar)->paginate(10);

        } else if (!isset($nome) && isset($anoAcademico) && isset($idCurso)) {
            if ($idCurso != 0) {
                $candidatos = Candidato::where('curso_id', $idCurso)->where('anoAcademico', $anoAcademico)->where('processo_id', $idProc)->whereDate('created_at', '<=', $data_segCh)->orderBy('nomeCompleto', 'asc')->get();
            } else if ($idCurso == 0) {
                $candidatos = Candidato::where('anoAcademico', $anoAcademico)->whereDate('created_at', '<=', $data_segCh)->orderBy('nomeCompleto', 'asc')->get();
            }
        }*/

        return view('candidatos.listaResultadosProcesso', compact('candidatos', 'cursos', 'idProc'));
    }
    public function listarCandidatos(Request $request, $idProc)
    {


        $candidatos = Candidato::orderBy('nomeCompleto', 'asc')->get();
        $cursos = Curso::all();

        $nome = $request->nome;
        $idCurso = $request->curso;

        $anoAcademico = $request->ano;

        // $lista;

        //$lista2;
        if (isset($nome)) {
            $candidatos = Candidato::where('nomeCompleto', 'LIKE', '%' . $nome . '%')->where('processo_id', $idProc)->where('estado', 'candidato')->orderBy('nomeCompleto', 'asc')->get();
            // $lista=Estudante::buscarpor($tipo, $buscar)->paginate(10);

        } else if (!isset($nome) && isset($anoAcademico) && isset($idCurso)) {
            if ($idCurso != 0) {
                $candidatos = Candidato::where('curso_id', $idCurso)->where('anoAcademico', $anoAcademico)->where('processo_id', $idProc)->where('estado', 'candidato')->orderBy('nomeCompleto', 'asc')->get();
            } else if ($idCurso == 0) {
                $candidatos = Candidato::where('anoAcademico', $anoAcademico)->where('estado', 'candidato')->orderBy('nomeCompleto', 'asc')->get();
            }
        }

        return view('candidatos.listarCandidatos', compact('candidatos', 'cursos', 'idProc'));
    }

    public function listarInscritos(Request $request, $idProc)
    {

        $candidatos = Candidato::where('estado', 'inscrito')->orderBy('nomeCompleto', 'asc')->get();
        $cursos = Curso::all();

        $nome = $request->nome;
        if ($request->curso) {
            $idCurso = $request->curso;
        } else {
            $idCurso = 0;
        }

        $anoAcademico = $request->ano;
        //dd($anoAcademico);
        if ($nome != null) {
            $candidatos = Candidato::where('nomeCompleto', 'LIKE', '%' . $nome . '%')->where('anoAcademico', $anoAcademico)->where('processo_id', $idProc)->where('estado', 'inscrito')->orderBy('nomeCompleto', 'asc')->get();
        }
        if ($idCurso != 0) {
            // dd("entro aqui");
            $candidatos = Candidato::where('curso_id', $idCurso)->where('anoAcademico', $anoAcademico)->where('processo_id', $idProc)->where('estado', 'Inscrito')->orderBy('nomeCompleto', 'asc')->get();
        }

        return view('candidatos.listarInscritos', compact('candidatos', 'cursos', 'idProc', 'idCurso'));
    }

    public function indexMatriculas(Request $request, $idProc)
    {

        // $processoActual=ProcessoCandidatura::find($idProc);
        $proc = ProcessoCandidatura::find($idProc);
        $cursos = Curso::all();
        $curso_id=$request->curso;

        if ($request->curso == null) {
            $candidatos = Candidato::where('processo_id', $idProc)->orderBy('nomeCompleto', 'asc')->get();
        }
        if ($request->curso != null) {
            $candidatos = Candidato::where('processo_id', $idProc)->where("curso_id",$curso_id)->orderBy('nomeCompleto', 'asc')->get();
        }

        return view('candidatos.indexMatriculas', compact('candidatos', 'cursos', 'idProc','curso_id'));
    }
    public function matricular($id, $idProc)
    {
        $date = Carbon::now();
        $date = $date->format('20y-m-d');
        $processoActual = ProcessoCandidatura::find($idProc);
        $provincias = Provincia::all(); //pluck('nome', 'id');
        $municipios = Municipio::all(); //pluck('nome', 'id');


        $cursos = Curso::all();
        $turmas = Turma::all();
        $pais = DB::table('pais')->pluck('paisNome', 'paisId');
        $candidato = Candidato::where('id', $id)->first();
        //$turmas = Turma::where("curso_id", $candidato->curso_id)->where("anoLectivo", 1)->get();


        return view('candidatos.matricular', compact('cursos', 'pais', 'candidato', 'turmas', 'date', 'processoActual', 'provincias', 'municipios', 'turmas'));
    }

    public function store(Request $request)
    {
        $candidato = new Candidato();
        $nomeCompleto = $request->nomeCompleto;
        //$apelido = $request->apelido;
        //$email = $request->email;
        //$turma = $request->turma;
        //$anoAcademi = $request->anoAdmissao;
        $anoAdmissao = $request->anoAdmissao;

        //$curso = $request->curso;
        $cursoId = $request->curso; //cambios curso
        $estado = $request->estado;
        $dataNac = $request->dataNac;
        $BI = $request->BI;
        $dataEmissaoBI = $request->dataEmissaoBI;
        $dataValidadeBI = $request->dataValidadeBI;
        $genero = $request->genero;
        $naturalDe = $request->naturalDe;
        $nacionalidade = $request->nacionalidade;
        $paisOrigem = $request->paisOrigem;
        $nomePai = $request->nomePai;
        $nomeMai = $request->nomeMai;

        // $provRecidencia = $request->provRecidencia;
        $idProv = $request->provRecidencia;
        // $munRecidencia = $request->munRecidencia;
        $idMunicipio = $request->munRecidencia;
        $telefone1 = $request->telefone1;
        $telefone2 = $request->telefone2;
        $telefoneEmergencia = $request->telefoneEmergencia;

        $endereco = $request->endereco;
        $provEndereco = $request->provEndereco;
        $munEndereco = $request->munEndereco;
        $trabalhador = $request->trabalhador;
        $processo_id = $request->processo;


        $candidato->nomeCompleto = $nomeCompleto;
        // $candidato->apelido = $apelido;
        //$estudante->curso = $curso;
        $candidato->curso_id = $cursoId; //cambio curso
        // $candidato->email = $email;
        // $candidato->turma_id = $turma;
        $candidato->anoAcademico = $anoAdmissao;
        //  $candidato->anoAcademico = $anoAcademico;
        $candidato->estado = $estado;
        $candidato->dataNac = $dataNac;
        $candidato->BI = $BI;
        $candidato->dataEmissaoBI = $dataEmissaoBI;
        $candidato->dataValidadeBI = $dataValidadeBI;
        $candidato->genero = $genero;
        $candidato->naturalDe = $naturalDe;
        $candidato->nacionalidade = $nacionalidade;
        $candidato->paisOrigem = $paisOrigem;
        $candidato->nomePai = $nomePai;
        $candidato->nomeMai = $nomeMai;

        //  $candidato->provRecidencia = $provRecidencia;
        $candidato->provincia_id = $idProv;
        //  $candidato->munRecidencia = $munRecidencia;
        $candidato->municipio_id = $idMunicipio;

        $candidato->telefone1 = $telefone1;
        $candidato->telefone2 = $telefone2;
        $candidato->telefoneEmergencia = $telefoneEmergencia;
        $candidato->endereco = $endereco;
        $candidato->provinciaEndereco_id = $provEndereco;
        $candidato->municipioEndereco_id = $munEndereco;

        $candidato->media_linguaP = $request->media_linguaP;
        $candidato->media_mat = $request->media_mat;
        $candidato->media_final = $request->media_linguaP;
        //   $candidato->pathImage = $nombre;
        $candidato->trabalhador = $trabalhador;
        $candidato->processo_id = $processo_id;




        do {
            $numero = mt_rand(1, 9999);
            $strAno = strval($candidato->anoAcademico);
            $ano = substr($strAno, -2);
            $codigo = "CAN" . $ano . $numero;
        } while ($this->codigoExistente($codigo));

        $candidato->codigo = $codigo;

        $candidato->save();

        $documentos = $request->documentos;

        foreach ($documentos as $documento) {
            $candidato->documentos()->attach($documento);
        }
        $candidato->save();

        $contactos = $request->contactos;

        foreach ($contactos as $contacto) {
            $candidato->contactos()->attach($contacto);
        }
        $candidato->save();

        $EmolInscricao = Emolumento::find(27);
        $valorInsc = $EmolInscricao->valor;

        $factura = new Factura();

        do {
            $numeroF = mt_rand(1, 99999);
            $strAnoF = strval($candidato->anoAcademico);
            $anoF = substr($strAnoF, -2);
            $codigoFactura = "FT-" . $anoF . $numeroF;
        } while ($this->codigoFacturaExistente($codigoFactura, $candidato->anoAcademico));


        $factura->numFactura = $codigoFactura;
        $factura->tipo = "Candidatura";
        $factura->codEst = $candidato->codigo;
        $factura->ano = $candidato->anoAcademico;
        $factura->estado = "Emitida";
        $factura->save();
        $numFactura = $factura->numFactura;

        $pdf = PDF::loadView('candidatos.pdfFacturaCandidatura', compact("candidato", 'valorInsc', 'numFactura'));
        // return $pdf->download('facturaCandidatura.pdf');
        // redirect()->route('listarCandidatos',1);
        return $pdf->stream();
        // $pdf->stream("facturaCandidatura.pdf", array("Attachment" => false));

        //  return redirect()->route('listarCandidatos');
    }

    public function codigoExistente($codigo)
    {
        $candidato = Candidato::where('codigo', $codigo)->first();
        if ($candidato != null) {
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

    public function mudarCodigos()
    {
        $candidatos = Candidato::all();

        foreach ($candidatos as $candidato) {
            do {
                $numero = mt_rand(1, 9999);
                $codigo = "CAN" . 2020 . $numero;
            } while ($this->codigoExistente($codigo));

            $candidato->codigo = $codigo;

            $candidato->save();
        }
    }



    public function editar($id, $idProc)
    {
        $date = Carbon::now();
        $date = $date->format('yyyy-mm-dd');

        $cursos = Curso::all();
        // $pais = DB::table('pais')->pluck('paisNome', 'paisId');
        $candidato = Candidato::where('id', $id)->first();
        $processoActual = ProcessoCandidatura::where('id', $idProc)->first();
        $provincias = Provincia::all(); //pluck('nome', 'id');
        $municipios = Municipio::all(); //pluck('nome', 'id');



        return view('candidatos.editar', compact('candidato', 'cursos', 'date', 'idProc', 'processoActual', 'provincias', 'municipios'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $candidato = Candidato::where('id', $id)->first();
        // $estudante->fill($request);

        /*    $file = $request->file('imagenperfil');
      //obtenemos el nombre del archivo
      if ($file != null) {
        $nombre =  time() . "_" . $file->getClientOriginalName();
        File::delete(\Storage::disk('imagenperfil'), $candidato->pathImage); // Delete
        \Storage::disk('imagenperfil')->put($nombre,  \File::get($file));
        $candidato->pathImage = $nombre;
      }*/




        $nomeCompleto = $request->nomeCompleto;
        //$apelido = $request->apelido;
        //$email = $request->email;
        //$turma = $request->turma;
        //$anoAcademi = $request->anoAdmissao;
        $anoAcademico = $request->anoAcademico;
        //dd($anoAcademico);

        //$curso = $request->curso;
        $cursoId = $request->curso; //cambios curso
        $estado = $request->estado;
        $dataNac = $request->dataNac;
        $BI = $request->BI;
        $dataEmissaoBI = $request->dataEmissaoBI;
        $dataValidadeBI = $request->dataValidadeBI;
        $genero = $request->genero;
        $naturalDe = $request->naturalDe;
        $nacionalidade = $request->nacionalidade;
        // $paisOrigem = $request->paisOrigem;
        $nomePai = $request->nomePai;
        $nomeMai = $request->nomeMai;

        $provRecidencia = $request->provRecidencia;
        $munRecidencia = $request->munRecidencia;
        $telefone1 = $request->telefone1;
        $telefone2 = $request->telefone2;
        $telefoneEmergencia = $request->telefoneEmergencia;

        $endereco = $request->endereco;
        $provEndereco = $request->provEndereco;
        $munEndereco = $request->munEndereco;
        $trabalhador = $request->trabalhador;







        $candidato->nomeCompleto = $nomeCompleto;
        // $candidato->apelido = $apelido;
        //$estudante->curso = $curso;
        $candidato->curso_id = $cursoId; //cambio curso
        // $candidato->email = $email;
        // $candidato->turma_id = $turma;
        $candidato->anoAcademico = $anoAcademico;
        //  $candidato->anoAcademico = $anoAcademico;
        $candidato->estado = $estado;
        $candidato->dataNac = $dataNac;
        $candidato->BI = $BI;
        $candidato->dataEmissaoBI = $dataEmissaoBI;
        $candidato->dataValidadeBI = $dataValidadeBI;
        $candidato->genero = $genero;
        $candidato->naturalDe = $naturalDe;
        $candidato->nacionalidade = $nacionalidade;
        //  $candidato->paisOrigem = $paisOrigem;
        $candidato->nomePai = $nomePai;
        $candidato->nomeMai = $nomeMai;

        // $candidato->provRecidencia = $provRecidencia;
        //   $candidato->munRecidencia = $munRecidencia;
        $candidato->provincia_id = $provRecidencia;
        $candidato->municipio_id = $munRecidencia;

        $candidato->telefone1 = $telefone1;
        $candidato->telefone2 = $telefone2;
        $candidato->telefoneEmergencia = $telefoneEmergencia;
        $candidato->endereco = $endereco;
        $candidato->provinciaEndereco_id = $provEndereco;
        $candidato->municipioEndereco_id = $munEndereco;

        //  $candidato->pathImage = $nombre;
        $candidato->trabalhador = $trabalhador;

        $candidato->media_linguaP = $request->media_linguaP;
        $candidato->media_mat = $request->media_mat;
        $candidato->media_final = $request->media_linguaP;

        $candidato->save();

        $documentos = $request->documentos;

        // foreach ($documentos as $documento) {
        $candidato->documentos()->sync($documentos);
        //  }
        $candidato->save();


        // return redirect()->route('listarCandidatos', $request->idProc);
        return redirect()->route('listar_candidatos');
    }

    public function mudarEstadoCandidatos(Request $request)
    {
        // $candidatoSel=$request->mudarEstadoFrente;
        //  dd($candidatoSel);
        $idProc = $request->idProc;
        //  dd($idProc);
        $candidatos = $request->id;
        $max = sizeof($candidatos);
        $estado = $request->mudarEstado;
        for ($i = 0; $i < $max; $i++) {
            $candidato = Candidato::where('id', $candidatos[$i])->first();
            $candidato->estado = $estado;
            $candidato->save();
        }



        return redirect()->route('listarCandidatos', $idProc);
    }

    public function mudarEstadoReprovado($id, $idProc)
    {
        $estado = "Não Admitido";

        $candidato = Candidato::where('id', $id)->first();
        $candidato->estado = $estado;
        $candidato->save();

        return redirect()->route('resultadosProcesso', $idProc);
    }
    public function mudarEstadoAprovado($id, $idProc)
    {
        $estado = "Admitido";
        $candidato = Candidato::where('id', $id)->first();
        $candidato->estado = $estado;
        $candidato->save();

        return redirect()->route('resultadosProcesso', $idProc);
    }

    public function mudarEstadoSegundaChamada($id, $idProc)
    {
        $estado = "Segunda Chamada";
        $candidato = Candidato::where('id', $id)->first();
        $candidato->estado = $estado;
        $candidato->save();

        return redirect()->route('resultadosProcesso', $idProc);
    }
    public function mudarEstadoInscrito($id, $idProc)
    {
        $estado = "Inscrito";
        $candidato = Candidato::where('id', $id)->first();
        $candidato->estado = $estado;
        $candidato->save();

        return redirect()->route('resultadosProcesso', $idProc);
    }

    public function delete(Request $request)
    {
        $idProc = $request->idProc;
        $candidato = Candidato::where('id', $request->id)->first();
        $candidato->delete();
        return redirect()->route('listarCandidatos', $idProc);
    }

    public function resultados()
    {
        $candidatos = Candidato::orderBy('nomeCompleto', 'asc')->get();
        $cursos = Curso::all();


        return view('candidatos.resultados', compact('candidatos', 'cursos'));
    }

    public function pdfListaInscritos($curso_id)
    {

        if ($curso_id == 0) {
            $candidatos = Candidato::where('estado', 'Inscrito')->orderBy('nomeCompleto', 'asc')->get();
        } else {
            $candidatos = Candidato::where('estado', 'Inscrito')->where("curso_id", $curso_id)->orderBy('nomeCompleto', 'asc')->get();
        }


        $pdf = PDF::loadView('candidatos.pdfListaInscritos', compact("candidatos", 'curso_id'));
        return $pdf->stream();
    }
    public function pdfListaInscritosSegCh($curso_id)
    {
        $data_segCh = Carbon::parse("2021-09-16");

        if ($curso_id == 0) {
            $candidatos = Candidato::where('estado', 'Inscrito')->where("created_at", ">=", $data_segCh)->orderBy('nomeCompleto', 'asc')->get();
        } else {
            //$candidatos = Candidato::where('estado', 'Inscrito')->where("curso_id", $curso_id)->where("created_at", ">=", $data_segCh)->orderBy('nomeCompleto', 'asc')->get();
            $candidatos = Candidato::where("curso_id", $curso_id)
            ->where("estado","<>","Admitido")
            ->orderBy("nomeCompleto")->get();
        }


        $pdf = PDF::loadView('candidatos.pdfListaInscritos', compact("candidatos", 'curso_id'));
        return $pdf->stream();
    }

    public function updateLocalExame()
    {
    }
    public function pdfActaExame($curso)
    {
        $candidatos = Candidato::where("curso_id", $curso)->orderBy("nomeCompleto")->get();
        $pdf = PDF::loadView('candidatos.pdfActaExame', compact("candidatos", 'curso'));
        return $pdf->stream();
    }
    public function pdfActaExameSegCh($curso)
    {
        $data_segCh = Carbon::parse("2021-09-16");

        $candidatos = Candidato::where("curso_id", $curso)
        ->where("estado","<>","Admitido")
        ->orderBy("nomeCompleto")->get();
        $pdf = PDF::loadView('candidatos.pdfActaExame', compact("candidatos", 'curso'));
        return $pdf->stream();
    }

    public  function eliminarExameCandidatura($id)
    {

        $aval = AvaliacaoCandidatura::find($id);
        $aval->delete();
    }

    public function listasCandidatos(Request $request)
    {
        $data_segCh = Carbon::parse("2021-09-16");


        $proc = ProcessoCandidatura::where("actual", 1)->first();
        $idProc = $proc->id;

        $cursos = Curso::all();
        $curso_sel = 1;


        if ($request->curso == null) {
            // $curso=1;
            $candidatos = Candidato::where("processo_id", $idProc)->where("created_at", "<=", $data_segCh)->orderBy("nomeCompleto")->get();
        }
        if ($request->curso != null) {
            $curso_sel = $request->curso;

            $candidatos = Candidato::where("curso_id", $request->curso)->where("created_at", "<=", $data_segCh)->orderBy("nomeCompleto")->get();
        }

        return view("candidatos.listas", compact("candidatos", "idProc", "cursos", "curso_sel"));
    }
    public function listasCandidatosPdf($curso)
    {
        $data_segCh = Carbon::parse("2021-09-16");
        $idProc = ProcessoCandidatura::where('actual', true)->first();

        $candidatos = Candidato::where("curso_id", $curso)->orderBy("nomeCompleto")->get();
        $pdf = PDF::loadView('candidatos.lista', compact("candidatos", 'curso', 'idProc'));
        return $pdf->stream();
    }

    public function exportRegistroPrimario()
    {
        return Excel::download(new \App\Exports\RegistroPrimarioExport(), 'RegistroPrimario.xlsx');
    }
}
