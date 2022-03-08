@extends('layouts.Main')

@section('content')

<h1>Inserir Dispesas</h1>

<form action="{{route('storeDispesasDpto')}}">
	<label>Mes</label>
	<select name="mes">
		<option value="1">Janeiro</option>
		<option value="2">Fevereiro</option>
		<option value="3">Março</option>

	</select>
	<label>Ano</label>
	<select name="ano">
		<option value="2018">2018</option>
		<option value="2019">2019</option>
		<option value="2020">2020</option>

	</select>
    <label>Departamento</label>
	<select name="departamento">
	@foreach($departamentos as $departamento)
		<option value="{{$departamento->id}}">{{$departamento->identificador}}</option>
	@endforeach


	</select>
	<label>Valor</label>
	<input type="text" name="valor">
	<button type="submit">Inserir</button>
</form>

@stop