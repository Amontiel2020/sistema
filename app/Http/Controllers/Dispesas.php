<?php

namespace App\Http\Controllers;

use  Illuminate\Http\Request;
use  App\DispesaTotal;
use  App\Dispesa;
use  App\Departamento;


class Dispesas extends Controller
{

    public function __construct()    
    {        
        $this->middleware('auth');    
    }
    

    public function distribuirDispesas(Request $request){
    	$dispesaTotal=0;
    	$mes=$request['mes'];
    	$ano=$request['ano'];
       
        $dispesa=DispesaTotal::where(['mes'=>$mes,'ano'=>$ano])->first();

       if (isset($dispesa)) {
        $dispesaTotal=$dispesa->valor;
       }

      // $dispesas=Dispesa::where(['mes'=>$mes,'ano'=>$ano]);
       $dispesas=Dispesa::all();

       


    	return view('dispesas.distribuirDispesas',compact('dispesaTotal','dispesas'));
    }


    public function indexDispesasTotais(){
    	$dispesas=DispesaTotal::all();
    	 return view('Dispesas.indexDispesasTotais',compact('dispesas'));
    }

    public function inserirDispesasTotais(){
    	 return view('Dispesas.inserirDispesasTotais');
    
    }

        public function inserirDispesas(){
            $departamentos=Departamento::all();
         return view('Dispesas.inserirDispesas',compact('departamentos'));
    
    }

    public function storeDispesas(Request $request){

    $dispesaTotal=DispesaTotal::where(['mes'=>$request->mes,'ano'=>$request->ano])->first();
    $valorPermitido=$dispesaTotal->valor-$dispesaTotal->valorDistribuido;


if ($request->valor<=$valorPermitido) {
        $dispesa=Dispesa::create(
        [
            'mes'=>$request['mes'],
            'ano'=>$request['ano'],
            'valor'=>$request['valor'],
            'departamento_id'=>$request['departamento']

            
        ]

        );
     $dispesaTotal->valorDistribuido+=$dispesa->valor;
     $dispesaTotal->save();

}

     


     return redirect()->route('indexTest');

    }

    public function storeDispesasTotais(Request $request){

        DispesaTotal::create(
        [
            'mes'=>$request['mes'],
            'ano'=>$request['ano'],
            'valor'=>$request['valor']

            
        ]

        );

     return redirect()->route('indexTest');

    }

    public function indexTest(){
        $dispesas=DispesaTotal::all();
        $dispesasMensal=Dispesa::all();
        $departamentos=Departamento::all();

        
         return view('dispesas.indexTest',compact('dispesas','dispesasMensal','departamentos'));
    }


    public function updateDispesaDpto($dispesa,$cantidad){
         $dispesa=Dispesa::where('id',$dispesa)->first();

         $dispesaTotal=DispesaTotal::where(['mes'=>$dispesa->mes,'ano'=>$dispesa->ano])->first();
         $valorPermitido=$dispesaTotal->valor-$dispesaTotal->valorDistribuido;

        $valorPedido=$cantidad-$dispesa->valor;
        
        
         if ($valorPedido>0 &&  $valorPedido<=$valorPermitido) {
            $dispesa->valor=$cantidad;
            $dispesaTotal->valorDistribuido+=$valorPedido;
            $dispesa->save();
            $dispesaTotal->save();
         }elseif ($valorPedido<0) {
             $valorSedido=$dispesa->valor-$cantidad;
             $dispesa->valor=$cantidad;
             $dispesaTotal->valorDistribuido-=$valorSedido;
             $dispesa->save();
             $dispesaTotal->save();
         }
         

   
         
         

        // $actualizado='true';

        return redirect()->route('indexTest');
    }

    public function deleteDispesaDpto($id){
        $dispesa =Dispesa::where('id',$id)->first();
        $dispesaTotal=DispesaTotal::where(['mes'=>$dispesa->mes,'ano'=>$dispesa->ano])->first();
        $dispesa->delete();
        $dispesaTotal->valorDistribuido-=$dispesa->valor;
        $dispesaTotal->save();

        return redirect()->route('indexTest');
    }

    public function deleteDispesaTotal($id){
        $dispesaTotal =DispesaTotal::where('id',$id)->first();
        $dispesasMensais=Dispesa::where(['mes'=>$dispesaTotal->mes,'ano'=>$dispesaTotal->ano])->get();
        $dispesaTotal->delete();
        
        foreach ($dispesasMensais as $dispesa) {
            $dispesa->delete();
        }

        return redirect()->route('indexTest');
    }

    public function ordenarDispesaDpto($dpto,$ano='2020'){

        $dispesas=Dispesa::where([
                                   'departamento_id'=>$dpto,
                                   'ano'=>$ano
                                 ])->orderBy('mes', 'asc')->get();

        

    }

    public function editarDispesasTotal($id){
        $dispesa=DispesaTotal::where('id',$id)->first();
        return view('dispesas.editarDispesasTotal',compact('dispesa'));

    }

    public function updateDispesasTotal(Request $request,$id){

            $dispesa=DispesaTotal::where('id',$id)->first();

        $dispesa->mes=$request->mes;
        $dispesa->ano=$request->ano;
        $dispesa->valor=$request->valor;

        $dispesa->save();

        return redirect()->route('indexTest');    

    }  


}
