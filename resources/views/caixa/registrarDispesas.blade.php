@extends('layouts.Main')

@section('content')


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Registrar Dispesas</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
   <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
           Dispesas
        </div>
				    <div class="panel-body">
				    <div class="row">
				        <div class="col-lg-6">
							
							<form role="form" action="{{route('storeDispesas')}}" id="createDispesas_form" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="form-group">
									<label>Data</label>
									<input class="form-control" type="date" name="data" value="{{ old('data') }}" required>
									<span class="text-danger">{{ $errors->first('data') }}</span>
								</div>
								<div class="form-group">
									<label>Descrição</label>
									<textarea class="form-control" type="text" name="descricao" value="{{ old('descricao') }}" required>
                                    </textarea>
									<span class="text-danger">{{ $errors->first('descricao') }}</span>
								</div>
    							<datalist id="fornecedores">
								@foreach($fornecedores as $fornecedor)
                                <option value="{{$fornecedor->nome}}">{{$natureza->nome}}</option>  
                                @endforeach       
								</datalist>
								<div class="form-group">
									<label>Fornecedor</label>
									<input list="fornecedores" class="form-control" type="text" name="fornecedor" value="{{ old('fornecedor') }}" >
									<span class="text-danger">{{ $errors->first('fornecedor') }}</span>
								</div>
                                <div class="form-group">
									<label>Valor</label>
									<input class="form-control" type="text" name="valor" value="{{ old('valor') }}" required>
									<span class="text-danger">{{ $errors->first('valor') }}</span>
								</div>
                                <div class="form-group">
									<label>Meio Pagamento</label>
									<select name="meioPagamento" id="" class="form-control">
									  <option value="-">-</option>
									  <option value="Cash">Cash</option>
									  <option value="Depósito">Depósito</option>
									  <option value="TPA">TPA</option>
									</select>
									<span class="text-danger">{{ $errors->first('meioPagamento') }}</span>
								</div>
								<datalist id="naturezas">
								@foreach($naturezas as $natureza)
                                <option value="{{$natureza->descricao}}">{{$natureza->descricao}}</option>  
                                @endforeach       
								</datalist>
								<div class="form-group">
									<label>Natureza</label>
									<input list="naturezas" class="form-control" type="text" name="natureza" value="{{ old('natureza') }}" >
									<span class="text-danger">{{ $errors->first('natureza') }}</span>
								</div>
								<div class="form-group">
									<label>Nº Factura</label>
									<input class="form-control" type="text" name="numFactura" value="{{ old('numFactura') }}" >
									<span class="text-danger">{{ $errors->first('numFactura') }}</span>
								</div>

								<div class="form-group">
									<label>Area</label>
									<select name="area" id="area" class="form-control">
                                   
									@foreach($departamentos as $departamento)
                                      <option value="{{$departamento->id}}">{{$departamento->identificador}}</option>  
                                    @endforeach    
									</select>
									<span class="text-danger">{{ $errors->first('area') }}</span>
								</div>

								
							
				        </div>
				    </div>
				</div>
       </div>
       <div class="panel panel-default">
       	<div class="panel-body">
			<div class="row">
									
				<div class="col-lg-12">
											
					<div class="col-lg-6">
						<button class="btn btn-primary btn-block" type="submit">Registrar</button>
					</div>
					<div class="col-lg-6">
					    <button class="btn btn-outline btn-success btn-block">Cancelar</button>	
					</div>
				</div>
									   
										
			</div>
       	</div>
       </div>
    </div>
</div>
</form>




@stop