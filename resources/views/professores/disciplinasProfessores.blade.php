@extends('layouts.Main')

@section('content')
<div class="page-header"></div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>Unidades Curriculares do ano acadêmico {{\App\CONFIGURACAO::getAnoAcademico()}}</h3>

    </div>
    <div class="panel-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Nº</th>
                <th>Nome da Unidade Curricular</th>
                <th>Semestre</th>
                <th>Curso</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($disciplinas as $i=>$disciplina)
            <tr>
                <td>{{$i+1}}</td>
                <td>{{$disciplina->nome}}</td>
                <td>{{$disciplina->semestre}}</td>
                <td>{{\App\Curso::toString($disciplina->curso_id)}}</td>
                <td><a href="{{route('obterInscricoes',[$disciplina,\App\CONFIGURACAO::getAnoAcademico()])}}">Avaliações</a></td>
                <th><a href="{{route('professores_actividades',$disciplina->id)}}">ver</a></th>

            </tr>
            @endforeach
        </table>
        <!-- <table class="table table-bordered table-striped">
            <tr>
                <th>Nº</th>
                <th>Nome</th>
                <th>Curso</th>
                <th>Turma</th>
                <th>Disciplina</th>

                <th></th>
            </tr>
            @foreach( $pautas as $i=>$item)

            <tr>
                <td>{{$i+1}}</td>
                <td>{{$item->nome}}</td>
                <td>{{\App\Turma::getCurso($item->turma_id)}}</td>
                <td>{{\App\Turma::toString($item->turma_id)}}</td>
                <td>{{\App\Disciplina::toString($item->disciplina_id)}}</td>

                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                      
                        <a href="{{route('mostrarPauta',$item->id)}}" class="btn btn-secondary" role="button">Mostrar</a>
                      
                    </div>

                </td>

            </tr>
            @endforeach
        </table>-->
    </div>
</div>



@stop