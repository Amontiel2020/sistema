<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Departamento;

class Departamentos extends Controller
{

    public function __construct()    
    {        
        $this->middleware('auth');    
    }

    
    public function index(){
        	$lista=Departamento::paginate(5);
    	return view('Departamentos.index',compact('lista'));
    }

    public function inserir(){
    	return view('Departamentos.inserir');
    }

       public function store(Request $request){

    	Departamento::create(
        [
        	'identificador'=>$request['identificador']
        	
        ]

    	);

    	return redirect()->route('listarDepartamentos');

    }


    public function editar($id){
         $departamento=Departamento::where('id',$id)->first();
         
         return view('Departamentos.editar',compact('departamento'));
    }

    public function update(Request $request,$id){
       $departamento=Departamento::where('id',$id)->first();
      // $estudante->fill($request);
       $identificador=$request->identificador;
       


       $departamento->identificador=$identificador;
       $departamento->save();
        return redirect()->route('listarDepartamentos');


    }

    public function delete($id){
        $departamento=Departamento::where('id',$id)->first();
        $departamento->delete();
        return redirect()->route('listarDepartamentos');

    }




}
