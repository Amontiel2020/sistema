<?php

namespace App\Http\Controllers;

use App\AvaliacaoCandidatura;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProcessoCandidatura;
use App\Curso;
use App\ExameCandidatura;
use App\PautaCandidatura;
use App\Professor;
use App\Candidato;
use App\DocumentoCandidatura;
use App\Municipio;
use App\Estudante;
use App\Pagamento;
use App\Emolumento;
use App\Contacto;
use Illuminate\Support\Facades\Mail;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use Prophecy\Promise\PromiseInterface;

class ProcessosCandidaturas extends Controller
{
    public function listar($id)
    {
        $item = $id;
        $exames = ExameCandidatura::where('processo_id', $id)->get();
        $cursos = Curso::all();
        $professores = Professor::all();
        return view('processosCandidaturas.listar', compact('item', 'exames', 'cursos', 'professores'));
    }
    /*  public function listar($id)
    {
        $item = ProcessoCandidatura::find($id);
        $professores = Professor::all();
        $documentos = DocumentoCandidatura::all();
        $cursos = Curso::all();
        $EmolInscricao = Emolumento::find(27);
        $valorInsc = $EmolInscricao->valor;

        $jsonProfessores = json_encode($professores);

        return view('processosCandidaturas.listar', compact('item', 'cursos', 'professores', 'documentos', 'valorInsc', 'jsonProfessores'));
    }*/
    public function listar_todos()
    {
        $processos = ProcessoCandidatura::all();

        return view('processosCandidaturas.listar_todos', compact('processos'));
    }
    public function inserir()
    {
        return view('processosCandidaturas.inserir');
    }
    public function store(Request $request)
    {
        $processo = new ProcessoCandidatura();

        $processo->nome = $request->nome;
        $processo->ano = $request->ano;
        if ($request->corte != null) {
            $processo->valorDeCorte = $request->corte;
        }
        if ($request->descricao != null) {
            $processo->descricao = $request->descricao;
        }
        $processo->save();

        return redirect()->route('listar_todos');
    }
    public function eliminar($id)
    {
        $proc = ProcessoCandidatura::find($id);
        $proc->candidatos()->delete();
        $proc->cursos()->delete();
        $proc->exames()->delete();
        $proc->pautas()->delete();
        $proc->documentos()->delete();

        return redirect()->route('listar_todos');
    }

    public function addCurso($idProc, $idCurso)
    {
        $processos = ProcessoCandidatura::all();
        $processo = ProcessoCandidatura::find($idProc);
        $processo->cursos()->attach($idCurso);
        $processo->save();

        return redirect('listarProcessosCandidaturas')->with('processos');
    }

    public function deleteCurso($idProc, $idCurso)
    {
        $processos = ProcessoCandidatura::all();
        $processo = ProcessoCandidatura::find($idProc);
        $processo->cursos()->detach($idCurso);
        $processo->save();

        return redirect('listarProcessosCandidaturas')->with('processos');
    }

    public function addCursoToExame(Request $request)
    {
        $processos = ProcessoCandidatura::all();
        $idExame = $request->exame_id;
        $idCurso = $request->curso_id;
        $idProf = $request->professorExame;

        $exame = ExameCandidatura::find($idExame);
        $exame->cursos()->attach($idCurso, ['professor_id' => $idProf]);
        $exame->save();
        //  $message = "Hola esta es la mensagem";
        //  Mail::send('emails.aviso', ['key' => 'value'], function ($message) {
        //   $message->to('adan.montiel@gmail.com', 'ESPB')->subject('Aviso de Pauta!');
        //  });

        return redirect('listarProcessosCandidaturas')->with('processos');
    }

    public function deleteCursoToExame($idExame, $idCurso)
    {
        $processos = ProcessoCandidatura::all();
        $exame = ExameCandidatura::find($idExame);
        $exame->cursos()->detach($idCurso);
        $exame->save();

        return redirect('listarProcessosCandidaturas')->with('processos');
    }

    public function criarPautaExameCandidatura($idProc, $idExame, $idProf, $idCurso)
    {
        $processos = ProcessoCandidatura::all();
        $pautaCandidatura = new PautaCandidatura();
        $pautaCandidatura->processo_id = $idProc;
        $pautaCandidatura->professor_id = $idProf;
        $pautaCandidatura->exame_id = $idExame;
        $pautaCandidatura->curso_id = $idCurso;

        $pautaCandidatura->save();

        return redirect('listarProcessosCandidaturas')->with('processos');
    }

