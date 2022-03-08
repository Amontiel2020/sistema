<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Tipo_contrato;

class Tipos_contrato extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $lista = Tipo_contrato::all();
        return view('contratos.index', compact('lista'));
    }


    public function inserir()
    {
        return view('contratos.inserir');
    }

    public function store(Request $request)
    {

        Tipo_contrato::create(
            [
                'nome' => $request['nome'],
                'descricao' => $request['descricao']


            ]
        );

        return redirect()->route('index_tipo_contrato');
    }

    public function editar($id)
    {
        $contrato = Tipo_contrato::where('id', $id)->first();

        return view('contratos.editar', compact('contrato'));
    }

    public function update(Request $request)
    {
        $id=$request->id;
        $contrato = Tipo_contrato::where('id', $id)->first();

        $nome = $request->nome;
        $descricao = $request->descricao;

        $contrato->nome = $nome;
        $contrato->descricao = $descricao;

        $contrato->save();
        return redirect()->route('index_tipo_contrato');
    }

    public function eliminar($id)
    {
        $contrato = Tipo_contrato::where('id', $id)->first();
        $contrato->delete();
        return redirect()->route('index_tipo_contrato');
    }
}
