@extends('layouts.Main')

@section('content')
<div class="page-header">
   
</div>

<div class="panel panel-primary">
 <div class="panel-heading">
 <h3>Registrar processo de candidatura</h3>
 </div>

    <div class="panel-body">
        <form action="{{'store_processoCandidatura'}}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <label>Nome</label>
                <input class="form-control" type="text" name="nome" required>

            </div>
            <div class="form-group">
                <label>Ano</label>
                <input class="form-control" type="number" name="ano" required>

            </div>
            <div class="form-group">
                <label>Valor de Corte</label>
                <input class="form-control" type="text" name="corte">

            </div>
            <div class="form-group">
                <label>Descrição</label>
                <input class="form-control" type="text" name="descricao">

            </div>
            <button type="submit" class="btn btn-success">Registrar</button>
        </form>

    </div>
</div>

@stop