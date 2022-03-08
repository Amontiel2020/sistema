<?php

namespace App\Http\Controllers;

use App\Funcionario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Lingua;

class Linguas extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $lista = Lingua::all();
        return view('idiomas.index', compact('lista'));
    }


    public function inserir()
    {
        return view('idiomas.inserir');
    }

    public function store(Request $request)
    {

        Lingua::create(
            [
                'nome' => $request['nome'],
                'descricao' => $request['descricao']


            ]
        );

        return redirect()->route('index_lingua');
    }

    public function editar($id)
    {
        $lingua = Lingua::where('id', $id)->first();

        return view('idiomas.editar', compact('lingua'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $lingua = Lingua::where('id', $id)->first();

        $nome = $request->nome;
        $descricao = $request->descricao;

        $lingua->nome = $nome;
        $lingua->descricao = $descricao;

        $lingua->save();
        return redirect()->route('index_lingua');
    }

    public function eliminar($id)
    {
        $lingua = Lingua::where('id', $id)->first();
        $lingua->delete();
        return redirect()->route('index_lingua');
    }

    public function add_idioma($idFunc,$idIdioma){
        $funcionario=Funcionario::find($idFunc);
        $funcionario->idiomas()->attach($idIdioma);
        $funcionario->save();

        return redirect()->route('editar_funcionario',$funcionario->id);
      
    }

    public function eliminar_idioma($idFunc,$idIdioma){
        $funcionario=Funcionario::find($idFunc);
        $funcionario->idiomas()->detach($idIdioma);
        $funcionario->save();

        return redirect()->route('editar_funcionario',$funcionario->id);
      
    }
}
