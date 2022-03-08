@extends('layouts.Main')

@section('content')

<div class=" panel panel-primary">
    <div class="panel-heading">
        <H3>Pauta dos resultados de candidatura</H3>
    </div>
    <div class="panel-body">
        <form action="#">
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
                        @foreach($cursos as $curso)
                        <option value="{{$curso->id}}">{{$curso->nome}}</option>
                        @endforeach


                    </select>
                </div>

                <div class=col-md-3>

                    <button type="submit" class="btn btn-primary" title="Pesquisar">
                        Pesquisar
                    </button>
                </div>
            </div>
        </form>
    </div>

    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>Nº</th>
            <th>Código</th>
            <th>Nome Completo</th>
            <th>Sexo</th>
            <th>Idade</th>
            <th>Curso</th>
            <th>Exames</th>

        </tr>
        @foreach($candidatos as $i=>$candidato)
        <tr>
            <td>{{$i+1}}</td>
            <td>{{$candidato->codigo}}</td>
            <td>{{$candidato->nomeCompleto}}</td>
            <td>{{$candidato->genero}}</td>
            <td>{{$candidato->idade}}</td>
            <td>{{\App\Curso::toString($candidato->curso_id)}}</td>
            <td>
                <table class="table">
                    <tr>
                        <th>Disciplina</th>
                        <th>Classificação</th>
                    </tr>
                    @foreach($candidato->obterAvaliacoes($candidato->id,$candidato->processo_id) as $aval)
                    <tr>
                        <td>{{\App\ExameCandidatura::toString($aval->exame_id)}}</td>
                        <td>{{$aval->valor}}</td>
                    </tr>
                    @endForeach
                    <tr>
                        <td>Media <span style="font-size: 4;">(Aritimetica)</span> </td>
                        <td>{{round($candidato->obterMedia($candidato->processo_id,$candidato->id),2)}}</td>
                    </tr>
                    <tr>
                        <td>Media (%)</td>
                        <td>{{round($candidato->obterMediaPorCiento($candidato->processo_id,$candidato->id),2)}}</td>
                    </tr>
                </table>
            </td>
        </tr>
        @endForeach
    </table>


    
</div>


@stop