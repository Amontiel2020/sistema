@extends('layouts.Main')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6">

            </div>
            <div class="col-md-6" align="right">
                <!--    <a href="{{route('inserirEstudantes')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Inserir Estudante</a>-->
            </div>
        </div>
    </div>


    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3>Lista dos livros</h3>
        </div>

        <div class="panel-body">
            <form action="{{route('listarLivros')}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row">

                    <div class=col-md-4>
                        <input type="text" class="form-control" name="buscarpor" value="" placeholder="Titulo">
                    </div>
                    <div class=col-md-4>
                        <select name="curso" class="form-control">
                            <option value="curso">Curso</option>
                            @foreach($cursos as $curso)
                            <option value="{{$curso->id}}">{{$curso->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class=col-md-4>

                        <button type="submit" class="btn btn-primary" title="Pesquisar">
                            Pesquisar
                        </button>
                    </div>
                </div>
            </form>
            <br>
            <a class="btn btn-success btn-sm" href="{{route('registrarLivro')}}">Cadastrar Livro</a>
            <br>
            <br>

            @if (!$livros->isEmpty())
            <div class="panel panel-default">
                <div class="panel-body">


                    <table class="table table-bordered table-striped">
                        <tr>

                            <th>Nº</th>
                            <th>Titulo</th>
                            <th>Autor</th>
                            <th>Edição</th>
                            <th>Editora</th>
                            <th>Ano</th>
                            <th>Pais</th>
                            <th>Qtd</th>
                            <th>Categoria</th>
                            <th>Curso</th>
                            <th>Actualizar</th>
                            <th>Eliminar</th>

                        </tr>
                        @foreach($livros as $i=>$livro)
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$livro->titulo}}</td>
                            <td>{{$livro->autor}}</td>
                            <td>{{$livro->edicao}}</td>
                            <td>{{$livro->editora}}</td>
                            <td>{{$livro->ano}}</td>
                            <td>{{\App\Livro::toStringPais($livro->pais)}}</td>
                            <td>{{$livro->qtd}}</td>
                            <td>{{\App\Cat_livro::toString($livro->cat_livro_id)}}</td>
                            <td>{{\App\Curso::toString($livro->curso_id)}}</td>
                            <td class="text-center"><a class="btn btn-primary btn-sm" href="{{route('actualizarLivro',$livro->id)}}"><i class="fa fa-edit" aria-hidden="true"></i></a></td>
                            <th class="text-center"><a class="btn btn-danger btn-sm" href="{{route('eliminarLivro',$livro->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></th>

                        </tr>
                        @endforeach

                    </table>
                    <div align="center">{{$livros->render()}}</div>
                </div>
            </div>

            @else
            <div class="panel panel-default">
                <div class="body">
                    <p class="text-center">Sem Livros Cadastrados!</p>
                </div>
            </div>
            @endif
        </div>
    </div>



    @stop