@extends('layouts.layoutComprovativo')


@section('content')





<table class="table table-bordered table-striped">
    <tr>
        <th>Nº</th>
        <th>Emolumento</th>
        <th>Mês</th>
        <th>Valor</th>
        <th>Data</th>


    </tr>
    @foreach($new_array as  $item)
    <tr>
        <td></td>
        <td>{{$item->idEmolumento}}</td>
        <td>{{$item->mes}}</td>
        <td>{{$item->valor}}</td>
        <td>{{$item->ano}}</td>



    </tr>
    @endforeach



</table>
@endsection