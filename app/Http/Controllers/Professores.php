<?php

namespace App\Http\Controllers;

use App\Disciplina;
use Illuminate\Http\Request;
use \App\Professor;
use \App\Pauta;
use \App\Turma;

use App\PautaCandidatura;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class Professores extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $nome = $request->buscarpor;

        if ($nome != null) {
            $lista = Professor::where('estado', 'activo')->where('nome', 'LIKE', '%' . $nome . '%')->orderBy('nome', 'Asc')->paginate(10);
        } else {
            $lista = Professor::where('estado', 'activo')->orderBy('nome', 'Asc')->paginate(10);
        }

        return view('professores.index', compact('lista'));
    }

    public function inserir()
    {
        $date = Carbon::now();
        $date = $date->format('20y-m-d');
        return view('professores.inserir', compact('date'));
    }

    public function salvar(Request $request)
    {

        $professor = new Professor();

        $nome = $request->nome;
        $apelidos = $request->apelidos;
        $BI = $request->BI;
        $dataEmissaoBI = $request->dataEmissaoBI;
        $dataValidadeBI = $request->dataValidadeBI;
        $genero = $request->genero;
        //$estado = $request->estado;
        $email = $request->email;
        $categoria = $request->categoria;
        $grauAcademico = $request->grauAcad;
        $tel1 = $request->telefone1;
        $tel2 = $request->telefone2;
        $email = $request->email;
        //$data_inicio_contrato = $request->data_inicio_contrato;
        //$data_fim_contrato = $request->data_fim_contrato;



        $professor->nome = $nome;
        $professor->apelidos = $apelidos;
        $professor->BI = $BI;
        $professor->dataEmissaoBI = $dataEmissaoBI;
        $professor->dataValidadeBI = $dataValidadeBI;
        $professor->genero = $genero;
        $professor->estado = "activo";
        $professor->categoria = $categoria;
        $professor->grauAcademico = $grauAcademico;

        $professor->telefone1 = $tel1;
        $professor->telefone2 = $tel2;
        $professor->email = $email;
        //$professor->inicio_contrato=$data_inicio_contrato;
       // $professor->fim_contrato=$data_fim_contrato;



        $professor->save();

        return redirect()->route('index-professores');
    }

    public function disciplinasProfessores($email)
    {

        // $anoAcademico = "2021";
        $prof = Professor::where('email', $email)->first();
        // dd($prof);
        $disciplinas = Disciplina::where('professor_id', $prof->id)->get();

        $pautas = Pauta::where('professor_id', $prof->id)->get();
        $pautasCandidaturas = PautaCandidatura::where('professor_id', $prof->id)->get();

        $professor_id=$prof->id;
        

        return view('professores.disciplinasProfessores', compact('pautas', 'pautasCandidaturas', "disciplinas",'professor_id'));
    }

    public function examesAdmissao()
    {

        // dd(Auth::user());
        $prof = Professor::where('email', Auth::user()->email)->first();

        $pautasCandidaturas = PautaCandidatura::where('professor_id', $prof->id)->get();

        return view('professores.examesAdmissao', compact('pautasCandidaturas'));
    }

    public function delete($id)
    {
        $prof = Professor::where('id', $id)->first();
        $prof->delete();
        return redirect()->route('index-professores');
    }

    public function obterProfessor(Request $request, $idDisc)
    {
        $disciplina = Disciplina::where('id', $idDisc)->get();
        $professor_id = $disciplina->professor_id;
        $professor = Professor::where('id', $professor_id)->get();
        if ($request->ajax()) {

            return response()->json($professor);
        }
    }

    public function editar($id)
    {
        $date = Carbon::now();
        $date = $date->format('20y-m-d');
        $professor = Professor::find($id);

        return view('professores.editar', compact('professor', 'date'));
    }

    public function actualizar(Request $request)
    {

        $professor = Professor::find($request->id);

        $nome = $request->nome;
        $apelidos = $request->apelidos;
        $BI = $request->BI;
        $dataEmissaoBI = $request->dataEmissaoBI;
        $dataValidadeBI = $request->dataValidadeBI;
        $genero = $request->genero;
        //$estado = $request->estado;
        $email = $request->email;
        $categoria = $request->categoria;
        $grauAcademico = $request->grauAcad;
        $tel1 = $request->telefone1;
        $tel2 = $request->telefone2;
        $email = $request->email;
       // $data_inicio_contrato = $request->data_inicio_contrato;
      //  $data_fim_contrato = $request->data_fim_contrato;

        $professor->nome = $nome;
        $professor->apelidos = $apelidos;
        $professor->BI = $BI;
        $professor->dataEmissaoBI = $dataEmissaoBI;
        $professor->dataValidadeBI = $dataValidadeBI;
        $professor->genero = $genero;
        $professor->estado = "activo";
        $professor->categoria = $categoria;
        $professor->grauAcademico = $grauAcademico;

        $professor->telefone1 = $tel1;
        $professor->telefone2 = $tel2;
        $professor->email = $email;
       // $professor->inicio_contrato=$data_inicio_contrato;
       // $professor->fim_contrato=$data_fim_contrato;


        $professor->save();

        return redirect()->route('index-professores');
    }
    public function obterInscricoes(Request $request)
    {
        $idDisc = $request->idDisc;
        $anoAcademico = $request->anoAcademico;
        $turma = $request->turma;

        if ($turma == null) {
            $turma = "todos";
            $estudantes = \App\Inscricao::getInscricoes($idDisc, $anoAcademico, $turma);
           // dd($estudantes);
        } else {
            $estudantes = \App\Inscricao::getInscricoes($idDisc, $anoAcademico, $turma);
          //  dd($estudantes);
        }
        // $estudantes = \App\Inscricao::getInscricoes($idDisc, $anoAcademico);
        $estudantes = $estudantes->sortBy("nome");
        $disciplina = Disciplina::find($idDisc);
        $turmas = Turma::where("curso_id", $disciplina->curso_id)->get();
        $pautas = Pauta::where('disciplina_id', $idDisc)->where('anoAcademico', $anoAcademico)->get();
        return view('disciplinas.avaliacoes', compact('estudantes', 'idDisc', 'anoAcademico', 'pautas', 'turmas'));
    }
}
