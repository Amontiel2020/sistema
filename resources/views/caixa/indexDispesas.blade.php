@extends('layouts.Main')

@section('content')

<div class="panel panel-primary">
                        <div class="panel-heading">
                            Filtros
                        </div>
                    <div class="panel-body">
                        <form class="form-inline" action="{{route('filtrarDispesasMes')}}" method="get">
                        <div class="form-group">
                           <label for="">Data</label>
                              <input type="date" name="data" class="form-control">
                           </div>
                           <div class="form-group">
                               <label for="">Mes</label>
                               <input type="month" name="fecha" id="fecha" class="form-control"  >
                             
                           </div>

                           <input type="submit" class="btn-primary" value="Filtrar" >
                        </form>
                      
                       
                           
                    </div>
 
</div>

<a href="{{route('registrarDispesas2')}}">Inserir</a>

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
                                            <th>Area</th>
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
                                            <td>{{App\Departamento::toString($dispesa->departamento_id)}}</td>
                                            
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
                                <div align="center">{{$dispesas->render()}}</div>
                            </div>
                           <!-- /.table-responsive -->
                    </div>
    </div>

@stop