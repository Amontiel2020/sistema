<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Consumivel;

class Consumiveis extends Controller
{
    
    public function index(){
        $lista=Consumivel::paginate(10);
    return view('consumiveis.index',compact('lista'));
}

public function inserir(){
    return view('consumiveis.inserir');
}

   public function store(Request $request){

    Consumivel::create(
    [
        'nome'=>$request['nome'],
        'tipo'=>$request['tipo'],
        'stockMin'=>$request['stockMin'],
        'fornecedor'=>$request['fornecedor'],
        'obs'=>$request['obs']
     
    ]

    );

    return redirect()->route('index-consumiveis');

}


public function editar($id){
     $consumivel=Consumivel::where('id',$id)->first();
     
     return view('consumiveis.editar',compact('consumivel'));
}

public function update(Request $request,$id){
   $consumivel=Consumivel::where('id',$id)->first();
  // $estudante->fill($request);
   $nome=$request->nome;
   $tipo=$request['tipo'];
   $stockMin=$request['stockMin'];
   $fornecedor=$request['fornecedor'];
   $obs=$request['obs'];

   $consumivel->nome=$nome;
   $consumivel->tipo=$tipo;
   $consumivel->stockMin=$stockMin;
   $consumivel->fornecedor=$fornecedor;
   $consumivel->obs=$obs;

   $consumivel->save();
    return redirect()->route('index-consumiveis');


}

public function eliminar($id){
    $consumivel=Consumivel::where('id',$id)->first();
    $consumivel->delete();
    return redirect()->route('index-consumiveis');

}

    
}
