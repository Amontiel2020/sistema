@extends('layouts.Main')

@section('content')
<div class="container-fluid">
	

    <div class="page-header">
    <div class="row">
        <div class="col-md-6">
       
        </div>
        <div class="col-md-6" align="right">
            <a href="{{route('inserirTurmas')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Registrar Turma</a>
        </div>

        </div>
    </div>

    <div class="panel panel panel-primary">
        <div class="panel-heading">
           <h3>Lista das Turmas</h3>
        </div>
        <div class="panel-body">
            <table class="table">
                    <tr>
                        <th>Código da Turma</th>
                        <th>Nome da Turma</th>
                      <!--  <th>Periodo Lectivo</th>
                        <th>Ano Curricular</th> -->
                        <th>Ano Acadêmico</th>
                        <th></th>
                        <th></th>
                    </tr>
                    
                @foreach($lista as $item)
                    <tr>
                        <td>{{$item->identificador}}</td>
                        <td>{{$item->curso}}</td>
                      <!--  <td>{{$item->periodo}}</td>
                        <td>{{$item->anoLectivo}}</td> -->
                        <td>{{$item->anoAcademico}}</td>


                        <td width="10"><a href="{{route('editarTurmas',$item->id)}}" class="btn btn-sm btn-primary">
                            <i class="fa fa-pencil-square"></i>         
                            </a>

                        </td>
                        <td width="10">
                            <form action="{{route('eliminarTurmas',$item->id)}}">
                                <input type="hidden" name="method" value="DELETE">
                            <button onclick="return confirm('Eliminar registro?')" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i>         
                            </button>
                            </form>

                        </td>

                    </tr>
                @endforeach
                </table>
                <div align="center">{{$lista->render()}}</div>
        
    </div>




</div>

@stop