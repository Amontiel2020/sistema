<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Disciplina;
use App\Curso;
use App\Professor;
use App\Turma;
use Illuminate\Support\Facades\DB;





class Disciplinas extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $lista = Disciplina::orderBy('nome', 'Asc')->paginate(200);
        $cursos = Curso::all();
        $nome = $request->nome;
        $curso = $request->curso;
        $ano = $request->ano;


        if ($nome != null) {
            $lista = Disciplina::where('nome','like',"%".$nome."%")->orderBy('nome', 'Asc')->paginate(200);
        }
        if ($curso != null) {
            $lista = Disciplina::where('curso_id',$curso)->orderBy('nome', 'Asc')->paginate(200);
        }
        if ($curso != null && $ano!=null) {
            $lista = Disciplina::where('curso_id',$curso)->where('ano',$ano)->orderBy('nome', 'Asc')->paginate(200);
        }

        return view('disciplinas.index', compact('lista', 'cursos'));
    }

    public function inserir()
    {
        $cursos = Curso::all();
        $professores = Professor::all();
        $disciplinas = Disciplina::orderBy('nome', 'Asc')->get();
        return view('disciplinas.inserir', compact('cursos', 'professores', 'disciplinas'));
    }

    public function store(Request $request)
    {

        $disciplina = new Disciplina();
        $disciplina->nome = $request->nome;
        $disciplina->curso_id = $request->curso;
        $disciplina->ano = $request->ano;
        $disciplina->semestre = $request->semestre;
        $disciplina->nuclear = $request->nuclear;
        //horas
        $disciplina->T = $request->T;
        $disciplina->TP = $request->TP;
        $disciplina->P = $request->P;
        $disciplina->HS = $request->HS;
        $disciplina->HSem = $request->HSem;

        $disciplina->descricao = $request->descricao;
        $disciplina->discPrec_id = $request->disPrec;

        if ($request->professor != "-") {
            $disciplina->professor_id = $request->professor;
        }
        if ($request->precedencia != "-") {
            $disciplina->discPrec_id = $request->precedencia;
        }

        $disciplina->save();


        /* Disciplina::create(
            [
                'nome' => $request['nome'],
                'curso_id' => $request['curso'],
                'ano' => $request['ano'],
                'semestre' => $request['semestre'],
                'descricao' => $request['descricao'],
                'professor_id'=>$request['professor']
            ]

        );*/

        return redirect()->route('listarDisciplinas');
    }


    public function editar($id)
    {
        $disciplina = Disciplina::where('id', $id)->first();
        $cursos = Curso::all();
        $disciplinas = Disciplina::orderBy('nome', 'Asc')->get();
        $professores = Professor::orderBy('nome', 'Asc')->get();


        return view('disciplinas.editar', compact('disciplina', 'disciplinas', 'cursos', 'professores'));
    }

    public function update(Request $request)
    {


        $disciplina = Disciplina::where('id', $request->id)->first();
        // $estudante->fill($request);
        $nome = $request->nome;
        $curso_id = $request->curso;
        $ano = $request->ano;
        $semestre = $request->semestre;
        $nuclear = $request->nuclear;
        $descricao = $request->descricao;

        $disciplina->nome = $nome;
        $disciplina->curso_id = $curso_id;
        $disciplina->ano = $ano;
        $disciplina->semestre = $semestre;
        $disciplina->nuclear = $nuclear;
        //horas
        $disciplina->T = $request->T;
        $disciplina->TP = $request->TP;
        $disciplina->P = $request->P;
        $disciplina->HS = $request->HS;
        $disciplina->HSem = $request->HSem;

        $disciplina->descricao = $descricao;

        if ($request->professor != "-") {
            $disciplina->professor_id = $request->professor;
        }
        if ($request->precedencia != "-") {
            $disciplina->discPrec_id = $request->precedencia;
        }

        $disciplina->save();
        return redirect()->route('listarDisciplinas');
    }

    public function delete($id)
    {
        $disciplina = Disciplina::where('id', $id)->first();
        $disciplina->delete();
        return redirect()->route('listarDisciplinas');
    }
    public function obterDisciplinas(Request $request, $turma, $ano, $sem)
    {
        $anoCurricular = "";
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
                # code...
                break;
        }

        $turmaSel = Turma::find($turma);

        $disciplinas = Disciplina::where("curso_id", $turmaSel->curso_id)->where('ano', $anoCurricular)->where('semestre', $sem)->get();
        if ($request->ajax()) {

            return response()->json($disciplinas);
        }
    }

    public function obterJsonDisciplinasCurso(Request $request, $curso)
    {
        $disciplinas = Disciplina::where('curso_id', $curso)->orderBy('nome', 'Asc')->get();
        if ($request->ajax()) {

            return response()->json($disciplinas);
        }
    }

    public function presedenciaUpdate(Request $request)
    {
        if ($request->ajax()) {
            $disciplina = Disciplina::find($request->input('pk'));
            $disciplina->discPrec_id = $request->input('value');
            //  dd($request->input('value'));

            $disciplina->save();

            return response()->json(['success' => true]);
        }
    }


    public function presedenciaLoad(Request $request)
    {
        $disciplinas = Disciplina::pluck('nome', 'id'); //->prepend('selecciona');
        // dd($request->input('pk'));

        $disciplinas = Disciplina::select(
            DB::raw("CONCAT(nome,' ',curso_id) AS nome2"),
            'id'
        )->orderBy('nome', 'asc')
            // ->where('estado','activo')
            ->pluck('nome2', 'id');
        return $disciplinas;
    }

    public function eliminar_precedencia($id)
    {

        $disciplina = Disciplina::find($id);
        $disciplina->discPrec_id = null;
        $disciplina->save();
        return redirect()->route('listarDisciplinas');
    }

    public function disciplinasSemestre($semestre, $anoAcademico)
    {
        // $disciplinas=Disciplina::where('')
    }
}
