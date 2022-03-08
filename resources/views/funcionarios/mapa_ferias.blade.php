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
            <h3>Mapa de Ferias</h3>
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
                            <option value="Novo Ingresso">Activo</option>
                            <option value="Desistente">Desistente</option>
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
            <a href="{{route('marcar_ferias')}}">Registrar Feria</a>
            <table class="table table-bordered table-striped">
                <tr>
                    <td>Nº</td>
                    <th>Nome do Funcionario</th>
                    <th>Ano Acadêmico</th>
                    <th>Data Inicio</th>
                    <th>Data Fim</th>


                    <th></th>
                    <th></th>


                </tr>


                @foreach($lista as $i=> $item)
                <tr>
                    <td>{{$i+1}}</td>
                    <td>{{App\Funcionario::toString($item->funcionario_id)}}</td>
                    <td>{{$item->ano_academico}}</td>
                    <td>{{$item->data_inicio}}</td>
                    <td>{{$item->data_fim}}</td>



  


                    <td width="10"><a href="{{route('editar_funcionario',$item->id)}}" class="btn btn-sm btn-primary">
                            <i class="fa fa-pencil-square"></i>
                        </a>
                    </td>

                    <td width="10">
                        <form action="{{route('eliminarEstudantes',$item->id)}}">
                            <input type="hidden" name="method" value="DELETE">
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