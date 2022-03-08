@extends('layouts.Main')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Inserir Departamentos</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
   <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
           Departamentos
        </div>
				    <div class="panel-body">
				    <div class="row">
				        <div class="col-lg-6">
							
							<form role="form" action="{{route('storeDepartamentos')}}" id="createDepartamento_form">

								<div class="form-group">
									<label>Identificador</label>
								    <input class="form-control" type="text" name="identificador" required>
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

