@extends('layouts.Main')


@section('estilos')
<style>
    body {
        font-size: 10px;
    }


    .linia {
        width: 990px;
        border-left: 0px !important;
        border-right: 0px !important;
        ;
    }

    .sinpadding [class*="col-"] {
        padding: 0;
    }
</style>
@endsection

@section('content')
<div class="page-header">
</div>

<div class="container-fluid">
    <!--<h1>Mapas de pagamentos</h1>-->
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <form action="{{route('relatoriosPagamentos')}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="col-md-1">
                        <label for="">Turma</label>
                    </div>
                    <div class="col-md-4">
                        <select name="idTurma" id="idTurma" class="form-control">
                            <option @if($turmaSelected=="todos" ) selected @endif value="todos">-</option>

                            @foreach($turmas as $turma)
                            <option @if($turmaSelected==$turma->id) selected @endif value="{{$turma->id}}">{{$turma->identificador}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-md-2">
                        <label for="">Ano acadêmico</label>
                    </div>
                    <div class="col-md-2">
                        <select name="ano" id="ano" class="form-control">
                            <option @if($ano==="2020" ) selected @endif value="2020">2020</option>
                            <option @if($ano==="2021" ) selected @endif value="2021">2021</option>
                            <option @if($ano==="2022" ) selected @endif value="2022">2022</option>
                            <option @if($ano==="2023" ) selected @endif value="2023">2023</option>
                            <option @if($ano==="2024" ) selected @endif value="2024">2024</option>
                            <option @if($ano==="2025" ) selected @endif value="2025">2025</option>
                            <option @if($ano==="2026" ) selected @endif value="2026">2026</option>
                            <option @if($ano==="2027" ) selected @endif value="2027">2027</option>
                            <option @if($ano==="2028" ) selected @endif value="2028">2028</option>
                            <option @if($ano==="2029" ) selected @endif value="2029">2029</option>
                            <option @if($ano==="2030" ) selected @endif value="2030">2030</option>
                        </select>
                    </div>

                    <div class="col-md-2">

                        <button type="submit" class="btn btn-success">Enviar</button>

                    </div>
                </form>
            </div>
        </div>

    </div>
    <hr>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="text-center">Mapa de pagamentos da turma {{\App\Turma::toString($turmaSelected)}}</h3>
        
            <h3>Ano Académico: {{$ano}}/{{$ano+1}}</h3>
           
        </div>
        <div class="panel-body">
            <table class="table table-hover  table-bordered">
                <tr>
                    <th colspan="2" align="center">Lenda</th>
                </tr>
                <tr>
                    <th>
                        <span class="label label-danger">X</span>

                    </th>
                    <td>Divida no mês</td>
                </tr>
                <tr>
                    <th>
                        <span class="label label-success">Pago</span>

                    </th>
                    <td>
                        Pagamento feito no mês
                    </td>
                </tr>
            </table>
            <br>
            @if($turmaSelected != "todos")
            <a href="{{route('pdfMapaPagamentos',[$turmaSelected,2020])}}">Pdf mapa devedoures</a>
            @endif
            <br>
            <a href="{{route('pdfMapaCompletoPagamentos')}}">Pdf mapa completo devedoures</a>

            <table class="table table-hover table-striped table-bordered">

                @if($ano==="2020")
                <thead>
                    <th>#</th>
                    <th>Nome Completo</th>
                    <th>Licenciatura</th>
                    <th>Turma</th>
                    <th>Propina Outubro</th>
                    <th>Propina Novembro</th>
                    <th>Propina Dezembro</th>
                    <th>Propina Janeiro</th>
                    <th>Propina Fevereiro</th>
                    <th>Propina Março</th>
                    <th>Propina Abril</th>
                    <th>Propina Maio</th>
                    <th>Propina Junho</th>
                    <th>Total Pago</th>
                    <th>Total Taxa</th>
                    <th>Total Divida</th>



                </thead>
                <tbody>
                    @foreach($estudantes as $estudante)

                    <!--  @if(App\Pagamento::pagamentoMesAno($estudante,4,$ano)==null || App\Pagamento::pagamentoMesAno($estudante,5,$ano)==null ||
                    App\Pagamento::pagamentoMesAno($estudante,6,$ano)==null || App\Pagamento::pagamentoMesAno($estudante,7,$ano)==null || App\Pagamento::pagamentoMesAno($estudante,8,$ano)==null
                    || App\Pagamento::pagamentoMesAno($estudante,9,$ano)==null || App\Pagamento::pagamentoMesAno($estudante,10,$ano)==null || App\Pagamento::pagamentoMesAno($estudante,11,$ano)==null
                    || App\Pagamento::pagamentoMesAno($estudante,12,$ano)==null
                    )-->
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$estudante->nome}}&nbsp;{{$estudante->apelido}}</td>
                        <td>{{\App\Curso::toString($estudante->curso_id)}}</td>
                        <td>{{\App\Turma::toString($estudante->turma_id)}}</td>
                        <td align="center">
                            @if(!(App\Pagamento::pagamentoMesAno($estudante,1,$ano)))
                            <span class="label label-danger">X</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,1,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,1,$ano)->taxa!=null))
                            <span class="label label-info">Pago</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,1,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,1,$ano)->taxa==null))
                            <span class="label label-success">Pago</span>
                            @endif
                        </td>
                        <td align="center">
                            @if(!(App\Pagamento::pagamentoMesAno($estudante,5,$ano)))
                            <span class="label label-danger">X</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,5,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,5,$ano)->taxa!=null))
                            <span class="label label-info">Pago</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,5,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,5,$ano)->taxa==null))
                            <span class="label label-success">Pago</span>
                            @endif
                        </td>
                        <td align="center">
                            @if(!(App\Pagamento::pagamentoMesAno($estudante,6,$ano)))
                            <span class="label label-danger">X</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,6,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,6,$ano)->taxa!=null))
                            <span class="label label-info">Pago</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,6,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,6,$ano)->taxa==null))
                            <span class="label label-success">Pago</span>
                            @endif
                        </td>
                        <td align="center">
                            @if(!(App\Pagamento::pagamentoMesAno($estudante,7,$ano)))
                            <span class="label label-danger">X</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,7,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,7,$ano)->taxa!=null))
                            <span class="label label-info">Pago</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,7,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,7,$ano)->taxa==null))
                            <span class="label label-success">Pago</span>
                            @endif
                        </td>
                        <td align="center">
                            @if(!(App\Pagamento::pagamentoMesAno($estudante,8,$ano)))
                            <span class="label label-danger">X</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,8,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,8,$ano)->taxa!=null))
                            <span class="label label-info">Pago</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,8,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,8,$ano)->taxa==null))
                            <span class="label label-success">Pago</span>
                            @endif
                        </td>
                        <td align="center">
                            @if(!(App\Pagamento::pagamentoMesAno($estudante,9,$ano)))
                            <span class="label label-danger">X</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,9,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,9,$ano)->taxa!=null))
                            <span class="label label-info">Pago</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,9,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,9,$ano)->taxa==null))
                            <span class="label label-success">Pago</span>
                            @endif
                        </td>
                        <td align="center">
                            @if(!(App\Pagamento::pagamentoMesAno($estudante,10,$ano)))
                            <span class="label label-danger">X</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,10,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,10,$ano)->taxa!=null))
                            <span class="label label-info">Pago</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,10,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,10,$ano)->taxa==null))
                            <span class="label label-success">Pago</span>
                            @endif
                        </td>
                        <td align="center">
                            @if(!(App\Pagamento::pagamentoMesAno($estudante,11,$ano)))
                            <span class="label label-danger">X</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,11,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,11,$ano)->taxa!=null))
                            <span class="label label-info">Pago</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,11,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,11,$ano)->taxa==null))
                            <span class="label label-success">Pago</span>
                            @endif
                        </td>
                        <td align="center">
                            @if(!(App\Pagamento::pagamentoMesAno($estudante,12,$ano)))
                            <span class="label label-danger">X</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,12,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,12,$ano)->taxa!=null))
                            <span class="label label-info">Pago</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,12,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,12,$ano)->taxa==null))
                            <span class="label label-success">Pago</span>
                            @endif
                        </td>
                        <td>
                            {{number_format(App\Pagamento::totalPagoEstAno($estudante,$ano),2,',','.') }}

                        </td>
                        <td> {{number_format(App\Pagamento::totalTaxaEstAno($estudante,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaEstAno($estudante,$ano),2,',','.') }}</td>
                    </tr>

                    @endif
                    @endforeach
                    @if($turmaSelected != "todos")
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> {{number_format(App\Pagamento::totalDividaTurmaMesAno($turmaSelected,4,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaTurmaMesAno($turmaSelected,5,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaTurmaMesAno($turmaSelected,6,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaTurmaMesAno($turmaSelected,7,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaTurmaMesAno($turmaSelected,8,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaTurmaMesAno($turmaSelected,9,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaTurmaMesAno($turmaSelected,10,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaTurmaMesAno($turmaSelected,11,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaTurmaMesAno($turmaSelected,12,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalPagoTurmaAno($turmaSelected,$ano),2,',','.') }}</td>
                        <td>{{number_format(App\Pagamento::totalTaxaTurmaAno($turmaSelected,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaTurmaAno($turmaSelected,$ano),2,',','.') }} </td>

                    </tr>
                    @endif
                    @if($turmaSelected == "todos")
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> {{number_format(App\Pagamento::totalDividaMesAno(4,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaMesAno(5,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaMesAno(6,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaMesAno(7,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaMesAno(8,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaMesAno(9,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaMesAno(10,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaMesAno(11,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaMesAno(12,$ano),2,',','.') }}</td>
                        <td></td>
                        <td></td>
                        <td> {{number_format(App\Pagamento::totalDividaAno($ano),2,',','.') }} </td>

                    </tr>
                    @endif

                </tbody>
                @endif
                @if($ano!=="2020")
                <thead>
                    <th>#</th>
                    <th>Nome Completo</th>
                    <th>Licenciatura</th>
                    <th>Turma</th>
                    <th>Propina Outubro</th>
                    <th>Propina Novembro</th>
                    <th>Propina Dezembro</th>
                    <th>Propina Janeiro</th>
                    <th>Propina Fevereiro</th>
                    <th>Propina Março</th>
                    <th>Propina Abril</th>
                    <th>Propina Maio</th>
                    <th>Propina Junho</th>
                    <th>Propina Julho</th>
                    <th>Total Pago</th>
                    <th>Total Taxa</th>
                    <th>Total Divida</th>



                </thead>
                <tbody>
                    @foreach($estudantes as $estudante)

                    <!--  @if(App\Pagamento::pagamentoMesAno($estudante,4,$ano)==null || App\Pagamento::pagamentoMesAno($estudante,5,$ano)==null ||
                    App\Pagamento::pagamentoMesAno($estudante,6,$ano)==null || App\Pagamento::pagamentoMesAno($estudante,7,$ano)==null || App\Pagamento::pagamentoMesAno($estudante,8,$ano)==null
                    || App\Pagamento::pagamentoMesAno($estudante,9,$ano)==null || App\Pagamento::pagamentoMesAno($estudante,10,$ano)==null || App\Pagamento::pagamentoMesAno($estudante,11,$ano)==null
                    || App\Pagamento::pagamentoMesAno($estudante,12,$ano)==null
                    )-->
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$estudante->nome}}&nbsp;{{$estudante->apelido}}</td>
                        <td>{{\App\Curso::toString($estudante->curso_id)}}</td>
                        <td>{{\App\Turma::toString($estudante->turma_id)}}</td>
                        <td align="center">
                            @if(!(App\Pagamento::pagamentoMesAno($estudante,1,$ano)))
                            <span class="label label-danger">X</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,1,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,1,$ano)->taxa!=null))
                            <span class="label label-info">Pago</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,1,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,1,$ano)->taxa==null))
                            <span class="label label-success">Pago</span>
                            @endif
                        </td>
                        <td align="center">
                            @if(!(App\Pagamento::pagamentoMesAno($estudante,2,$ano)))
                            <span class="label label-danger">X</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,2,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,2,$ano)->taxa!=null))
                            <span class="label label-info">Pago</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,2,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,2,$ano)->taxa==null))
                            <span class="label label-success">Pago</span>
                            @endif
                        </td>
                        <td align="center">
                            @if(!(App\Pagamento::pagamentoMesAno($estudante,3,$ano)))
                            <span class="label label-danger">X</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,3,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,3,$ano)->taxa!=null))
                            <span class="label label-info">Pago</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,3,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,3,$ano)->taxa==null))
                            <span class="label label-success">Pago</span>
                            @endif
                        </td>
                        <td align="center">
                            @if(!(App\Pagamento::pagamentoMesAno($estudante,4,$ano)))
                            <span class="label label-danger">X</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,4,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,4,$ano)->taxa!=null))
                            <span class="label label-info">Pago</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,4,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,4,$ano)->taxa==null))
                            <span class="label label-success">Pago</span>
                            @endif
                        </td>
                        <td align="center">
                            @if(!(App\Pagamento::pagamentoMesAno($estudante,5,$ano)))
                            <span class="label label-danger">X</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,5,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,5,$ano)->taxa!=null))
                            <span class="label label-info">Pago</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,5,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,5,$ano)->taxa==null))
                            <span class="label label-success">Pago</span>
                            @endif
                        </td>
                        <td align="center">
                            @if(!(App\Pagamento::pagamentoMesAno($estudante,6,$ano)))
                            <span class="label label-danger">X</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,6,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,6,$ano)->taxa!=null))
                            <span class="label label-info">Pago</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,6,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,6,$ano)->taxa==null))
                            <span class="label label-success">Pago</span>
                            @endif
                        </td>
                        <td align="center">
                            @if(!(App\Pagamento::pagamentoMesAno($estudante,7,$ano)))
                            <span class="label label-danger">X</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,7,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,7,$ano)->taxa!=null))
                            <span class="label label-info">Pago</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,7,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,7,$ano)->taxa==null))
                            <span class="label label-success">Pago</span>
                            @endif
                        </td>
                        <td align="center">
                            @if(!(App\Pagamento::pagamentoMesAno($estudante,8,$ano)))
                            <span class="label label-danger">X</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,8,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,8,$ano)->taxa!=null))
                            <span class="label label-info">Pago</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,8,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,8,$ano)->taxa==null))
                            <span class="label label-success">Pago</span>
                            @endif
                        </td>
                        <td align="center">
                            @if(!(App\Pagamento::pagamentoMesAno($estudante,9,$ano)))
                            <span class="label label-danger">X</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,9,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,9,$ano)->taxa!=null))
                            <span class="label label-info">Pago</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,9,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,9,$ano)->taxa==null))
                            <span class="label label-success">Pago</span>
                            @endif
                        </td>
                        <td align="center">
                            @if(!(App\Pagamento::pagamentoMesAno($estudante,10,$ano)))
                            <span class="label label-danger">X</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,10,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,10,$ano)->taxa!=null))
                            <span class="label label-info">Pago</span>
                            @endif

                            @if((App\Pagamento::pagamentoMesAno($estudante,10,$ano)) && (App\Pagamento::pagamentoMesAno($estudante,10,$ano)->taxa==null))
                            <span class="label label-success">Pago</span>
                            @endif
                        </td>
                        <td>
                            {{number_format(App\Pagamento::totalPagoEstAno($estudante,$ano),2,',','.') }}

                        </td>
                        <td> {{number_format(App\Pagamento::totalTaxaEstAno($estudante,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaEstAno($estudante,$ano),2,',','.') }}</td>
                    </tr>

                    @endif
                    @endforeach
                    @if($turmaSelected != "todos")
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> {{number_format(App\Pagamento::totalDividaTurmaMesAno($turmaSelected,4,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaTurmaMesAno($turmaSelected,5,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaTurmaMesAno($turmaSelected,6,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaTurmaMesAno($turmaSelected,7,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaTurmaMesAno($turmaSelected,8,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaTurmaMesAno($turmaSelected,9,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaTurmaMesAno($turmaSelected,10,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaTurmaMesAno($turmaSelected,11,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaTurmaMesAno($turmaSelected,12,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalPagoTurmaAno($turmaSelected,$ano),2,',','.') }}</td>
                        <td>{{number_format(App\Pagamento::totalTaxaTurmaAno($turmaSelected,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaTurmaAno($turmaSelected,$ano),2,',','.') }} </td>

                    </tr>
                    @endif
                    @if($turmaSelected == "todos")
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> {{number_format(App\Pagamento::totalDividaMesAno(4,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaMesAno(5,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaMesAno(6,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaMesAno(7,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaMesAno(8,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaMesAno(9,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaMesAno(10,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaMesAno(11,$ano),2,',','.') }}</td>
                        <td> {{number_format(App\Pagamento::totalDividaMesAno(12,$ano),2,',','.') }}</td>
                        <td></td>
                        <td></td>
                        <td> {{number_format(App\Pagamento::totalDividaAno($ano),2,',','.') }} </td>

                    </tr>
                    @endif

                </tbody>
                @endif
            </table>
        </div>

    </div>

    @stop