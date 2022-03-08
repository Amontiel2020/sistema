<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Turma;
use \App\Estudante;
use \App\Curso;
use \App\Sala;



class Turmas extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $lista = Turma::paginate(20);
        return view('Turmas.index', compact('lista'));
    }

    public function getEstudantes(Request $request, $id)
    {
        if ($request->ajax()) {
            $estudantes = Estudante::estudantes($id);
            return response()->json($estudantes);
        }
    }

    public function inserir()
    {
        $cursos = Curso::all();
        $salas=Sala::all();
        return view('Turmas.inserir', compact('cursos','salas'));
    }

    public function store(Request $request)
    {

        Turma::create(
            [
                'identificador' => $request['identificador'],
                'curso_id' => $request['curso'],
                'periodo' => $request['periodo'],
                'anoLectivo' => $request['anoLectivo'],
                'anoAcademico' => $request['anoAcademico']



            ]

        );
        return redirect()->route('listarTurmas');
    }

    public function editar($id)
    {
        $turma = Turma::where('id', $id)->first();
        $cursos = Curso::all();

        return view('Turmas.editar', compact('turma', 'cursos'));
    }

    public function update(Request $request, $id)
    {
        $turma = Turma::where('id', $id)->first();
        // $estudante->fill($request);
        $identificador = $request->identificador;
        $curso = $request->curso;
        $periodo = $request->periodo;
        $anoLectivo = $request->anoLectivo;
        $anoAcademico = $request->anoAcademico;



        $turma->identificador = $identificador;
        $turma->curso_id = $curso;
        $turma->periodo = $periodo;
        $turma->anoLectivo = $anoLectivo;
        $turma->anoAcademico = $anoAcademico;



        $turma->save();
        return redirect()->route('listarTurmas');
    }

    public function delete($id)
    {
        $turma = Turma::where('id', $id)->first();
        $turma->delete();
        return redirect()->route('listarTurmas');
    }

    public function estudantesTurmas()
    {
        $turmas = Turma::all();
        return view('Turmas.estudantes-turmas', compact('turmas'));
    }

}
