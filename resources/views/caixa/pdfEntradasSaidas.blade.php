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
            text-align: center;
            border: 1px solid #999 !important;
        }

        tr:nth-child(1) {
            background: #dedede;
        }

        p {
            /*  font-size: 8px !important;*/
            line-height: 5px !important;
        }
    </style>

</head>

<body>

    <div class="container">
        <!-- primera parte -->
        <div class="row">
            <div class="col-xs-12" align="center">

                <img width="50px" height="50px" src="{{ public_path('imagenes-perfil/logo.png') }}">


                <!--  <p>MINISTERIO DO ENSINO SUPERIOR CIÊNCIA, TECNOLOGIA E INOVAÇÃO</p> -->
                <p><b>ESCOLA SUPERIOR POLITÉCNICA DE BENGUELA</b></p>
                <p> Decreto Presidencial nº 168/12 de 24 de Julho</p>
                <p>NIF-5401154836</p>


            </div>

        </div>
        <h3>Diario de Banco Referente à {{$stringMes}} de {{$ano}}</h3>
        <hr>

        <div class="row">
            <div class="col-xs-12">
                <div class="table-responsive">
                    @if($collection!=null)
                    <table class="table table-bordered table-striped">

                        <tr>
                            <th>Nª /ord</th>
                            <th>Data</th>
                            <th>Descrição</th>
                            <th>Recebimentos</th>
                            <th>Pagamentos</th>

                        </tr>

                        @foreach($collection as $i=>$item)
                        <tr>
                            <td>{{$i+1}}</td>
                            <td><?php echo date('d-m-Y', strtotime($item->created_at)) ?>

                            </td>
                            <td>
                                {{$item->descricao}}
                            </td>
                            <td align="right">
                                @if($item->descricao=="Propinas e Emolumentos")
                                {{number_format($item->valor,2,',','.')}}
                                @endif
                            </td>
                            <td align="right">
                                @if($item->descricao!="Propinas e Emolumentos")
                                {{number_format($item->valor,2,',','.')}}
                                @endif
                            </td>

                        </tr>
                        @endforeach
                        <tr>
                            <td align="right" colspan="3"><b>Total:</b></td>
                            <td align="right"> {{number_format($totalPagamentos,2,',','.')}}</td>
                            <td align="right">{{number_format($totalDispesas,2,',','.')}}</td>


                        </tr>
                        <tr>
                            <td  colspan="5"></td>
                        </tr>
                        <tr>
                            <td  colspan="3"></td>
                            <th align="right">Saldo Folha Anterior</th>
                            <td></td>
                        </tr>
                        <tr>
                            <td  colspan="3"></td>
                            <th align="right">Total Recebimentos</th>
                            <td align="right">{{number_format($totalPagamentos,2,',','.')}}</td>
                        </tr>
                        <tr>
                            <td  colspan="3"></td>
                            <th align="right">Subtotal</th>
                            <td></td>
                        </tr>
                        <tr>
                            <td  colspan="3"></td>
                            <th align="right">Total Pagamentos</th>
                            <td align="right">{{number_format($totalDispesas,2,',','.')}}</td>
                        </tr>
                        <tr>
                            <td  colspan="3"></td>
                            <th align="right">Saldo Final</th>
                            <td></td>
                        </tr>

                    </table>

                    @endif

                </div>

            </div>
        </div>




    </div>


</body>

</html>