@extends('layouts.Main')

@section('content')




<div class="panel panel-primary">
    <div class="panel-heading">
        Emolumentos

    </div>
    <div class="panel-body">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('inserirEmolumentos')}}" class="btn btn-info"><i class="fa fa-plus-circle"></i> Inserir Emolumento</a>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive table-bordered">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Editar</th>
                                <th>Eliminar</th>
                                <th>Nome</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lista as $item)
                            <tr>
                                <td width="10"><a href="{{route('editarEmolumentos',$item->id)}}" class="btn btn-primary btn-xs">
                                        <i class="fa fa-pencil-square"></i>
                                    </a>

                                </td>
                                <td width="10">
                                    <form action="{{route('eliminarEmolumentos',$item->id)}}">
                                        <input type="hidden" name="method" value="DELETE">
                                        <button onclick="return confirm('Eliminar registro?')" class="btn btn-danger btn-xs">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                </td>
                                <td width="400">{{$item->nome}}</td>
                                <td>{{$item->valor}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div align="center">{{$lista->render()}}</div>
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