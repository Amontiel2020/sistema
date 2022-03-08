@extends('layouts.Main')

@section('content')
<br>
<form action="{{route('distribuirDispesas')}}">
	<label>Mes</label>
	<select name="mes">
		<option value="1">Janeiro</option>
		<option value="2">Fevereiro</option>
		<option value="3">Março</option>
		<option value="4">Abril</option>
		<option value="5">Maio</option>
		<option value="6">Junho</option>
		<option value="7">Julho</option>
		<option value="8">Agosto</option>
		<option value="9">Setembro</option>
		<option value="10">Outubro</option>
		<option value="11">Novembro</option>
		<option value="12">Dezembreo</option>


	</select>
	<label>Ano</label>
	<select name="ano">
		<option value="2018">2018</option>
		<option value="2019">2019</option>
		<option value="2020">2020</option>

	</select>
	<button type="submit">Enviar</button>
</form>
<hr>
<p>Dispesa total:{{$dispesaTotal}}</p>
<p>Dispesa usada:</p>

<hr>
<h3>Distribuir</h3>

<table class="table">
<tr>
	<th>Departamento</th>
	<th>Valor</th>
	<th>Mes</th>
	<th>Ano</th>
	<th></th>
	<th></th>
</tr>
@foreach($dispesas as $item)
<tr>
	<td>{{\App\Departamento::toString($item->departamento_id)}}</td>
	<td>{{$item->valor}}</td>
	<td>{{$item->mes}}</td>
	<td>{{$item->ano}}</td>
	<td><button>Editar</button></td>
	<td><a href="">Justificar</a></td>
</tr>
@endforeach
</table>

@stop