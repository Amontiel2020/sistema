<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Horario;
use App\Turma;
use App\Curso;
use App\Event;
use App\Disciplina;

class Horarios extends Controller
{
    public function index()
    {
        $lista = Horario::all();
        return view('horarios.index', compact('lista'));
    }

    public function inserir()
    {
        $turmas = Turma::all();
        $cursos = Curso::all();

        return view("horarios.inserir", compact('turmas', 'cursos'));
    }

    public function save(Request $request)
    {
        $horario = new Horario();
        $horario->turma_id = $request->turma;
        $horario->semestre = $request->semestre;
        $horario->anoAcademico = $request->anoAcademico;

        $horario->save();

        return redirect()->route('horarios');
    }

    public function actividades(Request $request)
    {
        $horario = $request->horario;
        $horarioComp = Horario::find($horario);
        $turma = Turma::where('id', $horarioComp->turma_id)->first();
        $curso_id = $turma->curso_id;

        $unidades = Disciplina::where('curso_id', $curso_id)->where('ano', $turma->anoLectivo)->where('semestre', $horarioComp->semestre)->get();
        if ($request->ajax()) {
            $data = Event::where('horario_id', $horario)
                ->get(['id', 'title', 'start', 'end', 'horario_id']);
            return response()->json($data);
        }
        return view('full-calender', compact('horario', 'unidades'));
        // return view('horarios.actividades');
    }

    public function action(Request $request)
    {

        $disciplina = Disciplina::find($request->unidade);
        if ($request->ajax()) {
            if ($request->type == 'add') {

                $event = Event::create([
                    'title'        =>    $disciplina->nome,
                    'start'        =>    $request->start,
                    'end'        =>    $request->end,
                    'horario_id' =>    $request->horario_id,
                    'unidade' => $request->unidade,
                ]);

                return response()->json($event);
            }

            if ($request->type == 'update') {
                $event = Event::find($request->id)->update([
                    'title'        =>    $request->title,
                    'start'        =>    $request->start,
                    'end'        =>    $request->end
                ]);

                return response()->json($event);
            }

            if ($request->type == 'delete') {
                $event = Event::find($request->id)->delete();

                return response()->json($event);
            }
        }
    }

    public function professores_actividades(Request $request,$id)
    {
       $disciplina=Disciplina::find($id);
         
        if ($request->ajax()) {
            $data = Event::where('unidade', $disciplina->id)
            ->get(['id', 'title', 'start', 'end', 'horario_id']);
           // dd($data);
            return response()->json($data);
        }
       // dd($id);
        return view('calendario_profes',compact('id'));
        // return view('horarios.actividades');
    }
}
