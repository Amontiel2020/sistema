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
         /* padding: 1px 2px !important;*/
         /* text-align: center;*/
         border: 1px solid #999 !important;
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
            <!--      <p> Decreto Presidencial nº 168/12 de 24 de Julho</p>
                <p>Telef. +244 222711897/994809632/921226215 - Email: espbenguela@gmail.com</p>
                <p> Bairro da Graça - Benguela Angola</p> -->
            <h5> Mapa de controlo de propinas 2021/2022 </h5>
         </div>

      </div>
      <hr>

      <table class="table">
         <thead>

            <tr>
               <th>#</th>
               <th>Nome e Apelidos</th>
               <th>Outubro 2021</th>
               <th>Novembro 2021</th>
               <th>Dezembro 2021</th>
               <th>Janeiro 2022</th>
               <th>Fevereiro 2022</th>
               <th>Março 2022</th>
               <th>Abril 2022</th>
               <th>Maio 2022</th>
               <th>Junho 2022</th>
               <th>Julho 2022</th>
               <th>Total</th>
               <th>Total Taxa</th>
               <th>Total Divida</th>

            </tr>
         </thead>
         <tbody>
            @foreach($estudantes as $index=>$estudante )
            @if(App\Pagamento::pagamentoMesAno($estudante,1,2021)==null
            || App\Pagamento::pagamentoMesAno($estudante,2,2021)==null
            || App\Pagamento::pagamentoMesAno($estudante,3,2021)==null
            || App\Pagamento::pagamentoMesAno($estudante,4,2021)==null
            || App\Pagamento::pagamentoMesAno($estudante,5,2021)==null
            || App\Pagamento::pagamentoMesAno($estudante,6,2021)==null
            || App\Pagamento::pagamentoMesAno($estudante,7,2021)==null
            || App\Pagamento::pagamentoMesAno($estudante,8,2021)==null
            || App\Pagamento::pagamentoMesAno($estudante,9,2021)==null
            || App\Pagamento::pagamentoMesAno($estudante,10,2021)==null



            )
            <tr>
               <td>{{$index+1}}</td>
               <td>{{$estudante->nome}}{{" "}}{{$estudante->apelido}}</td>
               <td align="center" @if(App\Pagamento::pagamentoMesAno($estudante,3,$ano)) class="bg-success" @endif @if(App\Pagamento::pagamentoMesAno($estudante,3,$ano)==null) class="bg-danger" @endif>
                  @if(App\Pagamento::pagamentoMesAno($estudante,3,$ano)!=null)
                  {{number_format((App\Pagamento::pagamentoMesAno($estudante,3,$ano))->valor,2,',','.') }}
                  @if(App\Pagamento::pagamentoMesAno($estudante,3,$ano)->taxa !=null)
                  <span>Taxa {{number_format(App\Pagamento::pagamentoMesAno($estudante,3,$ano)->taxa,2,',','.') }}

                  </span>
                  @endif
                  @else
                  --
                  @endif
               </td>
               <td align="center" @if(App\Pagamento::pagamentoMesAno($estudante,4,$ano)) class="bg-success" @endif @if(App\Pagamento::pagamentoMesAno($estudante,4,$ano)==null) class="bg-danger" @endif>
                  @if(App\Pagamento::pagamentoMesAno($estudante,4,$ano))
                  {{number_format((App\Pagamento::pagamentoMesAno($estudante,4,$ano))->valor,2,',','.') }}
                  @if(App\Pagamento::pagamentoMesAno($estudante,4,$ano)->taxa !=null)
                  <span>Taxa {{number_format(App\Pagamento::pagamentoMesAno($estudante,3,$ano)->taxa,2,',','.') }}</span>
                  @endif
                  @else
                  --
                  @endif
               </td>
               <td align="center" @if(App\Pagamento::pagamentoMesAno($estudante,5,$ano)) class="bg-success" @endif @if(App\Pagamento::pagamentoMesAno($estudante,5,$ano)==null) class="bg-danger" @endif>
                  @if(App\Pagamento::pagamentoMesAno($estudante,5,$ano))
                  {{number_format((App\Pagamento::pagamentoMesAno($estudante,5,$ano))->valor,2,',','.') }}
                  @if(App\Pagamento::pagamentoMesAno($estudante,5,$ano)->taxa !=null)
                  <span>Taxa {{number_format(App\Pagamento::pagamentoMesAno($estudante,5,$ano)->taxa,2,',','.') }}</span>
                  @endif
                  @else
                  --
                  @endif
               </td>
               <td align="center" @if(App\Pagamento::pagamentoMesAno($estudante,6,$ano)) class="bg-success" @endif @if(App\Pagamento::pagamentoMesAno($estudante,6,$ano)==null) class="bg-danger" @endif>
                  @if(App\Pagamento::pagamentoMesAno($estudante,6,$ano))
                  {{number_format((App\Pagamento::pagamentoMesAno($estudante,6,$ano))->valor,2,',','.') }}
                  @if(App\Pagamento::pagamentoMesAno($estudante,6,$ano)->taxa !=null)
                  <span>Taxa {{number_format(App\Pagamento::pagamentoMesAno($estudante,6,$ano)->taxa,2,',','.') }}</span>
                  @endif
                  @else
                  --
                  @endif
               </td>
               <td align="center" @if(App\Pagamento::pagamentoMesAno($estudante,7,$ano)) class="bg-success" @endif @if(App\Pagamento::pagamentoMesAno($estudante,7,$ano)==null) class="bg-danger" @endif>
                  @if(App\Pagamento::pagamentoMesAno($estudante,7,$ano))
                  {{number_format((App\Pagamento::pagamentoMesAno($estudante,7,$ano))->valor,2,',','.') }}
                  @if(App\Pagamento::pagamentoMesAno($estudante,7,$ano)->taxa !=null)
                  <span>Taxa {{number_format(App\Pagamento::pagamentoMesAno($estudante,7,$ano)->taxa,2,',','.') }}</span>
                  @endif
                  @else
                  --
                  @endif
               </td>
               <td align="center" @if(App\Pagamento::pagamentoMesAno($estudante,8,$ano)) class="bg-success" @endif @if(App\Pagamento::pagamentoMesAno($estudante,8,$ano)==null) class="bg-danger" @endif>
                  @if(App\Pagamento::pagamentoMesAno($estudante,8,$ano))
                  {{number_format((App\Pagamento::pagamentoMesAno($estudante,8,$ano))->valor,2,',','.') }}
                  @if(App\Pagamento::pagamentoMesAno($estudante,8,$ano)->taxa !=null)
                  <span>Taxa {{number_format(App\Pagamento::pagamentoMesAno($estudante,8,$ano)->taxa,2,',','.') }}</span>
                  @endif
                  @else
                  --
                  @endif
               </td>
               <td align="center" @if(App\Pagamento::pagamentoMesAno($estudante,9,$ano)) class="bg-success" @endif @if(App\Pagamento::pagamentoMesAno($estudante,9,$ano)==null) class="bg-danger" @endif>
                  @if(App\Pagamento::pagamentoMesAno($estudante,9,$ano))
                  {{number_format((App\Pagamento::pagamentoMesAno($estudante,9,$ano))->valor,2,',','.') }}
                  @if(App\Pagamento::pagamentoMesAno($estudante,9,$ano)->taxa !=null)
                  <span>Taxa {{number_format(App\Pagamento::pagamentoMesAno($estudante,9,$ano)->taxa,2,',','.') }}</span>
                  @endif
                  @else
                  --
                  @endif
               </td>
               <td align="center" @if(App\Pagamento::pagamentoMesAno($estudante,10,$ano)) class="bg-success" @endif @if(App\Pagamento::pagamentoMesAno($estudante,10,$ano)==null) class="bg-danger" @endif>
                  @if(App\Pagamento::pagamentoMesAno($estudante,10,$ano))
                  {{number_format((App\Pagamento::pagamentoMesAno($estudante,10,$ano))->valor,2,',','.') }}
                  @if(App\Pagamento::pagamentoMesAno($estudante,10,$ano)->taxa !=null)
                  <span>Taxa {{App\Pagamento::pagamentoMesAno($estudante,10,$ano)->taxa}}</span>
                  @endif
                  @else
                  --
                  @endif
               </td>
               <td align="center" @if(App\Pagamento::pagamentoMesAno($estudante,11,$ano)) class="bg-success" @endif @if(App\Pagamento::pagamentoMesAno($estudante,11,$ano)==null) class="bg-danger" @endif>
                  @if(App\Pagamento::pagamentoMesAno($estudante,11,$ano))
                  {{number_format((App\Pagamento::pagamentoMesAno($estudante,11,$ano))->valor,2,',','.') }}
                  @if(App\Pagamento::pagamentoMesAno($estudante,11,$ano)->taxa !=null)
                  <span>Taxa {{number_format(App\Pagamento::pagamentoMesAno($estudante,11,$ano)->taxa,2,',','.') }}</span>
                  @endif
                  @else
                  --
                  @endif
               </td>
               <td align="center" @if(App\Pagamento::pagamentoMesAno($estudante,12,$ano)) class="bg-success" @endif @if(App\Pagamento::pagamentoMesAno($estudante,12,$ano)==null) class="bg-danger" @endif>
                  @if(App\Pagamento::pagamentoMesAno($estudante,12,$ano))
                  {{number_format((App\Pagamento::pagamentoMesAno($estudante,12,$ano))->valor,2,',','.') }}
                  @if(App\Pagamento::pagamentoMesAno($estudante,12,$ano)->taxa !=null)
                  <span>Taxa{{number_format(App\Pagamento::pagamentoMesAno($estudante,12,$ano)->taxa,2,',','.') }}</span>
                  @endif
                  @else
                  --
                  @endif
               </td>
               <td class="bg-danger">
                  {{number_format((App\Pagamento::totalPagamentosAno($estudante,$ano)),2,',','.') }}
               </td>
               <td class="bg-danger">
                  {{number_format((App\Pagamento::totalPagamentosaxaAno($estudante,$ano)),2,',','.') }}
               </td>
               <td class="bg-danger">
                 <!-- {{number_format((App\Pagamento::totalPagamentosAno($estudante,$ano))+ (App\Pagamento::totalPagamentosaxaAno($estudante,$ano)),2,',','.') }}-->
                 {{number_format(App\Pagamento::totalDividaEstAno($estudante,$ano),2,',','.') }}
               </td>
            </tr>
            @endif
            @endforeach

            <tr>
               <td></td>
               <td></td>
               <td>{{number_format(App\Pagamento::totalDividaMesAno(1,2021),2,',','.') }}</td>
               <td> {{number_format(App\Pagamento::totalDividaMesAno(2,2021),2,',','.') }}</td>
               <td> {{number_format(App\Pagamento::totalDividaMesAno(3,2021),2,',','.') }}</td>
               <td> {{number_format(App\Pagamento::totalDividaMesAno(4,2021),2,',','.') }}</td>
               <td> {{number_format(App\Pagamento::totalDividaMesAno(5,2021),2,',','.') }}</td>
               <td> {{number_format(App\Pagamento::totalDividaMesAno(6,2021),2,',','.') }}</td>
               <td> {{number_format(App\Pagamento::totalDividaMesAno(7,2021),2,',','.') }}</td>
               <td> {{number_format(App\Pagamento::totalDividaMesAno(8,2021),2,',','.') }}</td>
               <td> {{number_format(App\Pagamento::totalDividaMesAno(9,2021),2,',','.') }}</td>
               <td> {{number_format(App\Pagamento::totalDividaMesAno(10,2021),2,',','.') }}</td>
               <td></td>
               <td></td>
               <td> {{number_format(App\Pagamento::totalDividaAno(2021),2,',','.') }} </td>

            </tr>
         </tbody>
      </table>

   </div>


</body>

</html>