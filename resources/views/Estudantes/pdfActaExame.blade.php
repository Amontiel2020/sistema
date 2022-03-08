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
            <p><b>ESCOLA SUPERIOR POLITÉCNICA DE BENGUELA</b></p>
            <p> Decreto Presidencial nº 168/12 de 24 de Julho</p>
            <p> Bairro da Graça ,Benguela-Angola</p>

            <p> <b>Acta de Avaliação</b></p>
        </div>

    </div>
    <p><b>Curso: &nbsp;</b> {{\App\Curso::toString($turma->curso_id)}} &nbsp; &nbsp; <span align="right"><b>Turma: &nbsp;</b> {{\App\Turma::toString($turma->id)}}</span></p>
    <p>Docente:&nbsp;________________________________________&nbsp;&nbsp; <span>Unidade Curricular:&nbsp;________________________________________</span></p>
    <p>Data_____/_____/_____ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<label><input type="checkbox" />1ª Freq</label> &nbsp; &nbsp; &nbsp;<label><input type="checkbox" />2ª Freq</label>&nbsp; &nbsp; &nbsp;<label><input type="checkbox" />EX1</label>&nbsp; &nbsp; &nbsp;<label><input type="checkbox" />Ex2</label>&nbsp; &nbsp; &nbsp;<label><input type="checkbox" />Ex3</label>


    </p>

    <table class="table">
        <tr>
            <th>Nº</th>
            <th>Nome Completo</th>
            <th>Asinatura</th>
            <th>Nota</th>
        </tr>
        @foreach($estudantes as $key => $item)
        
        @if($item->cantidadMesesPagos(2021)>3)
          <tr>
            <td width="5%">

                {{$i++}}

            </td>
            <td width="40%">{{$item->nome}} {{$item->apelido}}</td>
            <!--  <td>{{$item->apelido}}</td> -->
            <td width="45%"></td>
            <td width="10%"></td>
        </tr>
        @endif
        @endforeach
    </table>
    <p><b>O Juri</b>__________________________________________________________</p>
    <p>__________________________________________________________</p>
    <p>__________________________________________________________</p>

</body>

</html>