<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <title>Escola Superior Politecnica de Benguela</title>

    <style>
        body {
            font-size: 11px;
            padding-top: 0px;

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

        tr:nth-child(1) {
            background: #dedede;
        }

        p.logo {
            /* font-size: 8px !important;*/
            line-height: 0.1 !important;
        }

        p.descricao {
            /* font-size: 8px !important;*/
            line-height: 2.0 !important;
        }

        .textoLogo {
            padding-top: 10px;
        }
        .imgLogo {
            padding-top: 0px;
        }
    </style>

</head>

<body>

    <div class="container-fluid imgLogo">
        <!-- primera parte -->
        <div class="row">
            <div class="col-xs-12" align="center">

                <div class="imgLogo">
                    <img width="70px" height="70px" src="{{ public_path('imagenes-perfil/logo.png') }}">
                </div>

                <!--  <p>MINISTERIO DO ENSINO SUPERIOR CIÊNCIA, TECNOLOGIA E INOVAÇÃO</p> -->
                <div class="textoLogo">
                    <p class="logo"><b>ESCOLA SUPERIOR POLITÉCNICA DE BENGUELA</b>
                    <p>
                    <p class="logo"> Decreto Presidencial nº 168/12 de 24 de Julho</p>
                    <p class="logo">Bairro da Graça, Benguela - Angola</p>
                </div>




                <h3>Declaração</h3>
            </div>

        </div>

        <div class="row">
            <div class="col-xs-12 descricao">
                <p>Para efeitos de trabalho declara-se às Autoridades a quem o conhecimento desta competir que
                    {{$estudante->nome}} {{$estudante->apelido}} filho de {{$estudante->nomePai}} e {{$estudante->nomeMai}}, nascido aos {{$estudante->dataNac}}, natural de {{\App\Municipio::toString($estudante->municipio_id)}},
                    municipio de {{\App\Municipio::toString($estudante->municipio_id)}}, Provincia de {{\App\Municipio::toString($estudante->provincia_id)}}, portador do BI {{$estudante->BI}}, emitido pelo Arquivo de Identificação de Benguela,
                    válido até {{$estudante->dataValidadeBI}}, matriculado sob o número {{$estudante->codigo}}, concluiu nesta instituição de Ensino Superior o 1º ano
                    curricular do curso {{\App\Curso::toString($estudante->curso_id)}}, no ano academico 2020/2021 cujo rendimento académico se specifica abaixo.
                </p>

            </div>

        </div>

        <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Unidades Curriculares</th>
                        <th>Horas Lectivas</th>
                        <th>Semestre</th>
                        <th>Classificação</th>
                    </tr>
                    @foreach($estudante->inscricoes as $inscricao)
                    @foreach($inscricao->disciplinas as $disciplina)
                    @if(\App\Pauta::obterMediaFinal($estudante->id,$disciplina->id,$inscricao->anoAcademico)>0)
                    <tr>
                        <td>{{$disciplina->nome}}</td>
                        <td>{{$disciplina->HSem}}</td>
                        <td>{{$disciplina->semestre}}</td>
                        <td>{{\App\Pauta::obterMediaFinal($estudante->id,$disciplina->id,$inscricao->anoAcademico)}}</td>

                    </tr>
                    @endif
                    @endforeach
                    @endforeach

                </table>
                <p>Por ser verdade e nos ter sido solicitado, é emitidaa presente declaração que vai assinada
                    e autenticada com o carimbo a óleo em uso nesta instituião.
                    Escola Superior Politécnica de Benguela, em Benguela, aos data.
                </p>


            </div>
        </div>


        <!-- fin  primera parte -->
        <br>
        <p align="center">Telef. 921226215/996616277 - Email: direcao_geral@spb.ao
            INOVAÇÃO-COMPETIVIDADE-MODERNIZAÇÃO
        </p>
    </div>
</body>

</html>