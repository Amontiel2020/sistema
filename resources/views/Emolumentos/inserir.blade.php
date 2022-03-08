@extends('layouts.Main')

@section('content')


<div class="panel panel-primary">
                        <div class="panel-heading">
                           Formulario Inserir Emolumentos
                        </div>
                        <div class="panel-body">

								<form role="form" action="{{route('storeEmolumentos')}}">
									    <div class="form-group">
									    	<label for="nome">Nome</label>
											<input class="form-control" type="text" name="nome">
									    </div>
									    <div class="form-group">
									    	<label for="valor">Valor</label>
											<input class="form-control" type="text" name="valor">
									    </div>
									    <div class="form-group">
									    	<button class="btn btn-primary" type="submit"><i class="fa fa-plus-circle"></i> Inserir</button>
									    	<button class="btn btn-outline btn-primary">Cancelar</button>
									    </div>


											
								</form>
                        </div>
                        <div class="panel-footer">
                            
                        </div>
                    </div>







@stop