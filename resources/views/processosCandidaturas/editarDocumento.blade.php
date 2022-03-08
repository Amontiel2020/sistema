@extends('layouts.Main')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Actualizar Documento</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
   <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
           Documento
        </div>
				    <div class="panel-body">
				    <div class="row">
				        <div class="col-lg-6">
							
							<form role="form" action="{{route('updateDocumento')}}" id="createDepartamento_form" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="id" value="{{ $documento->id }}">


								<div class="form-group">
									<label>Nome</label>
								    <input class="form-control" type="text" name="nome" value="{{ $documento->nome}}" required>
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
<!-- Inico TEST -->
<div class="container">
	    <div class="col-md-12">
	        <div class="panel panel-default">
	            <div class="panel-heading">
	                <h3 class="panel-title">Lista de Documentos</h3>
	            </div>
	            <table class="table table-bordered table-striped table-condensed">
	                <tr>
	                    <td>Nome </td>
	                    <td>Descrição</td>
	                </tr>

	                @foreach($documentos as $row)
		                <tr>
		                    <td>
		                    	<a href="#" class="xedit" 
		                    	   data-pk="{{$row->id}}"
		                    	   data-name="nome">
		                    	   {{$row->nome}}</a>
		                    </td>

		                     <td>
		                    	<a href="#" class="xedit" 
		                    	   data-pk="{{$row->id}}"
		                    	   data-name="descricao">
		                    	   {{$row->descricao}}</a>
		                    </td>
		                </tr>
	                @endforeach

	            </table>
	        </div>

	    </div>
	</div>
<!-- Fin TEST -->


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
    
    $(document).ready(function () {
	            $.ajaxSetup({
	                headers: {
	                    'X-CSRF-TOKEN': '{{csrf_token()}}'
	                }
	            });

	            $('.xedit').editable({
	                url: '{{url("documentos/update")}}',
	                title: 'Actualizar',
	                success: function (response, newValue) {
	                    console.log('Updated', response)
	                }
	            });

	    })
 </script>
 @endSection



@stop

