<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Escola Superior Politecnica de Benguela</title>
    <style>
        body {
            font-size: 11px;
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

        td,
        th {
            padding: 1px 2px !important;
            /* text-align: center;*/
            border: 1px solid #999 !important;
        }

        tr:nth-child(1) {
            background: #dedede;
        }

        p {
            /* font-size: 8px !important;*/
            line-height: 1.0 !important;
        }

        p.logo {
            /* font-size: 8px !important;*/
            line-height: 0.5 !important;
        }

        label {

            padding-left: 15px;
            text-indent: -5px;
            vertical-align: 5px;

        }

        input {
            width: 13px;
            height: 13px;
            padding-top: 0;
            margin: 0;
            vertical-align: center;
            position: relative;
            top: -1px;
            *overflow: hidden;
        }

    </style>

</head>

<body>
    <!-- primera parte -->
    <div class="row">
        <div class="col-xs-12" align="center">

            <img width="50px" height="50px" src="{{ public_path('imagenes-perfil/logo.png') }}">

            <!--  <p>MINISTERIO DO ENSINO SUPERIOR CIÊNCIA, TECNOLOGIA E INOVAÇÃO</p> -->
            <p class="logo"><b>ESCOLA SUPERIOR POLITÉCNICA DE BENGUELA</b></p>
            <p class="logo"> Decreto Presidencial nº 168/12 de 24 de Julho</p>
            <p class="logo"> Bairro da Graça ,Benguela-Angola</p>

            <p> <b>Resultados do Exame de Admissão</b></p>
        </div>

    </div>
    <p><b>Curso:&nbsp;</b> {{ \App\Curso::toString($curso) }} &nbsp; &nbsp;&nbsp; &nbsp;<b>Ano
            Lectivo:&nbsp;</b>2021/2022 </p>

    <p>Data_____/_____/_____ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;


    </p>

    <table class="table">
        <tr>
            <th></th>
            <th></th>
            <th colspan="2">Classificação</th>
            <th></th>

        </tr>
        <tr>
            <th>Nº</th>
            <th>Nome Completo</th>
             @foreach (\App\Candidato::obterExames($curso) as $exame)
                <th>{{ $exame->nome }}</th>

            @endforeach
            <th>Estado</th>
        </tr>
        @foreach ($candidatos as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $item->nomeCompleto }} </td>
                @foreach (\App\Candidato::obterExames($curso) as $exame)
                    @if ($item->obterAvaliacoes($item->id, 1)->isEmpty())
                        <td></td>
                    @else
                        @foreach ($item->obterAvaliacoes($item->id, 1) as $aval)
                            @if ($aval->exame->id == $exame->id)
                                <td align="center">{{round( $aval->valor, 0, PHP_ROUND_HALF_UP)}}</td>
                                
                            @endif
                        @endforeach
                    @endif
                @endforeach


                <td>
                    {{ $item->estado }}
                </td>
            </tr>
        @endforeach
    </table>
    <div class="row">
        <div class="col-xs-12">

            <p><b>Funcionário</b>__________________________________________</p>
            <p><b>Pela Área Académica</b>___________________________________</p>

        </div>
    </div>

</body>

</html>
