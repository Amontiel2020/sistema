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

        tr:nth-child(1) {
            background: #dedede;
        }

        p {
            /* font-size: 8px !important;*/
            line-height: 1.0 !important;
        }
    </style>

</head>

<body>

    <div class="container-fluid">
        <!-- primera parte -->
        <div class="row">
            <div class="col-xs-12" align="center">

                <img width="50px" height="50px" src="{{ public_path('imagenes-perfil/logo.png') }}">

                <!--  <p>MINISTERIO DO ENSINO SUPERIOR CIÊNCIA, TECNOLOGIA E INOVAÇÃO</p> -->

                <p><b>ESCOLA SUPERIOR POLITÉCNICA DE BENGUELA</b></p>
                <p> Decreto Presidencial nº 168/12 de 24 de Julho</p>
                <p>Recibo de pagamentos</p>
            </div>

        </div>

        <div class="row">
            <div class="col-xs-9">
                <p><b>Nome do Estudante:</b>&nbsp;{{$estudante->nome}} &nbsp;{{$estudante->apelido}} &nbsp;&nbsp;&nbsp; <b>Nº:</b> &nbsp;{{$estudante->codigo}} </p>
                <p><b>Nº do BI:</b> &nbsp;{{$estudante->BI}} &nbsp;&nbsp;&nbsp; <b> Curso:</b> &nbsp;{{\App\Curso::toString($estudante->curso_id)}} <b> Turma:</b> &nbsp;{{\App\Turma::toString($estudante->turma_id)}} </p>
                <p align="right"><b>Ano Acadêmico:</b>&nbsp; {{\App\CONFIGURACAO::getAnoAcademico()}}</p>
                <p align="right"><b>Data:</b>&nbsp;{{ date('d-m-Y') }}</p>
            </div>

        </div>

        <div class="row">

        <table class="table_test">
                <tr>
                    <th>Designação</th>
                    <th>Mês</th>
                    <th>Valor</th>
                    <th>Taxa</th>
                    <th>Desconto</th>
                    <th>Meio Pagamento</th>
                    <th>Obs</th>
                </tr>
                @foreach($array as $key => $item)
                <tr>


                    <td>

                        {{\App\Emolumento::toString($item->emolumento_id)}}

                    </td>
                    <td>

                        @switch($item->mes)
                        @case(1)
                        <span>Outubro</span>
                        @break
                        @case(2)
                        <span>Novembro</span>
                        @break
                        @case(3)
                        <span>Dezembro</span>
                        @break
                        @case(4)
                        <span>Janeiro</span>
                        @break
                        @case(5)
                        <span>Fevereiro</span>
                        @break
                        @case(6)
                        <span>Março</span>
                        @break
                        @case(7)
                        <span>Abril</span>
                        @break
                        @case(8)
                        <span>Maio</span>
                        @break
                        @case(9)
                        <span>Junho</span>
                        @break
                        @case(10)
                        <span>Julho</span>
                        @break
                        @endswitch

                    </td>
                    <td> {{ number_format($item->valor,2,',','.') }}</td>

                    <td> {{ number_format($item->taxa,2,',','.') }} </td>
                    <td>{{ number_format($item->desconto,2,',','.') }}</td>
                    <th>{{$item->obs}}</th>
                    <th>{{$item->descrip}}</th>

                </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td align="right"><b>Total:</b></td>
                    <td>{{ number_format($total,2,',','.') }}</td>
                    <td>{{ number_format($totalTaxa,2,',','.') }}</td>
                    <td>{{ number_format($totalDesconto,2,',','.') }}</td>
                    <td></td>
                    <td></td>
                    <td></td>

                </tr>
                <tr>
                    <td></td>
                    <td align="right"><b>Total Geral:</b></td>
                    <td>{{ number_format(($total+$totalTaxa)-$totalDesconto,2,',','.') }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>

                </tr>



            </table>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <p><b>Assinatura do estudante</b>______________________________________</p>
            </div>
            <div class="col-md-6">
                <p><b>Nome do funcionário</b>__________________________________________</p>
            </div>
        </div>

        <!-- fin  primera parte -->
        <br>
        <p align="center">Telef. +244 996616277/921226215 - Email: espbenguela@gmail.com Bairro da Graça - Benguela Angola</p>
        <p class="linia">------------------------------------------------------------------------------------------------------
            -------------------------------------------------------------------------------------------------------------------</p>
        <!-- segunda  parte -->


        <div class="row">
            <div class="col-xs-12" align="center">

                <img width="50px" height="50px" src="{{ public_path('imagenes-perfil/logo.png') }}">


                <!--  <p>MINISTERIO DO ENSINO SUPERIOR CIÊNCIA, TECNOLOGIA E INOVAÇÃO</p> -->
                <p><b>ESCOLA SUPERIOR POLITÉCNICA DE BENGUELA</b></p>
                <p> Decreto Presidencial nº 168/12 de 24 de Julho</p>
                <p> Recibo de pagamentos</p>
            </div>

        </div>
        <div class="row">
            <div class="col-xs-9">
                <p><b>Nome do Estudante:</b>&nbsp;{{$estudante->nome}} &nbsp;{{$estudante->apelido}} &nbsp;&nbsp;&nbsp; <b>Nº:</b> &nbsp;{{$estudante->codigo}} </p>
                <p><b>Nº do BI:</b> &nbsp;{{$estudante->BI}} &nbsp;&nbsp;&nbsp; <b> Curso:</b> &nbsp;{{\App\Curso::toString($estudante->curso_id)}} <b> Turma:</b> &nbsp;{{\App\Turma::toString($estudante->turma_id)}} </p>
                <p align="right"><b>Ano Acadêmico:</b>&nbsp;</p>
                <p align="right"><b>Data:</b>&nbsp;{{ date('d-m-Y') }}</p>
            </div>

        </div>


        <div class="row">

        <table class="table_test">
                <tr>
                    <th>Designação</th>
                    <th>Mês</th>
                    <th>Valor</th>
                    <th>Taxa</th>
                    <th>Desconto</th>
                    <th>Meio Pagamento</th>
                    <th>Obs</th>
                </tr>
                @foreach($array as $key => $item)
                <tr>


                    <td>

                        {{\App\Emolumento::toString($item->emolumento_id)}}

                    </td>
                    <td>

                        @switch($item->mes)
                        @case(1)
                        <span>Outubro</span>
                        @break
                        @case(2)
                        <span>Novembro</span>
                        @break
                        @case(3)
                        <span>Dezembro</span>
                        @break
                        @case(4)
                        <span>Janeiro</span>
                        @break
                        @case(5)
                        <span>Fevereiro</span>
                        @break
                        @case(6)
                        <span>Março</span>
                        @break
                        @case(7)
                        <span>Abril</span>
                        @break
                        @case(8)
                        <span>Maio</span>
                        @break
                        @case(9)
                        <span>Junho</span>
                        @break
                        @case(10)
                        <span>Julho</span>
                        @break
                        @endswitch

                    </td>
                    <td> {{ number_format($item->valor,2,',','.') }}</td>

                    <td> {{ number_format($item->taxa,2,',','.') }} </td>
                    <td>{{ number_format($item->desconto,2,',','.') }}</td>
                    <th>{{$item->obs}}</th>
                    <th>{{$item->descrip}}</th>

                </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td align="right"><b>Total:</b></td>
                    <td>{{ number_format($total,2,',','.') }}</td>
                    <td>{{ number_format($totalTaxa,2,',','.') }}</td>
                    <td>{{ number_format($totalDesconto,2,',','.') }}</td>
                    <td></td>
                    <td></td>
                    <td></td>

                </tr>
                <tr>
                    <td></td>
                    <td align="right"><b>Total Geral:</b></td>
                    <td>{{ number_format(($total+$totalTaxa)-$totalDesconto,2,',','.') }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>

                </tr>



            </table>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <p><b>Assinatura do estudante</b>______________________________________</p>
            </div>
            <div class="col-md-6">
                <p><b>Nome do funcionário</b>__________________________________________</p>
            </div>
        </div>

        <p align="center">Telef. +244 996616277/921226215 - Email: espbenguela@gmail.com Bairro da Graça - Benguela Angola</p>

        <!-- fin  segunda  parte -->
    </div>


</body>

</html>