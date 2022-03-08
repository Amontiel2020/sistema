@extends('layouts.Main')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6">

            </div>
            <div class="col-md-6" align="right">
                <!--    <a href="{{route('inserirEstudantes')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Inserir Estudante</a>-->
            </div>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3>Selecione o estudante para fazer inscrição</h3>
        </div>
        <div class="panel-body">
            {!! Form::select('estudante',$estudante,null,['id'=>'estudanteInsc','style'=>'width: 50%']) !!}

        </div>
    </div>

    <div id=divMainInscricoes class="ocultar">
        <div class="panel panel-primary">

            <div class="panel-body">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div id="foto" class="panel-body">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h3> <b>Nome:&nbsp;</b><span id="nomeEstudante"></span>&nbsp;<span><b>Nº:</b></span><span id="codigoEst"><b>&nbsp;</b></span><span id="nomeEstPagamento"></span><br><br>
                                            &nbsp;<b>BI:&nbsp;</b><span id="bi"></span>
                                            &nbsp;<b>Curso:&nbsp;</b><span id="cursoEst"></span><br></h3>
                                        ano: <span id="anoActual"></span>&nbsp;&nbsp; semestre:<span id="semestreActual"></span>
                                    </div>
                                    <div class="col-md-3">

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <form id="formularioInsc" action="{{route('mostrarDiscInscricao')}}" class="form-inline" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" id="idEst" name="idEst" value="">
                                    <select name="ano" id="SelectAno" class="form-control">
                                        <option value="-" selected>Ano</option>
                                        <option  id="1" value="1º">1º</option>
                                        <option  id="2" value="2º">2º</option>
                                        <option  id="3" value="3º">3º</option>
                                        <option  id="4" value="4º">4º</option>


                                    </select>
                                    <select name="sem" id="SelectSemestre" class="form-control">
                                        <option value="-">Semestre</option>
                                        <option  id="I" value="I">I</option>
                                        <option  id="II" value="II">II</option>

                                    </select>
                                    <select name="anoAcademico" id="" class="form-control">
                                        <option value="-">Ano Acadêmico</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>

                                    </select>
                                    <button id="botonForm" class="btn btn-primary">Fazer Inscrição</button>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>

    <!-----------------------------------------------------------------------------------------------------------

              
               

                  <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Inscrições Feitas</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Ano Curricular</th>
                                    <th>Semestre</th>
                                    <th>Ano Acadêmico</th>
                                    <th>Unidades Curriculares</th>
                                    <th>Resultado</th>


                                </tr>

                            </thead>
                            <tbody >

                            </tbody>

                        </table>
                    </div>
                </div>

    --------------------------------------------------------------------------------------------------------------------------->

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Inscrições Feitas</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Ano Curricular</th>
                                    <th>Semestre</th>
                                    <th>Ano Acadêmico</th>
                                    <th>Unidades Curriculares</th>
                                    <th>Resultado</th>


                                </tr>

                            </thead>
                            <tbody id="inscricoesFeitas">

                            </tbody>

                        </table>
                    </div>
                </div>
             <!--   <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Inscrições em atraso</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Ano Curricular</th>
                                    <th>Semestre</th>
                                    <th>Ano Acadêmico</th>
                                    <th>Unidades Curriculares</th>
                                    <th>Resultado</th>


                                </tr>

                            </thead>
                            <tbody id="inscricoesAtraso">

                            </tbody>

                        </table>
                    </div>
                </div> -->



            </div>
        </div>

    </div>
</div>



</div>
</div>

