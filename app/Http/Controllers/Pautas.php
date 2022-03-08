<?php

namespace App\Http\Controllers;

use App\Disciplina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel as Excel;
use App\Pauta;
use App\Curso;
use App\Turma;
use App\Professor;
use App\Estudante;
use App\Inscricao;


use App\Avaliacao;
use App\Exports\PautaExport;
use Barryvdh\DomPDF\Facade as PDF;


class Pautas extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {

        $turmas = Turma::all();
        // $disciplinas = null;

        //$request->ano;
        //dd($turmaSel);

        /*  if (isset($request->idTurma) && $request->idTurma != "-") {
            $anoAcad = $request->anoAcademico;
            $turmaSel = Turma::where("id", $request->idTurma)->first();
            $pautas = Pauta::where("turma_id", $turmaSel->id)->where('anoAcademico', $anoAcad)->get();
        }else{
            $anoAcad = 2020; 
            $pautas = Pauta::all();
            $turmaSel=null;
        }*/
        $pautas = Pauta::all();
        $disciplinas = Disciplina::all();
        return view('pautas.index', compact('turmas', 'pautas', 'disciplinas'));

        // return view('pautas.index', compact('turmas', 'turmaSel', 'anoAcad', 'pautas'));
    }

    public function inserir()
    {
        $disciplinas = Disciplina::orderBy('nome', 'Asc')->get();
        $cursos = Curso::all();
        $turmas = Turma::all();
        $professores = Professor::all();


        return view('pautas.inserir', compact('disciplinas', 'cursos', 'turmas', 'professores'));
    }

    public function store(Request $request)
    {
        $pauta = new Pauta();
        //  $nome = $request->nome;
        $disciplina_id = $request->disciplina;
        $anoCurricular = $request->anoCurricular;
        $semestre = $request->semestre;
        //$professor_id = $request->professor;
        $turma_id = $request->turma;
        $anoAcademico = $request->anoAcademico;

        $disciplina = Disciplina::find($disciplina_id);
        $turma = Turma::find($turma_id);


        // $pauta->nome = $nome;
        $pauta->disciplina_id = $disciplina_id;
        $pauta->curso_id = $turma->curso_id;
        $pauta->ano = $anoCurricular . "º";
        $pauta->semestre = $semestre;
        $pauta->professor_id = $disciplina->professor_id;
        $pauta->turma_id = $turma_id;
        $pauta->anoAcademico = $anoAcademico;

        $pauta->save();
        // $idPautaGuard=$pauta->id;
        $ids = [];
        $estudantes = Estudante::where('turma_id', $turma->id)->where('estado', 'Activo')->get();

        foreach ($estudantes as $i => $estudante) {
            $pauta->estudantes()->attach($estudante->id);
            $ids[$i + 1] = $estudante->id;
        }

        //$pautaGuard=Pauta::find($idPautaGuard);

        //   $pauta->estudantes()->sync($ids);



        // $pauta->save();

        //Buscar os estudantes com disciplinas em atraso para registrar na primeira pauta encontrada
        $pautasComp = Pauta::where('anoAcademico', $pauta->anoAcademico)->where('disciplina_id', $pauta->disciplina_id)->get();
        if ($pautasComp->count() == 1) {
            $inscricoes = Inscricao::where('anoAcademico', $pauta->anoAcademico)->get();
            if ($inscricoes != null) {

                foreach ($inscricoes as  $inscricao) {
                    if ($inscricao->disciplinasAtraso != null) {
                        foreach ($inscricao->disciplinasAtraso as  $disciplina) {
                            if ($disciplina->pivot->disciplina_id == $pauta->disciplina_id) {
                                $pauta->estudantes()->attach($inscricao->estudante_id);
                            }
                        }
                    }
                }
            }
        }

        $pauta->save();


        return redirect()->route('listaPautas');
    }

    public function mostrarPauta($id)
    {
        $pauta = Pauta::where('id', $id)->first();
        $turma = Turma::where("id", $pauta->turma_id)->first();
        $idDisc = $pauta->disciplina_id;
        $anoAcad = $pauta->anoAcademico;


        // $estudantes = Estudante::where('turma_id', $turma->id)->where("estado", "activo")->get();
        $estudantes = $pauta->estudantes;
        return view('pautas.vista', compact('estudantes', 'idDisc', 'turma', 'anoAcad', 'pauta'));
    }

    public function mostrarPauta2($id)
    {
        $pauta = Pauta::where('id', $id)->first();
        $turma = Turma::where("id", $pauta->turma_id)->first();
        $idDisc = $pauta->disciplina_id;
        $anoAcad = $pauta->anoAcademico;

        // $estudantes = Estudante::where('turma_id', $turma->id)->where("estado", "activo")->get();
        $estudantes = $pauta->estudantes;
        return view('pautas.vista2', compact('estudantes', 'idDisc', 'turma', 'anoAcad', 'pauta'));
    }
    public function showAvaliarDisciplina()
    {
        $lista = [];
        $disciplina = null;
        $disciplinas = Disciplina::all();
        return view("pautas.avaliar", compact('disciplinas', 'lista', 'disciplina'));
    }
    public function avaliarPauta($id)
    {
        $pauta = Pauta::where('id', $id)->first();
        // $disciplina = nuLL;
        $anoAcad = 2020;
        // $lista = [];
        //  $disciplinas = Disciplina::all();
        //   if ($request->disciplina != null) {
        $disciplina = Disciplina::where('id', $pauta->disciplina_id)->first();
        $lista = Estudante::where('turma_id', $pauta->turma_id)->where("estado", 'activo')->get();
        //  }

        return view("pautas.avaliar", compact('lista', 'disciplina', 'anoAcad', 'id'));
    }

    public function avaliarEstudante(Request $request)
    {
        if ($request->F1 != null) {
            $aval =  Avaliacao::where("estudante_id", $request->idEst)->where("disciplina_id", $request->idDisc)
                ->where("anoAcad", $request->anoAcad)->where("tipo", 'F1')->first();

            if ($aval == null) {
                $aval = new Avaliacao();
                $F1 = $request->F1;
                $aval->tipo = "F1";
                $aval->valor = $F1;
                $aval->disciplina_id = $request->idDisc;
                $aval->estudante_id = $request->idEst;
                $aval->anoAcad = $request->anoAcad;
            } elseif ($aval != null) {
                $F1 = $request->F1;
                // $aval->tipo = "F1";
                $aval->valor = $F1;
                //   $aval->disciplina_id =$request->idDisc;
                //  $aval->estudante_id = $request->idEst;
                //  $aval->anoAcad = $request->anoAcad;
            }


            $aval->save();
        }
        /*
        if ($request->F2 != null) {
            $aval =  Avaliacao::where("estudante_id", $request->idEst)->where("disciplina_id", $request->idDisc)
                ->where("anoAcad", $request->anoAcad)->where("tipo", 'F2')->first();

            if ($aval == null) {
                $aval = new Avaliacao();
                $F2 = $request->F2;
                $aval->tipo = "F2";
                $aval->valor = $F2;
                $aval->disciplina_id = $request->idDisc;
                $aval->estudante_id = $request->idEst;
                $aval->anoAcad = $request->anoAcad;
            } elseif ($aval != null) {
                $F2 = $request->F2;
                // $aval->tipo = "F1";
                $aval->valor = $F2;
                //   $aval->disciplina_id =$request->idDisc;
                //  $aval->estudante_id = $request->idEst;
                //  $aval->anoAcad = $request->anoAcad;
            }


            $aval->save();
        }
        if ($request->Ex1 != null) {
            $aval =  Avaliacao::where("estudante_id", $request->idEst)->where("disciplina_id", $request->idDisc)
                ->where("anoAcad", $request->anoAcad)->where("tipo", 'Ex1')->first();

            if ($aval == null) {
                $aval = new Avaliacao();
                $Ex1 = $request->Ex1;
                $aval->tipo = "Ex1";
                $aval->valor = $Ex1;
                $aval->disciplina_id = $request->idDisc;
                $aval->estudante_id = $request->idEst;
                $aval->anoAcad = $request->anoAcad;
            } elseif ($aval != null) {
                $Ex1 = $request->Ex1;
                // $aval->tipo = "F1";
                $aval->valor = $Ex1;
                //   $aval->disciplina_id =$request->idDisc;
                //  $aval->estudante_id = $request->idEst;
                //  $aval->anoAcad = $request->anoAcad;
            }


            $aval->save();
        }

        if ($request->Ex2 != null) {
            $aval =  Avaliacao::where("estudante_id", $request->idEst)->where("disciplina_id", $request->idDisc)
                ->where("anoAcad", $request->anoAcad)->where("tipo", 'Ex2')->first();

            if ($aval == null) {
                $aval = new Avaliacao();
                $Ex2 = $request->Ex2;
                $aval->tipo = "Ex2";
                $aval->valor = $Ex2;
                $aval->disciplina_id = $request->idDisc;
                $aval->estudante_id = $request->idEst;
                $aval->anoAcad = $request->anoAcad;
            } elseif ($aval != null) {
                $Ex2 = $request->Ex2;
                // $aval->tipo = "F1";
                $aval->valor = $Ex2;
                //   $aval->disciplina_id =$request->idDisc;
                //  $aval->estudante_id = $request->idEst;
                //  $aval->anoAcad = $request->anoAcad;
            }


            $aval->save();
        }

        if ($request->Ex3 != null) {
            $aval =  Avaliacao::where("estudante_id", $request->idEst)->where("disciplina_id", $request->idDisc)
                ->where("anoAcad", $request->anoAcad)->where("tipo", 'Ex3')->first();

            if ($aval == null) {
                $aval = new Avaliacao();
                $Ex3 = $request->Ex3;
                $aval->tipo = "Ex3";
                $aval->valor = $Ex3;
                $aval->disciplina_id = $request->idDisc;
                $aval->estudante_id = $request->idEst;
                $aval->anoAcad = $request->anoAcad;
            } elseif ($aval != null) {
                $Ex3 = $request->Ex3;
                // $aval->tipo = "F1";
                $aval->valor = $Ex3;
                //   $aval->disciplina_id =$request->idDisc;
                //  $aval->estudante_id = $request->idEst;
                //  $aval->anoAcad = $request->anoAcad;
            }


            $aval->save();
        }


        if ($request->MAC != null) {

            $aval =  Avaliacao::where("estudante_id", $request->idEst)->where("disciplina_id", $request->idDisc)
                ->where("anoAcad", $request->anoAcad)->where("tipo", 'MAC')->first();

            $aval = new Avaliacao();
            $MAC = $request->MAC;
            $aval->tipo = "MAC";
            $aval->valor = $MAC;
            $aval->disciplina_id = $request->idDisc;
            $aval->estudante_id = $request->idEst;
            $aval->anoAcad = $request->anoAcad;
        } elseif ($aval != null) {
            $MAC = $request->MAC;
            // $aval->tipo = "F1";
            $aval->valor = $MAC;
            //   $aval->disciplina_id =$request->idDisc;
            //  $aval->estudante_id = $request->idEst;
            //  $aval->anoAcad = $request->anoAcad;
        }


        $aval->save();
*/


        $idPauta = $request->idPauta;
        return redirect()->route('avaliarPauta', $idPauta);
    }


    //AVALIAÇÕES

    public function avalF1Update(Request $request)
    {

        if ($request->ajax()) {
            //  $pauta = Pauta::find($request->input('pk'));
            $aval =  Avaliacao::where("estudante_id", $request->input('pk'))->where("disciplina_id", $request->input('name'))
                ->where("anoAcad", \App\CONFIGURACAO::getAnoAcademico())->where("tipo", 'F1')->first();
            $valor = round($request->input('value'), 1, PHP_ROUND_HALF_UP);
            // dd($valor_decimal);

            if ($aval == null) {
                $aval = new Avaliacao();
                $aval->anoAcad = \App\CONFIGURACAO::getAnoAcademico();
                $aval->disciplina_id = $request->input('name');
                $aval->estudante_id = $request->input('pk');
                // $aval->pauta_id = $request->input('pk');
                $aval->valor = $valor;  // $aval->valor = $request->input('value');
                $aval->tipo = "F1";
                $aval->save();
            }
            if ($aval != null) {
                $aval->valor = $valor;   //$aval->valor = $request->input('value');
                $aval->save();
            }

            return response()->json(['success' => true]);
        }
    }
    public function loadAvalF1(Request $request)
    {
        // $pauta = Pauta::find($request->input('pk'));
        $anoAcademico = \App\CONFIGURACAO::getAnoAcademico();
        $disciplina = $request->input('name');
        $estudante_id = $request->input('pk');
        $aval = Avaliacao::where('anoAcad', $anoAcademico)->where('disciplina_id', $disciplina)->where('estudante_id', $estudante_id)->where('tipo', 'F1')->first();
        return $aval;
    }

    ////////////////////////////////////////////////////////////////////////////
    public function avalF2Update(Request $request)
    {

        if ($request->ajax()) {
            //  $pauta = Pauta::find($request->input('pk'));
            $aval =  Avaliacao::where("estudante_id", $request->input('pk'))->where("disciplina_id", $request->input('name'))
                ->where("anoAcad", \App\CONFIGURACAO::getAnoAcademico())->where("tipo", 'F2')->first();
            $valor = round($request->input('value'), 1, PHP_ROUND_HALF_UP);
            if ($aval == null) {
                $aval = new Avaliacao();
                $aval->anoAcad = \App\CONFIGURACAO::getAnoAcademico();
                $aval->disciplina_id = $request->input('name');
                $aval->estudante_id = $request->input('pk');
                // $aval->pauta_id = $request->input('pk');
                $aval->valor = $valor; // $aval->valor = $request->input('value');
                $aval->tipo = "F2";
                $aval->save();
            }
            if ($aval != null) {
                $aval->valor = $valor; //$aval->valor = $request->input('value');
                $aval->save();
            }

            return response()->json(['success' => true]);
        }
    }
    public function loadAvalF2(Request $request)
    {
        // $pauta = Pauta::find($request->input('pk'));
        $anoAcademico = \App\CONFIGURACAO::getAnoAcademico();
        $disciplina = $request->input('name');
        $estudante_id = $request->input('pk');
        $aval = Avaliacao::where('anoAcad', $anoAcademico)->where('disciplina_id', $disciplina)->where('estudante_id', $estudante_id)->where('tipo', 'F2')->first();
        return $aval;
    }

    /////////////////////////////////////////////////////////////////////////////////////

    public function avalMACUpdate(Request $request)
    {

        if ($request->ajax()) {
            //  $pauta = Pauta::find($request->input('pk'));
            $aval =  Avaliacao::where("estudante_id", $request->input('pk'))->where("disciplina_id", $request->input('name'))
                ->where("anoAcad", \App\CONFIGURACAO::getAnoAcademico())->where("tipo", 'MAC')->first();
            $valor = round($request->input('value'), 1, PHP_ROUND_HALF_UP);
            if ($aval == null) {
                $aval = new Avaliacao();
                $aval->anoAcad = \App\CONFIGURACAO::getAnoAcademico();
                $aval->disciplina_id = $request->input('name');
                $aval->estudante_id = $request->input('pk');
                // $aval->pauta_id = $request->input('pk');
                $aval->valor = $valor; //$aval->valor = $request->input('value');
                $aval->tipo = "MAC";
                $aval->save();
            }
            if ($aval != null) {
                $aval->valor = $valor; // $aval->valor = $request->input('value');
                $aval->save();
            }

            return response()->json(['success' => true]);
        }
    }
    public function loadAvalMAC(Request $request)
    {
        // $pauta = Pauta::find($request->input('pk'));
        $anoAcademico = \App\CONFIGURACAO::getAnoAcademico();
        $disciplina = $request->input('name');
        $estudante_id = $request->input('pk');
        $aval = Avaliacao::where('anoAcad', $anoAcademico)->where('disciplina_id', $disciplina)->where('estudante_id', $estudante_id)->where('tipo', 'MAC')->first();
        return $aval;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////

    public function avalEx1Update(Request $request)
    {

        if ($request->ajax()) {
            //  $pauta = Pauta::find($request->input('pk'));
            $aval =  Avaliacao::where("estudante_id", $request->input('pk'))->where("disciplina_id", $request->input('name'))
                ->where("anoAcad", \App\CONFIGURACAO::getAnoAcademico())->where("tipo", 'Ex1')->first();
            //  $inscricao = Inscricao::where('estudante_id', $request->input('pk'))->where("disciplina_id", $request->input('name'))
            //         ->where("anoAcad", \App\CONFIGURACAO::getAnoAcademico())->first();
            $valor = round($request->input('value'), 1, PHP_ROUND_HALF_UP);
            if ($aval == null) {
                $aval = new Avaliacao();
                $aval->anoAcad = \App\CONFIGURACAO::getAnoAcademico();
                $aval->disciplina_id = $request->input('name');
                $aval->estudante_id = $request->input('pk');
                // $aval->pauta_id = $request->input('pk');
                // $valor= floatval($request->input('value'));

                $aval->valor = $valor; // $aval->valor =$request->input('value');
                $aval->tipo = "Ex1";
                $aval->save();
            }
            if ($aval != null) {
                $aval->valor = $valor; // $aval->valor =(float)$request->input('value'); //$request->input('value');
                $aval->save();
            }
            //ACTUALIZAR ESTADO
            //  dd(\App\Pauta::obterMediaFinal($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico()));

            /*       if (round(\App\Pauta::obterMediaFinal($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico(), 0, PHP_ROUND_HALF_UP) >= 10)) {
                $estado = "Aprovado";
                \App\Pauta::actulizarEstado($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico(), $estado);
                /*  foreach ($inscricao->disciplinas as  $disciplina) {
                        if ($disciplina->pivot->disciplina_id == $request->input('name')) {
                            $disciplina->pivot->resultado = "Aprovado";
                        }
                    }*/
            //  $inscricao->disciplinas()->updateExistingPivot($request->input('name'), ['resultado' => 'Aprovado']);
            /*        }
            if (round(\App\Pauta::obterMediaFinal($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico(), 0, PHP_ROUND_HALF_UP) < 10)) {
                $estado = "Reprovado";
                \App\Pauta::actulizarEstado($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico(), $estado);

                /*  foreach ($inscricao->disciplinas as  $disciplina) {
                        if ($disciplina->pivot->disciplina_id == $request->input('name')) {
                            $disciplina->pivot->resultado = "Reprovado";
                        }
                    }*/

            // $inscricao->disciplinas()->updateExistingPivot($request->input('name'), ['resultado' => 'Reprovado']);
            //  }



            return response()->json(['success' => true]);
        }
    }
    public function loadAvalEx1(Request $request)
    {
        // $pauta = Pauta::find($request->input('pk'));
        $anoAcademico = \App\CONFIGURACAO::getAnoAcademico();
        $disciplina = $request->input('name');
        $estudante_id = $request->input('pk');
        $aval = Avaliacao::where('anoAcad', $anoAcademico)->where('disciplina_id', $disciplina)->where('estudante_id', $estudante_id)->where('tipo', 'Ex1')->first();


        /////ACTUALIZAR ESTADO ///////////////////////////////
        /*     if (round(\App\Pauta::obterMediaFinal($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico(), 0, PHP_ROUND_HALF_UP) >= 10)) {
            $estado = "Aprovado";
            \App\Pauta::actulizarEstado($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico(), $estado);
            /*  foreach ($inscricao->disciplinas as  $disciplina) {
                if ($disciplina->pivot->disciplina_id == $request->input('name')) {
                    $disciplina->pivot->resultado = "Aprovado";
                }
            }*/
        //  $inscricao->disciplinas()->updateExistingPivot($request->input('name'), ['resultado' => 'Aprovado']);
        /*    }
        if (round(\App\Pauta::obterMediaFinal($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico(), 0, PHP_ROUND_HALF_UP) < 10)) {
            $estado = "Reprovado";
            \App\Pauta::actulizarEstado($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico(), $estado);

            /*  foreach ($inscricao->disciplinas as  $disciplina) {
                if ($disciplina->pivot->disciplina_id == $request->input('name')) {
                    $disciplina->pivot->resultado = "Reprovado";
                }
            }*/

        // $inscricao->disciplinas()->updateExistingPivot($request->input('name'), ['resultado' => 'Reprovado']);
        //  }


        //////////////////////////////////////////////////////


        return $aval;
    }

    /////////////////////////////////////////////////////////////////////////////////////////

    public function avalEx2Update(Request $request)
    {

        if ($request->ajax()) {
            //  $pauta = Pauta::find($request->input('pk'));
            $aval =  Avaliacao::where("estudante_id", $request->input('pk'))->where("disciplina_id", $request->input('name'))
                ->where("anoAcad", \App\CONFIGURACAO::getAnoAcademico())->where("tipo", 'Ex2')->first();
            /*  $inscricao = Inscricao::where('estudante_id', $request->input('pk'))->where("disciplina_id", $request->input('name'))
                    ->where("anoAcad", \App\CONFIGURACAO::getAnoAcademico())->first();*/
            $valor = round($request->input('value'), 1, PHP_ROUND_HALF_UP);
            if ($aval == null) {
                $aval = new Avaliacao();
                $aval->anoAcad = \App\CONFIGURACAO::getAnoAcademico();
                $aval->disciplina_id = $request->input('name');
                $aval->estudante_id = $request->input('pk');
                // $aval->pauta_id = $request->input('pk');
                $aval->valor = $valor; // $aval->valor = $request->input('value');
                $aval->tipo = "Ex2";
                $aval->save();
            }
            if ($aval != null) {
                $aval->valor = $valor; // $aval->valor = $request->input('value');
                $aval->save();
            }

            /////ACTUALIZAR ESTADO ///////////////////////////////
            if (round(\App\Pauta::obterMediaFinal($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico(), 0, PHP_ROUND_HALF_UP) >= 10)) {
                $estado = "Aprovado";
                \App\Pauta::actulizarEstado($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico(), $estado);
                /*  foreach ($inscricao->disciplinas as  $disciplina) {
                if ($disciplina->pivot->disciplina_id == $request->input('name')) {
                    $disciplina->pivot->resultado = "Aprovado";
                }
            }*/
                //  $inscricao->disciplinas()->updateExistingPivot($request->input('name'), ['resultado' => 'Aprovado']);
            }
            if (round(\App\Pauta::obterMediaFinal($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico(), 0, PHP_ROUND_HALF_UP) < 10)) {
                $estado = "Reprovado";
                \App\Pauta::actulizarEstado($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico(), $estado);

                /*  foreach ($inscricao->disciplinas as  $disciplina) {
                if ($disciplina->pivot->disciplina_id == $request->input('name')) {
                    $disciplina->pivot->resultado = "Reprovado";
                }
            }*/

                // $inscricao->disciplinas()->updateExistingPivot($request->input('name'), ['resultado' => 'Reprovado']);
            }


            //////////////////////////////////////////////////////

            return response()->json(['success' => true]);
        }
    }
    public function loadAvalEx2(Request $request)
    {
        // $pauta = Pauta::find($request->input('pk'));
        $anoAcademico = \App\CONFIGURACAO::getAnoAcademico();
        $disciplina = $request->input('name');
        $estudante_id = $request->input('pk');
        $aval = Avaliacao::where('anoAcad', $anoAcademico)->where('disciplina_id', $disciplina)->where('estudante_id', $estudante_id)->where('tipo', 'Ex2')->first();


        /////ACTUALIZAR ESTADO ///////////////////////////////
        if (round(\App\Pauta::obterMediaFinal($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico(), 0, PHP_ROUND_HALF_UP) >= 10)) {
            $estado = "Aprovado";
            \App\Pauta::actulizarEstado($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico(), $estado);
            /*  foreach ($inscricao->disciplinas as  $disciplina) {
                    if ($disciplina->pivot->disciplina_id == $request->input('name')) {
                        $disciplina->pivot->resultado = "Aprovado";
                    }
                }*/
            //  $inscricao->disciplinas()->updateExistingPivot($request->input('name'), ['resultado' => 'Aprovado']);
        }
        if (round(\App\Pauta::obterMediaFinal($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico(), 0, PHP_ROUND_HALF_UP) < 10)) {
            $estado = "Reprovado";
            \App\Pauta::actulizarEstado($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico(), $estado);

            /*  foreach ($inscricao->disciplinas as  $disciplina) {
                    if ($disciplina->pivot->disciplina_id == $request->input('name')) {
                        $disciplina->pivot->resultado = "Reprovado";
                    }
                }*/

            // $inscricao->disciplinas()->updateExistingPivot($request->input('name'), ['resultado' => 'Reprovado']);
        }


        //////////////////////////////////////////////////////


        return $aval;
    }

    ///////////////////////////////////////////////////////////////////////
    public function avalEx3Update(Request $request)
    {
        // dd($request->input('pk'),$request->input('name'),$request->input('value'));
        if ($request->ajax()) {
            //  $pauta = Pauta::find($request->input('pk'));
            $aval =  Avaliacao::where("estudante_id", $request->input('pk'))->where("disciplina_id", $request->input('name'))
                ->where("anoAcad", \App\CONFIGURACAO::getAnoAcademico())->where("tipo", 'Ex3')->first();
            /* $inscricao = Inscricao::where('estudante_id', $request->input('pk'))->where("disciplina_id", $request->input('name'))
                ->where("anoAcad", \App\CONFIGURACAO::getAnoAcademico())->first();*/
            $valor = round($request->input('value'), 1, PHP_ROUND_HALF_UP);
            if ($aval == null) {
                $aval = new Avaliacao();
                $aval->anoAcad = \App\CONFIGURACAO::getAnoAcademico();
                $aval->disciplina_id = $request->input('name');
                $aval->estudante_id = $request->input('pk');
                // $aval->pauta_id = $request->input('pk');
                $aval->valor = $valor; //$aval->valor = $request->input('value');
                $aval->tipo = "Ex3";
                //    dd($aval);
                $aval->save();
            }
            if ($aval != null) {
                $aval->valor = $valor; // $aval->valor = $request->input('value');
                $aval->save();
            }

            /*     if (\App\Pauta::obterMediaFinal($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico()) >= 10) {
                $estado = "Aprovado";
                \App\Pauta::actulizarEstado($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico(), $estado);

                /*  foreach ($inscricao->disciplinas as  $disciplina) {
                        if ($disciplina->pivot->disciplina_id == $request->input('name')) {
                            $disciplina->pivot->resultado = "Aprovado";
                        }
                    }*/
            //  $inscricao->disciplinas()->updateExistingPivot($request->input('name'), ['resultado' => 'Aprovado']);
            /*   }
            if (\App\Pauta::obterMediaFinal($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico()) < 10) {
                $estado = "Reprovado";
                \App\Pauta::actulizarEstado($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico(), $estado);

                /*  foreach ($inscricao->disciplinas as  $disciplina) {
                        if ($disciplina->pivot->disciplina_id == $request->input('name')) {
                            $disciplina->pivot->resultado = "Reprovado";
                        }
                    }*/

            // $inscricao->disciplinas()->updateExistingPivot($request->input('name'), ['resultado' => 'Reprovado']);
            //  }

            return response()->json(['success' => true]);
        }
    }
    public function loadAvalEx3(Request $request)
    {
        // $pauta = Pauta::find($request->input('pk'));
        $anoAcademico = \App\CONFIGURACAO::getAnoAcademico();
        $disciplina = $request->input('name');
        $estudante_id = $request->input('pk');
        $aval = Avaliacao::where('anoAcad', $anoAcademico)->where('disciplina_id', $disciplina)->where('estudante_id', $estudante_id)->where('tipo', 'Ex3')->first();

        /////ACTUALIZAR ESTADO ///////////////////////////////
        /*     if (round(\App\Pauta::obterMediaFinal($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico(), 0, PHP_ROUND_HALF_UP) >= 10)) {
            $estado = "Aprovado";
            \App\Pauta::actulizarEstado($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico(), $estado);
            /*  foreach ($inscricao->disciplinas as  $disciplina) {
                if ($disciplina->pivot->disciplina_id == $request->input('name')) {
                    $disciplina->pivot->resultado = "Aprovado";
                }
            }*/
        //  $inscricao->disciplinas()->updateExistingPivot($request->input('name'), ['resultado' => 'Aprovado']);
        /*   }
        if (round(\App\Pauta::obterMediaFinal($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico(), 0, PHP_ROUND_HALF_UP) < 10)) {
            $estado = "Reprovado";
            \App\Pauta::actulizarEstado($request->input('pk'), $request->input('name'), \App\CONFIGURACAO::getAnoAcademico(), $estado);

            /*  foreach ($inscricao->disciplinas as  $disciplina) {
                if ($disciplina->pivot->disciplina_id == $request->input('name')) {
                    $disciplina->pivot->resultado = "Reprovado";
                }
            }*/

        // $inscricao->disciplinas()->updateExistingPivot($request->input('name'), ['resultado' => 'Reprovado']);
        //  }


        //////////////////////////////////////////////////////


        return $aval;
    }

    public function publicarPauta($idPauta)
    {
        $pauta = Pauta::find($idPauta);
        $pauta->estado = "publicada";
        $pauta->save();

        return redirect()->route('mostrarPauta', $idPauta);
    }
    public function exportPauta($id)
    {
        return Excel::download(new \App\Exports\PautaExport($id), 'pauta.xlsx');
    }

    public function eliminar($id)
    {
        $pauta = Pauta::find($id);
        $avaliacoes = $pauta->avaliacoes;
        foreach ($avaliacoes as  $aval) {
            $aval->delete();
        }
        $pauta->delete();

        return redirect()->route('listaPautas');
    }

    public function gerarPdfPauta(Request $request)
    {
        $ids = [];
        $ids = $request->ids;
        $idDisc = $request->idDisc;
        // $pauta = Pauta::where('id', $pauta_id)->first();
        //  $turma = Turma::where("id", $pauta->turma_id)->first();
        //  $idDisc = $pauta->disciplina_id;
        $anoAcad = \App\CONFIGURACAO::getAnoAcademico();
        //dd($ids);

        //  $estudantes = Estudante::where('turma_id', $turma->id)->where("estado", "activo")->get();
        $estudantes = collect();

        $estudanteX = null;
        $curso = "";
        $turma = "";
        foreach ($ids as $i => $id) {
            $estudanteX = Estudante::where('id', $id)->first();
            if ($estudanteX != null) {
                $curso = \App\Curso::toString($estudanteX->curso_id);
                $turma = \App\Turma::toString($estudanteX->turma_id);
            }


            $estudante = Estudante::where('id', $id)->first();
            $estudantes->push($estudante);
        }
        $disciplina = Disciplina::find($idDisc);
        $pauta = new Pauta();
        $pauta->disciplina_id = $disciplina->id;
        $pauta->curso_id = $disciplina->curso_id;
        $pauta->ano = $disciplina->ano;
        $pauta->semestre = $disciplina->semestre;
        $pauta->professor_id = $disciplina->professor_id;
        $pauta->anoAcademico = \App\CONFIGURACAO::getAnoAcademico();
        $pauta->save();

        $idDisc = $pauta->disciplina_id;
        $nuclear = $disciplina->nuclear == 1 ? "Nuclear" : "Complementar";
        $i=1;
        //  return view('pautas.pdfPauta', compact('estudantes', 'idDisc', 'anoAcad', 'pauta', 'nuclear', 'curso', 'turma'));

        $pdf = PDF::loadView('pautas.pdfPauta', compact('estudantes', 'idDisc', 'anoAcad', 'pauta', 'nuclear', 'curso', 'turma','i'));

        $name = $pauta->id . "_" . $pauta->disciplina_id . '.pdf';


        $disk = Storage::disk('public');

        $output = $pdf->output();

        $disk->put($name, $output);


        $pauta->url = $disk->path($name);
        $pauta->save();

        return $pdf->download('pauta.pdf');
    }
    public function filtarPorTurma($estudantes, $turma)
    {
        $listaResultado = [];
        foreach ($estudantes as $i => $estudante) {
            if ($estudante->turma_id == $turma) {
                $listaResultado[$i] = $estudante;
            }
        }
        return collect($listaResultado);
    }

    public function aprovadosCurso($curso_id)
    {
        $curso = Curso::find($curso_id);
        $estudantes = Estudante::where("curso_id", $curso_id)->where("estado", "Activo")->where("anoAdmissao", 2020)->get();
        $disciplinas = Disciplina::where("curso_id", $curso_id)->where("ano", "1º")->get();
        $contAprovTodas = 0;
        $contAprovados = 0;
        $contReprovados = 0;
        foreach ($estudantes as  $estudante) {
            $contDiscReprovadas = 0;
            foreach ($disciplinas as $disciplina) {
                $mediaFinal = round(\App\Pauta::obterMediaFinal($estudante->id, $disciplina->id, 2021), 0, PHP_ROUND_HALF_UP);
                if ($mediaFinal < 10) {
                    $contDiscReprovadas++;
                }
            }
            if ($contDiscReprovadas > 0) {
                $contReprovados++;
            } else {
                $contAprovados++;
            }
        }
        return view("pautas.estatistica", compact("curso", "contAprovados", "contReprovados"));
    }
}
