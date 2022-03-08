@extends('layouts.Main')

@section('content')


<div class="page-header">
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3>Lista de Categorias</h3>
    </div>

    <div class="panel-body">
        <br>
        <a href="{{route('addCategoriaLivro')}}">Registrar Categoria</a>

        <table class="table table-bordered table-striped">
            <tr>

                <th>Nº</th>
                <th>Nome</th>
                <th>Descrição </th>
                <th></th>
                <th></th>


            </tr>


            @foreach($lista as $i=> $item)
            <tr>

                <td>{{$i+1}}</td>
                <td>{{$item->nome}}</td>
                <td>{{$item->descricao}}</td>
                <td width="10"><a href="{{route('editarCategoriaLivro',$item->id)}}" class="btn btn-sm btn-primary">
                        <i class="fa fa-pencil-square"></i>
                    </a>
                </td>

                <td width="10">
                    <form action="{{route('deleteCategoriaLivro',$item->id)}}">
                        <button onclick="return confirm('Eliminar registro?')" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>

            </tr>
            @endforeach
        </table>

    </div>
</div>



@stop