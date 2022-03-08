@extends('layouts.Main')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6">

            </div>
            <div class="col-md-6" align="right">
                <a role="button" class="btn btn-primary" href="{{route('inserirProfessores')}}"><i class="fa fa-plus-circle"></i> Registrar Professor</a>

            </div>
        </div>
    </div>


    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3>Lista de Professores</h3>
        </div>

        <div class="panel-body">
            <form action="{{route('index-professores')}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

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

                        <button type="submit" class="btn btn-primary" title="Pesquisar">
                            Pesquisar
                        </button>
                    </div>
                </div>

            </form>

            <table class="table table-bordered table-striped">
                <tr>
                    <!--  <th>Imagem</th> -->
                    <th>Nº</th>
                    <th>Nome Completo</th>
                    <th>Sexo</th>
                    <th>Email</th>
                    <th>Categoria</th>
                    <th>Grau Acadêmico</th>
                    <th>Telefones</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>


                @foreach($lista as $i=>$item)
                <tr>
                    <!--  <td><img src="" alt=""></td>-->
                    <td>{{$i+1}}</td>
                    <td>{{$item->nome}} {{$item->apelidos}}</td>
                    <td>{{$item->genero}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->categoria}}</td>
                    <td>{{$item->grauAcademico}}</td>
                    <td>
                        @if($item->telefone1 !=null)
                        <b>Tel.1:</b> {{$item->telefone1}} <br>
                        @endif
                        @if($item->telefone2 !=null)
                        <b>Tel.2:</b> {{$item->telefone1}}
                        @endif
                    </td>


                    <td width="10"><a href="{{route('editarProfessores',$item->id)}}" class="btn btn-sm btn-primary">
                            <i class="fa fa-pencil-square"></i>
                        </a>
                    </td>

                    <td width="10">
                        <form action="{{route('deleteProfessores',$item->id)}}">
                            <input type="hidden" name="method" value="DELETE">
                            <button onclick="return confirm('Eliminar registro?')" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </table>

            <div align="center">{{$lista->render()}}</div>

        </div>
    </div>
</div>



@stop