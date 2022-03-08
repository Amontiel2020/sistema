@extends('layouts.Main')

@section('content')

<div class="page-header">
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
    <h1>Estudantes com Unidades Curriculares em atraso</h1>
    </div>

    <div class="panel-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th>#</th>
                <th>Nome Completo</th>
                <th>Curso</th>
                <th>Turma</th>
                <th>Disciplinas Atraso</th>
            </tr>
            @foreach($lista as $i=>$estudante)
           
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{$estudante->nome}} {{$estudante->apelido}} </td>
                <td>{{\App\Curso::toString($estudante->curso_id)}}</td>
                <td>{{\App\Turma::toString($estudante->turma_id)}}</td>
                <td>
                    @foreach(\App\Estudante::obterDisciplinasAtrasoDadoEstudante($estudante->id) as $disciplina)
                   
                    {{\App\Disciplina::toString($disciplina)}}<br>
                   
                    @endforeach
                </td>
            </tr>
           
            @endforeach
        </table>

    </div>
</div>



@stop