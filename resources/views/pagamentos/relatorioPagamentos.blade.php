@extends('layouts.layoutPdf2')




@section('content')
<br>
<br>
<div class="container">
<div class="row">
<div class="col-md-3">
   <table id="table-pagamentos" class="table table-bordered">
  <tr>
   <th>Março</th>
   <th>{{(int)($cantPagamentosMar*100/$cantidadEstudantes)}}%</th>
  </tr>
     <tr>
   <td>Pagamentos</td>
   <td>{{$cantPagamentosMar}}</td>
  </tr>
     <tr>
   <td>Faltam</td>
   <td>{{$cantidadEstudantes-$cantPagamentosMar}}</td>
  </tr>
  </table>
</div>
<div class="col-md-3">
   <table id="table-pagamentos" class="table table-bordered">
  <tr>
   <th>Outubro</th>
   <th>{{(int)($cantPagamentosOut*100/$cantidadEstudantes)}}%</th>
  </tr>
     <tr>
   <td>Pagamentos</td>
   <td>{{$cantPagamentosOut}}</td>
  </tr>
     <tr>
   <td>Faltam</td>
   <td>{{$cantidadEstudantes-$cantPagamentosOut}}</td>
  </tr>
  </table>
</div>

<div class="col-md-3">
   <table id="table-pagamentos" class="table table-bordered">
  <tr>
   <th>Novembro</th>
   <th>{{(int)($cantPagamentosNov*100/$cantidadEstudantes)}}%</th>
  </tr>
     <tr>
   <td>Pagamentos</td>
   <td>{{$cantPagamentosNov}}</td>
  </tr>
     <tr>
   <td>Faltam</td>
   <td>{{$cantidadEstudantes-$cantPagamentosNov}}</td>
  </tr>
  </table>
</div>

<div class="col-md-3">
   <table id="table-pagamentos" class="table table-bordered">
  <tr>
   <th>Dezembro</th>
   <th>{{(int)($cantPagamentosDez*100/$cantidadEstudantes)}}%</th>
  </tr>
     <tr>
   <td>Pagamentos</td>
   <td>{{$cantPagamentosDez}}</td>
  </tr>
     <tr>
   <td>Faltam</td>
   <td>{{$cantidadEstudantes-$cantPagamentosDez}}</td>
  </tr>
  </table>
</div>
</div>


  


 
                            <table  class="table table-bordered">
                             <thead>
                                  <tr><td colspan="13" align="center"><b>Propinas</b></td></tr>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome e Apelidos</th>
                                        <th>Curso</th>
                                        <th>Março</th>
                                        <th>Outubro</th>
                                        <th>Novembro</th>
                                        <th>Dezembro</th>
                                        <th>Janeiro</th>
                                        <th>Fevereiro</th>
                                        <th>Março</th>
                                        <th>Abril</th>
                                        <th>Maio</th>
                                        <th>Junho</th>
                                       
                                    
                                    </tr>
                                </thead>
                                <tbody>
                              @foreach($estudantes as $index => $estudante)
                                
                                  <tr @if(\App\Pagamento::estudanteConDivida($estudante)) class="conDivida" @endif  >
                                   <td> {{ $index+1}}</td>
                                   <td> {{ $estudante->nome}}{{ $estudante->apelido}}</td>
                                  <td> {{ $estudante->curso}}</td>
                                  <td>
                                  @if(\App\Pagamento::estudanteConDividaMes($estudante,3))
                                  <p>--</p>
                                  @else
                                     @foreach($resultado as $pagamento)
                                       @if($pagamento->estudante_id==$estudante->id)
                                             @if($pagamento->valor!=null && $pagamento->mes==3)
                                                  {{$pagamento->valor}}
                                             @endif
                                       @endif
                                   @endforeach
                                  @endif
                                  
                                  </td>
                                   <td>
                                    @foreach($resultado as $pagamento)
                                       @if($pagamento->estudante_id==$estudante->id)
                                             @if($pagamento->valor!=null && $pagamento->mes==4)
                                                  {{$pagamento->valor}}
                                             @endif
                                       @endif
                                   @endforeach                                  
                                  </td>
                                   <td>
                                    @foreach($resultado as $pagamento)
                                       @if($pagamento->estudante_id==$estudante->id)
                                             @if($pagamento->valor!=null && $pagamento->mes==5)
                                                  {{$pagamento->valor}}
                                             @endif
                                       @endif
                                   @endforeach                                  
                                  </td>
                                   <td>
                                    @foreach($resultado as $pagamento)
                                       @if($pagamento->estudante_id==$estudante->id)
                                             @if($pagamento->valor!=null && $pagamento->mes==6)
                                                  {{$pagamento->valor}}
                                             @endif
                                       @endif
                                   @endforeach                                  
                                  </td>
                                   <td>
                                    @foreach($resultado as $pagamento)
                                       @if($pagamento->estudante_id==$estudante->id)
                                             @if($pagamento->valor!=null && $pagamento->mes==7)
                                                  {{$pagamento->valor}}
                                             @endif
                                       @endif
                                   @endforeach                                  
                                  </td>
                                   <td>
                                    @foreach($resultado as $pagamento)
                                       @if($pagamento->estudante_id==$estudante->id)
                                             @if($pagamento->valor!=null && $pagamento->mes==8)
                                                  {{$pagamento->valor}}
                                             @endif
                                       @endif
                                   @endforeach                                  
                                  </td>
                                   <td>
                                    @foreach($resultado as $pagamento)
                                       @if($pagamento->estudante_id==$estudante->id)
                                             @if($pagamento->valor!=null && $pagamento->mes==9)
                                                  {{$pagamento->valor}}
                                             @endif
                                       @endif
                                   @endforeach                                  
                                  </td>
                                   <td>
                                    @foreach($resultado as $pagamento)
                                       @if($pagamento->estudante_id==$estudante->id)
                                             @if($pagamento->valor!=null && $pagamento->mes==10)
                                                  {{$pagamento->valor}}
                                             @endif
                                       @endif
                                   @endforeach                                  
                                  </td>
                                   <td>
                                    @foreach($resultado as $pagamento)
                                       @if($pagamento->estudante_id==$estudante->id)
                                             @if($pagamento->valor!=null && $pagamento->mes==11)
                                                  {{$pagamento->valor}}
                                             @endif
                                       @endif
                                   @endforeach                                  
                                  </td>
                                   <td>
                                    @foreach($resultado as $pagamento)
                                       @if($pagamento->estudante_id==$estudante->id)
                                             @if($pagamento->valor!=null && $pagamento->mes==12)
                                                  {{$pagamento->valor}}
                                             @endif
                                       @endif
                                   @endforeach                                  
                                  </td>
                                 </tr>
                               @endforeach
                               </tbody>
                              </table>
                                  
        </div>                     
                            
                              



                          
                         





@stop