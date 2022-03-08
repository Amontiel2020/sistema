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
            <h3>Subsidios</h3>
        </div>
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-inline" action="{{route('index_subsidios')}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        {!! Form::select('funcionario_subsidio',$listaFuncionarios,null,['id'=>'funcionario_subsidio','style'=>'width: 50%']) !!}
                        <button type="submit" class="btn btn-success">Procurar</button>
                    </form>
                </div>
            </div>
            @if(!empty($lista_subsidios))
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Subsidios do funcionario {{$funcionario->nome_completo}}</h3>

                </div>
                <div class="panel-body">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h5>Registrar Subsidio</h5>
                        </div>
                        <div class="panel-body">
                            <form action="{{route('registrar_subsidio')}}" class="form-inline" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="funcionario" value="{{$funcionario->id}}">

                                <select class="form-control" name="subsidio" id="subsidio">
                                    @foreach($subsidios as $subsidio)
                                    <option value="{{$subsidio->id}}">{{$subsidio->nome}}</option>
                                    @endforeach
                                </select>
                                <input class="form-control" type="text" name="valor" id="valor" placeholder="Valor">
                                <button class="btn btn-success" type="submit">Registrar</button>
                            </form>
                        </div>

                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3>Subsidios</h3>
                            <table class="table table-bordered">
                                <tr>
                                <th>nº</th>
                                    <th>Subsidio</th>
                                    <th>Valor</th>
                                    <th></th>
                                </tr>
                                @foreach($funcionario->subsidios as $i=>$subsidio)
                                <tr>
                                <td>{{$i+1}}</td>
                                    <td>{{$subsidio->nome}}</td>
                                    <td>
                                     {{number_format($subsidio->pivot->valor,2,',','.') }}
                                    </td>
                                    <td> 
                                    <a href="{{route('eliminar_subsidio',[$funcionario->id,$subsidio->id])}}">
                                    <span class="label label-danger">Eliminar</span>
                                    </a>
                                    </td>

                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>

                </div>
            </div>


            @endif

        </div>
    </div>
</div>

@section('scripts')
<script>
    $(document).ready(function() {

        $('#funcionario_subsidio').select2({

        });
    });
</script>



@endsection

@stop