@extends('layouts.Admin')

@section('content')

<table class="table">
<thead>
	<th>Nombre</th>
</thead>	
<tbody>
@foreach($movies as $movie)
<td>{{$movie->nombre}}</td>
@endforeach
</tbody>

</table>

@stop