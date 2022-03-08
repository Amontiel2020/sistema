@extends('layouts.pantalla_grande')

@section('content')

<div class="container">
  
</div>
<br><br><br><br>
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">

            <div class="row">
                <div class="col-xs-6">
                    <div class="panel panel primary">
                        <div class="panel-body">
                            

                        </div>
                    </div>

                </div>
                <div class="col-xs-2"></div>
                <div class="col-xs-4">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <h1 align="left">Total Matriculados: {{$total_matriculados}}</h1>
                            <h3 align="left">Confirmação: {{$total_confirmacao}}</h3>
                            <h3 align="left">Novas Matriculas: {{$total_novasMatriculas}}</h3>
                        </div>
                    </div>

                </div>

            </div>
            <h3 align="center">Matriculados por Curso</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                @foreach($cursos as $curso)
                <div class="col-lg-3 col-md-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <div class="huge">{{\App\Curso::qtdMatriculados($curso->id)}}</div>
                                    @if($curso->id==1||$curso->id==2||$curso->id==3||$curso->id==4)
                                    <div class="huge" style="font-size: small;">1º Ano: {{\App\Curso::qtdMatriculadosPrimeiroAno($curso->id)}}</div>
                                    <div class="huge" style="font-size: small;">2º Ano: {{\App\Curso::qtdMatriculadosSegundoAno($curso->id)}}</div>
                                    @endif

                                    
                                  

                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <h3><a href="#">{{$curso->nome}}</a></h3><br>
                                 <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>

@stop