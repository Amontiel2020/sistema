@extends('layouts.Main')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Actualizar Dispesas</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
   <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
           Dispesas
        </div>
				    <div class="panel-body">
				    <div class="row">
				        <div class="col-lg-6">
							
							<form role="form" action="{{route('updateDispesas',$dispesa->id)}}" id="createDispesa_form" method="PUT">

								<div class="form-group">
									<label>Data</label>
								    <input class="form-control" type="date" name="data" value="<?php echo date('Y-m-d', strtotime($dispesa->created_at)) ?>" required>
								</div>
                                <div class="form-group">
									<label>Descrição</label>
								    <textarea class="form-control" type="text" name="descricao"required>
                                    {{ $dispesa->descricao}}
                                    </textarea>
								</div>
                                <div class="form-group">
									<label>Fornecedor</label>
								    <input class="form-control" type="text" name="fornecedor" value="{{ $dispesa->fornecedor}}" >
								</div>
                                <div class="form-group">
									<label>Valor</label>
								    <input class="form-control" type="text" name="valor" value="{{$dispesa->valor}}" required>
								</div>
                                <div class="form-group">
									<label>Meio de pagamento</label>
								    <input class="form-control" type="text" name="meioPagamento" value="{{ $dispesa->meioPagamento}}" >
								</div>
                                <div class="form-group">
									<label>Nº Factura</label>
								    <input class="form-control" type="text" name="numFactura" value="{{ $dispesa->numFactura}}" >
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