    public function listarPauta($processo_id, $exame_id, $curso_id)
    {
        //  $pauta = PautaCandidatura::where('processo_id', $idProc)->where('exame_id', $idExame)->where('curso_id', $idCurso)->first();
        $exame = ExameCandidatura::find($exame_id);
        $prof = $exame->professor_id;
       // $data_segCh = Carbon::parse("2021-09-16");
        $candidatos = Candidato::where('processo_id', $processo_id)->where('curso_id', $curso_id)->orderBy("nomeCompleto")->get();
        //  dd($candidatos);
        return view('processosCandidaturas.pautaCandidatura', compact('processo_id', 'exame_id', 'curso_id', 'prof', 'candidatos', 'exame'));
    }

    public function avaliarCandidato(Request $request)
    {
        //   $pautaEnviar = PautaCandidatura::find($request->pauta);

        //  $candidatos = Candidato::where('processo_id', $request->proc)->where('curso_id', $request->curso)->get();

        $aval = new AvaliacaoCandidatura();
        $valor = $request->valor;
        $processo = $request->proc;
        $exame = $request->exame;
        $candidato = $request->candidato;
        //  $cand = Candidato::find($candidato);

        $pauta = $request->pauta;
        // $registro = DB::table('exame_curso')->where('exame_id', $exame)->where('curso_id', $cand->curso_id)->first();
        //  $peso = $registro->peso;

        $aval->processo_id = $processo;
        $aval->exame_id = $exame;
        // $aval->processo_id = $processo;
        $aval->candidato_id = $candidato;
        $aval->pauta_id = $pauta;
        $aval->valor = $valor;
        //  $aval->peso = $peso;


        $aval->save();

        return redirect('listarPautaExameCandidatura' . "/" . $processo . "/" . $exame . "/" . $request->curso); //->with('pautaEnviar')->with('candidatos');

    }
    public function addExameToProcesso(Request $request)
    {
        // $processos = ProcessoCandidatura::all();

        $processo = ProcessoCandidatura::find($request->id);
        $exame = new ExameCandidatura();
        $exame->nome = $request->nome;
        $exame->processo_id = $request->id;
        $exame->curso_id = $request->curso;
        $exame->professor_id = $request->professor;

        $exame->save();

        return redirect()->route('listarProcessosCandidaturas', $request->id);
    }

    public function definirValorInscricao(Request $request)
    {
        $idProc = $request->processo_id;
        $idCurso = $request->curso_id;
        $valorInsc = $request->valorInsc;


        $processos = ProcessoCandidatura::all();
        $processo = ProcessoCandidatura::find($idProc);
        // $processo->cursos()->where('curso_id',$idCurso);
        $processo->cursos()->updateExistingPivot($idCurso, ['valor_inscricao' => $valorInsc]);


        return redirect('listarProcessosCandidaturas')->with('processos');
    }

    public function editarPeso(Request $request)
    {

        if ($request->ajax()) {
            // ExameCandidatura::find($request->input('pk'))->update([$request->input('name') => $request->input('value')]);
            // $exame = ExameCandidatura::find($request->input('pk'));
            $somaPesos = 0;


            $peso = $request->input('value');

            $registrosCurso = DB::table('curso_exame')->where('exame_id', '<>', $request->input('pk'))->where('curso_id', $request->input('name'))->get();
            foreach ($registrosCurso as  $registro) {
                $somaPesos += $registro->peso;
            }

            if (($somaPesos + $peso) > 100) {
                return response()->json(['success' => false]);
            } else {
                //  $exame->cursos()->updateExistingPivot($request->input('curso_id'), ['peso' => $request->input('value')])
                DB::table('curso_exame')->where('exame_id', $request->input('pk'))->where('curso_id', $request->input('name'))->update(['peso' => $request->input('value')]);

                return response()->json(['success' => true]);
            }
        }

        // return redirect('listarProcessosCandidaturas')->with('processos');
    }


    public function addDocumentoToProcesso($idDoc, $idProc)
    {
        $processos = ProcessoCandidatura::all();
        $processo = ProcessoCandidatura::find($idProc);
        $processo->documentos()->attach($idDoc);
        $processo->save();

        return redirect('listarProcessosCandidaturas')->with('processos');
    }

    public function deleteDocumentoToProcesso($idDoc, $idProc)
    {
        $processos = ProcessoCandidatura::all();
        $processo = ProcessoCandidatura::find($idProc);
        $processo->documentos()->detach($idDoc);
        $processo->save();

        return redirect('listarProcessosCandidaturas')->with('processos');
    }

    public function addDocumento(Request $request)
    {
        $processos = ProcessoCandidatura::all();
        $nome = $request->nome;
        $doc = new DocumentoCandidatura();
        $doc->nome = $nome;
        $doc->save();

        return redirect('listarProcessosCandidaturas')->with('processos');
    }

