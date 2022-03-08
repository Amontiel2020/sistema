<?php
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Accept,charset,boundary,Content-Length');
header('Access-Control-Allow-Origin: *');

use App\Avaliacao;
use App\Inscricao;
use App\Estudante;
use App\Disciplina;

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
/*Route::options('/{path}', function() {
    return response('', 200)
        ->header(
          'Access-Control-Allow-Headers', 
          'Origin, Content-Type, Content-Range, Content-Disposition, Content-Description, X-Auth-Token, X-Requested-With')
        ->header('Access-Control-Allow-Methods', 'POST, GET, PUT, OPTIONS, DELETE')
        ->header('Access-Control-Allow-Origin','*')
        ->header('Access-Control-Allow-Credentials',' true');
  })->where('path', '.*');*/

Route::get('/ejemplo', function () {

    return \App\Estudante::where('estado', 'activo')->get();
});

Route::get('/curso/{id}', function ($id) {

    return \App\Curso::where('id', $id)->first();
});
//PAgamentos do estudante 
Route::get('/pagamentos/{id}', function ($id) {

    return \App\Pagamento::where('estudante_id', $id)->get();
});



//getEstudante
Route::get('/getEstudante/{estudante_id}', function ($estudante_id) {

    return \App\Estudante::where("id", $estudante_id)->first();
});



Route::get('/getJsonPagamentosTemp2/{id}', function ($estudante_id) {

    return \App\Pagamento_tmp::where('estudante_id', $estudante_id)->get();
});





/*Route::get('/getJsonPagamentosTemp2/{id}', function ($id) {

    return \App\Pagamento::where("id", $id)->get();
});*/


Route::get('/save_pagamentoTemp', function (Request $request) {

    $pagamento = new \App\Pagamento_tmp();
    $pagamento->designacao = "Propinas";
    $pagamento->estudante_id = $request->estudante_id;
    $pagamento->valor = 25000;
    $pagamento->emolumento_id = 1;
    $pagamento->ano = 2022;
    $pagamento->mes = $request->mes;
    $pagamento->taxa = 0;

    $pagamento->save();
});


Route::get('/gerarComprovativo', function () {
    $item = \App\Pagamento::find(3591);
    $total = $item->valor;
    $totalTaxa = $item->taxa;

    $estudante = \App\Estudante::where('id', $item->estudante_id)->first();
    //$item->cant_recibos++;
    $item->save();
    // $pdf = PDF::loadView('pagamentos.pdfReciboSegundaVia2', compact("item", "estudante", "total", "totalTaxa"))->setPaper('a5-R');
    // return $pdf->download('comprovativo.pdf');
});


Route::get('/getPagamentosSemFazer/{estudante_id}/{anoAcademico}', function ($estudante_id, $anoAcademico) {
    $pagamentos_resultado = collect();

    $pagamentos = \App\Pagamento::where("estudante_id", $estudante_id)
        ->where("ano", $anoAcademico)->get();



    for ($mes = 1; $mes <= 10; $mes++) {
        $pagamento_semFazer = new \App\Pagamento();

        $pagamento_semFazer->estudante_id = (int)$estudante_id;
        $pagamento_semFazer->ano = "2022";
        $pagamento_semFazer->valor = null;
        $pagamento_semFazer->mes = (string)$mes;
        $pagamento = $pagamentos->firstWhere("mes", $mes);
        // $pagamento_semFazer->id=$pagamento->id;
        if ($pagamento != null) {
            $pagamentos_resultado->push($pagamento);
        } else {
            $pagamentos_resultado->push($pagamento_semFazer);
        }
    }
    return $pagamentos_resultado->toJson();
});




Route::get('/outrosPagamentos/{id}/{anoAcademico}', function ($id, $anoAcademico) {
    $resultado = Illuminate\Support\Facades\DB::table('pagamentos')
        ->join('emolumentos', function ($join) {
            $join->on('pagamentos.emolumento_id', '=', 'emolumentos.id');
        })
        ->join('estudantes', function ($join) {
            $join->on('pagamentos.estudante_id', '=', 'estudantes.id');
        })
        ->where('estudantes.id', "=", $id)
        // ->where('pagamentos.ano', "=", $anoAcademico)
        ->where('pagamentos.emolumento_id', "<>", 1)
        ->select('pagamentos.valor', 'pagamentos.obs', 'pagamentos.descrip', 'pagamentos.created_at as data', 'emolumentos.nome as nome')
        ->groupBy('pagamentos.valor', 'pagamentos.obs', 'pagamentos.descrip', 'pagamentos.created_at', 'emolumentos.nome')
        ->get();

    // return Pagamento::where('estudante_id', $id)->where('emolumento_id',"<>", 1)->where('ano', $anoAcademico)->get();
    return $resultado;
});




