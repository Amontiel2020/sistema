@extends('layouts.Main')

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">

    </div>
    <div class="panel-body">
        <form class="form-inline" action="{{route('filtrarPagamentosMes')}}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="">Data</label>
                <input type="date" name="data" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Mes</label>
                <input type="month" name="fecha" id="fecha" class="form-control">

            </div>
            <div class="form-group">
                <label for="">Todos</label>
                <input type="checkbox" name="todos" id="todos" class="form-control">

            </div>
            <div class="form-group">

                <input type="submit" class="btn-primary " value="Filtrar">
            </div>
        </form>
    </div>



</div>

<div class="row">
    <div class="col-lg-2 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        Kz
                    </div>
                    <div class="col-xs-9 text-right">
                        <div>{{ number_format($totalInscricao,2,',','.') }}</div>
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
    <div class="col-lg-2 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        Kz
                    </div>
                    <div class="col-xs-9 text-right">
                        <div>{{ number_format($totalMatricula,2,',','.') }}</div>
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
    <div class="col-lg-2 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        Kz
                    </div>
                    <div class="col-xs-9 text-right">
                        <div>{{ number_format($totalPropinas,2,',','.') }}</div>
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
    <div class="col-lg-2 col-md-6">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        Kz
                    </div>
                    <div class="col-xs-9 text-right">
                        <div>{{ number_format($totalEmolumentos,2,',','.') }}</div>
                        <div>Emolumentos</div>
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
                        <div>{{ number_format($total,2,',','.') }}</div>
                        <div>Total</div>
                        <div>


                        </div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <div>Total TPA:{{ number_format($totalTPA,2,',','.') }}</div>
                    <div>Total Dinheiro:{{ number_format($totalDinheiro,2,',','.') }}</div>
                    <div>Total Transferência:{{ number_format($totalTransf,2,',','.') }}</div>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

</div>
<!-- /.row -->

<a href="{{route('pdfDiarioCaixa',$date)}}">PDF Diario de Caixa</a>

<!--<div id="containerTest" style="min-width: 400px; height: 300px; margin: 0 auto"></div>-->

<div class="panel panel-primary">
    <div class="panel-heading">
        Pagamentos
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Designação</th>
                        <th>Estudante</th>
                        <th>Mes</th>
                        <th>Valor</th>
                        <th>Taxa</th>
                        <th>Meio Pagamento</th>
                        <th>Obs</th>
                        @if(Auth::user()->hasRole('gestor'))
                        <th></th>
                        <th></th>
                        <th></th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($pagamentos as $pagamento)
                    <tr>
                        <td><?php echo date('d-m-Y', strtotime($pagamento->created_at)) ?></td>
                        <td>

                            {{\App\Emolumento::toString($pagamento->emolumento_id)}}


                        </td>
                        <td>
                            @if($pagamento->estudante_id!=0)
                            {{\App\Pagamento::toStringEstudante($pagamento->estudante_id)}}
                            @elseif($pagamento->estudante_id==0 && $pagamento->descrip!=null)
                            {{\App\Pagamento::toStringCandidato($pagamento->descrip)}}
                            @elseif($pagamento->estudante_id==0 )
                            Candidato
                            @endif
                        </td>
                        <td>

                            @if($pagamento->ano==2021)
                            @switch($pagamento->mes)
                            @case(1)
                            <span> Outubro</span>
                            @break
                            @case(2)
                            <span>Novembro</span>
                            @break
                            @case(3)
                            <span>Dezembro</span>
                            @break
                            @case(4)
                            <span>Janeiro</span>
                            @break
                            @case(5)
                            <span>Fevereiro</span>
                            @break
                            @case(6)
                            <span>Março</span>
                            @break
                            @case(7)
                            <span>Abril</span>
                            @break
                            @case(8)
                            <span>Maio</span>
                            @break
                            @case(9)
                            <span>Junho</span>
                            @break
                            @case(10)
                            <span>Julho</span>
                            @break
                            @endswitch
                            @endif
                            @if($pagamento->ano==2020)
                            @switch($pagamento->mes)
                            @case(1)
                            <span> Março/2020</span>
                            @break
                            @case(2)
                            <span>Outubro/2020</span>
                            @break
                            @case(3)
                            <span>Novembro/2020</span>
                            @break
                            @case(4)
                            <span>Dezembro/2020</span>
                            @break
                            @case(5)
                            <span>Janeiro/2021</span>
                            @break
                            @case(6)
                            <span>Fevereiro/2021</span>
                            @break
                            @case(7)
                            <span>Março/2021</span>
                            @break
                            @case(8)
                            <span>Abril/2021</span>
                            @break
                            @case(9)
                            <span>Maio/2021</span>
                            @break
                            @case(10)
                            <span>Junho/2021</span>
                            @break
                            @endswitch
                            @endif
                        </td>
                        <td align="right">{{number_format($pagamento->valor,2,',','.') }}</td>
                        <td align="right">{{number_format($pagamento->taxa,2,',','.') }}</td>
                        <td>{{$pagamento->obs}}</td>
                        <td>{{$pagamento->descrip}}</td>

                        @if(Auth::user()->hasRole('gestor'))
                        <td>
                            <form action="{{route('recibo_segundaVia',$pagamento->id)}}">
                                <button class="btn btn-sm btn-success">
                                    Recibo 2ª via ({{$pagamento->cant_recibos}})
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="{{route('editarPagamento',$pagamento->id)}}">
                                <button class="btn btn-sm btn-success">
                                    <i class="fa fa-pencil-square"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="{{route('eliminarPagamento',$pagamento->id)}}">
                                <input type="hidden" name="method" value="DELETE">
                                <button onclick="return confirm('Eliminar registro?')" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                        @endif


                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="10"></td>
                    </tr>
                    <tr>

                        <td colspan="4" align="right"><strong>Subtotal:</strong></td>
                        <td align="right">{{number_format($total,2,',','.') }}</td>
                        <td align="right">{{number_format($totalTaxa,2,',','.') }}</td>
                        <td colspan="5"></td>
                    </tr>
                    <tr>

                        <td colspan="4" align="right"><strong>Total Geral:</strong></td>
                        <td align="right">{{number_format($total+$totalTaxa,2,',','.') }}</td>
                        <td align="right"><strong>Total Propinas:</strong> {{number_format($totalPropinas,2,',','.')}}</td>
                        <td align="right"></td>
                        <td align="right"><strong>Total Emolumentos:</strong> {{number_format($totalEmolumentos,2,',','.')}}</td>
                        <td align="right"></td>
                        <td colspan="2"></td>

                    </tr>

                </tbody>
            </table>
        </div>


    </div>

