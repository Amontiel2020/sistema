<!doctype html>
<html lang="es">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   
  <!-- <link href="{{asset('bootstrap-3.3.7/dist/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">-->


   <title>Escola Superior Politecnica de Benguela</title>

   <style>
      body {
         font-size: 10px;
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
            <h5> Mapa de controlo de propinas 2020/2021 do curso <b>{{\App\Curso::toString($turmaSelected->curso_id)}}</b>, turma <b>{{$turmaSelected->identificador}}</b></h5>
         </div>

      </div>
      <hr>

      <table class="table table-hover table-striped table-bordered" border="0.01">
         <thead>
            <tr>
               <th>#</th>
               <th>Nome Completo</th>
               <th>Propina Outubro</th>
               <th>Propina Novembro</th>
               <th>Propina Dezembro</th>
               <th>Propina Janeiro</th>
               <th>Propina Fevereiro</th>
               <th>Propina Março</th>
               <th>Propina Abril</th>
               <th>Propina Maio</th>
               <th>Propina Junho</th>
               <th>Propina Julho</th>



            </tr>
         </thead>
         <tbody>
            @foreach($estudantes as $estudante)

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
               <td>{{$i++}}</td>
               <td>{{$estudante->nome}}&nbsp;{{$estudante->apelido}}</td>
               <td align="center">
                  @if(!(App\Pagamento::pagamentoMesAno($estudante,1,2021)))
                  <span><b>Sem Pagar</b></span>
                  @endif

                  @if((App\Pagamento::pagamentoMesAno($estudante,1,2021)))
                  <span >Pago</span>
                  @endif
               </td>
               <td align="center">
                  @if(!(App\Pagamento::pagamentoMesAno($estudante,2,2021)))
                  <span><b>Sem Pagar</b></span>
                  @endif

                  @if((App\Pagamento::pagamentoMesAno($estudante,2,2021)))
                  <span >Pago</span>
                  @endif
               </td>
               <td align="center">
                  @if(!(App\Pagamento::pagamentoMesAno($estudante,3,2021)))
                  <span><b>Sem Pagar</b></span>
                  @endif

                  @if((App\Pagamento::pagamentoMesAno($estudante,3,2021)))
                  <span >Pago</span>
                  @endif
               </td>
               <td align="center">
                  @if(!(App\Pagamento::pagamentoMesAno($estudante,4,2021)))
                  <span><b>Sem Pagar</b></span>
                  @endif

                  @if((App\Pagamento::pagamentoMesAno($estudante,4,2021)))
                  <span >Pago</span>
                  @endif
               </td>
               <td align="center">
                  @if(!(App\Pagamento::pagamentoMesAno($estudante,5,2021)))
                  <span><b>Sem Pagar</b></span>
                  @endif

                  @if((App\Pagamento::pagamentoMesAno($estudante,5,2021)))
                  <span >Pago</span>
                  @endif
               </td>
               <td align="center">
                  @if(!(App\Pagamento::pagamentoMesAno($estudante,6,2021)))
                  <span><b>Sem Pagar</b></span>
                  @endif

                  @if((App\Pagamento::pagamentoMesAno($estudante,6,2021)))
                  <span >Pago</span>
                  @endif
               </td>
               <td align="center">
                  @if(!(App\Pagamento::pagamentoMesAno($estudante,7,2021)))
                  <span><b>Sem Pagar</b></span>
                  @endif

                  @if((App\Pagamento::pagamentoMesAno($estudante,7,2021)))
                  <span >Pago</span>
                  @endif
               </td>
               <td align="center">
                  @if(!(App\Pagamento::pagamentoMesAno($estudante,8,2021)))
                  <span><b>Sem Pagar</b></span>
                  @endif

                  @if((App\Pagamento::pagamentoMesAno($estudante,8,2021)))
                  <span >Pago</span>
                  @endif
               </td>
               <td align="center">
                  @if(!(App\Pagamento::pagamentoMesAno($estudante,9,2021)))
                  <span><b>Sem Pagar</b></span>
                  @endif

                  @if((App\Pagamento::pagamentoMesAno($estudante,9,2021)))
                  <span >Pago</span>
                  @endif
               </td>  
               <td align="center">
                  @if(!(App\Pagamento::pagamentoMesAno($estudante,10,2021)))
                  <span><b>Sem Pagar</b></span>
                  @endif

                  @if((App\Pagamento::pagamentoMesAno($estudante,10,2021)))
                  <span >Pago</span>
                  @endif
               </td>           
            </tr>

            @endif
            @endforeach


         </tbody>
      </table>

   </div>


</body>

</html>