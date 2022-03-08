@extends('layouts.Main')

@section('content')
<div class="page-header">
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3>Actualizar Palavra Passe</h3>
    </div>
    <div class="panel-body">
        <div class="panel panel-default">
            <div class="panel-body">
                <form action="{{route('update_password')}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="">Palavra Passe</label>
                                <input type="text" class="form-control" name="password_old">
                            </div>
                            <div class="form-group">
                                <label for="">Nova Palavra Passe</label>
                                <input type="text" class="form-control" name="password">
                            </div>
                          <!--  <div class="form-group">
                                <label for="">Repetir Nova Palavra Passe</label>
                                <input type="text" class="form-control" name="password-new-repeat">
                            </div> -->

                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@stop