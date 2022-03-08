@extends('layouts.Main')

@section('content')

<div class="page_header">

</div>
<div class="panel panel-default">
    <div class="panel-heading">

    </div>
    <div class="panel-body">
    <h3>Ferias do funcionário {{$funcionario->nome_completo}}</h3>
        <form action="{{route('store_feria')}}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="funcionario_id" value="{{ $funcionario->id }}">


            <div class="form-group">
                <label for="">Inicio</label>
                
                <input min="{{$date}}" max="2021-12-31" class="form-control" type="date" name="data_inicio" value="{{$feria->data_inicio}}" >
            </div>
            <div class="form-group">
                <label for="">Fim</label>
                <input min="{{$date}}" max="2021-12-31" name="data_fim" type="date" class="form-control" value="{{$feria->data_fim}}" >
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>

        </form>
    </div>
</div>



@stop