Route::get('/pagamentos_react/{id}', function ($id) {
    return \App\Pagamento::where('estudante_id', $id)->where('emolumento_id', 1)->get();
});




Route::get('/getCursos', function () {
    return \App\Curso::all();
});




Route::get('/filtrarEstudantes/{turma_id}', function ($turma_id) {
    return \App\Estudante::where('estado', 'Activo')->where('turma_id', $turma_id)->get();
});




Route::get('/filtrarTurmas/{curso_id}', function ($curso_id) {
    return \App\Turma::where("curso_id", $curso_id)->get();
});




Route::get('/getTurmas', function () {
    return \App\Turma::all();
});



Route::get('/estudantes_react', function () {
    // return \App\Estudante::where('estado', 'Activo')->get();
    $resultado = Illuminate\Support\Facades\DB::table('estudantes')
        ->join('cursos', function ($join) {
            $join->on('estudantes.curso_id', '=', 'cursos.id');
        })

        ->where('estudantes.estado', 'Activo')
        ->select(
            'estudantes.id',
            'estudantes.nome',
            'estudantes.BI',
            'estudantes.codigo',
            'estudantes.pathImage',
            'cursos.nome as curso',

        )
        ->groupBy(
            'estudantes.id',
            'estudantes.nome',
            'estudantes.BI',
            'estudantes.codigo',
            'estudantes.pathImage',
            'cursos.nome',

        )
        ->get();

    return $resultado;
});



Route::get('/buscar_estudantes/{buscar}', function ($buscar) {

    //return \App\Estudante::where('estado', 'Activo')->where('nome','LIKE', '%' . $buscar . '%')->get();

    $resultado = Illuminate\Support\Facades\DB::table('estudantes')
        ->join('cursos', function ($join) {
            $join->on('estudantes.curso_id', '=', 'cursos.id');
        })
        ->where('estudantes.estado', 'Activo')
        ->where('estudantes.nome', 'LIKE', '%' . $buscar . '%')

        ->select('estudantes.id', 'estudantes.nome', 'estudantes.BI', 'estudantes.codigo', 'estudantes.pathImage', 'cursos.nome as curso')
        ->groupBy('estudantes.id', 'estudantes.nome', 'estudantes.BI', 'estudantes.codigo', 'estudantes.pathImage', 'cursos.nome')
        ->get();

    return $resultado;
});



Route::get('/updatePagamentoTemp/{id}/{taxa}', function ($id, $taxa) {
    $valor = $id->get("id");
    $pag = \App\Pagamento_tmp::find($valor);
    $pag->taxa = $taxa;

    $pag->save();
});



Route::get('/eliminarPagamentoTemp/{id}', function ($id) {
    $pag = \App\Pagamento_tmp::find($id);
    $pag->delete();
});




Route::get('/save_pagamento/{id}', function ($id) {
    $pagamentosTemp = \App\Pagamento_tmp::where("estudante_id", $id)->get();

    foreach ($pagamentosTemp as $p) {
        $pagamento = new \App\Pagamento();
        $pagamento->estudante_id = $p->estudante_id;
        $pagamento->valor = 25000;
        $pagamento->emolumento_id = 1;
        $pagamento->ano = 2022;
        $pagamento->mes = $p->mes;
        $pagamento->taxa = 0;

        $pagamento->save();
        $p->delete();
    }
});




Route::get('/getCurso/{curso_id}', function ($curso_id) {
    return \App\Curso::where("id", $curso_id)->get();
});




Route::get('getTurma/{turma_id}', function ($turma_id) {
    return \App\Turma::where("id", $turma_id)->first();
});



Route::get('/getEmolumento/{id}', function ($id) {
    return \App\Emolumento::where("id", $id)->first();
});



Route::get('/getPagamento/{estudante_id}/{mes}', function ($estudante_id, $mes) {
    return \App\Pagamento::where("estudante_id", $estudante_id)->where("mes", $mes)->where("ano", 2022)->first();
});



Route::get('/getPagamentosSemFazer/{estudante_id}', function ($estudante_id, $anoAcademico) {
    $pagamentos_resultado = collect();

    $pagamentos = \App\Pagamento::where("estudante_id", $estudante_id)
        ->where("ano", $anoAcademico)->get();



    for ($mes = 1; $mes <= 10; $mes++) {
        $pagamento_semFazer = new \App\Pagamento();

        $pagamento_semFazer->estudante_id = (int)$estudante_id;
        $pagamento_semFazer->ano = "2022";
        $pagamento_semFazer->valor = null;
        $pagamento_semFazer->mes = (string)$mes;
        $pagamento = $pagamentos->firstWhere("mes", $mes);
        // $pagamento_semFazer->id=$pagamento->id;
        if ($pagamento != null) {
            $pagamentos_resultado->push($pagamento);
        } else {
            $pagamentos_resultado->push($pagamento_semFazer);
        }
    }
    return $pagamentos_resultado->toJson();
});




