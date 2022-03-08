<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Estudante;
use \App\Pagamento;
use \App\Turma;
use \App\Emolumento;


class PagamentosOld extends Controller
{

  public function __construct()    
    {        
        $this->middleware('auth');    
    }
    public function index(){
    	return view('pagamentos.index');
    }

    public function registrar(Request $request){
    	//Request $request;
    	$idEstudante=$request['idEst'];
    	//$mes2=$request['mes'];
      $ano=$request->ano;

    	$turmas=Turma::all();
    	//$turma="'".$request['turma']."'";
    	$turmaSelecionada=$request['turma'];
    	

     if ($turmaSelecionada==null) {
     	$estudantes=Estudante::all();
     }elseif($turmaSelecionada!=null){
     	$estudantes=Estudante::where('turma_id',$turmaSelecionada)->get();

     }
    	

    	return view('pagamentos.registrar',compact('estudantes','idEstudante','turmas','turmaSelecionada','ano'));
    }

    public function confirmarPagamento(Request $request){
      $estudante= $request['estudante'];	
      $mes=$request['mes'];

     // $mesok="'".$mes."'";
      $emolumento=Emolumento::where('nome','Propinas')->first();

      Pagamento::create(
       [
       	'valor'=>$emolumento->valor,
       	'mes'=>$mes,
       	'ano'=>'2020',
       	'emolumento_id'=>$emolumento->id,
       	'estudante_id'=>$estudante


       ]
      );
      return redirect()->route('registrarPagamento');
  
    }

    public function pagarEmolumento(){
      $estudantes=Estudante::all();
      $emolumentos=Emolumento::all();

      $pagamentos=Pagamento::all();

    	return view('pagamentos.pagarEmolumento',compact('estudantes','emolumentos','pagamentos'));
    }

    public function pagarEmolumentoGeral(Request $request){

       $estudante= $request['estudante']; 
       $mes=$request['mes'];
       $ano=$request['ano'];
       $idEmolumento=$request['emolumento'];
      $emolumento=Emolumento::where('id',$idEmolumento)->first();

      Pagamento::create(
       [
        'valor'=>$emolumento->valor,
        'mes'=>$mes,
        'ano'=>$ano,
        'emolumento_id'=>$emolumento->id,
        'estudante_id'=>$estudante


       ]
      );
      return redirect()->route('pagarEmolumento');
     // return "OK";



    }

}
