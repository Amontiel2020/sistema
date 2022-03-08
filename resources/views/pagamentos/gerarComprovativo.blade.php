@extends('layouts.Main')

@section('content')

<div class="panel panel-primary">
                        <div class="panel-heading">Ficha Estudante</div>
                        <div class="panel-body" >

                        <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Mes</th>
                                            <th>Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                @foreach($pagamentos as $pagamento)
                                        <tr>
                                              <td>{{$pagamento->mes}}</td>
                                              <td>{{$pagamento->valor}}</td>
                                        </tr>
                                @endforeach
                                     </tbody>
                                </table>
                               
                            </div>
                           <!-- /.table-responsive -->
                        </div>



 </div>

@stop