</div>

<a href="#">voltar</a>
<div id="containerExample" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
<div id="containerDia" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
<div id="container2" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
<div id="container3" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

@section('scripts')


<script src="{{asset('js/highcharts.js')}}"></script>
<script src="{{asset('js/exporting.js')}}"></script>
<script src="{{asset('js/export-data.js')}}"></script>





<script type="text/javascript">
    $(function() {
        $('#containerTest').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Pagamentos de Inscrições, Matriculas e Propinas'
            },
            subtitle: {
                text: 'Escola Superior Politécnica de Benguela'
            },
            xAxis: {
                categories: [

                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total (Kz)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:,.1f}Kz</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                    name: 'Inscrições',
                    @if(empty($totalInscricao))
                    data: []
                    @else
                    data: [


                        {
                            {
                                $totalInscricao
                            }
                        }



                    ]
                    @endif

                }, {
                    name: 'Matriculas',
                    @if(empty($totalMatricula))
                    data: []
                    @else
                    data: [


                        {
                            {
                                $totalMatricula
                            }
                        }



                    ]
                    @endif

                }, {
                    name: 'Propinas',
                    @if(empty($totalPropinas))
                    data: []
                    @else
                    data: [


                        {
                            {
                                $totalPropinas
                            }
                        }



                    ]
                    @endif

                }
                /*, {
            name: 'Berlin',
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

        }*/
            ]
        });
    });
</script>

<script type="text/javascript">
    $(function() {
        $('#container3').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Pagamentos e Dispesas mensal'
            },
            subtitle: {
                text: 'Escola Superior de Benguela'
            },
            xAxis: {
                categories: [
                    'Jan',
                    'Fev',
                    'Mar',
                    'Abr',
                    'Mai',
                    'Jun',
                    'Jul',
                    'Ago',
                    'Set',
                    'Out',
                    'Nov',
                    'Dez'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total (Kz)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:,.1f}Kz</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                    name: 'Pagamentos',
                    @if(empty($ingresos))
                    data: []
                    @else
                    data: [

                        @foreach($ingresos as $ing) {
                            {
                                $ing
                            }
                        } {
                            {
                                ","
                            }
                        }
                        @endforeach


                    ]
                    @endif

                }, {
                    name: 'Dispesas',
                    @if(empty($egresos))
                    data: []
                    @else
                    data: [

                        @foreach($egresos as $egreso) {
                            {
                                $egreso
                            }
                        } {
                            {
                                ","
                            }
                        }
                        @endforeach


                    ]
                    @endif

                }
                /*, {
            name: 'Berlin',
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

        }*/
            ]
        });
    });
</script>

@endsection

@stop