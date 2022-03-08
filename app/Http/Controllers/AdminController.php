<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estudante;
use App\Departamento;
use App\User;
use App\Pagamento;
use App\Pagamento_tmp;
use App\Funcionario;
use App\Emolumento;
use App\Turma;
use App\Curso;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;



class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public  function index()
    {
        // $est=\App\Estudante::where('estado','activo')->get();
        // $estMasculinos=Estudante::where('estado','activo')->where("genero","Masculino")->count();
        //  $estFemeninos=Estudante::where('estado','activo')->where("genero","Femenino")->count();
        //  $estTrab=Estudante::where('estado','activo')->where("trabalhador",1)->count();



        $departamentos = Departamento::all();
        $usuarios = User::all();
        $funcionarios = Funcionario::all();

        $inscricoes = Pagamento::where(['ano' => 2020, 'mes' => 1])->get();
        $matriculas = Pagamento::where(['ano' => 2020, 'mes' => 2])->get();
        $propinas3 = Pagamento::where(['ano' => 2020, 'mes' => 3])->get();

        $propinas4 = Pagamento::where(['ano' => 2020, 'mes' => 4])->get();
        $propinas5 = Pagamento::where(['ano' => 2020, 'mes' => 5])->get();
        $propinas6 = Pagamento::where(['ano' => 2020, 'mes' => 6])->get();
        $propinas7 = Pagamento::where(['ano' => 2020, 'mes' => 7])->get();
        $propinas8 = Pagamento::where(['ano' => 2020, 'mes' => 8])->get();
        $propinas9 = Pagamento::where(['ano' => 2020, 'mes' => 9])->get();
        $propinas10 = Pagamento::where(['ano' => 2020, 'mes' => 10])->get();
        $propinas11 = Pagamento::where(['ano' => 2020, 'mes' => 11])->get();
        $propinas12 = Pagamento::where(['ano' => 2020, 'mes' => 12])->get();


        $valorInscricao = 0;
        $valorMatricula = 0;
        $valorPropina = 0;

        foreach ($inscricoes as $inscricao) {
            $valorInscricao += $inscricao->valor;
        }


        foreach ($matriculas as $matricula) {
            $valorMatricula += $matricula->valor;
        }
        foreach ($propinas3 as $propina) {
            $valorPropina += $propina->valor;
        }

        foreach ($propinas4 as $propina) {
            $valorPropina += $propina->valor;
        }
        foreach ($propinas5 as $propina) {
            $valorPropina += $propina->valor;
        }
        foreach ($propinas6 as $propina) {
            $valorPropina += $propina->valor;
        }
        foreach ($propinas7 as $propina) {
            $valorPropina += $propina->valor;
        }
        foreach ($propinas8 as $propina) {
            $valorPropina += $propina->valor;
        }
        foreach ($propinas9 as $propina) {
            $valorPropina += $propina->valor;
        }
        foreach ($propinas10 as $propina) {
            $valorPropina += $propina->valor;
        }
        foreach ($propinas11 as $propina) {
            $valorPropina += $propina->valor;
        }
        foreach ($propinas12 as $propina) {
            $valorPropina += $propina->valor;
        }



        // $cantEst=count($est);
        $cantDptos = count($departamentos);
        $cantUsuarios = count($usuarios);
        $cantFuncionarios = count($funcionarios);

        $total = $valorInscricao + $valorMatricula + $valorPropina;
        $estudantesSemDividas = \App\Pagamento::estudanteSemDividas();

        //return view('index',compact('cantEst','cantDptos','cantUsuarios'));
        //       return view('index',compact('cantEst','cantDptos','cantUsuarios','valorInscricao',
        //       'valorMatricula','valorPropina','total','estMasculinos','estFemeninos','estTrab'));

        return view('index', compact(
            'cantDptos',
            'cantUsuarios',
            'valorInscricao',
            'valorMatricula',
            'valorPropina',
            'total',
            'cantFuncionarios',
            'estudantesSemDividas'
        ));
    }

    public function profile()
    {
        return view('Admin.layout.index');
    }
    public function v_test()
    {
        return view('Admin.v_test');
    }
    public function test_react()
    {
        return view('Admin.test_react');
    }
    public function listaPagamentos($id, $anoAcademico)
    {


        return Pagamento::where('estudante_id', $id)->where('emolumento_id', 1)->where('ano', $anoAcademico)->get();
    }

    public function outrosPagamentos($id, $anoAcademico)
    {
        $resultado = DB::table('pagamentos')
            ->join('emolumentos', function ($join) {
                $join->on('pagamentos.emolumento_id', '=', 'emolumentos.id');
            })
            ->join('estudantes', function ($join) {
                $join->on('pagamentos.estudante_id', '=', 'estudantes.id');
            })
            ->where('estudantes.id', "=", $id)
           // ->where('pagamentos.ano', "=", $anoAcademico)
            ->where('pagamentos.emolumento_id', "<>", 1)
            ->select('pagamentos.valor', 'pagamentos.obs', 'pagamentos.descrip','pagamentos.created_at as data', 'emolumentos.nome as nome')
            ->groupBy('pagamentos.valor', 'pagamentos.obs', 'pagamentos.descrip','pagamentos.created_at', 'emolumentos.nome')
            ->get();

        // return Pagamento::where('estudante_id', $id)->where('emolumento_id',"<>", 1)->where('ano', $anoAcademico)->get();
        return $resultado;
    }
    public function listaEstudantes()
    {

        return Estudante::where('estado', 'Activo')->get();
    }
    public function filtrarEstudantes($turma_id)
    {
        return Estudante::where('estado', 'Activo')->where('turma_id', $turma_id)->get();
    }
    public function getEstudante($estudante_id)
    {
        return Estudante::where("id", $estudante_id)->get();
    }
    public function getCurso($curso_id)
    {
        return Curso::where("id", $curso_id)->get();
    }
    public function getTurma($turma_id)
    {
        return Turma::where("id", $turma_id)->first();
    }
    public function getPagamento2($estudante_id, $mes)
    {
        return Pagamento::where("estudante_id", $estudante_id)->where("mes", $mes)->where("ano", 2022)->first();
    }
    public function getTurmas()
    {

        return Turma::all();
    }
    public function filtrarTurmas($curso_id)
    {

        return Turma::where("curso_id", $curso_id)->get();
    }
    public function getCursos()
    {

        return Curso::all();
    }

    public function save_pagamento($id)
    {
        $pagamentosTemp = Pagamento_tmp::where("estudante_id", $id)->get();

        foreach ($pagamentosTemp as $p) {
            $pagamento = new Pagamento();
            $pagamento->estudante_id = $p->estudante_id;
            $pagamento->valor = 25000;
            $pagamento->emolumento_id = 1;
            $pagamento->ano = 2022;
            $pagamento->mes = $p->mes;
            $pagamento->taxa = 0;

            $pagamento->save();
            $p->delete();
        }

        /* $pagamento = new Pagamento();
        $pagamento->estudante_id = $request->estudante_id;
        $pagamento->valor = 25000;
        $pagamento->emolumento_id = 1;
        $pagamento->ano = 2022;
        $pagamento->mes = $request->mes;
        $pagamento->taxa = $request->taxa;

        $pagamento->save();*/

        //return Estudante::where('estado','Activo')->get();
    }
    public function save_pagamentoTemp(Request $request)
    {
        $pagamento = new Pagamento_tmp();
        $pagamento->estudante_id = $request->estudante_id;
        $pagamento->valor = 25000;
        $pagamento->emolumento_id = 1;
        $pagamento->ano = 2022;
        $pagamento->mes = $request->mes;
        $pagamento->taxa = $request->taxa;

        $pagamento->save();

        //return Estudante::where('estado','Activo')->get();
    }

    public function getPagamento($id)
    {
        $pagamento = Pagamento::where("id", $id)->get();
        return $pagamento;
    }
    public function getPagamentosSemFazer($estudante_id, $anoAcademico)
    {
        $pagamentos_resultado = collect();

        $pagamentos = Pagamento::where("estudante_id", $estudante_id)
            ->where("ano", $anoAcademico)->get();



        for ($mes = 1; $mes <= 10; $mes++) {
            $pagamento_semFazer = new Pagamento();

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
    }

    public function gerarComprovativo()
    {
        $item = Pagamento::find(3591);
        $total = $item->valor;
        $totalTaxa = $item->taxa;

        $estudante = Estudante::where('id', $item->estudante_id)->first();
        //$item->cant_recibos++;
        $item->save();
        $pdf = PDF::loadView('pagamentos.pdfReciboSegundaVia2', compact("item", "estudante", "total", "totalTaxa"))->setPaper('a5-R');
        return $pdf->download('comprovativo.pdf');
    }
    public function lista_emolumentos()
    {
        return Emolumento::all();
    }
    public function getEmolumento($id)
    {
        $emolumento = Emolumento::where("id", $id)->first();
    }
}
