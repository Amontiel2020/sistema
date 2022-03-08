@extends('layouts.Main')

@section('content')

<div class="container">


 

    <div class="panel panel-primary">
        <div class="panel-heading">

        </div>
        <div class="panel-body">
            <table class="table">

                <tr>
                    <th>Consumivel</th>
                    <th>Tipo</th>
                    <th>Entradas</th>
                    <th>Saidas</th>
                    <th>Stock Disponivel</th>
                    <th>Estado</th>

  
                </tr>

                @foreach($lista as $item)
                <tr>
                    <td>{{$item->nome}}</td>
                    <td>{{$item->tipo}}</td>
                    <td>{{\App\Entrada::obterEntradas($item->id)}}</td>
                    <td>{{\App\Saida::obterSaidas($item->id)}}</td>
                    <td>{{\App\Entrada::obterEntradas($item->id)-\App\Saida::obterSaidas($item->id)}}</td>
                    <td></td>

  


                </tr>
                @endforeach
            </table>
        </div>



    </div>
    @stop