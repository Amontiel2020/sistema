<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Escola Superior Politecnica de Benguela</title>

    <style>
        body {
            font-size: 11px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .linia {
            width: 990px;
            border-left: 0px !important;
            border-right: 0px !important;
            ;
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

        .table2 {
            border: none;
            width: 30%;
            border-collapse: collapse;
            /* font-size: 8px !important;*/
        }

        td,
        th {
            padding: 1px 2px !important;
            text-align: center;
            border: 1px solid #999 !important;
        }



        p {
            /*  font-size: 8px !important;*/
            line-height: 5px !important;
        }

        @page {
            margin-top: 25px !important;
            margin-left: 50px !important;
            margin-right: 50px !important;
        }
    </style>

</head>

<body>

    <div id="div_top" align="center">

        <img width="75px" height="75px" src="{{ public_path('imagenes-perfil/logo.png') }}">

        <p><b>ESCOLA SUPERIOR POLITÉCNICA DE BENGUELA</b></p>
        <p> Decreto Presidencial nº 168/12 de 24 de Julho</p>
        <p>Telef. +244222711897/ 994809632/92122621 - Email: espbenguela@gmail.com</p>

    </div>



    <div>
        <div class="row">
            <div class="col-xs-8">

                <p align="center"><b>PAUTA DE APROVEITAMENTO</b></p>

                <p><b>Ano Académico:</b>&nbsp;2020/2021&nbsp;&nbsp; <b>Semestre:</b>&nbsp;{{$pauta->semestre}}&nbsp;&nbsp; <b>Data:</b>&nbsp;{{ date('d.m.Y') }}</p>
                <p><b>Curso:</b>&nbsp;{{$curso}}&nbsp;&nbsp;<b>Turma:</b>&nbsp;{{$turma}}&nbsp;&nbsp; <b>Ano curricular:</b>&nbsp;{{$pauta->ano}}</p>
                <p><b>Unidade Curricular:</b>&nbsp; {{\App\Disciplina::toString($pauta->disciplina_id)}}&nbsp;&nbsp; &nbsp;&nbsp;<b>Natureza:</b>&nbsp; {{$nuclear}}</p>

                <p><b>Nome do Professor:</b>&nbsp; {{\App\Professor::toString($pauta->professor_id)}}</p>
                <p align="right"><b>Área Académica</b>_____________________________________________</p>

            </div>
            <div class="col-xs-4">

                <!--  <table >
                    <tr>
                        <td>Estatistica (%)</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Inscritos</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Avaliados</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Aprovados </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Reprovados</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Não avaliados</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Aprovados / %</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Reprovados /%</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Aproveitamento /%</td>
                        <td></td>
                    </tr>
                </table> -->
            </div>

        </div>

        <div class="row">
            <div class="col-xs-12">
                <div align="center">
                    <table class="table table-bordered table-striped ">
                        <tr>
                            <th colspan="2"></th>
                            <th colspan="3">Frequências</th>
                            <th></th>
                            <th colspan="3">EXAMES</th>
                            <th colspan="2">Resultado da média final</th>
                        </tr>
                        <tr>
                            <th>Nº</th>
                            <th>Nome do Aluno</th>
                            <th>F1</th>
                            <th>F2</th>
                            <th>MAC</th>
                            <th>M</th>
                            <th>EX1</th>
                            <th>EX2</th>
                            <th>EX3</th>
                            <th>MF</th>
                            <th>Resultado</th>
                        </tr>


                        @foreach($estudantes as $item)
                        @if($item->cantidadMesesPagos(2021)>3)

                        <tr>
                            <td>{{ $i++ }}</td>
                            <td style=" text-align: left;">{{$item->nome}} {{$item->apelido}}</td>
                            <td>
                                @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"F1",$anoAcad)!="")
                                {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"F1",$anoAcad),1)}}
                                @endif

                            </td>
                            <td>

                                @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"F2",$anoAcad)!="")
                                {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"F2",$anoAcad),1)}}
                                @endif

                            </td>
                            <td>

                                @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"MAC",$anoAcad)!="")
                                {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"MAC",$anoAcad),1)}}
                                @endif

                            </td>
                            <td>{{\App\Pauta::obterMedia($item->id,$idDisc,$anoAcad)}}</td>
                            <td>

                                @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex1",$anoAcad)!="")
                                {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex1",$anoAcad),1)}}
                                @endif

                            </td>
                            <td>

                                @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex2",$anoAcad)!="")
                                {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex2",$anoAcad),1)}}
                                @endif

                            </td>
                            <td>

                                @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex3",$anoAcad)!="")
                                {{number_format(\App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex3",$anoAcad),1)}}
                                @endif

                            </td>
                            <td>
                                {{round(\App\Pauta::obterMediaFinal($item->id,$idDisc,$anoAcad), 0, PHP_ROUND_HALF_UP)}}



                            </td>
                            <td>
                                @if(round(\App\Pauta::obterMediaFinal($item->id,$idDisc,$anoAcad), 0, PHP_ROUND_HALF_UP)>=10)
                                @if(strcmp($item->genero,"Masculino")==0)
                                Aprovado
                                @endif
                                @if(strcmp($item->genero,"Feminino")==0)
                                Aprovada
                                @endif
                                @endif
                                @if((round(\App\Pauta::obterMediaFinal($item->id,$idDisc,$anoAcad), 0, PHP_ROUND_HALF_UP)<10) && ( \App\Pauta::obterAvaliacao($item->id,$idDisc,"F1",$anoAcad)!=""
                                    || \App\Pauta::obterAvaliacao($item->id,$idDisc,"F2",$anoAcad)!=""
                                    || \App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex1",$anoAcad)!=""
                                    || \App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex2",$anoAcad)!=""
                                    || \App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex3",$anoAcad)!=""
                                    )

                                    )
                                    @if(strcmp($item->genero,"Masculino")==0)
                                    <span style="color:red">Recurso</span>
                                    @endif
                                    @if(strcmp($item->genero,"Feminino")==0)
                                    <span style="color:red">Recurso</span>
                                    @endif

                                    @endif

                                    @if(\App\Pauta::obterAvaliacao($item->id,$idDisc,"F1",$anoAcad)==""
                                    && \App\Pauta::obterAvaliacao($item->id,$idDisc,"F2",$anoAcad)==""
                                    && \App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex1",$anoAcad)==""
                                    && \App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex2",$anoAcad)==""
                                    && \App\Pauta::obterAvaliacao($item->id,$idDisc,"Ex3",$anoAcad)==""
                                    )
                                    @if(strcmp($item->genero,"Masculino")==0)
                                    <span style="color:red">Não Avaliado</span>
                                    @endif
                                    @if(strcmp($item->genero,"Feminino")==0)
                                    <span style="color:red">Não Avaliada</span>
                                    @endif
                                    @endif
                            </td>
                        </tr>

                        @endif




                        @endforeach

                    </table>
                </div>

                <p><b>Legenda</b></p>

                <p>F1=Primeira Frequência;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;F2=Segunda Frequência;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MAC=Média das Avaliações Contínuas;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MF=Média Final;</p>
                <p>EX1=Exame da primeira Época;&nbsp;&nbsp;&nbsp;&nbsp;EX2=Exame da Segunda Época;&nbsp;&nbsp;&nbsp;&nbsp;EX3=Exame da Época Especial;</p>
                <p>M=Média das Frequências e Avaliação Contínua;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$turma}}:&nbsp;&nbsp;{{\App\Turma::getDescricao($turma)}} </p>

                <p><b>Cálculo da Média</b></p>
                <p>M=F1+F2+MAC/3 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MF=(M x 0,4) + (EX1 ou EX2 ou EX3 x 0,6) </p>
                <br>
                <!--
                <div style="float: left;">
                    <table class="table2">
                        <tr>
                            <th colspan="2">Estatistica</th>
                        </tr>
                        <tr>
                            <td width="40%">Inscritos</td>
                            <td width="10%">{{$i+1}}</td>
                        </tr>
                        <tr>
                            <td width="40%">Avaliados</td>
                            <td width="10%">{{\App\Pauta::obter_avaliados($estudantes,$idDisc,$anoAcad)}}</td>
                        </tr>
                        <tr>
                            <td width="40%">Aprovados</td>
                            <td width="10%">{{\App\Pauta::obter_aprovados($estudantes,$idDisc,$anoAcad)}}</td>
                        </tr>
                        <tr>
                            <td width="40%">Reprovados</td>
                            <td width="10%">{{\App\Pauta::obter_reprovados($estudantes,$idDisc,$anoAcad)}}</td>
                        </tr>
                        <tr>
                            <td width="40%">Não Avaliados</td>
                            <td width="10%">{{\App\Pauta::obter_nao_avaliados($estudantes,$idDisc,$anoAcad)}}</td>
                        </tr>
                        <tr>
                            <td width="40%">Aprovados %</td>
                            <td width="10%">
                                @if(\App\Pauta::obter_aprovados($estudantes,$idDisc,$anoAcad)>0)
                                {{round(((\App\Pauta::obter_aprovados($estudantes,$idDisc,$anoAcad)*100)/($i+1)), 0, PHP_ROUND_HALF_UP)}}%

                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td width="40%">Reprovados %</td>
                            <td width="10%">
                                @if(\App\Pauta::obter_reprovados($estudantes,$idDisc,$anoAcad)>0)
                                {{round(((\App\Pauta::obter_reprovados($estudantes,$idDisc,$anoAcad)*100)/($i)), 0, PHP_ROUND_HALF_UP)}}%

                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td width="40%">Aproveitamento %</td>
                            <td width="10%">
                                {{round(
                            ((\App\Pauta::obter_aprovados($estudantes,$idDisc,$anoAcad))*100)
                            /
                            (\App\Pauta::obter_avaliados($estudantes,$idDisc,$anoAcad)), 0, PHP_ROUND_HALF_UP)}}%

                            </td>
                        </tr>
                    </table>
                </div>
                                -->
                <div style="float: left; padding-left: 15px;">
                    <p><span align="left"><b>O Docente da Unidade Curricular</b>_________________________________________________</span></p>
                    <p><span align="left"><b>O Coordenador do Curso</b>________________________________________________________</span></p>
                </div>

            </div>
        </div>



    </div>
</body>

</html>