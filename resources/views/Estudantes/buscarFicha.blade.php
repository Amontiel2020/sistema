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
            <h3>Selecione o estudante para ver a Ficha</h3>
        </div>
        <div class="panel-body">
            <form action="{{route('mostrarFicha')}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                {!! Form::select('estudanteFicha',$listaEstudantes,null,['id'=>'estudanteFicha','style'=>'width: 50%']) !!}
                <button type="submit" class="btn btn-primary">Enviar</button>

            </form>
        </div>
    </div>
    @if(isset($estudante))
    <div id=divMainInscricoes>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Ficha de estudante</h3>
            </div>
            <div class="panel-body">
                <div class="row">

                    <div class="row">
                        <div class="col-xs-12" align="center">

                            <img width="100px" height="100px" src="{{url('/storage/'.'logo.png') }}">

                            <!--  <p>MINISTERIO DO ENSINO SUPERIOR CIÊNCIA, TECNOLOGIA E INOVAÇÃO</p> -->

                            <p><b>ESCOLA SUPERIOR POLITÉCNICA DE BENGUELA</b></p>
                            <p><b> Decreto Presidencial nº 168/12 de 24 de Julho</b></p>
                            <p><b>Bairro da Graça, Benguela - A n g o l a</b></p>

                        </div>



                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <img width="150px" height="150px" src="{{url('/storage/'.$estudante->pathImage) }}" alt="">
                        <br>
                        <p>Nº Estudante: {{$estudante->codigo}}</p>
                    </div>
                    <div class="col-md-8">
                        <br>
                        <br>
                        <div style="font-size: large;">
                            <p><b>Curso:</b>&nbsp;{{\App\Curso::toString($estudante->curso_id)}}</p>
                            <p><b>Nome:</b>&nbsp;{{$estudante->nome}}&nbsp;{{$estudante->apelido}}</p>
                            <p><b>Filhação:</b>&nbsp;{{$estudante->nomePai}} e {{$estudante->nomeMai}} </p>
                            <p><b>Natural de:</b>&nbsp;{{$estudante->naturalDe}}&nbsp;&nbsp;<b>Munícipio de:</b> {{$estudante->naturalDe}} </p>
                            <p> <b>Província de:</b>&nbsp;{{$estudante->provRecidencia}}&nbsp;&nbsp;<b>Nascido em: </b> {{$estudante->dataNac}}</p>
                          <!--  <p><b>Matrícula</b><b>&nbsp;Renovação da Matrícula*</b></p>-->
                        </div>


                    </div>
                </div>

                <br>
               <a class="btn btn-primary btn-sm" href="{{route('pdf_fichaEstudante',$estudante->id)}}">Gerar PDF</a>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th></th>
                        <th colspan="2">INSCRIÇÕES</th>
                        <th></th>
                        <th></th>
                        <th colspan="3">FREQUENCIA</th>
                        <th></th>
                        <th colspan="3">EXAMES</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>Ano curricular</th>
                        <th>Nº</th>
                        <th>Ano Acadêmico</th>
                        <th>UNIDADE CURRICULAR</th>
                        <th>SEMESTRE</th>
                        <th>F1</th>
                        <th>F2</th>
                        <th>MAC</th>
                        <th>M</th>
                        <th>Ex1</th>
                        <th>Ex2</th>
                        <th>Ex3</th>
                        <th>MÉDIA FINAL</th>
                        <th>CONFIRMADO POR</th>
                        <th>OBSERVAÇÕES</th>
                    </tr>

                    @foreach($estudante->inscricoes as $inscricao)
                    @foreach($inscricao->disciplinas as $i=> $disciplina)
                    <tr>
                        <td>{{$disciplina->ano}}</td>
                        <td>{{$i+1}}</td>
                        <td>
                            {{$inscricao->anoAcademico}}
                        <a href="#" class="editAno" data-pk="{{$inscricao->id}}">{{$inscricao->anoAcademico}}</a>
                        </td>
                        <td>
                            {{\App\Disciplina::toString($disciplina->pivot->disciplina_id)}}

                        </td>
                        <td align="center">{{$disciplina->semestre}}</td>
                        <td>{{\App\Pauta::obterAvaliacao($estudante->id,$disciplina->id,"F1",$inscricao->anoAcademico)}}</td>
                        <td>{{\App\Pauta::obterAvaliacao($estudante->id,$disciplina->id,"F2",$inscricao->anoAcademico)}}</td>
                        <td>{{\App\Pauta::obterAvaliacao($estudante->id,$disciplina->id,"MAC",$inscricao->anoAcademico)}}</td>
                        <td>{{ round(\App\Pauta::obterMedia($estudante->id,$disciplina->id,$inscricao->anoAcademico), 0, PHP_ROUND_HALF_UP)}}</td>
                        <td>{{\App\Pauta::obterAvaliacao($estudante->id,$disciplina->id,"Ex1",$inscricao->anoAcademico)}}</td>
                        <td>{{\App\Pauta::obterAvaliacao($estudante->id,$disciplina->id,"Ex2",$inscricao->anoAcademico)}}</td>
                        <td>{{\App\Pauta::obterAvaliacao($estudante->id,$disciplina->id,"Ex3",$inscricao->anoAcademico)}}</td>
                        <td>{{\App\Pauta::obterMediaFinal($estudante->id,$disciplina->id,$inscricao->anoAcademico)}}</td>
                        <td></td>
                        <td></td>

                    </tr>


                    @endforeach
                    @endforeach


            </div>
        </div>

    </div>
</div>



</div>
</div>
@endif

@section('scripts')
<script>
    $(document).ready(function() {

        $('#estudanteFicha').select2({

        });


        // $("#selectEstudantes").change(function (event) {
        $("#estudanteInsc").change(function(event) {
            $("#divMainInscricoes").css("visibility", "visible");

            $('#lista').empty();
            // $("#divInscricoes").css("visibility", "visible");
            id = $(this).val();
            url = "inscricoesEstudante/" + id + "";

            $.getJSON(url, function(response, state) {
                imagenInserida = false;
                $("#foto").empty();
                $("#inscricoesFeitas").empty();
                $("#nomeEstudante").empty();
                $("#cursoEst").empty();
                $("#bi").empty();
                $("#codigoEst").empty();
                $("#idEst").empty();


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



                        imagenInserida = true;
                    }



                    $("#inscricoesFeitas").append(
                        "<tr><td>" +
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
            });
        });
    });
</script>
<script>

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });

        $('.editAno').editable({
            url: '{{url("inscricoes/updateAno")}}',
            title: 'Actualizar',
            success: function(response, newValue) {
                console.log('Updated', response)
            }
        });
 


   




    });
</script>
@endsection

@stop