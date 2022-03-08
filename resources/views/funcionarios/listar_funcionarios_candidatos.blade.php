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
            <h3>Lista de Candidatos</h3>
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
            <a href="{{route('inserirFuncionario_candidato')}}">Registrar Candidato</a>
            <table class="table table-bordered table-striped">
                <tr>
                    <td>Nº</td>
                    <th>Fotografia</th>
                    <th>Nome Completo</th>
                    <th>Sexo</th>
                    <th>Numero do Bilhete de Identidade</th>
                    <th>Data de Emissão do BI</th>
                    <th>Data de Validade do BI</th>
                    <th>Data de Nascimento</th>
 
                    <th></th>
                    <th></th>
                    <th></th>


                </tr>


                @foreach($lista as $i=> $item)
                <tr>
                    <td>{{$i+1}}</td>
                    <td></td>
                    <td>{{$item->nome_completo}} </td>
                    <td>{{$item->sexo}}</td>
                    <td>{{$item->numero_bi}}</td>
                    <td>{{$item->data_emissao_bi}}</td>
                    <td>{{$item->data_validade_bi}}</td>
                    <td>{{$item->data_nac}}</td>

                    <td width="10"><a href="{{route('contratar_candidato',$item->id)}}" class="btn btn-sm btn-primary">
                            Contratar
                        </a>
                    </td>
                    <td width="10"><a href="{{route('editar_candidato',$item->id)}}" class="btn btn-sm btn-primary">
                            <i class="fa fa-pencil-square"></i>
                        </a>
                    </td>

                    <td width="10">
                        <form action="{{route('eliminar_candidato',$item->id)}}">
                          
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