@extends('layouts.Main')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Inserir Consumivel</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
   <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
           Consumiveis
        </div>
				    <div class="panel-body">
				    <div class="row">
				        <div class="col-lg-6">
							
							<form role="form" action="{{route('storeConsumivel')}}" id="createConsumivel_form">

                            <div class="form-group">
									<label>Nome</label>
								    <input class="form-control" type="text" name="nome"  required>
                                </div>
                                <div class="form-group">
									<label>Tipo</label>
								    <input class="form-control" type="text" name="tipo" >
                                </div>
                                <div class="form-group">
									<label>Stock Mínimo</label>
								    <input class="form-control" type="text" name="stockMin" >
                                </div>
                                <div class="form-group">
                                <label>Fornecedor</label>
								    <input class="form-control" type="text" name="fornecedor" >
                                </div>
                                <div class="form-group">
                                <label>Responsavel</label>
								    <input class="form-control" type="text" name="responsavel">
                                </div>
                                <div class="form-group">
                                <label>Obs</label>
								    <input class="form-control" type="text" name="obs">
                                </div>

       <div class="panel panel-default">
       	<div class="panel-body">
			<div class="row">
									
				<div class="col-lg-12">
											
					<div class="col-lg-6">
						<button class="btn btn-primary btn-block" type="submit">Inserir</button>
					</div>
					<div class="col-lg-6">
					    <button class="btn btn-outline btn-success btn-block">Cancelar</button>	
					</div>
				</div>
									   
										
			</div>
       	</div>
       </div>
    </div>
</div>
</form>

@section('scripts')
<script>

    if ($("#createDepartamento_form").length > 0) {
		$('#createDepartamento_form').find('.error').val(' ');
        jQuery.validator.addMethod("lettersonly", function(value, element) {
         return this.optional(element) || /^[a-z]+$/i.test(value);
        }, "Solo letras");
		
        $("#createDepartamento_form").validate({
 
            rules: {
                identificador: {
                    required: true,
                    maxlength: 50,
					},
 
               
            },
            messages: {
 
                identificador: {
                    required: "É obrigatória a indicação de um valor para o campo identificador.",
                }
 
            },
        })
    } 
 </script>
 @endSection



@stop
