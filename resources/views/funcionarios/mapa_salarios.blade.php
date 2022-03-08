@extends('layouts.pantalla_grande')

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
            <h3>Mapa Salarios</h3>
        </div>

        <div class="panel-body">
            <div class="panel panel-secondary">
                <div class="panel-body">
                    <a href="{{route('exportar_mapaPagamentos',$mapa->id)}}"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i> Mapa Salarios</a><br>
                    <a href="{{route('exportar_mapa_seg_social',$mapa->id)}}"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i> Mapa Segurança Social</a><br>
                    <a href="{{route('exportar_mapa_irt',$mapa->id)}}"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i> Mapa IRT</a>

                </div>
            </div>

            <table class="table table-bordered table-striped">
                <tr>
                    <th colspan="6"></th>
                    <th class="" colspan="2">Remunerações</th>
                    <th></th>
                    <th colspan="4">Descontos</th>
                    <th colspan="4">SUBSIDIOS</th>
                    <th></th>

                </tr>
                <tr>
                    <td>Nº</td>
                    <th>Nome Completo</th>
                    <th>Categoria Ocupacional</th>
                    <th>Salario Base</th>
                    <th>Faltas</th>
                    <th>Desconto Faltas</th>
                    <th>Subsidio Função</th>
                    <th>Outros Adicionais</th>
                    <th>Salario Iliquido</th>
                    <th>SEG SOC</th>
                    <th>I.R.T</th>
                    <th>OUTROS</th>
                    <th>TOTAL</th>
                    <th>NATAL</th>
                    <th>FERIA</th>
                    <th>OUTROS</th>
                    <th>TOTAL</th>

                    <th>LIQUIDO A RECEBER</th>
                </tr>
                @foreach($mapa->temp_salarios as $i=> $item)
                <tr>
                    <td>{{$i+1}}</td>
                    <td>{{\App\Funcionario::toString($item->funcionario_id)}} </td>
                    <td>{{$item->funcionario->categoria_ocupacional}}</td>
                    <td>
                        {{number_format(\App\Funcionario::getSalario($item->funcionario_id),2,',','.') }}

                    </td>
                    <td>
                        <!-- FALTAS -->
                        <a href="#" data-type="text" class="editFaltas" data-pk="{{$item->id}}">{{$item->horas_faltas}} </a>

                    </td>
                    <td>
                        <!-- DESCONTO FALTAS -->
                        {{number_format(\App\Funcionario::obter_desconto_faltas($item->id),2,',','.') }}


                    </td>
                    <td>
                        <!-- Subsidio Função -->
                       <!-- <a href="#" data-type="text" class="subsidioFuncao" data-pk="{{$item->id}}">{{$item->subcidio_funcao}} </a>-->
                    </td>
                    <td>
                        <!-- Subsidio Outros -->
                       <!-- <a href="#" data-type="text" class="subsidio_outros" data-pk="{{$item->id}}">{{$item->subsidio_outros_adicionais}} </a>-->
                       {{number_format(\App\Funcionario::calcular_total_subsidio($item->funcionario_id),2,',','.') }}
                    </td>

                    <td>
                        {{number_format(\App\Funcionario::calcular_salario_liquido($item->id),2,',','.') }}

                    </td>
                    <td>
                        {{number_format(\App\Funcionario::calc_seg_social($item->id),2,',','.') }}
                    </td>
                    <td>

                        {{number_format(\App\Funcionario::calc_IRT($item->id),2,',','.') }}
                    </td>
                    <td></td>
                    <td>
                        {{number_format(\App\Funcionario::calc_desconto_total($item->id),2,',','.') }}
                       
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>

                    <td>
                    {{number_format(\App\Funcionario::calc_salario_final($item->id),2,',','.') }}

                      


                    </td>


                </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                    {{number_format(\App\Funcionario::total_salario_base($mapa->id),2,',','.') }}
                    
                    </td>
                    <td></td>
                    <td>
                        {{number_format(\App\Funcionario::total_desconto_faltas($mapa->id),2,',','.') }}
                    </td>
                    <td></td>
                    <td></td>
                    <td>

                        {{number_format(\App\Funcionario::total_salario_iliquido($mapa->id),2,',','.') }}

                    </td>
                    <td>

                        {{number_format(\App\Funcionario::total_desconto_seguridad_social($mapa->id),2,',','.') }}

                    </td>
                    <td>
                        {{number_format(\App\Funcionario::total_desconto_irt($mapa->id),2,',','.') }}
                    </td>
                    <td></td>
                    <td>
                    {{number_format(\App\Funcionario::total_desconto($mapa->id),2,',','.') }}
                    
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                    {{number_format(\App\Funcionario::total_salario($mapa->id),2,',','.') }}
                    
                    </td>

                </tr>
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
                url: '{{url("subsidioFuncao/update")}}',
                source: '{{url("subsidioFuncao/load")}}',
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