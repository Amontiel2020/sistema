@extends('layouts.Main')

@section('content')
<div class="page-header">

</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3>Lista dos candidatos</h3>
    </div>

    <div class="panel-body">

        <div class="panel panel-default">
            <div class="panel-body">
                <form action="{{route('listar_candidatos')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="processo_id" id="processo" class="form-control">
                                    <option value="">Processo</option>
                                    @foreach($processos as $proc)
                                    <option value="{{$proc->id}}">{{$proc->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="submit">Filtrar</button>
                        </div>


                    </div>



                </form>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
            <a class="btn btn-primary" href="{{route('indexCandidatos')}}">Registrar Candidato</a>
            </div>
        </div>

        <table class="table table-bordered table-striped table-condensed">
            <tr>
                <th>Nº</th>
                <th>Nome Completo</th>
                <!-- <th>Sexo</th>-->
                <th>Curso</th>
                <th>Estado</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($candidatos as $i=>$candidato)
            <tr>
                <td>{{$i+1}}</td>
                <td>{{$candidato->nomeCompleto}}</td>
                <!--   <td>{{$candidato->genero}}</td>-->
                <td>{{\App\Curso::toString($candidato->curso_id)}}</td>
                <td>{{$candidato->estado}}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{route('editarCandidato',[$candidato->id,1])}}">Editar</a>
                </td>

                <td>
                    <a class="btn btn-danger btn-sm" href="#">Eliminar</a>
                </td>

            </tr>
            @endforeach
        </table>
    </div>

</div>




@stop