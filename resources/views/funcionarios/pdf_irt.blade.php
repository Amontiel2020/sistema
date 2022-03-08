<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Escola Superior Politecnica de Benguela</title>

    <style>
        body {
            font-size: 9px;
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

        .table2 {
            border: none;
            width: 50%;
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

        .left {
            float: left;

        }
    </style>

</head>

<body>

    <div class="container-fluid">
        <!-- primera parte -->
        <div>
            <div class="left">
                <p><b>ABP-Sociedade Formação e Serviços,Lda.</b> </p>
                <p><b>Rua Major Kanhangulo, 198-200</b> </p>
                <p><b>Luanda</b></p>
                <p><b>NIF: 5401154836</b></p>
            </div>
            <div align="center">

                <img width="50px" height="50px" src="{{ public_path('imagenes-perfil/logo.png') }}">


                <!--  <p>MINISTERIO DO ENSINO SUPERIOR CIÊNCIA, TECNOLOGIA E INOVAÇÃO</p> -->
                <p><b>ESCOLA SUPERIOR POLITÉCNICA DE BENGUELA</b></p>
                <!--      <p> Decreto Presidencial nº 168/12 de 24 de Julho</p>
                <p>Telef. +244 222711897/994809632/921226215 - Email: espbenguela@gmail.com</p>
                <p> Bairro da Graça - Benguela Angola</p> -->
                <h5> MAPA PAGAMENTO DO I.R.T - {{$mes}}/{{$ano}}</h5>
            </div>



        </div>
        <br>
        <br>

        <table class="table">

            <tr>
               <!-- <td>Nº</td> -->
                <th>Nome Completo</th>
                <th>Categoria Ocupacional</th>
                <th>Salario Base</th>
                <th>Faltas ao serviço</th>
                <th>Adicionais</th>
                <th>Salario Iliquido</th>
                <th>SEG SOC</th>
                <th>Matéria colectavel</th>
                <th>IRT</th>

            </tr>
            @foreach($mapas as $mapa)
            @foreach($mapa->temp_salarios as $i=> $item)
            @if(\App\Funcionario::calc_IRT($item->id)>0)
            <tr align="right">
               <!-- <td align="center">{{$i+1}}</td>-->
                <td align="left">{{\App\Funcionario::toString($item->funcionario_id)}} </td>
                <td align="left">{{$item->funcionario->categoria_ocupacional}}</td>
                <td>
                    {{number_format(\App\Funcionario::getSalario($item->funcionario_id),2,',','.') }}

                </td>
                <td> {{$item->horas_faltas}}</td>
                <td>
                    {{number_format(\App\Funcionario::calcular_total_subsidio($item->funcionario_id),2,',','.') }}
                </td>
                <td>
                    {{number_format(\App\Funcionario::calcular_salario_liquido($item->id),2,',','.') }}

                </td>
                <td>
                    {{number_format(\App\Funcionario::calc_seg_social($item->id),2,',','.') }}
                </td>
                <td>{{number_format(\App\Funcionario::materia_coletavel($item->id),2,',','.') }}</td>
                <td>{{number_format(\App\Funcionario::calc_IRT($item->id),2,',','.') }}</td>


            </tr>
            @endif
            @endforeach
            @endforeach
            <tr align="right">
               <!-- <td></td>-->
                <td></td>
                <td></td>
                <td> {{number_format(\App\Funcionario::total_salario_base_mes($mes,$ano),2,',','.') }}</td>
                <td> {{number_format(\App\Funcionario::total_desconto_faltas_mes($mes,$ano),2,',','.') }}</td>
                <td> </td>
                <td>{{number_format(\App\Funcionario::total_salario_iliquido_mes($mes,$ano),2,',','.') }} </td>
                <td>{{number_format(\App\Funcionario::total_desconto_seguridad_social_mes($mes,$ano),2,',','.') }}</td>
                <td></td>
                <td> {{number_format(\App\Funcionario::total_desconto_irt_mes($mes,$ano),2,',','.') }}</td>


            </tr>
        </table>

        <br>
        <br>
        <br>
        <br>



    </div>


    <div class="row">
        <div class="col-md-4">
    
                    <p>Total a depositar  <span><b>{{number_format(\App\Funcionario::total_desconto_irt_mes($mes,$ano),2,',','.') }}</b></span></p>
  
            <br>
            <br>
            <div align="center">
                <p>Benguela, <?php echo date('d-m-Y', strtotime($date)) ?></p>
                <p>A Direcção</p>
                <p>_______________________________</p>
            </div>
        </div>
    </div>



</body>

</html>