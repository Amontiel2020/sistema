@extends('layouts.Main')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6">

            </div>
            <div class="col-md-6" align="right">
                <!--    <a href="{{route('inserirEstudantes')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Inserir Estudante</a>-->
            </div>
        </div>
    </div>


    <div class="panel panel-primary">
        <div class="panel-heading">
            Lista nominal para a prova de admissão
        </div>

        <div class="panel-body">
            <form action="{{route('listarInscritos',$idProc)}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="idProc" value="{{ $idProc }}">

                <div class="row">

                    <div class=col-md-3>
                        <input type="text" class="form-control" name="nome" value="" placeholder="Nome">
                    </div>
                    <div class=col-md-3>
                        <select class="form-control" name="curso" id="curso">
                            <option value="0">Curso</option>
                            @foreach($cursos as $curso)
                            <option value="{{$curso->id}}">{{$curso->nome}}</option>
                            @endforeach


                        </select>
                    </div>
                    <div class=col-md-3>
                        <!-- <input type="text" class="form-control" name="buscarporEstado" value="" placeholder="Estado">-->
                        <select class="form-control" name="ano" id="ano">
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>


                        </select>
                    </div>
                    <div class=col-md-3>

                        <button type="submit" class="btn btn-primary" title="Pesquisar">
                            Pesquisar
                        </button>
                    </div>
                </div>
            </form>
            <br>
            <a class="btn btn-primary btn-sm" href="{{route('pdfListaInscritos',$idCurso)}}">Gerar pdf</a><br><br>
  
                <table class="table table-bordered table-striped">
                    <tr>
                        <td>Nº</td>
                        <td>Codigo</td>
                        <th>Nome Completo</th>
                        <th>Curso</th>
                        <th>Estado</th>
                        <th>Trabalhador</th>
                        <th></th>
                        @if(Auth::user()->hasRole('gestorAreaAcademica') )
                        <th></th>
                        @endif
                    </tr>
                    @foreach($candidatos as $i=>$item)
                    <tr>
                        <td>{{$i+1}}</td>
                        <td>{{$item->codigo}}</td>
                        <td>{{$item->nomeCompleto}} {{$item->apelido}}</td>
                        <td>{{\App\Curso::toString($item->curso_id)}}</td>
                        <td>
                            <label class="btn-info btn-sm">Inscrito</label>
                        </td>
                        <td>
                            @if($item->trabalhador==1)
                            Sim
                            @else
                            Não
                            @endif
                        </td>
                        <td width="10">
                            <a href="{{route('editarCandidato',[$item->id,$idProc])}}" class="btn btn-sm btn-primary">
                                <i class="fa fa-pencil-square"></i>
                            </a>
                        </td>
                        @if(Auth::user()->hasRole('gestorAreaAcademica') )
                        <td width="10">
                            <form action="{{route('eliminarCandidato',$item->id)}}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="idProc" value="{{$idProc}}">
                                <input type="hidden" name="id" value="{{$item->id}}">
                                <button onclick="return confirm('Eliminar registro?')" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </table>
           
        </div>
    </div>
    @stop