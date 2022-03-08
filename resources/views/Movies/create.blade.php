@extends('layouts.Admin')

@section('content')
<form action="/store" method="GET">
	<div class="form-group">
	<input type="text" name="nombre">
	<input type="submit" name="botao" value="enviar">
	</div>
</form>
@stop