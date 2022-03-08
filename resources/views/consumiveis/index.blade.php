@extends('layouts.Main')

@section('content')

<div class="container">
	

    <div class="page-header">
        <div class="row">
            <div class="col-md-6">
                 <h5>Lista de Consumiveis </h5>
            </div>
            <div class="col-md-6" align="right">
                 <a href="{{route('inserirConsumiveis')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Inserir Consumivel</a>
            </div>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            Consumiveis({{count($lista)}})
        </div>
        <div class="panel-body">
                <table class="table">
                        
                    <tr>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Stock Minimo</th>
                        <th>Fornecedor</th>
                        <th>Responsavel</th>
                        <th></th>
                        <th></th>


                    </tr>
                    
                   @foreach($lista as $item)
                    <tr>

                        <td>{{$item->nome}}</td>
                        <td>{{$item->tipo}}</td>
                        <td>{{$item->stockMin}}</td>
                        <td>{{$item->fornecedor}}</td>
                        <td>{{$item->responsavel}}</td>
                        <td width="10"><a href="{{route('editarConsumiveis',$item->id)}}" class="btn btn-sm btn-primary">
                                <i class="fa fa-pencil-square"></i>         
                                </a>

                        </td>
                        <td width="10">
                            <form action="{{route('eliminarConsumiveis',$item->id)}}">
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