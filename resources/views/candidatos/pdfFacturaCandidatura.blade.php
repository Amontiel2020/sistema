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
                <h3>Factura de Candidatura</h3>
            </div>

        </div>
        <div class="row">
            <div class="col-xs-12">
                <p align="right"><b>Data:</b>&nbsp;{{ date('d-m-Y H:i:s') }}</p>
                <p align="right"><b>Nº Factura:</b>&nbsp;{{$numFactura}}</p>

            </div>
        </div>


        <div class="row">
            <div class="col-xs-12">
                <p><b>Nome do Candidato:</b>&nbsp;{{$candidato->nomeCompleto}} &nbsp;{{$candidato->apelido}} &nbsp;&nbsp;&nbsp; <b>Codigo:</b> &nbsp;{{$candidato->codigo}} </p>
                <p><b>Nº do BI:</b> &nbsp;{{$candidato->BI}} &nbsp;&nbsp;&nbsp; </p>

            </div>

        </div>
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered">
                    <tr>
                        <th>Descrição</th>
                        <th>Valor</th>
                    </tr>
                    <tr>
                        <td>Pagamento da inscrição para a candidatura no curso de {{\App\Curso::toString($candidato->curso_id)}}</td>
                        <td>{{$valorInsc}}</td>
                    </tr>

                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">

                <p><b>Asinatura do Candidato</b>__________________________________________</p>
                <p><b>Asinatura do funcionário</b>_____________________________________________</p>

            </div>
        </div>
        <br>
        <br>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Informação</h4>
            </div>
            <div class="panel-body">
                <p>Caro candidato, no prazo maximo de dois dias úteis,
                    dirija-se a Tesouraria desta instituição, para proceder o pagamento do emolumento da inscrição</p>
                <p>
                    O não pagamento do emolumeno no prazo estabelecido, implicará a anulação da inscrição.
                </p>
            </div>
        </div>

        <!-- fin  primera parte -->

    </div>

    <!--   <div style="page-break-after:always;"></div> -->

</body>

</html>