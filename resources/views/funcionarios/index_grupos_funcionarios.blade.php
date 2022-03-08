@extends('layouts.Main')

@section('content')

    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-6" align="right">
                    <!--    <a href="{{ route('inserirEstudantes') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Inserir Estudante</a>-->
                </div>
            </div>
        </div>


        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3>Grupos de Funcionarios</h3>
            </div>

            <div class="panel-body">
                <a href="{{ route('registrar_grupo_funcionario') }}">Regristrar Grupo</a>

                <table class="table table-bordered table-striped">

                    <tr>
                        <th>Nº</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th></th>
                        <th></th>




                    </tr>
                    @foreach ($grupos as $i => $item)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $item->nome }}</td>
                            <td>{{ $item->descricao }}</td>
                            <td width="10"><a href="{{ route('editar_grupo_funcionario', $item->id) }}"
                                    class="btn btn-sm btn-primary">
                                    <i class="fa fa-pencil-square"></i>
                                </a>
                            </td>

                            <td width="10">
                                <form action="{{ route('eliminar_grupo_funcionario', $item->id) }}">
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
    </div>




    @stop
