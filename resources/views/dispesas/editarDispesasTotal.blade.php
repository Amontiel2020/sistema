@extends('layouts.Main')

@section('content')

<h1>Editar Dispesas</h1>

<form action="{{route('updateDispesasTotal',$dispesa->id)}}">
	<label>Mes</label>
	<select name="mes">
		<option  value="1" @if($dispesa->mes=="1")selected @endif>Janeiro</option>
		<option  value="1" @if($dispesa->mes=="2")selected @endif>Janeiro</option>
		<option  value="1" @if($dispesa->mes=="3")selected @endif>Janeiro</option>

	</select>
	<label>Ano</label>
	<select name="ano">
		<option  value="2018" @if($dispesa->ano=="2018")selected @endif>2018</option>
		<option  value="2019" @if($dispesa->ano=="2019")selected @endif>2019</option>
		<option  value="2020" @if($dispesa->ano=="2020")selected @endif>2020</option>
		
	</select>
	<label>Valor</label>
	<input type="text" name="valor" value="{{$dispesa->valor}}">
	<button type="submit">Actualizar</button>
</form>

@stop