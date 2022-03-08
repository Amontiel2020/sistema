@extends('layouts.Main')

@section('content')

<div class="page-header"></div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3>Perfil</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>imagem perfil</p>
                    </div>
                </div>

            </div>
            <div class="col-md-9">
                <form action="{{route('update_perfil')}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="">Nome Proprio</label>
                                <input type="text" class="form-control" name="nome" value="{{$usuario->name}}">
                            </div>
                            <div class="form-group">
                                <label for="">Apelido</label>
                                <input type="text" class="form-control" name="apelido" value="{{$usuario->last_name}}">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" value="{{$usuario->email}}">
                            </div>
                            <div class="form-group">
                                <label for="">Palavra Passe</label>
                                <a href="{{route('showChangePassword')}}" class="btn btn-success">Alterar Palavra Passe</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-group">
                                <button class="btn btn-success">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop