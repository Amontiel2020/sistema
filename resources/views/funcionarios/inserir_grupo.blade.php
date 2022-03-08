@extends('layouts.Main')

@section('content')


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Registrar Grupo</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">

                        <form role="form" action="{{route('store_grupo_funcionario')}}" id="createEstudante_form" enctype="multipart/form-data" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label>Nome</label>
                                <input class="form-control" type="text" name="nome" value="{{ old('nome') }}" required>
                                <span class="text-danger">{{ $errors->first('nome') }}</span>

                            </div>

                            <div class="form-group">
                                <label>Descrição</label>
                                <textarea name="descricao" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">

                    <div class="col-lg-12">

                        <div class="col-lg-6">
                            <button class="btn btn-primary btn-block" type="submit">Registrar</button>
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