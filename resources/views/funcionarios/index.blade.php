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
            <h3>Lista de funcionários</h3>
        </div>

        <div class="panel-body">
            <form action="#">
                <div class="row">

                    <div class=col-md-4>
                        <input type="text" class="form-control" name="buscarpor" value="" placeholder="Nome">
                    </div>
                    <div class=col-md-4>
                          <select class="form-control" name="buscarporEstado" id="buscarporEstado">
                            <option value="Activo">Activo</option>
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
            <a href="{{route('inserirFuncionario')}}">Registrar Funcionário</a>

            <table class="table table-bordered table-striped">
                <tr>

                    <th>Nº</th>
                    <th>Fotografia</th>
                    <th>Nome Completo</th>
                    <th>Sexo</th>
                    <th>Categoria Ocupacional</th>
                    <th>Numero do BI</th>
                    <th>Data de Nascimento</th>
                    <th>Contacto</th>
                    <th></th>
                    <th></th>


                </tr>


                @foreach($lista as $i=> $item)
                <tr>

                    <td>{{$i+1}}</td>
                    <td><img width="100px" height="100px" src="{{url('/storage/'.$item->pathImage) }}" alt=""></td>
                    <td>{{$item->nome_completo}} </td>
                    <td>{{$item->sexo}}</td>
                    <td>{{$item->categoria_ocupacional}}</td>
                    <td>{{$item->numero_bi}}</td>
                    <td>{{$item->data_nac}}</td>
                    <td>
                        @if($item->telefone1 !=null)
                        <b>Telefone 1:</b> {{$item->telefone1}} <br>
                        @endif
                        @if($item->telefone2 !=null)
                        <b>Telefone 2:</b> {{$item->telefone2}}
                        @endif
                    </td>


                    <td width="10"><a href="{{route('editar_funcionario',$item->id)}}" class="btn btn-sm btn-primary">
                            <i class="fa fa-pencil-square"></i>
                        </a>
                    </td>

                    <td width="10">
                          <form action="{{route('eliminar_funcionario',$item->id)}}">
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