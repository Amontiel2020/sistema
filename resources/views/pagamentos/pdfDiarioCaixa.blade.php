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
                <!--      <p> Decreto Presidencial nº 168/12 de 24 de Julho</p>
                <p>Telef. +244 222711897/994809632/921226215 - Email: espbenguela@gmail.com</p>
                <p> Bairro da Graça - Benguela Angola</p> -->
                <h5> Diario de Caixa <?php echo date('d-m-Y', strtotime($date)) ?></h5>
            </div>

        </div>

        <table class="table_test">

            <tr>
                <!-- <th>Data</th>-->
                <th>Designação</th>
                <th>Estudante</th>
                <th>Mes</th>
                <th>Valor</th>
                <th>Taxa</th>
                <th>Meio Pagamento</th>
                <th>Obs</th>

            </tr>


            @foreach($pagamentos as $pagamento)
            <tr>
                <!--  <td width="7%"><?php echo date('d-m-Y', strtotime($pagamento->created_at)) ?></td>-->
                <td>

                    {{\App\Emolumento::toString($pagamento->emolumento_id)}}


                </td>
                <td>{{\App\Pagamento::toStringEstudante($pagamento->estudante_id)}}</td>
                <td width="7%" align="center">
                    @switch($pagamento->mes)
                    @case(1)
                    <span> Outubro</span>
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
                <td width="7%" align="right">{{number_format($pagamento->valor,2,',','.') }}</td>
                <td width="5%" align="right">{{number_format($pagamento->taxa,2,',','.') }}</td>
                <td width="3%" align="center">
                    {{$pagamento->obs}}

                </td>
                <td>
                    {{$pagamento->descrip}}

                </td>

            </tr>
            @endforeach
            <tr>
                <td colspan="7">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td align="right"><strong>Subtotal:</strong></td>
                <td align="right">{{number_format($total,2,',','.') }}</td>
                <td align="right">{{number_format($totalTaxa,2,',','.') }}</td>
                <!--  <td>{{number_format($totalTPA,2,',','.') }}</td>-->
                <!--      <td>{{number_format($totalTransf,2,',','.') }}</td>-->
                <td colspan="2"></td>


            </tr>
            <tr>
                <td colspan="2"></td>
                <td align="right"><strong>Total Geral:</strong></td>
                <td align="right">{{number_format($total+$totalTaxa,2,',','.') }}</td>
                <td colspan="3"></td>


            </tr>



        </table>
        <br><br>
        <table  align="right">
            <tr>
                <th>Propinas</th>
                <th>Emolumentos</th>
            </tr>
            <tr>
                <td>{{number_format($totalPropinas,2,',','.')}}</td>
                <td>{{number_format($totalEmolumentos,2,',','.')}}</td>
            </tr>
        </table>


    </div>


</body>

</html>