<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\TipoUsuario;
use App\Role;

class TiposUsuarios extends Controller
{
    public function __construct()    
    {        
        $this->middleware('auth');    
    }
    
        public function index(){
        	$lista=Role::paginate(5);
    	return view('TiposUsuarios.index',compact('lista'));
    }


        public function inserir(){
    	return view('TiposUsuarios.inserir');
    }


          public function store(Request $request){

     	Role::create(
        [
            'name'=>$request['name'],
            'description'=>$request['description']

    ]);

    	return redirect()->route('listarTiposUsuarios');

    }


           public function editar($id){
         $tipo=Role::where('id',$id)->first();
         
         return view('TiposUsuarios.editar',compact('tipo'));
    }

    public function update(Request $request,$id){
       $tipo=Role::where('id',$id)->first();
      
       $name=$request->name;
       $description=$request->description;
       


       $tipo->name=$name;
       $tipo->description=$description;
    
       $tipo->save();

        return redirect()->route('listarTiposUsuarios');


    }

    public function delete($id){
        $tipo=Role::where('id',$id)->first();
        $tipo->delete();
        return redirect()->route('listarTiposUsuarios');

    }

}
