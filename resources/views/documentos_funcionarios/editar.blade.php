@extends('layouts.Main')

@section('content')

<h1>Editar Documento</h1>
<form action="{{route('update_documentos',$documento->id)}}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="id" value="{{ $documento->id }}">

	    <div class="form-group">
	    	<label for="nome">Nome</label>
			<input type="text" name="nome" value="{{$documento->nome}}">
	    </div>
	    <div class="form-group">
	    	<label for="descricao">Descrição</label>
			<input type="text" name="descricao" value="{{$documento->descricao}}">
	    </div>
	    <div class="form-group">
	    	<button class="btn btn-primary" type="submit"><i class="fa fa-plus-circle"></i> Actualizar</button>
	    	<button class="btn btn-primary">Cancelar</button>
	    </div>


			
</form>


@stop