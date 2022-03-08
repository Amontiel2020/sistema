@extends('layouts.Main')

@section('content')

<h1>Editar Emolumentos</h1>
<form action="{{route('updateEmolumentos',$emolumento->id)}}" method="PUT">
	    <div class="form-group">
	    	<label for="nome">Nome</label>
			<input type="text" name="nome" value="{{$emolumento->nome}}">
	    </div>
	    <div class="form-group">
	    	<label for="valor">Valor</label>
			<input type="text" name="valor" value="{{$emolumento->valor}}">
	    </div>
	    <div class="form-group">
	    	<button class="btn btn-primary" type="submit"><i class="fa fa-plus-circle"></i> Actualizar</button>
	    	<button class="btn btn-primary">Cancelar</button>
	    </div>


			
</form>


@stop