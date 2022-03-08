<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->

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
    <!-- primera parte -->
    <div class="row">
        <div class="col-xs-12" align="center">

            <img width="50px" height="50px" src="{{ public_path('imagenes-perfil/logo.png') }}">

            <!--  <p>MINISTERIO DO ENSINO SUPERIOR CIÊNCIA, TECNOLOGIA E INOVAÇÃO</p> -->
            <p><b>ESCOLA SUPERIOR POLITÉCNICA DE BENGUELA</b></p>
            <p> Decreto Presidencial nº 168/12 de 24 de Julho</p>
            <p> <b>Lista dos estudantes</b></p>
        </div>

    </div>
    <p><b>Curso: &nbsp;</b> {{\App\Curso::toString($turma->curso_id)}} &nbsp; &nbsp; <span align="right">
            <b>Turma: &nbsp;</b> {{\App\Turma::toString($turma->id)}}&nbsp; &nbsp; <b>Periodo: &nbsp;</b>
            @if($turma->periodo=="M")
            Manhã
            @endif
            @if($turma->periodo=="T")
            Tarde
            @endif

            @if($turma->periodo=="N")
            Noite
            @endif
        </span></p>


    <table class="table">
        <tr>
            <th>Nº Ordem</th>
            <th>Nº Estudante</th>
            <th>Nome Completo</th>
            <th>Curso</th>
            <th>Periodo</th>

        </tr>
        @foreach($estudantes as $key => $item)
        <tr>
            <td width="5%">{{$key+1}}</td>
            <td>{{$item->codigo}}</td>
            <td>{{$item->nome}} {{$item->apelido}}</td>
            <td>{{\App\Curso::toString($turma->curso_id)}}</td>
            <td>
                @if($turma->periodo=="M")
                Manhã
                @endif
                @if($turma->periodo=="T")
                Tarde
                @endif

                @if($turma->periodo=="N")
                Noite
                @endif
            </td>

        </tr>
        @endforeach
    </table>

</body>

</html>