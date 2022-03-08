<?php

namespace App\Http\Controllers;

use App\Consumivel;
use Illuminate\Http\Request;
use \App\Saida;

class Saidas extends Controller
{
    public function index(){
        $lista=Saida::paginate(10);
    return view('saidas.index',compact('lista'));
}

public function inserir(){
    $consumiveis=Consumivel::all();
    return view('saidas.inserir',compact('consumiveis'));
}

   public function store(Request $request){
//dd($request['consumivel']);
  $saida=  Saida::create(
    [
        'consumivel_id'=>$request['consumivel'],
        'qtd'=>$request['qtd'],
        'destinatario'=>$request['destinatario'],
        'responsavel'=>$request['responsavel'],
        'obs'=>$request['obs']

       
    ]

    );
    $saida->created_at=$request['data'];
    $saida->save();

    return redirect()->route('listarSaidas');

}


public function editar($id){
    $consumiveis=Consumivel::all();
     $saida=Saida::where('id',$id)->first();
     
     return view('saidas.editar',compact('saida','consumiveis'));
}

public function update(Request $request,$id){
   $saida=Saida::where('id',$id)->first();
  // $estudante->fill($request);
   $consumivel=$request->consumivel;
   $qtd=$request['qtd'];
   $destinatario=$request['destinatario'];
   $responsavel=$request['responsavel'];
   $obs=$request['obs'];
   $data=$request['data'];


   $saida->consumivel_id=$consumivel;
   $saida->qtd=$qtd;
   $saida->destinatario=$destinatario;
   $saida->responsavel=$responsavel;
   $saida->obs=$obs;
   $saida->created_at=$data;

   $saida->save();
    return redirect()->route('listarSaidas');


}

public function eliminar($id){
    $saida=Saida::where('id',$id)->first();
    $saida->delete();
    return redirect()->route('listarSaidas');

}

}

