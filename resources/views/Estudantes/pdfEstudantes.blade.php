@extends('layouts.layoutPdf')

@section('content')
<table class="table table-bordered table-striped">
    <tr>
        <th>Nome e Apelidos</th>
        <th>Curso</th>
        <th>Ano</th>
        <th>Turma</th>
        <th>Estado</th>

    </tr>


    @foreach($estudantes as $item)
    <tr>
        <td>{{$item->nome}} {{$item->apelido}}</td>
        <!--  <td>{{$item->apelido}}</td> -->
        <td>{{$item->curso}}</td>
        <td>{{$item->anoAcademico}}</td>
        <td>{{\App\Turma::toString($item->turma_id)}}</td>
        <td>{{$item->estado}}</td>

    </tr>
    @endforeach
</table>
@endsection