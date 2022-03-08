@extends('layouts.Main')

@section('content')

<div class="panel panel-primary">
                        <div class="panel-heading">
                            Filtros
                        </div>
                        <div class="panel-body">
                        <form class="form-inline" action="{{route('indexPagamentos')}}">
                        	<div class="form-group">
                        		<label>Emolumento</label>
                        		<select class="form-control" name="emolumento">
                        	  @foreach($emolumentos as $emolumento)
                        			<option value="{{$emolumento->id}}">{{$emolumento->nome}}</option>
                              @endforeach
                        		</select>
                        	</div>
                        	<button type="submit" class="btn btn-primary">Filtrar</button>
                        </form>
                        </div>

                    </div>

<div class="panel panel-primary">
                        <div class="panel-heading">
                            Pagamentos
                        </div>
                        <div class="panel-body">
<div class="panel panel-default">
 
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                           
                                            <th>Emolumento</th>
                                            <th>Estudante</th>
                                            <th>Valor</th>
                                            <th>Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     @foreach($pagamentos as $pagamento)
                                      <tr>
                                      	<td>{{App\Emolumento::toString($pagamento->emolumento_id)}}</td>
                                      	<td>{{App\Estudante::toString($pagamento->estudante_id)}}</td>
                                      	<td>{{$pagamento->valor}}</td>
                                      	<td>{{$pagamento->created_at}}</td>
                                      </tr>
                                     @endforeach
                                    </tbody>
                                </table>
                                <div align="center">{{$lista->render()}}</div>
                               
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                        </div>
                        <div class="panel-footer">
                            
                        </div>
                    </div>







@stop