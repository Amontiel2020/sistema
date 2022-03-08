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
                Candidatos
            </div>

            <div class="panel-body">
                <form action="{{ route('resultadosProcesso', $idProc) }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="idProc" value="{{ $idProc }}">
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
                        <div class=col-md-3>
                            <input type="text" class="form-control" name="nome" value="" placeholder="Nome">
                        </div>
                        <div class=col-md-3>
                            <select class="form-control" name="curso" id="curso">
                                <option value="0">Curso</option>
                                @foreach ($cursos as $curso)
                                    <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                                @endforeach


                            </select>
                        </div>
                        <div class=col-md-3>
                            <!-- <input type="text" class="form-control" name="buscarporEstado" value="" placeholder="Estado">-->
                            <select class="form-control" name="ano" id="ano">
                                <option value="2020">2020</option>
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

              <!--  <a href="{{ route('actualizarResultados', $idProc) }}"><i class="fa fa-refresh" aria-hidden="true"></i>-->
                    Actualizar Resultados</a>
                <br>
                <form action="{{ route('mudarEstadoCandidatos') }}" name="candidatos" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="idProc" value="{{ $idProc }}">

                    <input type="hidden" name="candidatoSel" value="">


                    <table class="table table-bordered table-striped">
                        <tr>
                            <td>Nº</td>
                            <td></td>
                            <td>Codigo</td>
                            <!--   <th>Imagem</th> -->
                            <th>Nome Completo</th>
                            <th>Curso</th>
                            <th>Avaliações</th>
                            <th>Classificação</th>
                            <th>Resultado Final</th>
                            <th>Trabalhador</th>
                            <th></th>
                            @if (Auth::user()->hasRole('gestorAreaAcademica'))
                                <th></th>
                            @endif
                        </tr>


                        @foreach ($candidatos as $i=>$item)
                          
                               
                           
                                <tr>
                                    <td>{{$i+1}}</td>
                                    <td><input type="checkbox" name="id[]" value="{{ $item->id }}"></td>
                                    <td>{{ $item->codigo }}</td>
                                    <!--  <td><img src="{{ url('/storage/' . $item->pathImage) }}" alt=""></td> -->
                                    <td>{{ $item->nomeCompleto }} {{ $item->apelido }}</td>
                                    <!--  <td>{{ $item->apelido }}</td> -->
                                    <td>{{ \App\Curso::toString($item->curso_id) }}</td>
                                    <td>
                                        @foreach (\App\Candidato::obterAvaliacoes2($item->id, $idProc) as $aval)
                                        <p>{{$aval->exame->nome}}: <span class="badge" style="color: white;">{{$aval->valor}} </span><!--<a href="{{route("eliminarExameCandidatura",$aval->id)}}">eliminar</a>--></p>
                                       
                                        @endforeach
                                    </td>


                                    <td >{{ round($item->obterMedia($idProc, $item->id), 2) }}</td>
                                    <td>

                                        <!--   <a role="button" href="#" @if ($item->estado == 'Candidato') class="btn-warning btn-sm" @else class="btn btn-outline btn-warning btn-sm" @endif>Candidato</a>
                                    <a role="button" href="#" @if ($item->estado == 'Inscrito') class="btn-info btn-sm" @else class="btn btn-outline btn-info btn-sm" @endif>Inscrito</a>-->
                                        <a role="button" href="{{ route('mudarEstadoReprovado', [$item->id, $idProc]) }}"
                                            @if ($item->estado == 'Não Admitido') class="btn-danger btn-sm" @else class="btn btn-outline btn-danger btn-sm" @endif>Não Admitido</a>
                                        <a role="button" href="{{ route('mudarEstadoAprovado', [$item->id, $idProc]) }}"
                                            @if ($item->estado == 'Admitido') class="btn-success btn-sm" @else class="btn btn-outline btn-success btn-sm" @endif>Admitido</a>
                                            <a role="button" href="{{ route('mudarEstadoSegundaChamada', [$item->id, $idProc]) }}"
                                                @if ($item->estado == 'Segunda Chamada') class="btn-success btn-sm" @else class="btn btn-outline btn-success btn-sm" @endif>Segunda Chamada</a>

                                    </td>
                                    <td>
                                        @if ($item->trabalhador == 1)
                                            Sim
                                        @else
                                            Não
                                        @endif
                                    </td>
                                    <td width="10"><a href="{{ route('editarCandidato', [$item->id, $idProc]) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="fa fa-pencil-square"></i>
                                        </a>
                                    </td>

                                    @if (Auth::user()->hasRole('gestorAreaAcademica'))
                                        <td width="10">
                                            <form action="{{ route('eliminarCandidato', $item->id) }}" method="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                                <input type="hidden" name="idProc" value="{{ $idProc }}">
                                                <input type="hidden" name="id" value="{{ $item->id }}">


                                                <button onclick="return confirm('Eliminar registro?')"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                               
                        @endforeach
                    </table>


                    <a href="javascript:seleccionar_todo()">Marcar todos</a>
                    <a href="javascript:deseleccionar_todo()">Desmarcar todos</a>
                    Para os elementos que estão marcados
                    <select name="mudarEstado">
                        <option value="Admitido">Admitido</option>
                        <option value="Não Admitido">Não Admitido</option>
                        <option value="Segunda Chamada">Segunda Chamada</option>


                    </select>
                    <button type="submit" onclick="return confirm('Mudar Estados?')" class="btn btn-sm btn-success">
                        Mudar Estado
                    </button>
                </form>

            </div>
        </div>

    @section('scripts')
        <script>
            function seleccionar_todo() {
                for (i = 0; i < document.candidatos.elements.length; i++)
                    if (document.candidatos.elements[i].type == "checkbox")
                        document.candidatos.elements[i].checked = 1
            }

            function deseleccionar_todo() {
                for (i = 0; i < document.candidatos.elements.length; i++)
                    if (document.candidatos.elements[i].type == "checkbox")
                        document.candidatos.elements[i].checked = 0
            }

            function ejecutarFormulario() {
                //  $("input:hidden#candidatoSel").val(id);
                document.candidatos.submit();
            }
        </script>
    @endsection

@stop
