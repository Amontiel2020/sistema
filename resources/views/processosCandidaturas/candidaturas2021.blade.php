@extends('layouts.pantalla_grande')

@section('content')

<div class="container">
  
    <div class="row">
        
        <div class="col-lg-6 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <div>Registrar Candidato</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <a href="{{route('indexCandidatos')}}">Registrar</a>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-6 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-money fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <div>Pagar Factura</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <a href="{{route('listarCandidaturas')}}">Pagar</a>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<br><br><br><br>
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">

            <div class="row">
                <div class="col-xs-6">
                    <div class="panel panel primary">
                        <div class="panel-body">
                            <h3>Formas de contacto</h3>
                            <ul>
                                <li>Redes Sociais {{$redes}}</li>
                                <li>Radio {{$radio}}</li>
                                <li>TV {{$tv}}</li>
                                <li>Autocarro {{$autocarro}}</li>
                                <li>Visita para escolas {{$visita}}</li>
                                <li>Outdoors {{$outdoors}}</li>
                                <li>Mensagem verbal {{$mensagem}}</li>


                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-xs-2"></div>
                <div class="col-xs-4">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <h1 align="left">Total Candidatos: {{$total_candidatos}}</h1>
                            <h1 align="left" style="color:red">Segunda Chamada: {{$total_candidatosSegCh}}</h1>

                            <h1 align="left">Hoje: {{$candidatosHoje}}</h1>
                        </div>
                    </div>

                </div>

            </div>
            <h3 align="center">Candidatos inscritos por Curso</h3>
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

                                    <div class="huge"><s>{{\App\Curso::qtdCandidatos($curso->id)}}</s></div>
                                    <div class="huge" style="color:red">{{\App\Curso::qtdCandidatosSegCh($curso->id)}}</div>

                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <h3><a href="{{route('pdfListaInscritos',$curso->id)}}">{{$curso->nome}}</a></h3><br>
                                <a href="{{route('pdfListaInscritosSegCh',$curso->id)}}"><span style="color:red">Lista Segunda Chamada</span></a><br>

                                <a href="{{route('pdfActaExameCand',$curso->id)}}">Acta Exame</a><br>
                                <a href="{{route('pdfActaExameCandSegCh',$curso->id)}}"><span style="color:red">Acta Exame - Segunda Chamada</span></a>

                                


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