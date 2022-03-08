@extends('relatorios.cabecalho')

@section('content')

<br>


<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Descrição</th>
                                            <th>Valor</th>
                                            <th>Natureza</th>
                                            <th>Meio Pagamento</th>
                                            <th>Factura Nº</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                @foreach($dispesas as $dispesa)
                                        <tr>

                                            <td>{{date('d-m-Y', strtotime($dispesa->created_at))}}</td>
                                            <td>{{$dispesa->descricao}}</td>
                                            <td>{{ number_format($dispesa->valor,2,',','.') }}</td>
                                            <td>{{$dispesa->natureza}}</td>
                                            <td>{{$dispesa->meioPagamento}}</td>
                                             <td>{{$dispesa->numFactura}}</td>
 
                                   

                                        </tr>
                                @endforeach
                                     </tbody>
                                </table>
                               
                            </div>
                           <!-- /.table-responsive -->
@endsection