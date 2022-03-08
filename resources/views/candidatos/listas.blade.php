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
                Lista nominal para a prova de admissão
            </div>

            <div class="panel-body">
                <form action="{{ route('listasCandidatos') }}">
                    <div class="row">
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

                <a href="{{ route('listasCandidatosPdf', $curso_sel) }}">Lista PDF</a>
                <table class="table table-bordered table-striped">
                    <tr>
                        <td>Nº</td>
                        <th>Nome Completo</th>
                        <th>Curso</th>
                        <th></th>
                        <th>Estado</th>
                    </tr>
                    @foreach ($candidatos as $i => $item)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $item->nomeCompleto }} </td>
                            <td>{{ \App\Curso::toString($item->curso_id) }}</td>
                            <td>
                                @foreach ($item->obterAvaliacoes($item->id, $idProc) as $aval)
                                    <p><b>{{ $aval->exame->nome }}:</b> {{ $aval->valor }}</p>
                                @endforeach
                            </td>
                            <td>
                                {{ $item->estado }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>



    @stop
