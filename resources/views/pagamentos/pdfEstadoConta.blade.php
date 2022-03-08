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
                <h5> Estado de Conta</h5>
            </div>

        </div>
        <hr>


        <div class="row">
            <div class="col-xs-12">
                <p><b>Nome do Estudante:</b> &nbsp;{{$estudante->nome}} &nbsp;{{$estudante->apelido}} &nbsp;&nbsp;&nbsp; <b>Nº do Estudante:</b> &nbsp;{{$estudante->codigo}} </p>
                <p><b>Nº do BI:</b> &nbsp;{{$estudante->BI}} &nbsp;&nbsp;&nbsp; <b> Curso:</b> &nbsp;{{$estudante->curso}} <b> Turma:</b> &nbsp;{{\App\Turma::toString($estudante->turma_id)}}</p>

                <div class="text-rigth">

                    <p class="text-right"><b>Data:</b>{{ date('d-m-Y H:i:s') }}</p>
                </div>

                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Taxa</th>
                        <th>Meio Pagamento</th>
                        <th>Data</th>
                        <th>Obs</th>

                    </tr>
                    @foreach($pagamentos as $item)
                    <tr>
                       
                        <td>
                            @if($item->mes==1)
                            <span>Pagamento Inscrição</span>
                            @elseif($item->mes==2)
                            <span>Pagamento Matricula</span>
                            @else
                             {{\App\Emolumento::toString($item->emolumento_id)}} {{\App\Emolumento::toStringMes($item->mes)}}
                            @endif
                        </td>
                        <td class="text-right"> {{ number_format($item->valor,2,',','.') }}</td>
                        <td class="text-right"> 
                        @if($item->taxa!=null)
                        {{ number_format($item->taxa,2,',','.') }}
                        @endif
                        </td>
                        <td class="text-center">{{$item->obs}}</td>
                        <td class="text-center">{{$item->created_at}} </td>
                        <td>{{$item->descrip}}</td>

                    </tr>
                    @endforeach
                    <tr>
                       
                        <td class="text-right"><b>Subtotal:</b></td>
                        <td class="text-right"> {{ number_format($total,2,',','.') }}</td>
                        <td class="text-right"> {{ number_format($totalTaxas,2,',','.') }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                       
                        <td class="text-right"><b>Total:</b></td>
                        <td class="text-right"> {{ number_format($total+$totalTaxas,2,',','.') }}</td>
                        <td> </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>



                </table>
                <h6>Informação dos pagamentos de propinas</h6>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>Total a pagar</td>
                        <td>250 000,00</td>
                    </tr>
                    <tr>
                        <td> Total pago</td>
                        <td>{{ number_format($totalPropinas,2,',','.') }}</td>
                    </tr>
                    <tr>
                        <td>Falta por pagar</td>
                       <!-- <td>{{ number_format($resto,2,',','.') }}</td>-->
                       <td>-</td>
                    </tr>

                </table>



            </div>
        </div>


        <!-- fin  primera parte -->
        <br>