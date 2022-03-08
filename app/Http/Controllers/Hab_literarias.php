<?php

namespace App\Http\Controllers;

use App\Funcionario;
use App\Hab_literaria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Hab_literarias extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $lista = Hab_literaria::all();
        return view('hab_literarias.index', compact('lista'));
    }


    public function inserir()
    {
        return view('hab_literarias.inserir');
    }

    public function store(Request $request)
    {

        Hab_literaria::create(
            [
                'nome' => $request['nome'],
                'descricao' => $request['descricao']


            ]
        );

        return redirect()->route('index_hab_literarias');
    }

    public function editar($id)
    {
        $hab = Hab_literaria::where('id', $id)->first();

        return view('hab_literarias.editar', compact('hab'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $hab = Hab_literaria::where('id', $id)->first();

        $nome = $request->nome;
        $descricao = $request->descricao;

        $hab->nome = $nome;
        $hab->descricao = $descricao;

        $hab->save();
        return redirect()->route('index_hab_literarias');
    }

    public function eliminar($id)
    {
        $hab = Hab_literaria::where('id', $id)->first();
        $hab->delete();
        return redirect()->route('index_hab_literarias');
    }

    public function add_hab_literaria($idFunc,$idHab){
        $funcionario=Funcionario::find($idFunc);
        $funcionario->hab_literarias()->attach($idHab);
        $funcionario->save();

        return redirect()->route('editar_funcionario',$funcionario->id);
      
    }
    
    public function eliminar_hab_literaria($idFunc,$idHab){
        $funcionario=Funcionario::find($idFunc);
        $funcionario->hab_literarias()->detach($idHab);
        $funcionario->save();

        return redirect()->route('editar_funcionario',$funcionario->id);
      
    }
}
