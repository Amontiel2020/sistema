@extends('layouts.Main')

@section('content')
<div class="page-header">

</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3>Processos de candidaturas</h3>
    </div>

    <div class="panel-body">
    <a class="btn btn-primary" href="{{route('inserir_processoCandidatura')}}">Registrar processo</a><br><br>
        <table class="table table-bordered table-striped table-condensed">
            <tr>
                <th>Nº</th>
                <th>Nome</th>
                <th>Ano</th>
                <th>Valor de corte</th>
                <th>Lista dos Candidatos</th>
                <th>Lista dos Inscritos</th>
                <th>Lista dos Aprovados</th>
                <th>Exames Admissão</th>
                <th>Resultados do corte</th>
                <th>Pauta final</th>
                <th>Listas</th>
                <th></th>
            </tr>
            @foreach($processos as $i=>$proc)
            <tr>
                <td>{{$i+1}}</td>
                <td>{{$proc->nome}}</td>
                <td>{{$proc->ano}}</td>
                <td>{{$proc->valorDeCorte}}</td>
                <td>
                <a href="{{route('listarCandidatos',$proc->id)}}">Ver</a><br>
                </td>
                <td>
                <a href="{{route('listarInscritos',$proc->id)}}">Ver</a><br>
                </td>
                <td>
                <a class="btn btn-primary btn-sm" href="{{route('indexMatriculas',$proc->id)}}">Ver</a>  
                </td>
                <td>
                <a class="btn btn-primary btn-sm" href="{{route('listarProcessosCandidaturas',$proc->id)}}">Ver</a>
                </td>
                <td>
                <a href="{{route('resultadosProcesso',$proc->id)}}">Ver</a><br>
                </td>
                <td>
                <a href="{{route('resultadosCandidatos')}}">Ver</a><br>
                </td>
                <td>
                    <a href="{{route('listasCandidatos')}}">Ver</a><br>
                    </td>
                <td>
                    <a href="#">Editar</a>/ <a href="#">Eliminar</a>
               <!-- <a class="btn btn-danger btn-sm" href="{{route('eliminarProcessosCandidaturas',$proc->id)}}">Eliminar</a>-->
                </td>

            </tr>
            @endforeach
        </table>
    </div>

</div>




@stop