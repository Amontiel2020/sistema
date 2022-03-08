<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Emolumento;

class Emolumentos extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $lista = Emolumento::orderby('nome')->paginate(50);
        return view('Emolumentos.index', compact('lista'));
    }


    public function inserir()
    {
        return view('Emolumentos.inserir');
    }

    public function store(Request $request)
    {

        Emolumento::create(
            [
                'nome' => $request['nome'],
                'valor' => $request['valor']


            ]
        );

        return redirect()->route('listarEmolumentos');
    }

    public function editar($id)
    {
        $emolumento = Emolumento::where('id', $id)->first();

        return view('Emolumentos.editar', compact('emolumento'));
    }

    public function update(Request $request, $id)
    {
        $emolumento = Emolumento::where('id', $id)->first();

        $nome = $request->nome;
        $valor = $request->valor;

        $emolumento->nome = $nome;
        $emolumento->valor = $valor;

        $emolumento->save();
        return redirect()->route('listarEmolumentos');
    }

    public function delete($id)
    {
        $emolumento = Emolumento::where('id', $id)->first();
        $emolumento->delete();
        return redirect()->route('listarEmolumentos');
    }

    public function getEmolumentos()
    {
        return Emolumento::all();
    }
}
