@extends('layouts.Main')

@section('content')

<div class="container">
    <br/>
<!--	<div class="row justify-content-center">
      <div class="col-2"> <h3>ESPB</h3> <h6>caixa</h6> </div>
                        <div class="col-12 col-md-10 col-lg-8">
                            <form class="card card-sm">
                                <div class="card-body row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <i class="fas fa-search h4 text-body"></i>
                                    </div>
                                  
                                    <div class="col">
                                        <input id="busqueda" class="form-control form-control-lg form-control-borderless" type="search" placeholder="Digite o nome do estudante">
                                    </div>
                                 
 
                                  
                                </div>
                            </form>
                        </div>
                   
    </div>
-->
<div  class="row">
<div class="col-2"><img src="{{url('/storage/logo.png') }}" alt="">
<div>ESPB. Caixa</div>
</div>
<div class="col-10">
                           <form class="card card-sm">
                                <div class="card-body row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <i class="fas fa-search h4 text-body"></i>
                                    </div>
                                    <!--end of col-->
                                    <div class="col">
                                        <input id="busqueda" class="form-control form-control-lg form-control-borderless" type="search" placeholder="Digite o nome do estudante">
                                    </div>
                                    <!--end of col-->
                                   
                                    <!--end of col-->
                                </div>
                               
                            </form>
                            <br>
                            
        <!-- ******************************TEST******************************************-->
                                            <div class="card-deck">
                                                        <!-- Card -->
                                                        <div class="card">

                                                        <!-- Card image -->
                                                        <div class="view overlay">
                                                        <img class="card-img-top" src="{{asset('images/propinas.svg')}}">
                                                       
                                                          
                                                        <a href="#!">
                                                            <div class="mask rgba-white-slight"></div>
                                                        </a>
                                                        </div>

                                                        <!-- Card content -->
                                                        <div class="card-body">

                                                        <!-- Title -->
                                                        <h4 class="card-title"><strong>Propinas</strong></h4>
                                                        <!-- Text -->
                                                        
                                                        <!-- Button -->
                                                        <a href="#" class="btn btn-primary">Registrar Pagamento</a>

                                                        </div>

                                                        </div>
                                                        <!-- Card -->
  
                                   <!-- Card Narrower -->
                                                        <div class="card card-cascade narrower">
                                                       
                                                        <!-- Card image -->
                                                        <div class="view view-cascade overlay">
                                                      
                                                        <img class="card-img-top" src="{{asset('images/emolumento.webp')}}">
                                                        <a>
                                                            <div class="mask rgba-white-slight"></div>
                                                        </a>
                                                        </div>

                                                        <!-- Card content -->
                                                        <div class="card-body card-body-cascade">

                                                        <!-- Label -->
                                                        <h4 class="card-title"><strong>Emolumentos</strong></h4>
                                                        <!-- Title -->
                                                        
                                                        <!-- Button -->
                                                        <a href="{{route('pagamentoEmolumento')}}" class="btn btn-primary">Registrar Pagamento</a>

                                                        </div>

                                                        </div>
                                                        <!-- Card Narrower -->

                                                        <!-- Card Regular -->
                                                        <div class="card card-cascade">

                                                        <!-- Card image -->
                                                        <div class="view view-cascade overlay">
                                                        <img class="card-img-top" src="{{asset('images/estudiantes-adolescentes.jpg')}}">
                                                        <a>
                                                            <div class="mask rgba-white-slight"></div>
                                                        </a>
                                                        </div>

                                                        <!-- Card content -->
                                                        <div class="card-body card-body-cascade text-center">

                                                        <!-- Title -->
                                                        <h4 class="card-title"><strong>Matriculas</strong></h4>
                                                        <!-- Subtitle -->
                                                        
                                                        <a href="#" class="btn btn-primary">Registrar Pagamento</a>

                                                       

                                                        </div>

                                                        </div>
                                                        <!-- Card Regular -->
        
         <!-- ******************************TEST******************************************-->  
        
        

        
    
         <div id="resultado"></div>
           <!--         <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            
                                            <th>Nome</th>
                                            <th>Meses Pagos</th>
                                        </tr>
                                    </thead>
                                    <tbody id="resultado">

                                    </tbody>
                                </table> 
                     </div>     -->      
</div>

</div>
</div>



@stop