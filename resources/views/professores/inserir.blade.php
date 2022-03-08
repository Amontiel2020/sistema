@extends('layouts.Main')

@section('content')


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<form role="form" action="{{route('salvarProfessores')}}" id="createEstudante_form" enctype="multipart/form-data" method="POST">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Registrar Professor</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label>Nome Completo</label>
                        <input class="form-control" type="text" name="nome" value="{{ old('nome') }}" required>
                        <span class="text-danger">{{ $errors->first('nome') }}</span>
                    </div>
                    <div class="form-group">
                        <label>Sexo</label>
                        <select name="genero" class="form-control">
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                        </select>
                        <span class="text-danger">{{ $errors->first('genero') }}</span>
                    </div>
                    <div class="panel panel-default">
                        <div align="center">
                            <h4><b>Dados do Bilhete de Identidade</b></h4>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Número </label>
                                <input id="BITest" class="form-control" type="text" name="BI" value="{{ old('BI') }}" required>
                                <span class="text-danger">{{ $errors->first('BI') }}</span>
                            </div>
                            <div class="form-group">
                                <label>Data de Emissão </label>
                                <input min="2010-08-14" max="{{$date}}" class="form-control" type="date" name="dataEmissaoBI" required>
                                <span class="text-danger">{{ $errors->first('BI') }}</span>
                            </div>
                            <div class="form-group">
                                <label>Data de Validade </label>
                                <input min="{{$date}}" class="form-control" type="date" name="dataValidadeBI" required>
                                <span class="text-danger">{{ $errors->first('BI') }}</span>
                            </div>

                        </div>
                    </div>

                    <!--<div class="form-group">
                        <label>Estado</label>
                        <select name="estado" class="form-control">
                            <option value="activo">Activo</option>
                        </select>
                        <span class="text-danger">{{ $errors->first('genero') }}</span>
                    </div> -->

                    <div class="form-group">
                        <label>Categoria</label>
                        <input class="form-control" type="text" name="categoria" value="{{ old('categoria') }}" required>
                        <span class="text-danger">{{ $errors->first('categoria') }}</span>
                    </div>
                    <div class="form-group">
                        <label>Grau Acadêmico</label>
                        <input class="form-control" type="text" name="grauAcad" value="{{ old('categoria') }}" required>
                        <span class="text-danger">{{ $errors->first('categoria') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div align="center">
                            <h4><b>Telefones</b></h4>
                        </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input class="form-control" type="text" id="telefone1" name="telefone1" value="{{ old('categoria') }}" placeholder="Telef. 1" required>
                                        <span class="text-danger">{{ $errors->first('telefone1') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input class="form-control" type="text" id="telefone2" name="telefone2" value="{{ old('categoria') }}" placeholder="Telef. 2" required>
                                        <span class="text-danger">{{ $errors->first('telefone2') }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" value="{{ old('email') }}" required>
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Data do Inicio do Contrato </label>
                                        <input  class="form-control" type="date" name="data_inicio_contrato" >
                                       
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Data do Fim do Contrato </label>
                                        <input  class="form-control" type="date" name="data_fim_contrato" >
                                        
                                    </div>
                                </div>

                            </div>

                        </div>

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


</form>

@section('scripts')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
    $(document).ready(function() {

        $("#createEstudante_form").validate({


            rules: {
                nomeCompleto: {
                    required: true,
                    maxlength: 50,
                    //lettersonly: true 
                },

                telefone1: {
                    required: true,
                    minlength: 11,
                },
                telefone2: {
                    required: true,
                    minlength: 11,
                },
                telefoneEmergencia: {
                    required: true,
                    minlength: 11,
                },

                apelido: {
                    required: true,
                    maxlength: 500,
                },
                BI: {
                    required: true,
                    maxlength: 14,
                    minlength: 14,

                },


            },
            messages: {

                nomeCompleto: {
                    required: "É obrigatória a indicação de um valor para o campo nome.",
                },
                apelido: {
                    required: "É obrigatória a indicação de um valor para o campo apelido.",
                },
                telefone1: {
                    required: "É obrigatório.",
                    minlength: "Devem ser 9 digitos",
                },
                telefone2: {
                    required: "É obrigatório.",
                    minlength: "Devem ser 9 digitos",
                },
                telefoneEmergencia: {
                    required: "É obrigatório.",
                    minlength: "Devem ser 9 digitos",
                },
                BI: {
                    required: "É obrigatório.",
                    minlength: "Devem ser 14 digitos",
                },

            },
        })

    });

    $(document).ready(function() {
        $("#telefone1, #telefone2").mask("Z00-000-000", {
            translation: {
                Z: {
                    pattern: /[9]/
                }
            }
        }).attr('minlength', 9);

        $("#BI").mask("000000000AA000", {
            translation: {
                A: {
                    pattern: /['BA']/
                }
            }
        }).attr('minlength', 14);
    });
</script>
@endSection


@stop