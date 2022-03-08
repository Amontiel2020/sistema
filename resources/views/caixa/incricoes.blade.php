@extends('layouts.Main')

@section('content')

<div class="panel panel-primary">
        <div class="panel-heading">
            <h3>Facturas de Candidatura</h3> 
           
        </div>
                        <div class="panel-body">
 
                           <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nº</th>
                                            <th>Numero da Factura</th>
                                            <th>Tipo</th>
                                            <th>Código Candidato</th>
                                            <th>Nome Completo</th>
                                            <th>Estado</th>
                                            <th>Data Emissão</th>
                                            <th></th>
                                            <th>Forma de Pago</th>

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
                                           <a href="{{route('pagamentoInscricao',$factura->numFactura)}}" class="btn btn-primary">
									            Pagamento         
									            </a>
                                                @endif

									        </td>
                                            <td>
                                               <a href="#" class="editFormaPagamento" data-pk="{{$factura->numFactura}}">{{$factura->formaPagamento}}</a>
                                             
                                            </td>
                                         </tr>
                                @endforeach
                                     </tbody>
                                </table>
                              
                            </div>
                           <!-- /.table-responsive -->
                    </div>
    </div>

    @section('scripts')
    <script>
        $(document).ready(function() {
            //  $("#presedencia").select2({      });
            $.fn.editable.defaults.ajaxOptions = {
                type: "POST"
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });

            $('.editFormaPagamento').editable({
                url: '{{url("formaPago/update")}}',
                source: '["TPA","Dinheiro","Transferência"]',
                type: 'select',
                emptytext: 'forma de pago',
                /* params: function(params) {
                     //originally params contain pk, name and value
                    // params['X-CSRF-TOKEN'] = '{{csrf_token()}}';
                  
                     return params;
                 }*/

            });


        });
    </script>
    @endsection

@stop