<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->

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

            <p> <b>Lista Nominal para o Exame de Acesso</b></p>
        </div>

    </div>
    <p><b>Curso:&nbsp;</b> {{\App\Curso::toString($curso)}} &nbsp; &nbsp;&nbsp; &nbsp;<b>Ano Lectivo:&nbsp;</b>2021/2022 </p>
    <p>Docente:&nbsp;________________________________________&nbsp;&nbsp; </p>
    <p>Data_____/_____/_____ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
       
          
            </p>

            <table class="table">
                <tr>
                    <th>Nº</th>
                    <th>Nome Completo</th>
                    <th>Assinatura</th>
                    <th>Classificação</th>
                </tr>
                @foreach($candidatos as $key => $item)
               

                <tr>
                    <td width="5%" align="center">

                        {{$key+1}}

                    </td>
                    <td width="40%">{{$item->nomeCompleto}}</td>
                    <!--  <td>{{$item->apelido}}</td> -->
                    <td width="45%"></td>
                    <td width="10%"></td>
                </tr>
              
                @endforeach
            </table>
            <p><b>O Juri</b>__________________________________________________________</p>
            <p>__________________________________________________________</p>
            <p>__________________________________________________________</p>

</body>

</html>