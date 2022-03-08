<?php

namespace App\Http\Controllers;

use App\Cat_livro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Curso;
use \App\Seccao;

use Illuminate\Support\Facades\DB;


class Categorias_livros extends Controller
{

 

  public function listarCategorias()
  {
    $lista = Cat_livro::orderBy('nome', 'Asc')->get();
    return view('categoriasLivros.listarCategorias', compact('lista'));
  }

  public function addCategoria()
  {
   
    return view('categoriasLivros.addCategoria');
  }

  public function store(Request $request)
  {
    $categoria = new Cat_livro();
    $categoria->nome = $request->nome;
    $categoria->descricao = $request->descricao;
   
    $categoria->save();

    return redirect()->route('listarCategoriasLivros');
  }

  public function delete($id)
  {
    $categoria = Cat_livro::find($id);
    $categoria->delete();
    return redirect()->route('listarCategoriasLivros');
  }
 

  public function editarCategoria($id)
  {
    $categoria = Cat_livro::find($id);
    return view('categoriasLivros.editarCategoria',compact("categoria"));
  }

  public function update(Request $request)
  {
    $categoria = Cat_livro::find($request->id);
    $categoria->nome = $request->nome;
    $categoria->descricao = $request->descricao;
   
    $categoria->save();

    return redirect()->route('listarCategoriasLivros');
  }
}
