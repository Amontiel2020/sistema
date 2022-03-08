@extends('layouts.Main')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6">

            </div>
            <div class="col-md-6" align="right">
                <!--    <a href="{{route('inserirEstudantes')}}" ><i class="fa fa-plus-circle"></i> Inserir Estudante</a>-->
                <a class="btn btn-primary" href="{{route('inserirDisciplinas')}}"> <i class="fa fa-plus-circle"></i> Registrar Unidad Curricular</a>
            </div>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3>Lista de Unidades Curriculares</h3>
        </div>

        <div class="panel-body">
            <form action="{{route('listarDisciplinas')}}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class=col-md-3>
                        <input type="text" class="form-control" name="nome" value="" placeholder="Nome">
                    </div>
                    <div class=col-md-3>
                        <select class="form-control" name="curso" id="curso">
                            <option value="">Curso</option>
                            @foreach($cursos as $item)
                            <option value="{{$item->id}}">{{$item->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class=col-md-3>
                        <select class="form-control" name="ano" id="curso">
                            <option value="">Ano</option>
                           
                            <option value="1º">1º</option>
                            <option value="2º">2º</option>
                            <option value="3º">3º</option>
                            <option value="4º">4º</option>
                            <option value="5º">5º</option>

                           
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
            <table class="table table-bordered table-striped">
                <tr>
                    <td>Nº</td>
                    <th>Nome da Unidade Curricular</th>
                    <th>Curso</th>
                    <th>Ano Curricular</th>
                    <th>Semestre</th>
                    <th>Nuclear</th>
                    <th>Precedência</th>
                    <th>Nome do Professor</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>


                @foreach($lista as $i=> $item)
                <tr>
                    <td>{{$i+1}}</td>
                    <td>{{$item->nome}} </td>
                    <!--  <td>{{$item->apelido}}</td> -->
                    <td>{{\App\Curso::toString($item->curso_id)}}</td>
                    <td>{{$item->ano}}</td>
                    <td>{{$item->semestre}}</td>
                    <td>
                        @if($item->nuclear=="0")
                        Não
                        @endif
                        @if($item->nuclear=="1")
                        Sim
                        @endif
                    </td>
                    <td>
                        @if(\App\Disciplina::toString($item->discPrec_id)!=null)
                        {{\App\Disciplina::toString($item->discPrec_id)}}
                        <a href="{{route('eliminar_precedencia',$item->id)}}"><span class="label label-danger">Eliminar</span></a>
                        @else
                        <a href="#" data-type="select" class="editPresedencia" data-pk="{{$item->id}}">{{\App\Disciplina::toString($item->discPrec_id)}} </a>
                        @endif

                    </td>
                    <td>{{\App\Professor::toString($item->professor_id)}}</td>


                    <td width="10"><a href="{{route('editarDisciplinas',$item->id)}}" class="btn btn-sm btn-primary">
                            <i class="fa fa-pencil-square"></i>
                        </a>
                    </td>

                    <td width="10">
                        <form action="{{route('eliminarDisciplinas',$item->id)}}">
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
    @section('scripts')
    <script>
        $(document).ready(function() {
            //  $("#presedencia").select2({      });
            $.fn.editable.defaults.ajaxOptions = {
                type: "GET"
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });

            $('.editPresedencia').editable({
                url: '{{url("presedencia/update")}}',
                source: '{{url("presedencia/load")}}',
                type: 'select',
                emptytext: 'Definir precedência',
                /* params: function(params) {
                     //originally params contain pk, name and value
                    // params['X-CSRF-TOKEN'] = '{{csrf_token()}}';
                  
                     return params;
                 }*/

            });


        });
    </script>
    @endsection

    @stop