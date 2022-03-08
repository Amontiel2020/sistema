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

            <p> <b>Estudantes que fizeram recurso e exame especial</b></p>
        </div>

    </div>

    <table class="table">
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th colspan="2">Recursos</th>
            <th colspan="2">Ex3</th>

        </tr>

        <tr>
            <th>Nº</th>
            <th>Nome Completo</th>
            <th>Curso</th>
            <th>UC</th>
            <th>Pagamento</th>
            <th>UC</th>
            <th>Pagamento</th>
        </tr>
        @foreach($estudantes as $i=>$estudante)
        @if(\App\Estudante::listaRecursos($estudante->id) !=null || \App\Estudante::listaEx3($estudante->id) !=null)
        <tr>
            <td>{{$i+1}}</td>
            <td>{{$estudante->nome}}</td>
            <td>{{\App\Curso::toString($estudante->curso_id)}}</td>
            @if(\App\Estudante::listaRecursos($estudante->id) !=null)
            <td>
                <ol>
                    @foreach(\App\Estudante::listaRecursos($estudante->id) as $recurso)
                    <li>{{$recurso->disciplina_nome}}</li>
                    @endforeach
                </ol>
            </td>
            <td></td>
            @else
            <td></td>
            <td></td>
            @endif

            @if(\App\Estudante::listaEx3($estudante->id) !=null)
            <td>
                <ol>
                    @foreach(\App\Estudante::listaEx3($estudante->id) as $exame)
                    <li>{{$exame->disciplina_nome}}</li>
                    @endforeach
                </ol>
            </td>
            <td></td>
            @else
            <td></td>
            <td></td>
            @endif

        </tr>
        @endif
        @endforeach
    </table>




</body>

</html>