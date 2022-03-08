<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->

    <title>Escola Superior Politecnica de Benguela</title>
    <style>
        body {
            font-size: 10px;
        }

        .linia {
            width: 990px;
            border-left: 0px !important;
            border-right: 0px !important;
            
        }

        .sinpadding [class*="col-"] {
            padding: 0;
        }

        table {
            border: none;
            width: 100%;
            border-collapse: collapse;
            /* font-size: 8px !important;*/
        }

        td,
        th {
            /* padding: 1px 2px !important;*/
            /* text-align: center;*/
            border: 1px solid #999 !important;
        }

        p {
            /* font-size: 8px !important;*/
            line-height: 1.0 !important;
        }
    </style>


</head>

<body>
    <div id=divMainInscricoes>
        <div class="panel panel-default">
            <div class="panel-heading">

            </div>
            <div class="panel-body">
                <div class="row">

                    <div class="row">
                        <div class="col-xs-12" align="center">

                            <!-- <img width="100px" height="100px" src="{{url('/storage/'.'logo.png') }}">-->
                            <p><b>ESCOLA SUPERIOR POLITÉCNICA DE BENGUELA</b></p>
                            <p><b> Decreto Presidencial nº 168/12 de 24 de Julho</b></p>
                            <p><b>Bairro da Graça, Benguela - A n g o l a</b></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                     <div style="float: left;">
                        <div>
                            <p><b>Nome:</b>&nbsp;{{$estudante->nome}}&nbsp;&nbsp;&nbsp;&nbsp;<b>Curso:</b>&nbsp;{{\App\Curso::toString($estudante->curso_id)}}</p>
                            <p><b>Nome do Pai:</b>&nbsp;{{$estudante->nomePai}} &nbsp;&nbsp;<b>Nome da Mae:</b>&nbsp; {{$estudante->nomeMai}}&nbsp;&nbsp;&nbsp;&nbsp; <b>Provincia:</b>&nbsp;{{$estudante->provRecidencia}}&nbsp;&nbsp;<b>Munícipio:</b> {{$estudante->munRecidencia}}</p>

                        </div>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>

                <div>
                    <table class="table">
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
                            <th>Ano Curricular</th>
                            <th>Nº</th>
                            <th>Ano Académico</th>
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
                        <tr align="center">
                            <td width="2%">{{$disciplina->ano}}</td>
                            <td width="2%">{{$i+1}}</td>
                            <td width="2%">{{$inscricao->anoAcademico}}</td>
                            <td width="30%" align="left">
                                {{\App\Disciplina::toString($disciplina->pivot->disciplina_id)}}

                            </td>
                            <td>{{$disciplina->semestre}}</td>
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
                    </table>
                </div>
            </div>
        </div>

    </div>
</body>

</html>