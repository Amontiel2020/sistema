@extends('layouts.Main')

@section('estilos')

<style type="text/css">
   .ocultable {
      display: none
   }
</style>


@endsection
@section('content')

<div class="panel panel-primary">
   <div class="panel-heading">Ficha Estudante</div>
   <div class="panel-body">

      <div class="row">
         <div class="col-md-12">
          <div class=col-md-3> <img src="{{url('/storage/'.$estudante->pathImage) }}" alt=""></div> 
         
            <div class=col-md-9>
               <table>
                  <tr>
                     <th>Nome e Apelidos:</th>
                     <td>{{$estudante->nome}}{{$estudante->apelido}}</td>
                  </tr>
                  <tr>
                     <td>Turma</td>
                     <td></td>
                  </tr>
                  <tr>
                     <td>Curso</td>
                     <td>{{$estudante->curso}}</td>
                  </tr>


               </table>
            </div>

         </div>
      </div>




      <h3>Pagamentos</h3>
      <div class="row">
         <div class="col-md-12">
            <form action="{{route('salvarFicha')}}" method="POST">

               @if($mes1Pago==null)
               <div class="col-md-1">
                  <input id="mes1" name="mes1" class="form-control" placeholder="1" type="text">
               </div>
               @else
               <div class="col-md-1 test">
                  {{$mes1Pago->valor}}
                  <!--  <input value="{{$mes1Pago->id}}" type="checkbox" name="checkMes[]" class="close"> -->
               </div>
               @endif

               @if($mes2Pago==null)
               <div class="col-md-1">
                  <input id="mes2" name="mes2" class="form-control" placeholder="2" type="text">
               </div>
               @else
               <div class="col-md-1 test">
                  {{$mes2Pago->valor}}

               </div>
               @endif

               @if($mes3Pago==null)
               <div class="col-md-1">
                  <input id="mes3" name="mes3" class="form-control" placeholder="3" type="text">
               </div>
               @else
               <div class="col-md-1 test">
                  {{$mes3Pago->valor}}

               </div>
               @endif

               @if($mes4Pago==null)
               <div class="col-md-1">
                  <input id="mes4" name="mes4" class="form-control" placeholder="4" type="text">
               </div>
               @else
               <div class="col-md-1 test">
                  {{$mes4Pago->valor}}

               </div>
               @endif

               @if($mes5Pago==null)
               <div class="col-md-1">
                  <input name="mes5" class="form-control" placeholder="5" type="text">
               </div>
               @else
               <div class="col-md-1 test">
                  {{$mes5Pago->valor}}

               </div>
               @endif

               @if($mes6Pago==null)
               <div class="col-md-1">
                  <input name="mes6" class="form-control" placeholder="6" type="text">
               </div>
               @else
               <div class="col-md-1 test">
                  {{$mes6Pago->valor}}

               </div>
               @endif

               @if($mes7Pago==null)
               <div class="col-md-1">
                  <input name="mes7" class="form-control" placeholder="7" type="text">
               </div>
               @else
               <div class="col-md-1 test">
                  {{$mes7Pago->valor}}

               </div>
               @endif

               @if($mes8Pago==null)
               <div class="col-md-1">
                  <input name="mes8" class="form-control" placeholder="8" type="text">
               </div>
               @else
               <div class="col-md-1 test">
                  {{$mes8Pago->valor}}

               </div>
               @endif

               @if($mes9Pago==null)
               <div class="col-md-1">
                  <input name="mes9" class="form-control" placeholder="9" type="text">
               </div>
               @else
               <div class="col-md-1 test">
                  {{$mes9Pago->valor}}

               </div>
               @endif

               @if($mes10Pago==null)
               <div class="col-md-1">
                  <input name="mes10" class="form-control" placeholder="10" type="text">
               </div>
               @else
               <div class="col-md-1 test">
                  {{$mes10Pago->valor}}

               </div>
               @endif

               @if($mes11Pago==null)
               <div class="col-md-1">
                  <input name="mes11" class="form-control" placeholder="11" type="text">
               </div>
               @else
               <div class="col-md-1 test">
                  {{$mes11Pago->valor}}

               </div>
               @endif

               @if($mes12Pago==null)
               <div class="col-md-1">
                  <input name="mes12" class="form-control" placeholder="12" type="text">
               </div>
               @else
               <div class="col-md-1 test">
                  {{$mes12Pago->valor}}

               </div>
               @endif




         </div>
      </div>


   </div>

   <div class="panel-footer">
      <div class="row">
         <div class="col-md-4">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" id="id" value="{{$estudante->id}}">
            <button type="submit" class="btn btn-primary">Confirmar</button>
            <!--  <button id="confirmarPagamento" type="submit" class="btn btn-primary" data-toggle="modal" data-target="#miModal" 
                                  data-test="{{$estudante->id}}"
                                  data-nome="{{$estudante->nome}}"


                                  >Confirmar</button> -->
            <button id="btn-eliminar" type="submit" class="btn btn-danger ocultable">Eliminar</button>
            </form>
         </div>
      </div>
   </div>
