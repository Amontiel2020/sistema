<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Sumario;
use \App\Professor;

use Carbon\Carbon;



class Sumarios extends Controller
{

    public function registrar_sumario($prof_id,$disc_id)
    {

        return view('sumarios.inserir',compact('prof_id','disc_id'));
    }
    public function save(Request $request)
    {

        $sumario = new Sumario();
        $dataActual = Carbon::now();

        $sumario->titulo = $request->titulo;
        $sumario->resumo = $request->resumo;
        $sumario->professor_id = $request->professor_id;
        $sumario->disciplina_id = $request->disciplina_id;
        $sumario->data = $dataActual;

        

        $sumario->save();
        $professor=Professor::find($request->professor_id);
        $email=$professor->email;

        return redirect()->route('disciplinas-professores',$email);

    }
}
