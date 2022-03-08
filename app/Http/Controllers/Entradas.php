<?php

namespace App\Http\Controllers;

use App\Consumivel;
use Illuminate\Http\Request;
use \App\Entrada;

class Entradas extends Controller
{
    public function index(){
        $lista=Entrada::paginate(10);
    return view('entradas.index',compact('lista'));
}

public function inserir(){
    $consumiveis=Consumivel::all();
    return view('entradas.inserir',compact('consumiveis'));
}

   public function store(Request $request){
//dd($request['consumivel']);
  $entrada=  Entrada::create(
    [
        'consumivel_id'=>$request['consumivel'],
        'precoUnitario'=>$request['precoUnitario'],
        'qtd'=>$request['qtd'],
        'factura'=>$request['factura'],
        'fornecedor'=>$request['fornecedor']
       
    ]

    );
    $entrada->created_at=$request['data'];
    $entrada->save();

    return redirect()->route('listarEntradas');

}


public function editar($id){
    $consumiveis=Consumivel::all();
     $entrada=Entrada::where('id',$id)->first();
     
     return view('entradas.editar',compact('entrada','consumiveis'));
}

public function update(Request $request,$id){
   $entrada=Entrada::where('id',$id)->first();
  // $estudante->fill($request);
   $consumivel=$request->consumivel;
   $precoUnitario=$request['precoUnitario'];
   $qtd=$request['qtd'];
   $factura=$request['factura'];
   $fornecedor=$request['fornecedor'];
   $data=$request['data'];


   $entrada->consumivel_id=$consumivel;
   $entrada->precoUnitario=$precoUnitario;
   $entrada->qtd=$qtd;
   $entrada->factura=$factura;
   $entrada->fornecedor=$fornecedor;
   $entrada->created_at=$data;



   $entrada->save();
    return redirect()->route('listarEntradas');


}

public function eliminar($id){
    $entrada=Entrada::where('id',$id)->first();
    $entrada->delete();
    return redirect()->route('listarEntradas');

}

}
