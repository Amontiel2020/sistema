@extends('layouts.Main')

@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6">

        </div>
        <div class="col-md-6" align="right">
            <a href="{{route('addCurso')}}" role="button" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Registrar Curso</a>

        </div>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3>Lista dos Cursos</h3>
    </div>

    <div class="panel-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Nº</th>
                <th>Nome do Curso</th>
                <th>Abreviatura</th>
                <th>Duração Curricular (anos)</th>
                <th>Secção Salas de Aulas </th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
            @foreach($cursos as $i=>$curso)
            <tr>
                <td>{{$i+1}}</td>
                <td>{{$curso->nome}}</td>
                <td>{{$curso->codigo}}</td>
                <td>{{$curso->duracao}}</td>
                <td>{{\App\Seccao::toString($curso->seccao_id)}}</td>
                <td width="10"><a role="button" href="{{route('editarCurso',$curso->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square"></i></a></td>
                <td width="10">
                <form action="{{route('eliminarCurso',$curso->id)}}">
                            <input type="hidden" name="method" value="DELETE">
                            <button onclick="return confirm('Confirma que deseja eliminar o curso?')" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                </td>

            </tr>
            @endforeach

    </div>
</div>

@stop