@extends('layouts.Main')

@section('content')

 
<div class="panel panel-primary">
                        <div class="panel-heading">
                            Primary Panel
                        </div>
                        <div class="panel-body">
                            <form action="{{route('pagarEmolumentoGeral')}}">

                                  <div class="form-group">
                                      <label for="turma">Turma</label>                                        
                                      <select id="turmaDinamico" name="turma" class="form-control">
                                        <option selected>Selecione</option>
                                          @foreach($turmas as $turma)
                                            <option value="{{$turma->id}}">{{$turma->identificador}}</option>
                                          @endforeach
                                      </select>                                      
                                  </div>                                   

                                  <div class="form-group">
                                      <label for="estudante">Estudante</label>                                        
                                      <select id="estudanteDinamico" name="estudante" class="form-control">
                                          
                                            <option  selected value="">-</option>
                                      
                                      </select>                                      
                                  </div>                                   


                                  <div class="form-group">
                                      <label>Emolumento</label>                                            
                                      <select class="form-control" name="emolumento">
                                          @foreach($emolumentos as $emolumento)
                                            <option
                                             value="{{$emolumento->id}}"
                                             @if($emolumento->nome=="Propinas") disabled @endif
                                             >
                                             {{$emolumento->nome}}
                                           </option>
                                          @endforeach
                                      </select>                                            
                                  </div>                                    
                                  <div class="form-group">
                                      <label>Mes</label>                                                  
                                      <select class="form-control" name="mes">
                                            <option value="1">Janeiro</option>
                                      </select>                                              
                                  </div>                                      
                                  <div class="form-group">
                                      <label>Ano</label>                                                
                                      <select class="form-control" name="ano">
                                            <option value="2020">2020</option>
                                      </select>                                          
                                  </div>
                                  <div class="form-group">
                                      <button class="btn btn-primary" type="submit">Registrar</button>           
                                  </div>
                                                 
                            </form>

                        </div>
                        <div class="panel-footer">
                          
                        </div>
                    </div>







<div class="container">
  
   <div class="page-header text-center">
        <h1>
          <i class="fa fa-shopping-cart"></i>
        EMOLUMENTOS 
        </h1>
    </div>

          <hr>
<h3>Pagamentos feitos</h3>

<table class="table">
  <tr>
    <th>Editar</th>
    <th>Eliminar</th>
    <th>Emolumento</th>
    <th>Estudante</th>
    <th>Valor</th>
    <th>Mes</th>
    <th>Ano</th>
  </tr>
    @foreach($pagamentos as $pagamento)
    <tr>
    <td width="10"><a href="#" class="btn btn-primary">
            <i class="fa fa-pencil-square"></i>       
          </a>

      </td>
        <td width="10"><a href="#" class="btn btn-danger">
            <i class="fa fa-trash"></i>       
          </a>

      </td>
    <td>{{\App\Emolumento::toString($pagamento->emolumento_id)}}</td>
    <td>{{\App\Estudante::toString($pagamento->estudante_id)}}</td>
    <td>{{$pagamento->valor}}</td>
    <td>{{$pagamento->mes}}</td>
    <td>{{$pagamento->ano}}</td>

    </tr>
    @endforeach
</table>

</div>


@stop