Route::get('/lista_emolumentos', function () {
    return \App\Emolumento::all();
});

Route::get('/getPagamentos/{anoAcademico}', function ($anoAcademico) {
    return \App\Pagamento::where("emolumento_id", 1)->where("ano", $anoAcademico)->get();
});
Route::post('/registrarLivro', 'Livros@create');
/*Route::post('/registrarLivro', function (Request $request) {
    \App\Livro::create([
        'titulo' => $request->titulo,
        'autor' => $request->autor
    ]);

    $response['message'] = "Guardado exitosamente";
    $response['success'] = true;
    return $response;
});*/


//Route::get('/emolumentos', 'Emolumentos@getEmolumentos')->name('getEmolumentos');
Route::get('/emolumentos', function () {
    return \App\Emolumento::all();
});
Route::get('/emolumento/{id}', function ($id) {
    return \App\Emolumento::where("id", $id)->first();
});



Route::get('/getInscricoes/{idEstudante}', function ($idEstudante) {
    return \App\Inscricao::where("estudante_id", $idEstudante)->get();
});

Route::get('/getDiscInscricao/{idInscricao}', function ($idInscricao) {
    $inscricao = Inscricao::find($idInscricao);
    return $inscricao->disciplinas;
    // return  Illuminate\Support\Facades\DB::table('inscricao_disciplina')->where('inscricao_id', $idInscricao)->get();
});
Route::get('/getDiscParaInscricao/{idInscricao}', function ($idInscricao) {
    $inscricao = Inscricao::find($idInscricao);
    $disciplinas = Disciplina::where("curso_id", $inscricao->curso_id)
        ->where("ano", $inscricao->anoCurricular)
        ->where("semestre", $inscricao->semestre)->get();

    return $disciplinas;
    // return  Illuminate\Support\Facades\DB::table('inscricao_disciplina')->where('inscricao_id', $idInscricao)->get();
});

Route::get('/deleteInscricao/{idInscricao}/{estudanteSel}', function ($idInscricao, $estudanteSel) {
    $inscricao = Inscricao::find($idInscricao);
    // $estudante=Estudante::find($estudanteSel);

    $disciplinasInsc = $inscricao->disciplinas;

    foreach ($inscricao->disciplinas as $disciplina) {

        $avals = Avaliacao::where("estudante_id", $estudanteSel)->where("disciplina_id", $disciplina->id)->get();
        foreach ($avals as $aval) {
            $aval->delete();
        }
        $inscricoesDisc = Illuminate\Support\Facades\DB::table('inscricao_disciplina')->where('inscricao_id', $idInscricao)->delete();
        //dd($inscricoesDisc);
        /* foreach ($inscricoesDisc as $inscDisc) {
         $inscDisc->delete();
      }*/
    }
    $inscricao->delete();
    // return  Illuminate\Support\Facades\DB::table('inscricao_disciplina')->where('inscricao_id', $idInscricao)->get();
});

Route::post('/addInscricao', function (Request $request) {
    $estudante = Estudante::find($request->estudante_id);
    //inscriçao
    $inscricao = new Inscricao();
    $inscricao->estudante_id = $estudante->id;
    $inscricao->curso_id = $estudante->curso_id;
    $inscricao->anoCurricular = $request->anoCurricular;
    $inscricao->anoAcademico = $request->anoAcad;
    $inscricao->semestre = $request->sem;
    $inscricao->save();

    // $disciplinas = Disciplina::where("curso_id", $estudante->curso_id)->where("ano", "1º")->where("semestre", "I")->get();

    /* foreach ($disciplinas as  $disciplina) {
       $inscricao->disciplinas()->attach($disciplina);
     }*/
    $inscricao->save();
});


Route::post('/addDisciplinasInscricao', function (Request $request) {
   // dd($request->inscricao_id);
    $inscricao = Inscricao::find($request->inscricao);
    //dd($request->inscricao);
    $disciplinas = $request->listaDisciplinas;
    $arrayDisc=explode(",",$disciplinas);
   
    // $disciplinas = Disciplina::where("curso_id", $estudante->curso_id)->where("ano", "1º")->where("semestre", "I")->get();
    $tam = sizeof($arrayDisc);
    for ($i = 0; $i < $tam; $i++) {
        $disc = Disciplina::find($arrayDisc[$i]);
        $inscricao->disciplinas()->attach($disc);
    }
    $inscricao->save();
});

Route::get('/lista_estudantes', function () {
 $estudantes=Estudante::pluck("id","nome");
 return $estudantes;
 });
