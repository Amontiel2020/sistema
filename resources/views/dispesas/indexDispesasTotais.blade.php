@extends('layouts.Main')

@section('content')

<a href="{{route('inserirDispesaTotal')}}">inserir</a>
<table class="table">
	<tr>
		<th>Mes</th>
		<th>Ano</th>
		<th>Valor</th>
	</tr>
	@foreach($dispesas as $dispesa)
     <tr>
     	<td>{{$dispesa->mes}}</td>
     	<td>{{$dispesa->ano}}</td>
     	<td>{{$dispesa->valor}}</td>

     </tr>
	@endforeach


</table>
@stop