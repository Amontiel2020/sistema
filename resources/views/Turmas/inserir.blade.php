@extends('layouts.Main')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Registrar Turma</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">

                        <form role="form" action="{{route('storeTurmas')}}" id="createTurma_form">

                            <div class="form-group">
                                <label>Identificador</label>
                                <input class="form-control" type="text" id="identificador" name="identificador" value="{{ old('identificador') }}" readonly required>
                            </div>
                            <div class="form-group">
                                <label>Curso</label>
                                <select name="curso" id="curso" class="form-control">
                                    @foreach($cursos as $curso)
                                    <option value="{{$curso->id}}">{{$curso->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ano Curricular</label>
                                <select name="anoLectivo" id="ano" class="form-control">
                                    <option value="1">1º</option>
                                    <option value="2">2º</option>
                                    <option value="3">3º</option>
                                    <option value="4">4º</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Periodo</label>
                                <select name="periodo" id="periodo" class="form-control">
                                    <option value="M">Manhã</option>
                                    <option value="T">Tarde</option>
                                    <option value="N">Noite</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Sala</label>
                                <select name="sala" id="sala" class="form-control">
                                    @foreach($salas as $sala)
                                    <option value="{{$sala->id}}">{{$sala->id}}--{{\App\Seccao::toString($sala->seccao_id)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ano Acadêmico</label>
                                <select name="anoAcademico" id="anoAcademico" class="form-control">
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                    <option value="2030">2030</option>

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
                            <button class="btn btn-primary btn-block" type="submit">Inserir</button>
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

@section('scripts')
<script>
    if ($("#createTurma_form").length > 0) {
        $('#createTurma_form').find('.error').val(' ');
        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z]+$/i.test(value);
        }, "Solo letras");

        $("#createTurma_form").validate({

            rules: {
                identificador: {
                    required: true,
                    maxlength: 50,
                },

                curso: {
                    required: true,
                    maxlength: 50,

                },

                periodo: {
                    required: true,
                    maxlength: 50,
                },
            },
            messages: {

                identificador: {
                    required: "É obrigatória a indicação de um valor para o campo identificador.",
                },
                curso: {
                    required: "É obrigatória a indicação de um valor para o campo curso.",
                },
                periodo: {
                    required: "É obrigatória a indicação de um valor para o campo periodo.",
                    maxlength: "maximo permitido 50",
                },

            },
        })
    }

    $(document).ready(function() {

        $('#curso').change(function(event) {
            // codigo = obterCodigoCurso();
            id = $("#curso").val();
            url = "obterCurso/" + id + "";
            var codigo = "";
            $.getJSON(url, function(response, state) {
                $.each(response, function(k, v) {
                    // $('#identificador').attr('value', v.codigo + ano + periodo + sala);
                    //  $('#identificador').text(v.codigo);
                    codigo = v.codigo;
                    mudarIdentCodigoCurso(codigo);

                });
            });
        });

        $('#ano').change(function(event) {
            ano = $("#ano").val();
            id = $("#curso").val();
            url = "obterCurso/" + id + "";
            var codigo = "";
            $.getJSON(url, function(response, state) {
                $.each(response, function(k, v) {
                    // $('#identificador').attr('value', v.codigo + ano + periodo + sala);
                    //  $('#identificador').text(v.codigo);
                    codigo = v.codigo;
                    mudarIdentAnoCurricular(codigo, ano);

                });
            });
        });
        $('#periodo').change(function(event) {
            periodo = $("#periodo").val();
            id = $("#curso").val();
            url = "obterCurso/" + id + "";
            var codigo = "";
            $.getJSON(url, function(response, state) {
                $.each(response, function(k, v) {
                    // $('#identificador').attr('value', v.codigo + ano + periodo + sala);
                    //  $('#identificador').text(v.codigo);
                    codigo = v.codigo;
                    mudarIdentPeriodo(codigo, periodo);
                });
            });
        });
        $('#sala').change(function(event) {
            sala = $("#sala").val();
            id = $("#curso").val();
            url = "obterCurso/" + id + "";
            var codigo = "";
            $.getJSON(url, function(response, state) {
                $.each(response, function(k, v) {
                    // $('#identificador').attr('value', v.codigo + ano + periodo + sala);
                    //  $('#identificador').text(v.codigo);
                    codigo = v.codigo;
                    mudarIdentSala(codigo, sala);
                });
            });
        });
    });

    /* function mudarIdentCodCurso(codCurso) {
         anoCurricular = $("#ano").val();
         periodo = $("#periodo").val();
         sala = $("#sala").val();

         $('#identificador').attr('value', codCurso + anoCurricular + periodo + sala);


     }*/

    function obterCodigoCurso() {
        $(document).ready(function() {
            id = $("#curso").val();
            url = "obterCurso/" + id + "";
            var codigo = "";
            $.getJSON(url, function(response, state) {
                $.each(response, function(k, v) {
                    // $('#identificador').attr('value', v.codigo + ano + periodo + sala);
                    //  $('#identificador').text(v.codigo);
                    codigo = v.codigo;
                });
            });
            return codigo;
        });
    }


    function mudarIdentCodigoCurso(codCurso) {
        anoCurricular = $("#ano").val();
        // codCurso = obterCodigoCurso();
        // alert(codCurso);
        periodo = $("#periodo").val();
        sala = $("#sala").val();

        $('#identificador').attr('value', codCurso + anoCurricular + periodo + sala);
    }

    function mudarIdentAnoCurricular(codCurso, ano) {
        // anoCurricular = $("#ano").val();
        // codCurso = obterCodigoCurso();
        periodo = $("#periodo").val();
        sala = $("#sala").val();

        $('#identificador').attr('value', codCurso + ano + periodo + sala);
    }

    function mudarIdentPeriodo(codCurso, periodo) {
        anoCurricular = $("#ano").val();
        // codCurso = obterCodigoCurso();
        // periodo = $("#periodo").val();
        sala = $("#sala").val();

        $('#identificador').attr('value', codCurso + anoCurricular + periodo + sala);
    }

    function mudarIdentSala(codCurso, sala) {
        anoCurricular = $("#ano").val();
        // codCurso = obterCodigoCurso();
        periodo = $("#periodo").val();
        // sala = $("#sala").val();

        $('#identificador').attr('value', codCurso + anoCurricular + periodo + sala);
    }
</script>
@endSection


@stop