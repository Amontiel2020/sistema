@extends('layouts.Main')

@section('content')
<div class="page-header"></div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3>Exames de Admissão no ano acadêmico {{\App\CONFIGURACAO::getAnoAcademico()}}</h3>

    </div>
    <div class="panel-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Nº</th>
                <th>Disciplina</th>
                <th>Curso</th>
                <th></th>
            </tr>
            @foreach( $pautasCandidaturas as $i=>$item)
            <tr>
                <td>{{$i+1}}</td>
                <td> {{\App\ExameCandidatura::toString($item->exame_id)}}</td>
                <td>{{\App\Curso::toString($item->curso_id)}}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <!--   <a href="{{route('listarPautaExameCandidatura',[$item->processo_id,$item->exame_id,$item->curso_id])}}"  class="btn btn-secondary" role="button">ver</a>-->
                        <a href="{{route('listarPautaExameCandidatura',[$item->processo->id,$item->exame->id,$item->curso->id])}}" class="btn btn-secondary" role="button">Mostrar</a>
                        <!--  <a href="#"  class="btn btn-secondary" role="button">Publicar</a>-->
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>



@stop