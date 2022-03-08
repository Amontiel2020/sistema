@extends('layouts.Main')

@section('content')

<h1>Editar Idioma</h1>
<form action="{{route('update_lingua',$lingua->id)}}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="id" value="{{ $lingua->id }}">

	    <div class="form-group">
	    	<label for="nome">Nome</label>
			<input type="text" name="nome" value="{{$lingua->nome}}">
	    </div>
	    <div class="form-group">
	    	<label for="descricao">Descrição</label>
			<input type="text" name="descricao" value="{{$lingua->descricao}}">
	    </div>
	    <div class="form-group">
	    	<button class="btn btn-primary" type="submit"><i class="fa fa-plus-circle"></i> Actualizar</button>
	    	<button class="btn btn-primary">Cancelar</button>
	    </div>


			
</form>


@stop