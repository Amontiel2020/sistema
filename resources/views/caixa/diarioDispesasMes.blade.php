@extends('layouts.Main')

@section('content')

<div class="panel panel-primary">
                        <div class="panel-heading">
                            Resultado
                        </div>
                    <div class="panel-body">
     @if($data !=null)
     <h3>{{$data}}</h3>
     <h5>Dispesas:{{ number_format($total,2,',','.') }} </h5>
     <h5>Pagamentos:{{ number_format($totalPagamentos,2,',','.') }} </h5>
                    
     @elseif($mes !=null)
     <h3>{{$data}}</h3>
     <h5>Dispesas:{{ number_format($total,2,',','.') }}</h5>
     <h5>Pagamentos:{{ number_format($totalPagamentos,2,',','.') }}</h5>
     <a href="{{ route('test.pdf',$mes) }}">
           Diario Caixa
        </a>  
     @endif

                      
                   
                           
                    </div>
 
</div>

<a href="#">voltar</a>

<div class="panel panel-primary">
        <div class="panel-heading">
             Dispesas
           
        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Descrição</th>
                                            <th>Valor</th>
                                            <th>Meio Pagamento</th>
                                            <th>Natureza</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                @foreach($dispesas as $dispesa)
                                        <tr>

                                            <td><?php echo date('d-m-Y', strtotime($dispesa->created_at)) ?></td>
                                            <td>{{$dispesa->descricao}}</td>
                                            <td>{{ number_format($dispesa->valor,2,',','.') }}</td>
                                            <td>{{$dispesa->meioPagamento}}</td>
                                            <td>{{$dispesa->natureza}}</td>
                                            <td width="10"><a href="{{route('editarDispesas',$dispesa->id)}}" class="btn btn-primary btn-xs">
									            <i class="fa fa-pencil-square"></i>         
									            </a>

									        </td>
									        <td width="10">
									            <form action="{{route('deleteDispesas',$dispesa->id)}}">
									                <input type="hidden" name="method" value="DELETE">
									            <button onclick="return confirm('Eliminar registro?')" class="btn btn-danger btn-xs">
									            <i class="fa fa-trash"></i>         
									            </button>
									            </form>

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