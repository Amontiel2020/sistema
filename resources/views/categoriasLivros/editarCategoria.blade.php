@extends('layouts.Main')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Actualizar Categoria</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Categoria
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">

                        <form role="form" action="{{route('updateCategoriaLivro')}}" id="createDepartamento_form" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $categoria->id }}">
                            <div class="form-group">
                                <label>Nome</label>
                                <input class="form-control" type="text" name="nome" value="{{$categoria->nome}}" required>
                            </div>
                            <div class="form-group">
                                <label>Descrição</label>
                                <input class="form-control" type="text" name="descricao" value="{{$categoria->descricao}}">
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">

                                        <div class="col-lg-12">

                                            <div class="col-lg-6">
                                                <button class="btn btn-primary btn-block" type="submit">Actualizar</button>
                                            </div>
                                            <div class="col-lg-6">
                                                <button class="btn btn-outline btn-success btn-block">Cancelar</button>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                </form>

                @stop