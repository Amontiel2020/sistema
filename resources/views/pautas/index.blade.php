@extends('layouts.Main')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6">

            </div>
            <div class="col-md-6" align="right">
                <!--    <a href="{{route('inserirEstudantes')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Inserir Estudante</a>-->
                <a class="btn btn-sm btn-primary" href="{{route('inserirPauta')}}"><i class="fa fa-plus-circle"></i> Registrar Pauta</a>

            </div>
        </div>
    </div>


    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3>Lista das Pautas</h3>
        </div>

        <div class="panel-body">

            <form action="{{route('listaPautas')}}">
                <div class="row">

                    <div class=col-md-4>
                        <select class="form-control" name="idTurma" id="idTurma">
                            <option value="-" selected>Turma</option>
                            @foreach($turmas as $item)
                            <option value="{{$item->id}}">{{$item->identificador}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class=col-md-4>
                        <select class="form-control" name="anoAcademico" id="anoAcademico">
                            <option value="-" selected>Ano Acadêmico</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>

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
            <div class="panel panel-default">
                <div class="panel-heading">

                </div>
                <div class="panel-body">



                    <table class="table table-bordered table-striped">
                        <tr>
                            <td>Nº</td>
                            <th>Unidade Curricular</th>
                            <th>Curso</th>
                            <th>Ano Curricular</th>
                            <th>Semestre</th>
                            <th>Professor</th>
                            <th></th>
                            <!--<th></th>-->
                        </tr>


                        @foreach($disciplinas as $i=>$item)
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$item->nome}}</td>
                            <td>{{\App\Curso::toString($item->curso_id)}}</td>
                            <td>{{$item->ano}}</td>
                            <td>{{$item->semestre}}</td>
                            <td>
                                {{\App\Professor::toString($item->professor_id)}}
                            </td>
                            <td>
                                <a type="submit" href="{{route('obterInscricoes',[$item->id,\App\CONFIGURACAO::getAnoAcademico()])}}" class="btn btn-primary" title="ver">Ver</a>

                            </td>
                           <!-- <td>
                                <form action="{{route('eliminarPauta',$item->id)}}">
                                    <input type="hidden" name="method" value="DELETE">
                                    <button onclick="return confirm('Confirma que deseja eliminar a pauta?')" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>-->
                        </tr>
                        @endforeach
                    </table>

                </div>
            </div>



        </div>
    </div>



    @stop