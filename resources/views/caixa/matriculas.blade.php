@extends('layouts.Main')

@section('content')

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3>Facturas de Matricula</h3>

    </div>
    <div class="panel-body">
   <!--     <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nº Ordem</th>
                        <th>Nº Factura</th>
                        <th>Nº da Matricula</th>
                        <th>Nome completo do Candidato</th>
                        <th>Data de Emissão</th>
                        <th></th>
                        <th></th>


                    </tr>
                </thead>
                <tbody>
                    @foreach($matriculas as $i=> $matricula)
                    <tr>
                        <td>{{$i+1}}</td>
                        <td></td>
                        <td>{{$matricula->codigo}}</td>
                        <td>{{$matricula->nome}} {{$matricula->apelido}}</td>
                        <td></td>
                        <td width="10"><a href="{{route('pagamentoMatricula',$matricula->codigo)}}" class="btn btn-primary">
                                Efectuar Pagamento
                            </a>

                        </td>


                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>-->
        <!-- /.table-responsive -->

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Numero da Factura</th>
                        <th>Tipo</th>
                        <th>Codigo Candidato</th>
                        <th>Nome Completo</th>
                        <th>Estado</th>
                        <th>Data de Emissão</th>
                        <th>Pagamento</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($facturas as $i=>$factura)
                    <tr>
                        <td>{{$i+1}}</td>
                        <td>{{$factura->numFactura}}</td>
                        <td>{{$factura->tipo}}</td>
                        <td>{{$factura->codEst}}</td>
                        <td>{{\App\Candidato::toString($factura->codEst)}}</td>
                        <td>{{$factura->estado}}</td>
                        <td>{{$factura->created_at}}</td>
                        <td width="10">
                            @if($factura->estado=="Emitida")
                            <a href="{{route('pagamentoMatricula',$factura->numFactura)}}" class="btn btn-primary">
                                Pagamento
                            </a>
                            @endif

                        </td>
                       
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <!-- /.table-responsive -->
    </div>
</div>

@stop