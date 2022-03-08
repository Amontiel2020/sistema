@extends('layouts.Main')

@section('content')





<div class="panel panel-primary">
    <div class="panel-heading">
        Dispesas Geral
        <a href="{{route('inserirDispesaTotal')}}" class="btn btn-info btn-xs"><i class="fa fa-plus-circle"></i> Inserir</a>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th>Mes</th>
                        <th>Ano</th>
                        <th>Valor</th>
                        <th>Distribuido</th>
                        <th>Restante</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dispesas as $dispesa)
                    <tr>
                        <td width="10"><a href="{{route('editarDispesasTotal',$dispesa->id)}}" class="btn btn-primary btn-xs">
                                <i class="fa fa-pencil-square"></i>
                            </a>

                        </td>
                        <td width="10">
                            <form action="{{route('deleteDispesaTotal',$dispesa->id)}}">
                                <input type="hidden" name="method" value="DELETE">
                                <button onclick="return confirm('Eliminar registro?')" class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>

                        </td>
                        <td>{{$dispesa->mes}}</td>
                        <td>{{$dispesa->ano}}</td>
                        <td>{{$dispesa->valor}}</td>
                        <td>{{$dispesa->valorDistribuido}}</td>
                        <td>{{$dispesa->valor-$dispesa->valorDistribuido}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        Dispesas por departamento
        <a href="{{route('inserirDispesaDpto')}}" class="btn btn-info btn-xs"><i class="fa fa-plus-circle"></i> Inserir</a>
    </div>
    <div class="panel-body">

        <div class="row">
            <div class="col-md-12">
                @foreach($departamentos as $departamento)
                @if($departamento->temDispesas())
                <div class="col-md-4">

                    @include('dispesas.dispesasDepartamento')
                </div>
                @endif
                @endforeach

            </div>
        </div>
    </div>
</div>





<!-- .panel-heading -->
<div class="panel-body">
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">Departamento 1 350 000 </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                <div class="panel-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">Departamento2 120 000</a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                <div class="panel-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">Departamento 3 100 000</a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                <div class="panel-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
            </div>
        </div>

    </div>
</div>
<!-- .panel-body -->
</div>





@stop