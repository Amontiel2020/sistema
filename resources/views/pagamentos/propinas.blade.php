@extends('layouts.Main')

@section('content')



    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Filtros
                        </div>
                        <div class="panel-body">
                            <form class="form-inline" action="{{route('propinas')}}">
                            	<select class="form-control" name="idTurma">
                            		@foreach($turmas as $turma)
                            		<option value="{{$turma->id}}">{{$turma->identificador}}</option>  
                            		@endforeach                          		 
                            	</select>
                            	<button type="submit" class="btn btn-primary">Buscar</button>
                            </form>
        <form action="">
       <select name="tipo">
      <option>Pesquisar por tipo</option>
      <option>nome</option>
      <option>apelido</option>
      <option>curso</option>
      <option>email</option>
      <option>turma</option>
    </select>
       <input type="text"   name="buscarpor" value="">
 
      <button type="submit" class="btn btn-primary" title="Pesquisar">
                Pesquisar
            </button>

 
  
    
    </form>
    

                        </div>
                        <div class="panel-footer">
                         
                        </div>
    </div>

@if(isset($estudantes))
        <div class="panel panel-primary">
                        <div class="panel-heading">
                            <button class="btn btn-info"
                            data-toggle="modal" data-target="#myModal"
                            >Fazer Pagamento</button>
                            <button class="btn btn-info"
                            data-toggle="modal" data-target="#myModal2"
                            >Fazer Pagamento temporal</button>
                        </div>
                        <div class="panel-body">
                 <div class="panel panel-default">
                        <div class="panel-heading">
                            @if(isset($turmaSelecionada))
                            {{$turmaSelecionada->identificador}}--> {{$turmaSelecionada->curso}} {{$turmaSelecionada->periodo}}
                            @else
                            <p>Todos os estudantes</p>
                            @endif
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                           
                                            <th>Nome</th>
                                            <th>Turma</th>
                                            <th>Meses Pagos</th>





                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach($estudantes as $estudante)
                                         <tr>
                                          
                                         	<td width="200">
                                             <a 
                                             href="{{route('fichaPagamento',$estudante->id)}}" 
                                            
                                             >
                                             <img src="{{url('/storage/'.$estudante->pathImage) }}" alt="">  
                                             {{$estudante->nome}}
                                             </a>
                                             </td>
                                            <td width="20">{{App\Turma::toString($estudante->turma_id)}}</td>

                                         	<td>
                                         	   <div class="row">
                                         	   	  <div class="col-md-12"> 
		                                         	@foreach(App\Http\Controllers\Pagamentos::pagamentos(2020,$estudante->id) as $pagamento)

		                                         	<div class="col-md-2 @if($pagamento->valor!=0) test @else sinPagar @endif">
                                                        <form action="{{route('eliminarPagamento',$pagamento->id)}}">
                                                        @if($pagamento->valor!=0)
                                                           <button onclick="return confirm('Eliminar Pagamento?')" type="submit" class="close">×</button>
                                                        @endif
		                                         		{{$pagamento->valor}}
                                                        </form>
		                                         	</div>                                     	

		                                         	@endforeach

		           

		                                           </div>
                                         	    </div>
                                         	                                 		
                                         	</td>

                                         	

                                         </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <div align="center">{{$estudantes->render()}}</div>
                            </div>
                            <!-- /.table-responsive -->
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>

                        </div>
                        <div class="panel-footer">
                         
                        </div>
    </div>

    @else
    <h3>Sem resultados</h3>

    @endif


    <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Fazer Pagamento</h4>
                                        </div>
                                        <div class="modal-body">

                                            <form action="{{route('fazerPagamento')}}">
                                            	<div class="form-group">
                                            		<label>Estudante</label>
                                            		<select id="selectFazerPagamento" class="form-control" name="estudante">
                                            		@if(isset($estudantes))
                                                    <option>Selecione</option>
                                            			@foreach($estudantes as $estudante)
                                            			<option  value="{{$estudante->id}}">{{$estudante->nome}}</option>
                                            			@endforeach
                                            		@endif
                                            		</select>
                                            	</div>
                                            	<div class="form-group">
                                            		<select id="mesesFazerPagamento" multiple name="mes[]" class="form-control">                                    		
                                          
                                            		</select>

                                            	</div>
                                            	<div class="form-group">
                                            		<label>Ano:</label>
                                            		<input type="text" id="valorPagamento" name="valorPagamento" value="2020" readonly>
                                            	</div>
                                            	
  
                                            	
                                           
                                        </div>
                                        <div class="modal-footer">
                                           
                                            <button type="submit" class="btn btn-primary">Confirmar Pagamento</button>
                                        </div>
                                    </div>
                                     </form>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

<!--*************************************************************************************************-->
   <!-- Modal -->
   <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Fazer Pagamento</h4>
                                        </div>
                                        <div class="modal-body">

                                            <form action="{{route('fazerPagamentoTemporal')}}">
                                            	<div class="form-group">
                                            		<label>Estudante</label>
                                            		<select id="selectFazerPagamento" class="form-control" name="estudante">
                                            		@if(isset($estudantes))
                                                    <option>Selecione</option>
                                            			@foreach($estudantes as $estudante)
                                            			<option  value="{{$estudante->id}}">{{$estudante->nome}}</option>
                                            			@endforeach
                                            		@endif
                                            		</select>
                                            	</div>
                                                <label for="">Mes1</label>
                                            	<div class="form-group">
                                            		<input class="form-control" type="text" id="valorMes1" name="valorMes1">
                                            	</div>
                                                <label for="">Mes 2</label>
                                                <div class="form-group">
                                            		<input class="form-control" type="text" id="valorMes2" name="valorMes2">
                                            	</div>
                                                <label for="">Mes 3</label>
                                                <div class="form-group">
                                            		<input class="form-control" type="text" id="valorMes3" name="valorMes3">
                                            	</div>

                                            	
  
                                            	
                                           
                                        </div>
                                        <div class="modal-footer">
                                           
                                            <button type="submit" class="btn btn-primary">Confirmar Pagamento</button>
                                        </div>
                                    </div>
                                     </form>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
<!--******************************************************************************************* ******-->






   <!-- Modal 2 -->
                            <div class="modal fade" id="pagamento2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Fazer Pagamento</h4>
                                        </div>
                                        <div class="modal-body">

                                            <form action="{{route('fazerPagamentoMes')}}">
                                            	<input type="hidden" id="idEstudante" name="idEstudante">
                                            	<div class="form-group">
                                            		<label>Estudante</label>
                                                      <input class="form-control" type="text" id="nomeEstudante" name="estudante"  readonly>
                                            	</div>
                                            	<div class="form-group">
                                            		<label>Mes</label>
                                            		<input class="form-control" type="text" id="mesX" name="mesX" readonly>

                                            	</div>
                                            	<div class="form-group">
                                            		<label>Ano:</label>
                                            		<input class="form-control" type="text" name="anoX" value="2020"  readonly>
                                            	</div>
                                           	    <div class="form-group">
                                            		<label>Valor:</label>
                                            		<input class="form-control" type="text" name="valor">
                                            	</div>                                           	
                                            	
  
                                            	
                                           
                                        </div>
                                        <div class="modal-footer">
                                           
                                            <button type="submit" class="btn btn-primary">Confirmar Pagamento</button>
                                        </div>
                                    </div>
                                     </form>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->


@stop