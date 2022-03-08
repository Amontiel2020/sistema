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
                <h3>Factura da Matricula</h3>
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
                <p><b>Nome do Candidato:</b>&nbsp;{{$estudante->nomeCompleto}} &nbsp;{{$estudante->apelido}} &nbsp;&nbsp;&nbsp; <b>Codigo:</b> &nbsp;{{$estudante->codigo}} </p>
                <p><b>Nº do BI:</b> &nbsp;{{$estudante->BI}} &nbsp;&nbsp;&nbsp; </p>

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
                        <td>Pagamento da matricula no curso de {{\App\Curso::toString($estudante->curso_id)}}</td>
                        <td>{{$valorMatricula}}</td>
                    </tr>

                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">

                <p><b>Asinatura do Candidato</b>__________________________________________</p>
                <p><b>Nome do funcionário</b>_____________________________________________</p>

            </div>
        </div>


        <!-- fin  primera parte -->
        <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Informação</h4>
        </div>
        <div class="panel-body">
            <p>Saudamos a sua escolha de iniciar os seus estudos superiores na ESPB.
                Acabou de efectuar a matrícula provisoria que tornar-se-a efectiva, logo que,
                ate 20 horas do segundo dia útil afectuar o pagamento da factura anexa.
                Se não efectuar o pagamento neste prazo, a sua matrícula é anulada.
               <p>Quando efectuar o pagamento dentro daquele prazo: </p> 
            <ol>
                <li>Receberá um recibo comprovativo de pagamento. Deve conferir os dados do recibo antes de abandonar a Tesouraria da ESPB e guarde-o.
                </li>
                <li>A sua matrícula deixa de ser provisória.</li>
                <li>É-lhe conferido o estatuto de Estudante.</li>
                <li>É-lhe atribuído um número de estudante único que vem indicado no recibo.</li>
                <li>É-lhe atribuído um endereço institucional de email, que deverá adquirir, no departamento de Informática da ESPB nas horas normais de serviço.</li>
                <li>Juntamente com o endereço de email, receberá a sua primeira password.</li>
                <li>É-lhe atribuida uma turma, cuja informação será consultada no Átrio da ESPB, onde estará afixada
                    uma lista nominal dos estudantes matriculados assim como o respectivo horário de aulas.</li>

            </ol>
            </p>
            <h3>ÊXITOS</h3>

        </div>
    </div>

</body>

</html>