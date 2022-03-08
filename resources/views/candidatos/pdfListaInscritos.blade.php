<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

    <title>Escola Superior Politecnica de Benguela</title>

    <style>
        body {
            font-size: 12px;
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
        <div class="row">
            <div class="col-xs-12" align="center">
                <img width="50px" height="50px" src="{{ public_path('imagenes-perfil/logo.png') }}">
                <p><b>ESCOLA SUPERIOR POLITÉCNICA DE BENGUELA</b></p>
                <p> Decreto Presidencial nº 168/12 de 24 de Julho</p>
                <h3>Lista Nominal para a prova de admissão</h3> 
                 <p>@if($curso_id !=0)<b>Curso:</b> {{\App\Curso::toString($curso_id)}} @endif  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <b>Ano Académico: </b>2021/2022</p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <p align="right"><b>Data:</b>&nbsp;{{ date('d-m-Y') }}</p>
            </div>
        </div>
        <table class="table">
            <tr>
                <th align="center">Nº</th>
               <!-- <th align="center">Código</th>-->
                <th>Nome Completo</th>
                <th>Idade</th>
                <th>Data Inscrição</th>
            </tr>
            @foreach($candidatos as $i=>$item)
            <tr>
                <td  align="center">{{$i+1}}</td>
                <!-- <td  align="center">{{$item->codigo}}</td> -->
                <td>{{$item->nomeCompleto}}</td>
                 <td>{{\App\Candidato::getIdade($item->id)}}</td> 
                 <td><?php echo date('d-m-Y', strtotime($item->created_at)) ?></td>
            </tr>
            @endforeach
        </table>
</body>

</html>