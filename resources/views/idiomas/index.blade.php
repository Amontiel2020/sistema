@extends('layouts.Main')

@section('content')


<div class="panel panel-primary">
    <div class="panel-heading">
        Idiomas

    </div>
    <div class="panel-body">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('inserir_lingua')}}" class="btn btn-info"><i class="fa fa-plus-circle"></i> Inserir </a>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive table-bordered">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lista as $item)
                            <tr>
                                <td width="400">{{$item->nome}}</td>
                                <td>{{$item->descricao}}</td>
                                <td width="10"><a href="{{route('editar_lingua',$item->id)}}" class="btn btn-primary btn-xs">
                                        <i class="fa fa-pencil-square"></i>
                                    </a>

                                </td>
                                <td width="10">
                                    <form action="{{route('eliminar_lingua',$item->id)}}">
                                        <input type="hidden" name="method" value="DELETE">
                                        <button onclick="return confirm('Eliminar registro?')" class="btn btn-danger btn-xs">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
    </div>
    <div class="panel-footer">

    </div>
</div>
@stop