</div>




<!---------------------------------------------TEST------------------------
<div class="card" style="width: 18rem;">
   <div class="card-body">
      <h5 class="card-title">Pagamentos</h5>
      <h6 class="card-subtitle mb-2 text-muted">Propinas</h6>
      <p class="card-text">Mes</p>
      <a href="#" class="card-link">Card link</a>
      <a href="#" class="card-link">Another link</a>
   </div>
</div>
<----------------------------------------------------------------------------->

<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Confirmar Pagamento</h4>
         </div>
         <div class="modal-body">
            <form action="{{route('gerarComprovativo',$estudante->id)}}">
               <Label>Numero Estudante</Label>
               <input id="test" type="text" readonly class="form-control">
               <Label>Nome Estudante</Label>
               <input id="nome" type="text" readonly class="form-control"><br>

               <h3>Pagamentos</h3>
               <!--  @if($mes1Pago==null)
    <Label>Mes 1</Label>
    <input id="mes1Modal" name="mes1Modal" type="text" readonly class="form-control">
    @endif
    <Label>Mes 2</Label>
    <input id="mes2Modal" name="mes2Modal" type="text" readonly class="form-control">
    <Label>Mes 3</Label>
    <input id="mes3Modal" name="mes3Modal" type="text" readonly class="form-control"><br>-->
               <button type="submit" class="btn btn-primary ">Gerar Comprobativo</button>
               <a href="{{route('fichaPagamento',$estudante->id)}}">Voltar</a>
            </form>

         </div>
      </div>
   </div>
</div>

@section('scripts')
<script type="text/javascript">
   //alert("ola");

   $(function() {

      $('.close').on('click', function(e) {

         e.preventDefault();
         $('#btn-eliminar').toggleClass('ocultable');

      });


   });

   /*$(function() {

   $('#confirmarPagamento').on('click',function(e){

      e.preventDefault();
      var test=$(this).data('test');
      var nome=$(this).data('nome');
      var mes1=$("#mes1").val();
      var mes2=$("#mes2").val();
      var mes3=$("#mes3").val();




    

     // var href=$(this).data('href');
      $('#test').val(test);
      $('#nome').val(nome);
      $('#mes1Modal').val(mes1);
      $('#mes2Modal').val(mes2);
      $('#mes3Modal').val(mes3);




     // $('#idEstudante').val(id);
    //  $('#mesX').val(mes);
     //alert(mes);
    //  var cantidad=$('#dispesa_'+id).val();

    //  var href2=href+"/"+id+"/"+cantidad;
      //alert(href2);


     // window.location.href=href2;

   });


   });*/


   $(document).ready(function() {


      $("#mes2").keyup(function(event) {
         $("#valorMes1").html($(this).val());

      });

   });
</script>
@endsection
@stop