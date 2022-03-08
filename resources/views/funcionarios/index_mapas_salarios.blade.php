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
            <h3>Mapas de Salarios</h3>
        </div>

        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <a class="btn btn-success btn-sm" href="{{route('registrar_mapa_salarios')}}">Registrar Mapa</a>
                        </div>
                      
                        <div class="col-md-9">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5>Mapa IRT e Segurança Social</h5>
                                </div>
                                <div class="panel-body">
                                    <form action="{{route('index_mapas')}}" class="form-inline" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">IRT</label>
                                                    <input type="radio" name="tipo" id="tipo" value="irt">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Segurança Social</label>
                                                    <input type="radio" name="tipo" id="tipo" value="seg">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Resumo</label>
                                                    <input type="radio" name="tipo" id="tipo" value="resumo">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Mes</label>
                                                    <select name="mes" id="mes" class="form-control">
                                                        <option value="1">Janeiro</option>
                                                        <option value="2">Fevereiro</option>
                                                        <option value="3">Março</option>
                                                        <option value="4">Abril</option>
                                                        <option value="5">Maio</option>
                                                        <option value="6">Junho</option>
                                                        <option value="7">Julho</option>
                                                        <option value="8">Agosto</option>
                                                        <option value="9">Setembro</option>
                                                        <option value="10">Outubro</option>
                                                        <option value="11">Novembro</option>
                                                        <option value="12">Dezembro</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Ano</label>
                                                    <select name="ano" id="ano" class="form-control">
                                                        <option value="2021">2021</option>
                                                        <option value="2022">2022</option>
                                                        <option value="2023">2023</option>
                                                        <option value="2024">2024</option>
                                                        <option value="2025">2025</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                                </div>
                                            </div>

                                        </div>



                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>



                </div>
            </div>

            <table class="table table-bordered table-striped">

                <tr>
                    <th>Nº</th>
                    <th>Titulo</th>
                    <th>Mes</th>
                    <th>Ano</th>
                    <th>Grupo</th>
                    <th>Descrição</th>
                    <th></th>
                    <th></th>



                </tr>
                @foreach($mapas as $i=>$item)
                <tr>
                    <td>{{$i+1}}</td>
                    <td>{{$item->titulo}}</td>
                    <td>{{$item->mes}}</td>
                    <td>{{$item->ano}}</td>
                    <td>{{App\Grupo_funcionario::toString($item->grupo_funcionario_id)}}</td>
                    <td>{{$item->descricao}}</td>

                    <td>
                        <a class="btn btn-success btn-sm" href="{{route('mostrar_mapa',$item->id)}}">Mostrar</a>
                    </td>
                    <td>
                        <a class="btn btn-danger btn-sm" href="{{route('eliminar_mapa_salarios',$item->id)}}">Eliminar</a>
                    </td>
                </tr>
                @endforeach
            </table>

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

            $('.editFaltas').editable({
                url: '{{url("faltas/update")}}',
                source: '{{url("faltas/load")}}',
                type: 'select',
                emptytext: 'Horas Faltas',
            });

            $('.subsidioFuncao').editable({
                url: '{{url("presedencia/update")}}',
                source: '{{url("presedencia/load")}}',
                type: 'select',
                emptytext: 'Definir',
            });

            $('.subsidio_outros').editable({
                url: '{{url("presedencia/update")}}',
                source: '{{url("presedencia/load")}}',
                type: 'select',
                emptytext: 'Definir',
            });
        });
    </script>
    @endsection

    @stop