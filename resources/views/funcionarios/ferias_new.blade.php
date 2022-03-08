@extends('layouts.Main')

@section('content')

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3>Mapa de Ferias</h3>
    </div>
    <div class="panel-body">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h6>Marcar Ferias</h6>
            </div>
            <div class="panel-body">
                <form class="form-inline" action="{{route('store_feria')}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Funcionario</label>
                                <select class="form-control" name="funcionario_id" id="funcionario_id">
                                    @foreach($funcionarios as $funcionario)
                                    <option value="{{$funcionario->id}}">{{$funcionario->nome_completo}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Inicio</label>
        
                                <input min="{{$date}}" max="2021-12-31" class="form-control" type="date" name="data_inicio">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Fim</label>
                                <input name="data_fim"  min="{{$date}}" max="2021-12-31" type="date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="submit" class="button button-primary">Marcar</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <table class="table table-bordered table-striped">
            <tr>
                <th></th>
                <th>Jan</th>
                <th>Fev</th>
                <th>Mar</th>
                <th>Abr</th>
                <th>Maio</th>
                <th>Jun</th>
                <th>Jul</th>
                <th>Ago</th>
                <th>Set</th>
                <th>Out</th>
                <th>Nov</th>
                <th>Dez</th>


            </tr>
            @for ($i = 1; $i <= 31; $i++) <tr>
                <td>{{ $i }}</td>
                <td>
                    @foreach(\App\Funcionario::obterFuncionariosFerias($i,1) as $feria)
                    <a href="{{route('editar_ferias',$feria->id)}}"><span class="label label-primary">{{\App\Funcionario::primeiro_nome($feria->funcionario_id)}}</span></a>
                    @endforeach
                </td>
                <td>
                    @foreach(\App\Funcionario::obterFuncionariosFerias($i,2) as $feria)
                    <a href="{{route('editar_ferias',$feria->id)}}"><span class="label label-secondary">{{\App\Funcionario::primeiro_nome($feria->funcionario_id)}}</span></a>
                    @endforeach
                </td>
                <td>
                    @foreach(\App\Funcionario::obterFuncionariosFerias($i,3) as $feria)
                    <a href="{{route('editar_ferias',$feria->id)}}"><span class="label label-success">{{\App\Funcionario::primeiro_nome($feria->funcionario_id)}}</span></a>
                    @endforeach
                </td>
                <td>
                    @foreach(\App\Funcionario::obterFuncionariosFerias($i,4) as $feria)
                    <a href="{{route('editar_ferias',$feria->id)}}"><span class="label label-danger">{{\App\Funcionario::primeiro_nome($feria->funcionario_id)}}</span></a>
                    @endforeach
                </td>
                <td>
                    @foreach(\App\Funcionario::obterFuncionariosFerias($i,5) as $feria)
                    <a href="{{route('editar_ferias',$feria->id)}}"><span class="label label-warning">{{\App\Funcionario::primeiro_nome($feria->funcionario_id)}}</span></a>
                    @endforeach
                </td>
                <td>
                    @foreach(\App\Funcionario::obterFuncionariosFerias($i,6) as $feria)
                    <a href="{{route('editar_ferias',$feria->id)}}"><span class="label label-info">{{\App\Funcionario::primeiro_nome($feria->funcionario_id)}}</span></a>
                    @endforeach
                </td>
                <td>
                    @foreach(\App\Funcionario::obterFuncionariosFerias($i,7) as $feria)
                    <a href="{{route('editar_ferias',$feria->id)}}"><span class="label label-primary">{{\App\Funcionario::primeiro_nome($feria->funcionario_id)}}</span></a>
                    @endforeach
                </td>
                <td>
                    @foreach(\App\Funcionario::obterFuncionariosFerias($i,8) as $feria)
                    <a href="{{route('editar_ferias',$feria->id)}}"><span class="label label-primary">{{\App\Funcionario::primeiro_nome($feria->funcionario_id)}}</span></a>
                    @endforeach
                </td>
                <td>
                    @foreach(\App\Funcionario::obterFuncionariosFerias($i,9) as $feria)
                    <a href="{{route('editar_ferias',$feria->id)}}"><span class="label label-success">{{\App\Funcionario::primeiro_nome($feria->funcionario_id)}}</span></a>
                    @endforeach
                </td>
                <td>
                    @foreach(\App\Funcionario::obterFuncionariosFerias($i,10) as $feria)
                    <a href="{{route('editar_ferias',$feria->id)}}"><span class="label label-danger">{{\App\Funcionario::primeiro_nome($feria->funcionario_id)}}</span></a>
                    @endforeach
                </td>
                <td>
                    @foreach(\App\Funcionario::obterFuncionariosFerias($i,11) as $feria)
                    <a href="{{route('editar_ferias',$feria->id)}}"><span class="label label-warning">{{\App\Funcionario::primeiro_nome($feria->funcionario_id)}}</span></a>
                    @endforeach
                </td>
                <td>
                    @foreach(\App\Funcionario::obterFuncionariosFerias($i,12) as $feria)
                    <a href="{{route('editar_ferias',$feria->id)}}"><span class="label label-info">{{\App\Funcionario::primeiro_nome($feria->funcionario_id)}}</span></a>
                    @endforeach
                </td>




                </tr>
                @endfor
        </table>

    </div>
</div>




@stop