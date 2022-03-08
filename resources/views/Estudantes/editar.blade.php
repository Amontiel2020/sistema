@extends('layouts.Main')

@section('content')


<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"></h1>
	</div>
	<!-- /.col-lg-12 -->
</div>

<form role="form" action="{{route('update_estudante',$estudante->id)}}" id="createEstudante_form" enctype="multipart/form-data" method="POST">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3>Actualizar Estudante</h3>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6">

					<div class="panel panel-primary">
						<div class="panel-body">
							<div class="form-group">
								<label>Número do Estudante</label>
								<input class="form-control" type="text" name="numeroEstudante" value="{{$estudante->codigo}}" readonly>

							</div>

							<div class="form-group">
								<label>Nome Completo</label>
								<input class="form-control" type="text" name="nome_completo" value="{{$estudante->nome}}" required>
								<span class="text-danger">{{ $errors->first('nome') }}</span>
							</div>
								<div class="form-group">
								<label>Apelidos</label>
								<input class="form-control" type="text" name="apelido" value="{{$estudante->apelido}}" >
								<span class="text-danger">{{ $errors->first('apelido') }}</span>
							</div>  
							<!--  <div class="form-group">
									<label>Curso</label>
									<input class="form-control" type="text" name="curso" value="{{ old('curso') }}" required>
									<span class="text-danger">{{ $errors->first('curso') }}</span>
								</div> -->
							<div class="form-group">
								<label>Curso</label>
								<select name="curso_id" class="form-control">
									@foreach($cursos as $curso)
									<option @if($curso->id == $estudante->curso_id)
										selected
										@endif
										value="{{$curso->id}}">{{$curso->nome}}</option>
									@endforeach
								</select>
							</div>


							<div class="form-group">
								<label>Data Nascimento</label>
								<input min="1970-01-01" max="2006-12-31" class="form-control" type="date" name="data_nac" value="{{$estudante->dataNac }}">

								<span class="text-danger">{{ $errors->first('dataNac') }}</span>
							</div>
							<div class="form-group">
								<label>Nº do Bilhete de Identidade </label>
								<input class="form-control" type="text" name="BI" value="{{ $estudante->BI }}" required>
								<span class="text-danger">{{ $errors->first('BI') }}</span>
							</div>
							<div class="form-group">
								<label>Data de Emissão do Bilhete de Identidade</label>
								<input min="2010-08-14" max="{{$date}}" class="form-control" type="date" name="data_emissao_BI" value="{{ $estudante->dataEmissaoBI }}" >
								<span class="text-danger">{{ $errors->first('BI') }}</span>
							</div>
							<div class="form-group">
								<label>Data de Validade do Bilhete de Identidade</label>
								<input min="{{$date}}" class="form-control" type="date" name="data_validade_BI" value="{{ $estudante->dataValidadeBI }}" >
								<span class="text-danger">{{ $errors->first('BI') }}</span>
							</div>
							<div class="form-group">
								<label>Sexo</label>
								<select name="genero" class="form-control">
									<option @if($estudante->genero=='Masculino') selected @endif value="Masculino">Masculino</option>
									<option @if($estudante->genero=='Feminino') selected @endif value="Feminino">Feminino</option>
								</select>
								<span class="text-danger">{{ $errors->first('genero') }}</span>
							</div>

							<div class="form-group">
								<label>Nome do pai</label>
								<input class="form-control" type="text" name="nome_pai" value="{{ $estudante->nomePai }}" required>
								<span class="text-danger">{{ $errors->first('nome_pai') }}</span>
							</div>
							<div class="form-group">
								<label>Nome da Mae</label>
								<input class="form-control" type="text" name="nome_mai" value="{{ $estudante->nomeMai  }}" required>
								<span class="text-danger">{{ $errors->first('nome_mai') }}</span>
							</div>

							<div class="form-group">
								<label>Provincia</label>
								<select id="provincia_residencia" name="provincia_residencia" class="form-control">
									@foreach($provincias as $provincia)
									<option @if($estudante->provincia_id==$provincia->id) selected @endif value="{{$provincia->id}}">{{$provincia->nome}}</option>
									@endforeach
								</select>
								<span class="text-danger">{{ $errors->first('provRecidencia') }}</span>
							</div>
							<div class="form-group">
								<label>Municipio</label>
								<select id="municipio_residencia" name="municipio_residencia" class="form-control">
									@foreach($municipios as $municipio)
									<option @if($estudante->municipio_id==$municipio->id) selected @endif value="{{$municipio->id}}">{{$municipio->nome}}</option>
									@endforeach

								</select>
								<span class="text-danger">{{ $errors->first('munRecidencia') }}</span>
							</div>

							<div class="form-group">
								<label>Nacionalidade</label>
								<input class="form-control" type="text" name="nacionalidade" value="{{ $estudante->nacionalidade  }}" required>
								<span class="text-danger">{{ $errors->first('nacionalidade') }}</span>
							</div>

							<div id="ProvMunicipio">


							</div>

							<div class="form-group">
								<label for="">Trabalhador?</label>
								<label for="">Sim</label>
								<input type="radio" name="trabalhador" value="1" @if($estudante->trabalhador==1) checked @endif>
								<label for="">Não</label>
								<input type="radio" name="trabalhador" value="0" @if($estudante->trabalhador==0) checked @endif>
								<span class="text-danger">{{ $errors->first('trabalhador') }}</span>
							</div>
						</div>
					</div>

				</div>





				<div class="col-md-6">

					<div class="panel panel-primary">
						<h3 align="center">Telefones</h3>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Telefone1</label>
										<input class="form-control" type="tel" id="telefone1" name="telefone1" value="{{ $estudante->telefone1 }}" required>
										<span class="text-danger">{{ $errors->first('telefone1') }}</span>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Telefone2</label>
										<input class="form-control" type="tel" id="telefone2" name="telefone2" value="{{ $estudante->telefone2 }}" required>
										<span class="text-danger">{{ $errors->first('telefone2') }}</span>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Telefone de Emergência</label>
										<input class="form-control" type="tel" id="telefone3" name="telefoneEmergencia" value="{{ $estudante->telefoneEmergencia }}" >
										<span class="text-danger">{{ $errors->first('telefone2') }}</span>
									</div>
								</div>
								<div class="container">
									<div class="row">
										<div class="col-md-12">
											<small class="text-danger text-muted">ex. 999-999-999</small>
											<small class="text-danger text-muted"> * Obrigatorio iniciar com 9</small>
										</div>

									</div>
								</div>

							</div>
						</div>
					</div>

					<div class="panel panel-primary">
						<h3 align="center">Morada</h3>
						<div class="panel-body">

							<div class="form-group">
								<label>Provincia</label>
								<select id="prov_endereco" name="prov_endereco" class="form-control">
									@foreach($provincias as $provincia)
									<option @if($estudante->provinciaEndereco_id==$provincia->id) selected @endif value="{{$provincia->id}}">{{$provincia->nome}}</option>
									@endforeach
								</select>
								<span class="text-danger">{{ $errors->first('provRecidencia') }}</span>
							</div>
							<div class="form-group">
								<label>Municipio</label>
								<select id="mun_endereco" name="mun_endereco" class="form-control">
									@foreach($municipios as $municipio)
									<option @if($estudante->municipioEndereco_id==$municipio->id) selected @endif value="{{$municipio->id}}">{{$municipio->nome}}</option>
									@endforeach

								</select>
								<span class="text-danger">{{ $errors->first('munRecidencia') }}</span>
							</div>
							<div class="form-group">
								<label>Morada Actual</label>
								<input class="form-control" type="text" name="morada" value="{{ $estudante->endereco }}" >
								<span class="text-danger">{{ $errors->first('morada') }}</span>
							</div>
						</div>
					</div>
					<div class="panel panel-primary">
						<h3 align="center">Email da Instituição</h3>
						<div class="panel-body">
							<div class="input-group">
								<input value="{{$estudante->email}}" onblur="duplicateEmail(this)" id="email" name="email" type="text" class="form-control" placeholder="Nome de usuario" aria-describedby="basic-addon2" >
								<span class="input-group-addon" id="basic-addon2">@espb.ao</span>
							</div>
							<span id="spanEmail" style="display:none;" class="text-danger">Email não disponivel</span>
						</div>
					</div>

					<div class="panel panel-primary">
						<h3 align="center">Turma</h3>
						<div class="panel-body">
							<div class="form-group">
							<select class="form-control" name="turma" id="turma">
								@foreach($turmas as $turma)
								<option @if($estudante->turma_id==$turma->id) selected @endif value="{{$turma->id}}">{{$turma->identificador}}</option>
								@endforeach

							</select>
							</div>
							<span id="spanEmail" style="display:none;" class="text-danger">Email não disponivel</span>
						</div>
					</div>
					<div class="panel panel-primary">
						<h3 align="center">Estado</h3>
						<div class="panel-body">
							<div class="form-group">
							<select class="form-control" name="estado" id="estado">
							  <option @if($estudante->estado=="Activo") selected @endif value="Activo">Activo</option>
							  <option @if($estudante->estado=="Desistente") selected @endif value="Desistente">Desistente</option>
							  <option @if($estudante->estado=="Desistente") selected @endif value="Desistente">Desistente</option>
							  <option @if($estudante->estado=="Desistente") selected @endif value="Desistente">Desistente</option>
							  <option @if($estudante->estado=="Desistente") selected @endif value="Desistente">Desistente</option>
							
							
							</select>
							</div>
							<span id="spanEmail" style="display:none;" class="text-danger">Email não disponivel</span>
						</div>
					</div>

					<div class="form-group ">

						<label for="">Imagem</label>
						<input id="file-input" name="imagenperfil" type="file" />

					</div>
				</div>
			</div>


			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">

						<div class="col-lg-12">

							<div class="col-lg-6">
								<button id="botonConfirmar" class="btn btn-primary btn-block" type="submit">Actualizar</button>
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
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
	$(document).ready(function() {

		//duplicateEmail();
		$("#createEstudante_form").validate({

			rules: {
				nomeCompleto: {
					required: true,
					maxlength: 50,
					//lettersonly: true 
				},

				telefone1: {
					required: true,
					minlength: 11,
				},
				telefone2: {
					required: true,
					minlength: 11,
				},
				telefoneEmergencia: {
					required: true,
					minlength: 11,
				},

				
				BI: {
					required: true,
					maxlength: 14,
					minlength: 14,

				},
				/*email: {
					required: true,
					//	emailValido: true,

				}*/

			},
			messages: {

				nomeCompleto: {
					required: "É obrigatória a indicação de um valor para o campo nome.",
				},
				
				telefone1: {
					required: "É obrigatório.",
					minlength: "Devem ser 9 digitos",
				},
				telefone2: {
					required: "É obrigatório.",
					minlength: "Devem ser 9 digitos",
				},
				telefoneEmergencia: {
					required: "É obrigatório.",
					minlength: "Devem ser 9 digitos",
				},
				BI: {
					required: "É obrigatório.",
					minlength: "Devem ser 14 digitos",
				},


			},
		});



	});


	/*	function validarEmail() {
			var email = $("#email");
			email.blur(function() {
				$.ajax({
					url: '/validarEmail',
					type: 'POST',
					//data:{"email" : email.val()}, 
					data: {
						"email": email.val(),
						_token: '{{csrf_token()}}'
					},
					success: function(data) {
						console.log(data);
						data = $.parseJSON(data);
						// $("#resposta").text(data.resultado);
						alert(data);
					}
				});
			});
		}*/

	$("#provEndereco").change(function(event) {
		var id_prov = $(this).val();

		url = "/municipios/" + id_prov + "";

		$.getJSON(url, function(response, state) {
			$('#munEndereco').empty();

			$.each(response, function(k, v) {
				$('#munEndereco').append('<option value=' + v.id + '>' + v.nome + '</option>');

			});



		});

	});



	$("#telefone1, #telefone2, #telefoneEmergencia").mask("Z00-000-000", {
		translation: {
			Z: {
				pattern: /[9]/
			}
		}
	}).attr('minlength', 9);

	$(document).ready(function() {
		$('#open').on('click', function() {
			$('#popup').fadeIn('slow');
			$('.popup-overlay').fadeIn('slow');
			$('.popup-overlay').height($(window).height());
			return false;
		});

		$('#close').on('click', function() {
			$('#popup').fadeOut('slow');
			$('.popup-overlay').fadeOut('slow');
			return false;
		});
	});

	/*	$(function() {
			$("#telefone1").mask('ZA', {
				translation: {
					Z: {
						pattern: /[9]/
					},
					A: {
						pattern: /[0-9]/,
						recursive: true
					}
				}
			});
		});*/

	/*		function ValidaTel(val) {
				if (val.length < 11)
					alert("O telefone não pode ter menos de 9 digitos");
			}*/
	//onBlur="javascript: ValidaTel(this.value);"

	$(function() {
		$('.example-popover').popover({
			container: 'body'
		})
	});

	$(function() {
		$("input[type='checkbox']").change(function(event) {
			cantidadCheckbox = $("input[type='checkbox']").length;
			cantidadCheckboxSelec = $("input[type='checkbox']:checked").length;
			//	alert("Cantidad total" + cantidadCheckbox);
			//	alert("Cantidad selec" + cantidadCheckboxSelec);

			if (cantidadCheckboxSelec < cantidadCheckbox) {

				$('#botonConfirmar').prop('disabled', true);
			}

			if (cantidadCheckboxSelec == cantidadCheckbox) {
				$('#botonConfirmar').prop('disabled', false);
			}
		});




	});

	function duplicateEmail(element) {
		/*	$("#email").keyup(function() {
				var email = $('#email').val();
			//	alert(email);
				$.ajax({
					type: "POST",
					url: '/validarEmail',
					data: {
						email: email,
						_token: '{{csrf_token()}}'
					},
					dataType: "json",
					success: function(res) {
						if (res.exists) {
							//	alert('true');

							$("#email").attr("aria-invalid", true);
							$("#email").addClass('error');
							$("#spanEmail").show();
							//	$("#email").css('border-color', 'red');
							//	$("#email").parent().find('span').css('border-color', 'red');
							//	$("#email").parent().find('span').css('color', 'red');
							$('#botonConfirmar').prop('disabled', true);

							//return;
						} else {
							//alert('false');
							$("#spanEmail").hide();
							//$("#email").attr("required",false);

							//	$("#email").setAttribute("aria-invalid", "true");
							$('#botonConfirmar').prop('disabled', false);


						}
					},
					error: function(jqXHR, exception) {

					}
				});

			});*/

		var email = $(element).val();

		$.ajax({
			type: "POST",
			url: '/validarEmail',
			data: {
				email: email,
				_token: '{{csrf_token()}}'
			},
			dataType: "json",
			success: function(res) {
				if (res.exists) {
					//	alert('true');

					$("#email").attr("aria-invalid", true);
					$("#email").addClass('error');
					$("#spanEmail").show();
					//	$("#email").css('border-color', 'red');
					//	$("#email").parent().find('span').css('border-color', 'red');
					//	$("#email").parent().find('span').css('color', 'red');
					$('#botonConfirmar').prop('disabled', true);

					//return;
				} else {
					//alert('false');
					$("#spanEmail").hide();
					//$("#email").attr("required",false);

					//	$("#email").setAttribute("aria-invalid", "true");
					$('#botonConfirmar').prop('disabled', false);


				}
			},
			error: function(jqXHR, exception) {

			}
		});


	}
</script>
@endSection

@stop