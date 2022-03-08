
@extends('layouts.caixa')

@section('estilos')
@endsection

@section('content')
<div class="container">
<h3>Ficha Pagamentos</h3>
<div class="row">
<div class="col-6">
<p>Nome:{{$estudante->nome}}</p>
<p>Curso:{{$estudante->curso}}</p>
<p>Turma:{{App\Turma::toString($estudante->turma_id)}}</p>
</div>
<div class="col-6">
<label for="">Valor:</label>
</div>

</div>


<form action="">

<label for="">Confirmação de Matricula</label>
 <input type="checkbox" name="" id=""> <br>

<label for="">Propina</label>
 <input type="checkbox" name="" id=""><br>

 <label for="">Emolumento</label>
 <input type="checkbox" name="" id=""><br>
<br>
<br>

 <div id="confMatricula">
   <h3>Confirmação de Matricula</h3>
   <label for="">Valor</label>
   <input type="text" name="" id="">
 </div>

 <div id="propinas">
   <h3>Propinas</h3>

   <div class="panel panel-primary">
                        <div class="panel-heading">Pagamentos Propinas</div>
                        <div class="panel-body" >

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
                                             <form action="{{route('salvarFicha',$estudante->id)}}">
                                                @if($mes1Pago==null)
                                                <div class="col-md-1">
                                                   <input name="mes1" class="form-control" placeholder="1" type="text">
                                                </div>
                                                @else
                                                <div class="col-md-1 test">
                                                   {{$mes1Pago->valor}}
                                                   <input value="{{$mes1Pago->id}}" type="checkbox" name="checkMes[]" class="close">
                                                </div>
                                                @endif

                                                @if($mes2Pago==null)
                                                <div class="col-md-1">
                                                   <input name="mes2" class="form-control" placeholder="2" type="text">
                                                </div>
                                                @else
                                                <div class="col-md-1 test">
                                                   {{$mes2Pago->valor}}
                                                   <input value="{{$mes2Pago->id}}" type="checkbox" name="checkMes[]" class="close">
                                                </div>
                                                @endif

                                                @if($mes3Pago==null)
                                                <div class="col-md-1">
                                                   <input name="mes3" class="form-control" placeholder="3" type="text">
                                                </div>
                                                @else
                                                <div class="col-md-1 test">
                                                   {{$mes3Pago->valor}}
                                                   <input value="{{$mes3Pago->id}}" type="checkbox" name="checkMes[]" class="close">
                                                </div>
                                                @endif

                                                @if($mes4Pago==null)
                                                <div class="col-md-1">
                                                   <input name="mes4" class="form-control" placeholder="4" type="text">
                                                </div>
                                                @else
                                                <div class="col-md-1 test">
                                                   {{$mes4Pago->valor}}
                                                   <input value="{{$mes4Pago->id}}" type="checkbox" name="checkMes[]" class="close">
                                                </div>
                                                @endif

                                                @if($mes5Pago==null)
                                                <div class="col-md-1">
                                                   <input name="mes5" class="form-control" placeholder="5" type="text">
                                                </div>
                                                @else
                                                <div class="col-md-1 test">
                                                   {{$mes5Pago->valor}}
                                                   <input value="{{$mes5Pago->id}}" type="checkbox" name="checkMes[]" class="close">
                                                </div>
                                                @endif

                                                @if($mes6Pago==null)
                                                <div class="col-md-1">
                                                   <input name="mes6" class="form-control" placeholder="6" type="text">
                                                </div>
                                                @else
                                                <div class="col-md-1 test">
                                                   {{$mes6Pago->valor}}
                                                   <input value="{{$mes6Pago->id}}" type="checkbox" name="checkMes[]" class="close">
                                                </div>
                                                @endif

                                                @if($mes7Pago==null)
                                                <div class="col-md-1">
                                                   <input name="mes7" class="form-control" placeholder="7" type="text">
                                                </div>
                                                @else
                                                <div class="col-md-1 test">
                                                   {{$mes7Pago->valor}}
                                                   <input value="{{$mes7Pago->id}}" type="checkbox" name="checkMes[]" class="close">
                                                </div>
                                                @endif

                                                @if($mes8Pago==null)
                                                <div class="col-md-1">
                                                   <input name="mes8" class="form-control" placeholder="8" type="text">
                                                </div>
                                                @else
                                                <div class="col-md-1 test">
                                                   {{$mes8Pago->valor}}
                                                   <input value="{{$mes8Pago->id}}" type="checkbox" name="checkMes[]" class="close">
                                                </div>
                                                @endif

                                                @if($mes9Pago==null)
                                                <div class="col-md-1">
                                                   <input name="mes9" class="form-control" placeholder="9" type="text">
                                                </div>
                                                @else
                                                <div class="col-md-1 test">
                                                   {{$mes9Pago->valor}}
                                                   <input value="{{$mes9Pago->id}}" type="checkbox" name="checkMes[]" class="close">
                                                </div>
                                                @endif

                                                @if($mes10Pago==null)
                                                <div class="col-md-1">
                                                   <input name="mes10" class="form-control" placeholder="10" type="text">
                                                </div>
                                                @else
                                                <div class="col-md-1 test">
                                                   {{$mes10Pago->valor}}
                                                   <input value="{{$mes10Pago->id}}" type="checkbox" name="checkMes[]" class="close">
                                                </div>
                                                @endif

                                                @if($mes11Pago==null)
                                                <div class="col-md-1">
                                                   <input name="mes11" class="form-control" placeholder="11" type="text">
                                                </div>
                                                @else
                                                <div class="col-md-1 test">
                                                   {{$mes11Pago->valor}}
                                                   <input value="{{$mes11Pago->id}}" type="checkbox" name="checkMes[]" class="close">
                                                </div>
                                                @endif

                                                @if($mes12Pago==null)
                                                <div class="col-md-1">
                                                   <input name="mes12" class="form-control" placeholder="12" type="text">
                                                </div>
                                                @else
                                                <div class="col-md-1 test">
                                                   {{$mes12Pago->valor}}
                                                   <input value="{{$mes12Pago->id}}" type="checkbox" name="checkMes[]" class="close">
                                                </div>
                                                @endif

                                               
                                          
                                 
                                         </div>
                                 </div>
 
                                         
               </div>

               <div class="panel-footer">
                                 <div class="row">
                                  <div class="col-md-4">
                                  <button type="submit" class="btn btn-primary">Salvar</button>
                                  <button id="btn-eliminar" type="submit" class="btn btn-danger ocultable">Eliminar</button>
                                 </form>
                                  </div>
                                 </div>
                     </div>
</div>
 </div>

 <div id="emolumentos">
   <h3>Emolumentos</h3>
 </div>

</form>


</div>

@stop