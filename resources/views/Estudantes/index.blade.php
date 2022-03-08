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
            <h3>Lista de estudantes</h3>
        </div>

        <div class="panel-body">
            <form action="{{route('listarEstudantes')}}">
                <div class="row">
                    <!--  <div class=col-md-4>
                        <select name="tipo" class="form-control">
                            <option>Pesquisar por tipo</option>
                            <option>nome</option>
                            <option>apelido</option>
                            <option>curso</option>
                            <option>email</option>
                            <option>turma</option>
                        </select>
                    </div>
                    -->
                    <div class=col-md-4>
                        <input type="text" class="form-control" name="buscarpor" value="" placeholder="Nome">
                    </div>
                    <div class=col-md-4>
                        <!-- <input type="text" class="form-control" name="buscarporEstado" value="" placeholder="Estado">-->
                        <select class="form-control" name="buscarporEstado" id="buscarporEstado">
                            <option value="Candidato">Candidato</option>
                            <option value="Novo Ingresso">Activo</option>
                            <option value="Desistente">Desistente</option>
                            <option value="Anulado">Anulado</option>
                            <option value="Novo Ingresso">Novo Ingresso</option>
                            <option value="Em Continuação dos Estudos">Em Continuação dos Estudos</option>
                            <option value="Repetente">Repetente</option>
                            <option value="Em Preparação da Monografia">Em Preparação da Monografia</option>

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

            <table class="table table-bordered table-striped">
                <tr>
                    <td>Nº</td>
                    <th>Fotografia</th>
                    <th>Número de Estudante</th>
                    <th>Nome Completo</th>
                    <th>Curso</th>
                    <th>Ano Curricular</th>
                    <th>Turma</th>
                    <th>Estado</th>
                    <th>Idade</th>
                    <th>Trabalhador</th>
                    <th></th>
                    <th></th>
                    @if(Auth::user()->hasRole('gestorAreaAcademica') )
                    <th></th>
                    @endif
                </tr>


                @foreach($lista as $i=> $item)
                <tr>
                    <td>{{$i+1}}</td>
                    <td><img src="{{url('/storage/'.$item->pathImage) }}" alt=""></td>
                    <td>{{$item->codigo}}</td>
                    <td>{{$item->nome}} </td>
                    <!--  <td>{{$item->apelido}}</td> -->
                    <td>{{\App\Curso::toString($item->curso_id)}}</td>
                    <td>{{$item->anoAcademico}}</td>
                    @if($item->turma_id!=null)
                    <td>{{\App\Turma::toString($item->turma_id)}}</td>
                    @else
                    <td></td>
                    @endif
                    <td>{{$item->estado}}</td>
                    <td>{{$item->idade}}</td>
                    <td>
                        @if($item->trabalhador==1)
                        Sim
                        @else
                        Não
                        @endif
                    </td>
                    <td width="10"><a href="{{route('editarEstudantes',$item->id)}}" class="btn btn-sm btn-primary">
                            <i class="fa fa-pencil-square"></i>
                        </a>
                    </td>
                    <!-- <td width="10"><a href="{{route('fichaEstudante',$item->id)}}" class="btn btn-sm btn-primary">
                            perfil
                        </a>
                    </td>-->
                    <td width="10"> <a href="{{route('cartao2',$item->id)}}" class="btn btn-sm btn-primary">
                            cartao
                        </a>
                    </td>


                    @if(Auth::user()->hasRole('gestorAreaAcademica') )
                    <td width="10">
                        <form action="{{route('eliminarEstudantes',$item->id)}}">
                            <input type="hidden" name="method" value="DELETE">
                            <button onclick="return confirm('Eliminar registro?')" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </table>
            <p>
                <a href="{{ route('estudantes.pdf') }}" class="btn btn-sm btn-primary">
                    Descarregar estudantes em PDF
                </a>
            </p>
            <div align="center">{{$lista->render()}}</div>

        </div>
    </div>



    @stop