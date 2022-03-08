<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">



    <title>Escola Superior Politecnica de Benguela</title>

    <style>
        body {
            font-size: 10px;
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

        .table_test {
            border: none;
            width: 100%;
            border-collapse: collapse;
            /* font-size: 8px !important;*/
        }

        td,
        th {
            padding: 1px 2px !important;
            /* text-align: center;*/
            border: 1px solid #999 !important;
        }

       /* tr:nth-child(1) {
            background: #dedede;
        }*/

        p {
            /* font-size: 8px !important;*/
            line-height: 1.0 !important;
        }
    </style>

</head>

<body>

    <div class="container">
        <!-- primera parte -->
        <div class="row">
            <div class="col-xs-1">
                <img width="60px" height="60px" src="{{ public_path('imagenes-perfil/logo.png') }}">
            </div>
            <div class="col-xs-10">
                <h4>ESCOLA SUPERIOR POLITÉCNICA DE BENGUELA</h4>
                <p > Decreto Presidencial nº 168/12 de 24 de Julho</p>
            </div>


        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-8">
                            <p>COMPROVATIVO DE MATRICULA</p>
                        </div>
                        <div class="col-xs-4">
                            <p><b>Data:</b>&nbsp;{{ date('d-m-Y') }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <p><b>Nome do Estudante:</b>&nbsp;{{$inscricao->estudante->nome}} &nbsp;{{$inscricao->estudante->apelido}} &nbsp;&nbsp;&nbsp; <b>Nº de Estudante:</b> &nbsp;{{$inscricao->estudante->codigo}} </p>
                        </div>
                        <div class="col-xs-4">
                            <p><b>Nº do BI:</b> &nbsp;{{$inscricao->estudante->BI}} &nbsp;&nbsp;&nbsp; </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <p><b>Curso:</b>&nbsp;{{\App\Curso::toString($inscricao->estudante->curso_id)}} &nbsp;&nbsp;&nbsp; <b>Turma:</b> &nbsp;{{\App\Turma::toString($inscricao->estudante->turma_id)}} </p>
                        </div>

                    </div>

                </div>

            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <p><b>Resumo da matricula</b></p>
                    <table class="table_test">
                        <tr>
                            <th align="center">Nº</th>
                            <th>Unidad Curricular</th>
                            <th align="center">Ano</th>
                            <th align="center">Semestre</th>
                        </tr>
                        @foreach($inscricao->disciplinas as $i=>$disciplina)
                        <tr align="center">
                            <td>{{$i+1}}</td>
                            <td align="left">{{$disciplina->nome}}</td>
                            <td>{{$disciplina->ano}}</td>
                            <td>{{$disciplina->semestre}}</td>
                        </tr>
                        @endforeach
                    </table>


                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <p><b>Assinatura do estudante</b>__________________________________________</p>
                </div>
                <div class="col-xs-6">
                    <p><b>Nome do funcionário</b>_____________________________________________</p>
                </div>
            </div>
        </div>

        <!-- fin  primera parte -->

        <p align="center">Telef. +244 996616277/921226215 - Email: espbenguela@gmail.com Bairro da Graça - Benguela Angola</p>
        <p class="linia">------------------------------------------------------------------------------------------------------
            -------------------------------------------------------------------------------------------------------------------</p>
        <!-- segunda  parte -->



        <div class="row">
            <div class="col-xs-1">
                <img width="60px" height="60px" src="{{ public_path('imagenes-perfil/logo.png') }}">
            </div>
            <div class="col-xs-10">
                <h4 >ESCOLA SUPERIOR POLITÉCNICA DE BENGUELA</h4>
                <p > Decreto Presidencial nº 168/12 de 24 de Julho</p>
            </div>


        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-8">
                            <p>COMPROVATIVO DE MATRICULA</p>
                        </div>
                        <div class="col-xs-4">
                            <p><b>Data:</b>&nbsp;{{ date('d-m-Y') }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <p><b>Nome do Estudante:</b>&nbsp;{{$inscricao->estudante->nome}} &nbsp;{{$inscricao->estudante->apelido}} &nbsp;&nbsp;&nbsp; <b>Nº de Estudante:</b> &nbsp;{{$inscricao->estudante->codigo}} </p>
                        </div>
                        <div class="col-xs-4">
                            <p><b>Nº do BI:</b> &nbsp;{{$inscricao->estudante->BI}} &nbsp;&nbsp;&nbsp; </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <p><b>Curso:</b>&nbsp;{{\App\Curso::toString($inscricao->estudante->curso_id)}} &nbsp;&nbsp;&nbsp; <b>Turma:</b> &nbsp;{{\App\Turma::toString($inscricao->estudante->turma_id)}} </p>
                        </div>

                    </div>

                </div>

            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <p><b>Resumo da matricula</b></p>
                    <table class="table_test">
                        <tr>
                            <th align="center">Nº</th>
                            <th>Unidad Curricular</th>
                            <th align="center">Ano</th>
                            <th align="center">Semestre</th>
                        </tr>
                        @foreach($inscricao->disciplinas as $i=>$disciplina)
                        <tr align="center">
                            <td>{{$i+1}}</td>
                            <td align="left">{{$disciplina->nome}}</td>
                            <td>{{$disciplina->ano}}</td>
                            <td>{{$disciplina->semestre}}</td>
                        </tr>
                        @endforeach
                    </table>


                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <p><b>Assinatura do estudante</b>__________________________________________</p>
                </div>
                <div class="col-xs-6">
                    <p><b>Nome do funcionário</b>_____________________________________________</p>
                </div>
            </div>
        </div>
        <p align="center">Telef. +244 996616277/921226215 - Email: espbenguela@gmail.com Bairro da Graça - Benguela Angola</p>

        <!-- fin  segunda  parte -->
    </div>


</body>

</html>