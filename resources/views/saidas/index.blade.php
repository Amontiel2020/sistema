@extends('layouts.Main')

@section('content')

<div class="container">


    <div class="page-header">
        <div class="row">
            <div class="col-md-6">
                <h5>Lista de Saidas </h5>
            </div>
            <div class="col-md-6" align="right">
                <a href="{{route('inserirSaida')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Inserir Saida</a>
            </div>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">

        </div>
        <div class="panel-body">
            <table class="table">

                <tr>
                    <th>Data</th>
                    <th>Consumivel</th>
                    <th>Quantidade</th>
                    <th>Destinatario</th>
                    <th>Responsavel</th>
                    <th>Obs</th>
                    <th></th>
                    <th></th>
                </tr>

                @foreach($lista as $item)
                <tr>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->consumivel_id}}</td>
                    <td>{{$item->qtd}}</td>
                    <td>{{$item->destinatario}}</td>
                    <td>{{$item->responsavel}}</td>
                    <td>{{$item->obs}}</td>
                    <td width="10"><a href="{{route('editarSaida',$item->id)}}" class="btn btn-sm btn-primary">
                            <i class="fa fa-pencil-square"></i>
                        </a>

                    </td>
                    <td width="10">
                        <form action="{{route('eliminarSaida',$item->id)}}">
                            <input type="hidden" name="method" value="DELETE">
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