<?php

namespace App\Http\Controllers;

use App\Documento_funcionario;
use App\Funcionario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Documentos_funcionarios extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $lista = Documento_funcionario::all();
        return view('documentos_funcionarios.index', compact('lista'));
    }


    public function inserir()
    {
        return view('documentos_funcionarios.inserir');
    }

    public function store(Request $request)
    {

        Documento_funcionario::create(
            [
                'nome' => $request['nome'],
                'descricao' => $request['descricao']


            ]
        );

        return redirect()->route('index_documentos');
    }

    public function editar($id)
    {
        $documento = Documento_funcionario::where('id', $id)->first();

        return view('documentos_funcionarios.editar', compact('documento'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $doc = Documento_funcionario::where('id', $id)->first();

        $nome = $request->nome;
        $descricao = $request->descricao;

        $doc->nome = $nome;
        $doc->descricao = $descricao;

        $doc->save();
        return redirect()->route('index_documentos');
    }

    public function eliminar($id)
    {
        $doc = Documento_funcionario::where('id', $id)->first();
        $doc->delete();
        return redirect()->route('index_documentos');
    }

    public function add_documento($idFunc,$idDoc){
        $funcionario=Funcionario::find($idFunc);
        $funcionario->documentos()->attach($idDoc);
        $funcionario->save();

        return redirect()->route('editar_funcionario',$funcionario->id);
      
    }

    public function eliminar_documento($idFunc,$idDoc){
        $funcionario=Funcionario::find($idFunc);
        $funcionario->documentos()->detach($idDoc);
        $funcionario->save();

        return redirect()->route('editar_funcionario',$funcionario->id);
      
    }
}
