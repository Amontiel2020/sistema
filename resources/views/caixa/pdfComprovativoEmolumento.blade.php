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
            /* padding: 1px 2px !important;*/
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
                <p><b>Nome do Estudante:</b>&nbsp;{{$estudante->nome}} &nbsp;{{$estudante->apelido}} &nbsp;&nbsp;&nbsp; <b>Nº:</b> &nbsp;{{$estudante->id}} </p>
                <p><b>Nº do BI:</b> &nbsp;{{$estudante->BI}} &nbsp;&nbsp;&nbsp; <b> Curso:</b> &nbsp;{{$estudante->curso}} <b> Turma:</b> &nbsp;{{\App\Turma::toString($estudante->turma_id)}} </p>
                <p align="right"><b>Ano Acadêmico:</b>&nbsp;{{ $anoLectivo }}</p>
                <p align="right"><b>Data:</b>&nbsp;{{ date('d-m-Y H:i:s') }}</p>
            </div>
            <!--  <div class="col-xs-3">
                <p><b>Ano Acadêmico:</b>&nbsp;{{ $anoLectivo }}</p>
                <p><b>Data:</b>&nbsp;{{ date('d-m-Y H:i:s') }}</p>
            </div>-->
        </div>

        <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Designação</th>
                        <th>Valor</th>
                        <th>Meio Pagamento</th>
                        <th>Data Pagamento</th>
                        <th>Obs</th>

                    </tr>
                    @foreach($array as $key => $item)
                    <tr>

                        <td>
                            {{\App\Emolumento::toString($item->idEmolumento)}}

                        </td>

                        <td> {{ number_format($item->valor,2,',','.') }}</td>
                        <td>{{item->obs}}</td>
                        <td><?php echo date('d-m-Y', strtotime($dataPagamento)) ?></td>
                        <td>{{$item->descrip}}</td>

                    </tr>
                    @endforeach
                    <tr>
                        <td align="right"><b>Total:</b></td>
                        <td> {{ number_format($total,2,',','.') }}</td>
                        <td></td>
                    </tr>
                </table>
                <p><b>Asinatura do estudante</b>__________________________________________</p>
                <p><b>Nome do funcionário</b>_____________________________________________</p>

            </div>
        </div>


        <!-- fin  primera parte -->
        <br>
        <p align="center">Telef. +244 222711897/994809632/921226215 - Email: espbenguela@gmail.com Bairro da Graça - Benguela Angola</p>
        <p class="linia">------------------------------------------------------------------------------------------------------
            -------------------------------------------------------------------------------------------------------------------</p>
        <!-- segunda  parte -->


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
                <p><b>Nome do Estudante:</b>&nbsp;{{$estudante->nome}} &nbsp;{{$estudante->apelido}} &nbsp;&nbsp;&nbsp; <b>Nº:</b> &nbsp;{{$estudante->id}} </p>
                <p><b>Nº do BI:</b> &nbsp;{{$estudante->BI}} &nbsp;&nbsp;&nbsp; <b> Curso:</b> &nbsp;{{$estudante->curso}} <b> Turma:</b> &nbsp;{{\App\Turma::toString($estudante->turma_id)}} </p>
                <p align="right"><b>Ano Acadêmico:</b>&nbsp;{{ $anoLectivo }}</p>
                <p align="right"><b>Data:</b>&nbsp;{{ date('d-m-Y H:i:s') }}</p>
            </div>
            <!--  <div class="col-xs-3">
                <p><b>Ano Acadêmico:</b>&nbsp;{{ $anoLectivo }}</p>
                <p><b>Data:</b>&nbsp;{{ date('d-m-Y H:i:s') }}</p>
            </div>-->
        </div>

        <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Designação</th>
                        <th>Valor</th>
                        <th>Meio Pagamento</th>
                        <th>Data Pagamento</th>
                        <th>Obs</th>

                    </tr>
                    @foreach($array as $key => $item)
                    <tr>

                        <td>
                            {{\App\Emolumento::toString($item->idEmolumento)}}

                        </td>

                        <td> {{ number_format($item->valor,2,',','.') }}</td>
                        <td>{{item->obs}}</td>
                        <td><?php echo date('d-m-Y', strtotime($dataPagamento)) ?></td>
                        <td>{{$item->descrip}}</td>

                    </tr>
                    @endforeach
                    <tr>
                        <td align="right"><b>Total:</b></td>
                        <td> {{ number_format($total,2,',','.') }}</td>
                        <td></td>
                    </tr>
                </table>
                <p><b>Asinatura do estudante</b>__________________________________________</p>
                <p><b>Nome do funcionário</b>_____________________________________________</p>

            </div>
        </div>

        <!-- fin  segunda  parte -->
    </div>


</body>

</html>