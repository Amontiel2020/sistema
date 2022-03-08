@extends('layouts.Main')

@section('content')
<div class="container-fluid">
    <div class="page-header">

    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3>Selecione o estudante para gerar a declaração</h3>
        </div>
        <div class="panel-body">
            <form action="{{route('gerarDeclaracao')}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                {!! Form::select('estudanteDeclaracao',$listaEstudantes,null,['id'=>'estudanteDeclaracao','style'=>'width: 50%']) !!}
                <button type="submit" class="btn btn-primary">Gerar</button>

            </form>
        </div>
    </div>
</div>

@stop