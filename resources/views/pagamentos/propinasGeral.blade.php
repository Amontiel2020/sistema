@extends('layouts.Main')

@section('content')


<div class="panel panel-primary">
                        <div class="panel-heading">
                            Filtros
                        </div>
                    <div class="panel-body">
                        <form class="form-inline">
                           <div class="form-group input-group">
                              <input class="form-control" type="text" name="busqueda" id="busqueda" placeholder="Nome estudante">
                              <span class="input-group-addon"><i class="fa fa-search"></i></span>
                           </div>
                           <div class="form-group">
                             <select class="form-control" id="selectTurma">
                              <option selected >Turma</option>
                                @foreach($turmas as $turma)
                                <option value="{{$turma->id}}">{{$turma->identificador}}</option>  
                                @endforeach                              
                              </select>
                           </div>
                          
                        </form>
                      
                       
                           
                    </div>
 
</div>

<!--------------------------------------------------------------------------------------------------------->

                      <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            
                                            <th>Nome</th>
                                            <th>Meses Pagos</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyResultado">

                                    </tbody>
                                </table> 
                     </div>           
                        
 
                           
                 

                    

  <!--------------------------------------------------------------------------------------------------------->



                           
           
                        
                           
                    
                  

@stop