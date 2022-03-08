@extends('layouts.Main')

@section('content')

<<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Actualizar Tipo de Usuario</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
   <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
           Tipos de Usuarios
        </div>
				    <div class="panel-body">
				    <div class="row">
				        <div class="col-lg-6">
							
							<form role="form" action="{{route('updateTiposUsuarios',$tipo->id)}}" id="createTipoUsuario_form">

								<div class="form-group">
									<label>Nome</label>
								    <input class="form-control" type="text" name="name" value="{{$tipo->name}}" required>
								</div>
								<div class="form-group">
									<label>Descrição</label>
								    <input class="form-control" type="text" name="description" value="{{$tipo->description}}">
								</div>

       <div class="panel panel-default">
       	<div class="panel-body">
			<div class="row">
									
				<div class="col-lg-12">
											
					<div class="col-lg-6">
						<button class="btn btn-primary btn-block" type="submit">Actualizar</button>
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

    if ($("#createTipoUsuario_form").length > 0) {
		$('#createTipoUsuario_form').find('.error').val(' ');
        jQuery.validator.addMethod("lettersonly", function(value, element) {
         return this.optional(element) || /^[a-z]+$/i.test(value);
        }, "Solo letras");
		
        $("#createTipoUsuario_form").validate({
 
            rules: {
                name: {
                    required: true,
                    maxlength: 50,
					},
 
               
            },
            messages: {
 
                name: {
                    required: "É obrigatória a indicação de um valor para o campo nome.",
                }
 
            },
        })
    } 
 </script>
 @endSection



@stop