@extends('layouts.Main')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6">

            </div>
            <div class="col-md-6" align="right">

            </div>
        </div>
    </div>


    <!-- .panel-heading -->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3>Lista de Estudantes por Turma</h3>

        </div>
        <div class="panel-body">
            <h3> <b><u>Legenda</u></b> <br>
                Código da Turma (Nome da Turma)
                <span class="badge">Quantidade de Estudantes da Turma</span>
                <span class="badge">Link para gerar PDF da lista de precença</span>
                <span class="badge">Link para gerar PDF da acta de avaliação</span>
            </h3>
            <span style="color:red"> Obs. Fazer click acima do nome para mostrar a lista dos estudantes da Turma.</span>
            <br>
            <br>
            <div class="panel-group" id="accordion">
                @foreach($turmas as $turma)

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#{{$turma->id}}" aria-expanded="false" class="collapsed"> {{$turma->identificador}} ({{$turma->curso}}) </a><span class="badge">{{\App\Turma::cantidadEstudantes($turma->id)}}</span>
                            <span class="badge"><a href="{{ route('pdfEstudantesTurma',$turma->id) }}">Lista de presença</a></span>
                            <span class="badge"><a href="{{ route('pdfActaAvaliacao',$turma->id) }}">Acta de Avaliação</a></span>
                            <span class="badge"><a href="{{ route('pdfPagamentoCartao',$turma->id) }}">Lista pagamentos cartão est(PDF)</a></span>
                           <!-- <span class="badge"><a href="{{ route('pdfEstudantesCartao',$turma->id) }}">Lista cartão est(PDF)</a></span>
                            <span class="badge"><a href="{{ route('exportListaCartao',$turma->id) }}">Lista cartão est (EXCEL)</a></span>-->

                           

                            <span style="color:red"><a href="#">
                                    @if($turma->anoAcademico=="2020")
                                    2020/2021
                                    @else
                                   2021/2022
                                    @endif
                                </a>
                            </span>


                        </h4>

                    </div>
                    <div id="{{$turma->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <th>Nº</th>
                                    <th>Fotografia</th>
                                    <th>Número de Estudante</th>
                                    <th>Nome Completo</th>
                                    <th>Nº BI</th>
                                    <!-- <th>Data de Validade do BI</th>-->
                                    <th>Data de Nascimento</th>
                                    <th>Idade</th>
                                    <th>Morada</th>
                                    <th>Telefones</th>

                                    <th>Editar</th>
                                    <th>Ficha</th>
                                </tr>



                                @foreach($turma->listaEstudantes($turma->id) as $i=>$item)
                                <tr>
                                    <td>{{$i+1}}</td>
                                    <td><img src="{{url('/storage/'.$item->pathImage) }}" alt=""></td>
                                    <td>{{$item->codigo}}</td>
                                    <td>{{$item->nome}} {{$item->apelido}}</td>
                                    <td>{{$item->BI}}</td>
                                    <!-- <td>{{$item->dataValidadeBI}}</td>-->
                                    <td>{{$item->dataNac}}</td>
                                    <td>{{$item->idade}}</td>
                                    <td>
                                        @if($item->provinciaEndereco_id ==null)
                                        {{$item->endereco}}
                                        @else
                                        <p><b>Provincia:</b> {{\App\Provincia::toString($item->provincia_id)}} <br>
                                            <b>Municipio:</b> {{\App\Municipio::toString($item->municipio_id)}} <br>
                                            <b>Zona ou Comuna:</b> {{$item->endereco}}

                                        </p>

                                        @endif

                                    </td>
                                    <td>
                                        @if($item->telefone1 !=null)
                                        <b>Tel. 1:</b> {{$item->telefone1}} <br>
                                        @endif
                                        @if($item->telefone2 !=null)
                                        <b>Tel. 2:</b> {{$item->telefone2}} <br>
                                        @endif
                                        @if($item->telefoneEmergencia !=null)
                                        <b>Tel. Emerg:</b> {{$item->telefoneEmergencia}}
                                        @endif
                                    </td>








                                    <td width="10"><a href="{{route('editarEstudantes',$item->id)}}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-pencil-square"></i>
                                        </a>

                                    </td>
                                    <!--   <td width="10">
                        <form action="{{route('eliminarEstudantes',$item->id)}}">
                            <input type="hidden" name="method" value="DELETE">
                            <button onclick="return confirm('Eliminar registro?')" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>

                    </td>
                -->
                                    <td width="10"><a href="{{route('fichaEstudante',$item->id)}}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-file-square">Ficha</i>
                                        </a>

                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                @endforeach



            </div>
        </div>
        <!-- .panel-body -->
    </div>
</div>


@stop