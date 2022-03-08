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

            <p> <b>Lista Estudantes com Unidades Curriculares em Atrasso do curso {{\App\Curso::toString($curso)}}</b></p>
        </div>

    </div>
   


    </p>

    <table class="table">
        <tr>
            <th>Nº</th>
            <th>Nome Completo</th>
            <th>Unidades Curriculares em Atrasso</th>

        </tr>
        @foreach($estudantes as $key => $item)
       @if (count(\App\Estudante::obterTodasDisciplinasAtrasoDadoEstudante($item->id))>0)
           
    

        <tr>
            <td width="5%" align="center">

                {{$key+1}}

            </td>
            <td>{{$item->nome}}</td>
            <!--  <td>{{$item->apelido}}</td> -->
            <td>
            <ol>
            @foreach (\App\Estudante::obterTodasDisciplinasAtrasoDadoEstudante($item->id) as $disc )
           
               <li> {{\App\Disciplina::toString($disc)}}</li>
           
            @endforeach
            </ol>
            </td>
        </tr>
        @endif
        @endforeach
    </table>


</body>

</html>