@extends('layouts.Main')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Inserir Usuarios</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Formulario
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">

                        <form role="form" action="{{route('storeUsuarios')}}" id="createUsuario_form">

                            <div class="form-group">
                                <label>Nome</label>
                                <input class="form-control" type="text" name="name" required>
                            </div>
                            <div class="form-group">
                                <label>Apelidos</label>
                                <input class="form-control" type="text" name="last_name">
                            </div>
                            <div class="form-group input-group">

                                <span class="input-group-addon">@</span>
                                <input class="form-control" type="text" name="email" placeholder="email" required>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="usuario" name="user" required>
                            </div>

                            <div class="form-group">
                                <label>Palavra Passe</label>
                                <input class="form-control" type="password" name="password" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="col-lg-6">
                                        <label>Tipo</label>
                                        @if(Auth::user()->hasRole('Admin'))
                                        <select class="form-control" name="type">
                                            @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                        @else
                                        <select class="form-control" name="type">
                                            <option value="8">Professor</option>
                                        </select>
                                        @endif

                                    </div>
                                    <div class="col-lg-6">

                                        <div class="checkbox">
                                            <br>
                                            <label>
                                                <input name="active" type="checkbox" value="active">Activo
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div><br>


                            <div class="form-group">
                                <label>Endereço</label>
                                <input class="form-control" type="text" name="address">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="col-lg-6">
                                            <button class="btn btn-primary btn-block" type="submit">Inserir</button>
                                        </div>
                                        <div class="col-lg-6">
                                            <button class="btn btn-outline btn-success btn-block">Cancelar</button>
                                        </div>
                                    </div>

                                </div>



                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('scripts')
<script>
    if ($("#createUsuario_form").length > 0) {
        $('#createUsuario_form').find('.error').val(' ');
        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z]+$/i.test(value);
        }, "Apenas letras");

        $("#createUsuario_form").validate({

            rules: {
                name: {
                    required: true,
                    maxlength: 50,
                    lettersonly: true
                },
                last_name: {
                    required: true,
                    maxlength: 50,
                    lettersonly: true
                },

                email: {
                    required: true,
                    maxlength: 50,
                    email: true

                },

                user: {
                    required: true,
                    maxlength: 500,
                },
                password: {
                    required: true,
                    maxlength: 500,
                },
            },
            messages: {

                name: {
                    required: "É obrigatória a indicação de um valor para o campo nome.",
                },
                last_name: {
                    required: "É obrigatória a indicação de um valor para o campo apelido.",
                },
                email: {
                    required: "É obrigatória a indicação de um valor para o campo email.",
                    email: "Email não valido",
                    maxlength: "The email name should less than or equal to 50 characters",
                },
                user: {
                    required: "É obrigatória a indicação de um valor para o campo usuario.",
                },
                password: {
                    required: "É obrigatória a indicação de um valor para o campo palavra passe.",
                },

            },
        })
    }
</script>
@endSection



@stop