@section('scripts')
<script>
    var incrementar=0;

    $(document).ready(function() {

        $('#estudanteInsc').select2({

        });


        // $("#selectEstudantes").change(function (event) {
        $("#estudanteInsc").change(function(event) {
            $("#divMainInscricoes").css("visibility", "visible");

            $('#lista').empty();
        incrementar=0;
            // $("#divInscricoes").css("visibility", "visible");
            id = $(this).val();
          
            url = "inscricoesEstudante/" + id + "";
            url2 = "inscricoesAtrasoEstudante/" + id + "";

            urlJsonEstudante = "getJsonEstudante/" + id + "";
            var reprovado = 0;
            var anoCurricularActual = "";
            var semestreActual = "";

            $.getJSON(urlJsonEstudante, function(response, state) {
                imagenInserida = false;
                $("#foto").empty();
                //  $("#inscricoesFeitas").empty();
                $("#nomeEstudante").empty();
                $("#cursoEst").empty();
                $("#bi").empty();
                $("#codigoEst").empty();
                $("#idEst").empty();
                $("#anoActual").empty();
                $("#semestreActual").empty();
            
                $.each(response, function(k, v) {
                    if (!imagenInserida) {
                        pathImage = "../imagenes-perfil/" + v.pathImage;
                        imagem = "<img src=" + '"' + pathImage + '"' + " width=" + '"' + "200px" + '"' + " height=" + '"' + "200px" + '"' + '"' + " />";
                        $("#foto").append(imagem);
                        $("#nomeEstudante").append(" " + v.nome + " " + v.apelido + " ");
                        $("#cursoEst").append(" " + v.nomeCurso);
                        $("#bi").append(" " + v.BI);
                        $("#codigoEst").append(" " + v.codigo);
                        $("#idEst").attr('value', v.id);

                        $("#anoActual").append(" " + v.anoCurricular);
                        $("#semestreActual").append(" " + v.semestre);


                        imagenInserida = true;
                    }
                    anoCurricularActual = v.anoCurricular;
                    semestreActual = v.semestre;

                });

            });

            $.getJSON(url, function(response, state) {
                // imagenInserida = false;
                // $("#foto").empty();
                $("#inscricoesFeitas").empty();
                //  $("#nomeEstudante").empty();
                //   $("#cursoEst").empty();
                //   $("#bi").empty();
                //   $("#codigoEst").empty();
                //   $("#idEst").empty();

                $.each(response, function(k, v) {

                    if (v.estado == null) {
                        reprovado++;
                    }

                    incrementar++;
                    $("#inscricoesFeitas").append(
                        "<tr><td>" +
                        (incrementar) +
                        "</td><td>" +
                        v.anoCurricular +
                        "</td><td>" +
                        v.semestre +
                        "</td><td>" +
                        v.anoAcademico +
                        "</td><td>" +
                        v.nomeDisciplina +
                        "</td><td>" +
                        v.estado +
                        "</td></tr>");




                });
                ano = 0;
                switch (anoCurricularActual) {
                    case "1º":
                        ano = 1;
                        break;
                    case "2º":
                        ano = 2;
                        break;
                    case "3º":
                        ano = 3;
                        break;
                    case "4º":
                        ano = 4;
                        break;

                    default:
                        break;
                }
                if (ano == 1 && semestreActual == "I") {
                    $("#1").attr('disabled', false);
                    $("#II").attr('disabled', false);
                }
                if (ano == 1 && semestreActual == "II") {
                    $("#2").attr('disabled', false);
                    $("#I").attr('disabled', false);
                }
                if (ano == 2 && semestreActual == "I") {
                    $("#2").attr('disabled', false);
                    $("#II").attr('disabled', false);
                }
                if (ano == 2 && semestreActual == "II") {
                    $("#3").attr('disabled', false);
                    $("#I").attr('disabled', false);
                }
                if (ano == 3 && semestreActual == "I") {
                    $("#3").attr('disabled', false);
                    $("#II").attr('disabled', false);
                }
                if (ano == 3 && semestreActual == "II") {
                    $("#4").attr('disabled', false);
                    $("#I").attr('disabled', false);
                }
            });

            $.getJSON(url2, function(response, state) {
                imagenInserida = false;
                // $("#foto").empty();
                $("#inscricoesAtraso").empty();
                //  $("#nomeEstudante").empty();
                //   $("#cursoEst").empty();
                //   $("#bi").empty();
                //   $("#codigoEst").empty();
                //   $("#idEst").empty();

                $.each(response, function(k, v) {
                incrementar++;

                    if (v.estado == null) {
                        reprovado++;
                    }


                    $("#inscricoesFeitas").append(
                        "<tr><td>" +
                        (incrementar) +
                        "</td><td>" +
                        v.anoCurricular +
                        "</td><td>" +
                        v.semestre +
                        "</td><td>" +
                        v.anoAcademico +
                        "</td><td>" +
                        v.nomeDisciplina +
                        "</td><td>" +
                        v.estado +
                        "</td></tr>");




                });


                //  $("#SelectAno option#ano3").attr('disabled','disabled');
                //  $("#SelectAno option#ano4").attr('disabled','disabled');

                // $('#botonForm').prop('disabled', 'disabled');

            });


        });
    });
  
</script>

@endsection

@stop