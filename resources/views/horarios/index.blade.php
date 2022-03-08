@extends('layouts.Main')

@section('content')


<div class="page-header">
</div>


<div class="panel panel-primary">
    <div class="panel-heading">
        <h3>Lista de Horarios</h3>
    </div>

    <div class="panel-body">
        <form action="#">
            <div class="row">

            <div class=col-md-4>
                    <select class="form-control" name="curso" id="curso">
                        <option value="-">Curso</option>
                    </select>
                </div>
                <div class=col-md-4>
                    <select class="form-control" name="turma" id="turma">
                        <option value="turma">Turma</option>
                    </select>
                </div>
                <div class=col-md-4>

                    <button type="submit" class="btn btn-primary" title="Pesquisar">
                        Pesquisar
                    </button>
                </div>
            </div>
        </form>
        <br>
        <a href="{{route('inserir_horario')}}">Registrar Horario</a>

        <table class="table table-bordered table-striped">
            <tr>

                <th>Nº</th>
                <th>Turma</th>
                <th>Ano Académico </th>
                <th>Semestre</th>
                <th>Actividades</th>
                <th></th>
                <th></th>


            </tr>


            @foreach($lista as $i=> $item)
            <tr>

                <td>{{$i+1}}</td>
                <td>{{\App\Turma::toString($item->turma->id)}}</td>
                <td>{{$item->anoAcademico}}</td>
                <td>{{$item->semestre}}</td>
                <td><a href="{{route('horario-actividades',$item->id)}}">ver</a></td>
                <td width="10"><a href="#" class="btn btn-sm btn-primary">
                        <i class="fa fa-pencil-square"></i>
                    </a>
                </td>

                <td width="10">
                    <form action="#">
                        <button onclick="return confirm('Eliminar registro?')" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>

            </tr>
            @endforeach
        </table>

    </div>
</div>



@stop