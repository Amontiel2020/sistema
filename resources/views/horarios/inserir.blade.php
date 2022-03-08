@extends('layouts.Main')

@section('content')


<div class="page-header">

</div>

<form role="form" action="{{route('save_horario')}}" method="POST">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Registrar Horario</h3>
        </div>
        <div class="panel-body">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Curso</label>
                        <select name="curso" class="form-control">
                            @foreach($cursos as $curso)
                            <option value="{{$curso->id}}">{{$curso->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Turma</label>
                        <select name="turma" class="form-control">
                            @foreach($turmas as $turma)
                            <option value="{{$turma->id}}">{{$turma->identificador}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Semestre</label>
                        <select name="semestre" class="form-control">
                            <option value="I">I</option>
                            <option value="II">II</option>

                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Ano Académico</label>
                        <select name="anoAcademico" class="form-control">
                            <option value="2021">2021/2022</option>
                            <option value="2022">2022/2023</option>
                            <option value="2023">2023/2024</option>
                            <option value="2024">2024/2025</option>
                        </select>
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