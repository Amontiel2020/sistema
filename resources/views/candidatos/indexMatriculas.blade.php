@extends('layouts.Main')

@section('content')
<br>
<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1>Candidatos Admitidos @if($curso_id!=null) em  {{\App\Curso::toString($curso_id)}} @endif</h1>

        </div>
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{route('indexMatriculas',$idProc)}}">
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
                                    @foreach($cursos as $curso)
                                    <option value="{{$curso->id}}">{{$curso->nome}}</option>
                                    @endforeach


                                </select>
                            </div>
                            <div class=col-md-3>
                                <!-- <input type="text" class="form-control" name="buscarporEstado" value="" placeholder="Estado">-->
                                <select class="form-control" name="ano" id="ano">
                                    <option value="2020">2020</option>
                                    <option value="2021" selected>2021</option>
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
                </div>
            </div>


            <table class="table table-bordered table-striped">
                <tr>
                    <td>Código</td>
                    <!--   <th>Imagem</th> -->
                    <th>Nome Completo</th>
                    <th>Curso</th>
                    <th></th>

                </tr>


                @foreach($candidatos as $item)
                <tr>
                    <td>{{$item->codigo}}</td>
                    <!--  <td><img src="{{url('/storage/'.$item->pathImage) }}" alt=""></td> -->
                    <td>{{$item->nomeCompleto}} {{$item->apelido}}</td>
                    <!--  <td>{{$item->apelido}}</td> -->
                    <td>{{\App\Curso::toString($item->curso_id)}}</td>


                    <td width="10">
                       
                        <a href="{{route('matricularCandidato',[$item->id,$idProc])}}" class="btn btn-primary">
                            Matricular
                        </a>
                      

                    </td>



                </tr>
                @endforeach
            </table>
        </div>
    </div>

</div>


@stop