    public function actualizarResultados($idProc)
    {
        $processos = ProcessoCandidatura::all();
        $processo = ProcessoCandidatura::find($idProc);


        $candidatos = Candidato::where('processo_id', $idProc)->get();
        $valorCorte = $processo->valorDeCorte;
        foreach ($candidatos as $candidato) {
            $media = $candidato->obterMedia($idProc, $candidato->id);
            if ($media != -1 && $media > $valorCorte) {
                $candidato->estado = "Aprovado";
            } else if ($media != -1 && $media < $valorCorte) {
                $candidato->estado = "Reprovado";
            }
            $candidato->save();
        }

        return redirect()->route('resultadosProcesso', $idProc);
    }

    public function obterMunicipios(Request $request, $idProv)
    {
        $municipios = Municipio::where('provincia_id', $idProv)->get();
        if ($request->ajax()) {

            return response()->json($municipios);
        }
    }
    /*  public function obterMunicipios2(Request $request, $idProv)
    {
        $municipios = Municipio::where('provincia_id', $idProv)->get();
        if ($request->ajax()) {

            return response()->json($municipios);
        }
    }*/
    public function editarDocumento($idDoc)
    {
        $documento = DocumentoCandidatura::find($idDoc);
        $documentos = DocumentoCandidatura::all();

        return view('processosCandidaturas.editarDocumento', compact('documento', 'documentos'));
    }

    public function  updateDocumento(Request $request)
    {
        $processos = ProcessoCandidatura::all();

        $id = $request->id;

        $documento = DocumentoCandidatura::find($id);

        $documento->nome = $request->nome;
        $documento->save();

        return redirect('listarProcessosCandidaturas')->with('processos');
    }
    public function updateDoc(Request $request)
    {
        if ($request->ajax()) {
            DocumentoCandidatura::find($request->input('pk'))->update([$request->input('name') => $request->input('value')]);
            return response()->json(['success' => true]);
        }
    }
    public function checkEmail(Request $request)
    {
        $email = $request->email;
        $isExists = Estudante::where('email', $email)->first();
        if ($isExists) {
            return response()->json(array("exists" => true));
        } else {
            return response()->json(array("exists" => false));
        }
    }

    /*   public function definirCorte(Request $request)
    {
        $idProc=$request->processo_id;
        $valorCorte=$request->valorCorte;

        $processos = ProcessoCandidatura::all();
        $processo = ProcessoCandidatura::find($idProc);
        $processo->valorDeCorte=$valorCorte;
        $processo->save();

        return redirect('listarProcessosCandidaturas')->with('processos');
    }*/
    public function definirCorte(Request $request)
    {
        if ($request->ajax()) {
            ProcessoCandidatura::find($request->input('pk'))->update([$request->input('name') => $request->input('value')]);
            return response()->json(['success' => true]);
        }
    }
    public function editarExame(Request $request)
    {
        if ($request->ajax()) {
            ExameCandidatura::find($request->input('pk'))->update([$request->input('name') => $request->input('value')]);
            return response()->json(['success' => true]);
        }
    }

    public function loadProfessores(Request $request)
    {
        $professores = Professor::pluck('nome', 'id'); //->prepend('selecciona');
        return $professores;
        /* if ($request->ajax) {
        return response()->json($professores);
    }*/
    }
    public function loadExames(Request $request)
    {
        $exames = ExameCandidatura::pluck('nome', 'id'); //->prepend('selecciona');
        return $exames;
        /* if ($request->ajax) {
        return response()->json($professores);
    }*/
    }

    public function updateProfessores(Request $request)
    {
        //   id curso --name
        //   pk- id exame
        //professor -- value
        if ($request->ajax()) {

            $idExame = $request->input('pk');
            $idCurso = $request->input('name');
            $idProf = $request->input('value');
            $professor = Professor::find($idProf);
            $curso = Curso::find($idCurso);
            // $exame = ExameCandidatura::find($idExame);
            $curso->ExamesCandidaturas()->updateExistingPivot($idExame, ['professor_id' => $idProf]);
            $pauta = PautaCandidatura::where('exame_id', $idExame)->where('curso_id', $idCurso)->first();

            if ($pauta != null) {
                $pauta->professor_id = $professor->id;
                $pauta->save();
            }

            $curso->save();


            return response()->json(['success' => true]);
        }
    }

