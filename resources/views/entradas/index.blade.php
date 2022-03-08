@extends('layouts.Main')

@section('content')

<div class="container">


    <div class="page-header">
        <div class="row">
            <div class="col-md-6">
                <h5>Lista de Entradas </h5>
            </div>
            <div class="col-md-6" align="right">
                <a href="{{route('inserirEntrada')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Inserir Entrada</a>
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
                    <th>precoUnitario</th>
                    <th>Quantidade</th>
                    <th>Valor</th>
                    <th>Factura</th>
                    <th>Fornecedor</th>
                    <th></th>
                    <th></th>
                </tr>

                @foreach($lista as $item)
                <tr>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->consumivel_id}}</td>
                    <td>{{$item->precoUnitario}}</td>
                    <td>{{$item->qtd}}</td>
                    <td>valor</td>
                    <td>{{$item->factura}}</td>
                    <td>{{$item->fornecedor}}</td>
                    <td width="10"><a href="{{route('editarEntrada',$item->id)}}" class="btn btn-sm btn-primary">
                            <i class="fa fa-pencil-square"></i>
                        </a>

                    </td>
                    <td width="10">
                        <form action="{{route('eliminarEntrada',$item->id)}}">
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