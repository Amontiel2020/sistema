<?php

namespace App\Http\Controllers;

use App\Cat_livro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use \App\Livro;


class Livros extends Controller
{
    public function listarLivros(Request $request)
    {

      /*  $livros = Livro::all();

        foreach ($livros as $livro) {
            $categoria = $livro->categoria;
            if($categoria !=null && !($this->buscarCategoria($categoria))){
                $novaCat=new Cat_livro();
                $novaCat->nome=$categoria;
                $novaCat->save();
            }
        }*/

        $cursos = \App\Curso::all();



        if ($request->curso != null) {
            $livros = \App\Livro::where("curso_id", $request->curso)->paginate(30);
        } else {
            $livros = \App\Livro::paginate(30);
        }



        return view("livros.listar", compact("livros", "cursos"));
    }

    public function buscarCategoria($nome)
    {


        $categoria = Cat_livro::where('nome', 'LIKE', '%' . $nome . '%')->first();
        if ($categoria != null) {
            return true;
        } else if ($categoria == true) {
            return false;
        }
    }
    public function registrarLivro()
    {
        $cursos = \App\Curso::all();
        $categorias = \App\Cat_livro::all();
        $pais = DB::table('pais')->pluck('paisNome', 'paisId');

        return view("livros.inserir", compact("cursos", 'pais', 'categorias'));
    }

    public function storeLivro(Request $request)
    {

        $livro = new \App\Livro();

        $livro->titulo = $request->titulo;
        $livro->autor = $request->autor;
        $livro->edicao = $request->edicao;
        $livro->editora = $request->editora;
        $livro->ano = $request->ano;
        $livro->pais = $request->pais;
        $livro->qtd = $request->qtd;
        if ($request->curso != "-") {
            $livro->curso_id = $request->curso;
        }
        if ($request->categoria != "-") {
            $livro->cat_livro_id = $request->categoria;
        }
        $livro->codBarra = $request->codBarra;
        //$livro->categoria = $request->categoria;




        $livro->save();

        return redirect(route("listarLivros"))->with('success', 'Livro cadastrado com sucesso!');
    }

    public function eliminarLivro($id)
    {
        $livro = \App\Livro::find($id);
        $livro->delete();
        return redirect(route("listarLivros"))->with('success', 'Livro eliminado com sucesso!');
    }
    public function actualizarLivro($id)
    {
        $livro = \App\Livro::find($id);
        $cursos = \App\Curso::all();
        $categorias = \App\Cat_livro::all();
        $pais = DB::table('pais')->pluck('paisNome', 'paisId');

        return view("livros.editar", compact("livro", "cursos", "pais", "categorias"));
    }
    public function updateLivro(Request $request)
    {

        $livro = \App\Livro::find($request->id);

        $livro->titulo = $request->titulo;
        $livro->autor = $request->autor;
        $livro->edicao = $request->edicao;
        $livro->editora = $request->editora;
        $livro->ano = $request->ano;
        $livro->pais = $request->pais;
        $livro->qtd = $request->qtd;
        if ($request->curso != "-") {
            $livro->curso_id = $request->curso;
        }
        if ($request->categoria != "-") {
            $livro->cat_livro_id = $request->categoria;
        }
        $livro->codBarra = $request->codBarra;
        // $livro->categoria = $request->categoria;

        $livro->save();

        return redirect(route("listarLivros"))->with('success', 'Livro actualizado com sucesso!');
    }

    public function create(Request $request)
    {
        $livro = new Livro();
        $livro->titulo = $request->titulo;
        $livro->autor = $request->autor;
        $livro->save();
        /* Livro::create([
            'titulo' => $request->titulo,
            'autor' => $request->autor
        ]);*/

        $response['message'] = "Guardado exitosamente";
        $response['success'] = true;
        return $response;
    }
}