    public function cursoExameUpdate(Request $request)
    {
        //   id curso --name
        //   pk- id exame
        //professor -- value
        if ($request->ajax()) {

            $idExame = $request->input('value');
            $idCurso = $request->input('pk');


            $curso = Curso::find($idCurso);
            $curso->ExamesCandidaturas()->attach($idExame);

            $curso->save();


            return response()->json(['success' => true]);
        }
    }
    public function avalUpdate(Request $request)
    {
        //   id curso --name
        //   pk- id exame
        //professor -- value
        if ($request->ajax()) {
            // $pauta = PautaCandidatura::find($request->input('pk'));

            $exame = ExameCandidatura::find($request->input('pk'));
            $candidato_id = $request->input('name');
            $processo_id = $exame->processo_id;
            $aval = AvaliacaoCandidatura::where('processo_id', $processo_id)->where('exame_id', $exame->id)->where('candidato_id', $candidato_id)->first();

            if ($aval == null) {
                $aval = new AvaliacaoCandidatura();
                $aval->processo_id = $processo_id;
                $aval->exame_id = $exame->id;
                $aval->candidato_id = $candidato_id;
                // $aval->pauta_id = $request->input('pk');
                $aval->valor = $request->input('value');

                $aval->save();
            }
            if ($aval != null) {
                $aval->valor = $request->input('value');
                $aval->save();
            }



            return response()->json(['success' => true]);
        }
    }
    public function loadAval(Request $request)
    {
        // $pauta = PautaCandidatura::find($request->input('pk'));
        $exame = ExameCandidatura::find($request->input('pk'));
        $proc = $exame->processo_id;
        $candidato_id = $request->input('name');

        $aval = AvaliacaoCandidatura::where('processo_id', $proc)->where('exame_id', $exame->id)->where('candidato_id', $candidato_id)->first();

        return $aval;
    }

    public function listar_candidatos(Request $request)
    {
        $id = $request->processo_id;
        if ($id == null) {
            $candidatos = Candidato::all();
        } else if ($id != null) {
            $candidatos = Candidato::where('processo_id', $id)->get();
        }
        $processos = ProcessoCandidatura::all();

        return view('processosCandidaturas.lista_candidatos', compact('candidatos', 'processos'));
    }

    public  function candidaturas2021()
    {
        $date = Carbon::now();
        $cursos = Curso::all();
        /* $candidatos = Candidato::withCount(['contactos','contactos as cant_redes'=>function($query){
            $query->where('nome','Redes Sociais');
        }])
        ->get();*/
        $redes = 0;
        $radio = 0;
        $tv = 0;
        $autocarro = 0;
        $visita = 0;
        $outdoors = 0;
        $mensagem = 0;
        $candidatos = Candidato::all();
        $candidatosHoje = Candidato::whereDate('created_at', '=', Carbon::today())->count();
        $total_candidatos = $candidatos->count();
        $data_segCh = Carbon::parse("2021-09-16");
        $total_candidatosSegCh = Candidato::whereDate('created_at', '>=', $data_segCh)->count();


        foreach ($candidatos as $candidato) {
            foreach ($candidato->contactos as $contacto) {
                if ($contacto->nome == "Redes Sociais") {
                    $redes++;
                }
                if ($contacto->nome == "Radios") {
                    $radio++;
                }
                if ($contacto->nome == "TV") {
                    $tv++;
                }
                if ($contacto->nome == "Autocarro") {
                    $autocarro++;
                }
                if ($contacto->nome == "Visita para escolas") {
                    $visita++;
                }
                if ($contacto->nome == "Outdoors") {
                    $outdoors++;
                }
                if ($contacto->nome == "Mensagem verbal") {
                    $mensagem++;
                }
            }
        }



        return view('processosCandidaturas.candidaturas2021', compact(
            'candidatos',
            'cursos',
            'redes',
            'radio',
            'tv',
            'autocarro',
            'visita',
            'outdoors',
            'mensagem',
            'total_candidatos',
            'candidatosHoje',
            'total_candidatosSegCh'
        ));
    }
    function eliminarExame($exame_id)
    {
        $exame = ExameCandidatura::find($exame_id);
        $proc = $exame->processo_id;
        $avals = AvaliacaoCandidatura::where('exame_id', $exame_id)->get();

        foreach ($avals as $aval) {
            $aval->delete();
        }
        $exame->delete();
        return redirect('listarProcessosCandidaturas/' . $proc);
    }

    public  function matriculas2021()
    {
        $cursos = Curso::all();
        $total_matriculados = Pagamento::where("emolumento_id", 13)->orWhere("emolumento_id", 14)->count();
        $total_novasMatriculas = Pagamento::where("emolumento_id", 14)->count();
        $total_confirmacao = Pagamento::where("emolumento_id", 13)->count();






        return view('processosCandidaturas.matriculas2021', compact("cursos", "total_matriculados", "total_novasMatriculas", "total_confirmacao"));
    }
}
