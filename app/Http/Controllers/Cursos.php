<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Curso;
use \App\Seccao;

use Illuminate\Support\Facades\DB;


class Cursos extends Controller
{

  public function matriculadosPorCurso()
  {

    $cursos = Curso::all();
    $mes = 3;
    $curso = 4;

    $test = DB::table('pagamentos')
      ->join('estudantes', function ($join) {
        $join->on('estudantes.id', '=', 'pagamentos.estudante_id')
          //   ->where('estudantes.id', $id)
          ->where('estudantes.estado', 'Activo')
          ->where('estudantes.curso_id', 1)
          ->where('pagamentos.emolumento_id', 1)
          ->where('pagamentos.mes', 3);
        // ->where('pagamentos.ano', $ano);
      })
      ->select('estudantes.id', 'estudantes.nome', 'estudantes.pathImage', 'pagamentos.mes', 'pagamentos.valor', 'estudantes.curso')
      ->groupBy('estudantes.id', 'estudantes.nome', 'estudantes.pathImage', 'pagamentos.mes', 'pagamentos.valor', 'estudantes.curso')
      ->get();


    return view('cursos.matriculados', compact('cursos', 'test'));
  }

  public function listarCursos()
  {
    $cursos = Curso::orderBy('nome', 'Asc')->get();
    return view('cursos.listarCursos', compact('cursos'));
  }

  public function addCurso()
  {
    $seccoes = Seccao::all();
    return view('cursos.addCurso', compact('seccoes'));
  }

  public function store(Request $request)
  {
    $curso = new Curso();
    $curso->nome = $request->nome;
    $curso->codigo = $request->codigo;
    $curso->duracao = $request->duracao;
    $curso->seccao_id = $request->seccao;
    $curso->save();

    return redirect()->route('listarCursos');
  }

  public function eliminar($id)
  {
    $curso = Curso::find($id);
    $curso->delete();
    return redirect()->route('listarCursos');
  }
  public function obterCurso(Request $request, $id)
  {
    $curso = Curso::where('id', $id)->get();

    if ($request->ajax()) {

      return response()->json($curso);
    }
  }

  public function editar($id)
  {
    $curso = Curso::find($id);
    $seccoes = Seccao::all();

    return view('cursos.editar', compact('curso','seccoes'));
  }

  public function actualizar(Request $request)
  {
    $curso = Curso::find($request->id);
    $curso->nome = $request->nome;
    $curso->codigo = $request->codigo;
    $curso->duracao = $request->duracao;
    $curso->seccao_id = $request->seccao;
    $curso->save();

    return redirect()->route('listarCursos');
  }
}
