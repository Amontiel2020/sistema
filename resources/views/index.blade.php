@extends('layouts.Main')

@section('content')


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Painel de controlo</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

@if(Auth::user()->hasRole('admin'))
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Estudantes</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('listarEstudantes')}}"><span class="pull-left">Detalhes</span></a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">12</div>
                        <div>Cursos</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">Detalhes</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-building fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$cantDptos}}</div>
                        <div>Departamentos</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('listarDepartamentos')}}"> <span class="pull-left">Detalhes</span></a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$cantUsuarios}}</div>
                        <div>Usuarios</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('listarUsuarios')}}"> <span class="pull-left">Detalhes</span></a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->
@endif


@if(Auth::user()->hasRole('gestor'))
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        Kz
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ number_format($valorInscricao,2,',','.') }}</div>
                        <div>Inscrição</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">Detalhes</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        Kz
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ number_format($valorMatricula,2,',','.') }}</div>
                        <div>Matricula</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">Detalhes</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        Kz
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ number_format($valorPropina,2,',','.') }}</div>
                        <div>Propinas</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">Detalhes</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        Kz
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Total</div>
                        <div class="huge">{{ number_format($total,2,',','.') }}</div>
                        <div>
                            <a href="{{ route('ingresos.pdf') }}">
                                Relatório en pdf
                            </a>

                        </div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">Detalhes</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->





@endif

@if(Auth::user()->hasRole('Caixa'))
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">#</div>
                        <div>Propinas</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <!--  <a href="{{route('propinasGeral')}}"><span class="pull-left">Pagamentos</span></a> -->
                    <a href="{{route('pagamentosMes')}}"><span class="pull-left">Pagamentos</span></a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">#</div>
                        <div>Emolumentos</div>
                    </div>
                </div>
            </div>
            <a href="{{route('pagamentoEmolumento')}}">
                <div class="panel-footer">
                    <span class="pull-left">Pagamentos</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-building fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">#</div>
                        <div>Matriculas</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="#"> <span class="pull-left">Pagamentos</span></a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

</div>
<!-- /.row -->
@endif



@if(Auth::user()->hasRole('RH'))
<div class="row">
    <div class="col-lg-3 col-md-6">

        <div class="panel panel-primary">

            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Funcionarios</div>
                        {{$cantFuncionarios}}
                    </div>
                </div>
            </div>

            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('indexFuncionarios')}}">Lista dos Funcionarios</a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>

    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-money fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Mapas de Salarios</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('index_mapas_salarios')}}">Lista dos Mapas de Salarios</a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>

    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-calendar-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Mapa de Ferias</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('mapa_ferias')}}">Ver o mapa de Ferias</a>

                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>

    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-credit-card fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Subsidios</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('index_subsidios')}}">Lista dos Subsidios</a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>

    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-pencil-square-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Tipos de Contratos</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('index_tipo_contrato')}}">Listagem</a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>

    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Documentos</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('index_documentos')}}">Listagem</a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>

    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-mortar-board fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Habilitações Literarias</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('index_hab_literarias')}}">Listagem</a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>

    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-language fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Idiomas</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('index_lingua')}}">Listagem</a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>

    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-calendar-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Mapas IRT</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('mapa_ferias')}}">Ver</a>

                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>

    </div>

</div>
<!-- /.row -->
@endif
@if(Auth::user()->hasRole('DirectorAreaAcademica') || Auth::user()->hasRole('DirectorGeral'))
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-address-card-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Estudantes</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('listarEstudantes')}}">Lista</a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Turmas</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('listarTurmas')}}">Lista</a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-folder-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Estudantes-Turmas</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('estudantes-turmas')}}">Lista</a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user-circle fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Professores</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('index-professores')}}">Lista</a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-graduation-cap fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Cursos</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('listarCursos')}}">Lista</a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Unidades Curriculares</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('listarDisciplinas')}}">Lista</a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-pencil-square-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Inscrições</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('inscricoes')}}">Lista</a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-address-card fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Fichas de Estudante</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('buscarFicha')}}">Lista</a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

 @endif

 @if(Auth::user()->hasRole('gestorAreaAcademica') )
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-address-card-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Estudantes</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('listarEstudantes')}}">Lista</a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Turmas</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('listarTurmas')}}">Lista</a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-folder-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Estudantes-Turmas</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('estudantes-turmas')}}">Lista</a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user-circle fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Professores</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('index-professores')}}">Lista</a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-graduation-cap fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Cursos</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('listarCursos')}}">Lista</a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Unidades Curriculares</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('listarDisciplinas')}}">Lista</a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-pencil-square-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Inscrições</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('inscricoes')}}">Lista</a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-address-card fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Fichas de Estudante</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('buscarFicha')}}">Lista</a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

 @endif
 @if(Auth::user()->hasRole('GestorExamesAcesso') )
 <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-folder-open-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Processos Candidaturas</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <a href="{{route('listar_todos')}}">Lista</a>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
 @endif


@section('scripts')
<script src="{{secure_asset('js/d3.min.js')}}"></script>

<script type="text/javascript">
    var datos2 = [{
        {
            $valorInscricao
        }
    }, {
        {
            $valorMatricula
        }
    }, {
        {
            $valorPropina
        }
    }];

    d3.select('.graficoAdminEmp')
        .selectAll('div')
        .data(datos2)
        .enter().append('div')
        .attr('class', 'barra')
        .style("height", function(d) {
            return d / 5000 + "px";
        });


    var datos3 = [{
        {
            $valorInscricao
        }
    }, {
        {
            $valorMatricula
        }
    }, {
        {
            $valorPropina
        }
    }];

    d3.select('.grafico2')
        .selectAll('div')
        .data(datos3)
        .enter().append('div')
        .attr('class', 'barra')
        .style("height", function(d) {
            return d / 5000 + "px";
        })
</script>

@endSection


@stop