@extends('layouts.Main')

@section('content')


<div class="panel panel-primary">
    <div class="panel-heading">
        Formulário Registrar Idioma
    </div>
    <div class="panel-body">

        <form role="form" action="{{route('store_lingua')}}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <label for="nome">Nome</label>
                <input class="form-control" type="text" name="nome">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input class="form-control" type="text" name="descricao">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit"><i class="fa fa-plus-circle"></i> Registrar</button>
                <button class="btn btn-outline btn-primary">Cancelar</button>
            </div>



        </form>
    </div>
    <div class="panel-footer">

    </div>
</div>







@stop