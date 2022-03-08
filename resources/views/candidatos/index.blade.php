@extends('layouts.Main')

@section('content')

@section('estilos')

@endSection

<div class="page-header">

</div>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3>Ficha de Candidatura</h3>
	</div>
	<div class="panel-body">
		<form role="form" action="{{route('storeCandidato')}}" id="createEstudante_form" enctype="multipart/form-data" method="POST">


			<div class="panel panel-default">

				<div class="panel-body">

					<div class="row">
						<div class="col-md-6">
							<!-- formtarget="_blank" target="_blank"  -->
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<input type="hidden" name="processo" value="{{ $processoActual->id }}">

							<div class="form-group ">
								<label>Nome Completo</label>
								<input class="form-control" type="text" name="nomeCompleto" required>
							</div>

							<span class="text-danger">{{ $errors->first('nome') }}</span>

							<!--	<div class="form-group">
							<label>Apelidos</label>
							<input class="form-control" type="text" name="apelido" value="{{ old('apelido') }}" required>
							<span class="text-danger">{{ $errors->first('apelido') }}</span>
						</div>  -->
							<!--  <div class="form-group">
								<label>Curso</label>
								<input class="form-control" type="text" name="curso" value="{{ old('curso') }}" required>
								<span class="text-danger">{{ $errors->first('curso') }}</span>
							</div> -->
							<div class="form-group">
								<label>Curso</label>
								<select name="curso" class="form-control">
									@foreach($cursos as $curso)
									<option value="{{$curso->id}}">{{$curso->nome}}</option>
									@endforeach
								</select>
							</div>
							<!--	<div class="form-group input-group">
								
								<span class="input-group-addon">@</span>
								<input class="form-control" type="text" name="email" placeholder="email" value="{{ old('email') }}" required>
								<span class="text-danger">{{ $errors->first('email') }}</span>
							</div>-->
							<div class="row">
								<div class="col-md-4">
								<label>Media Língua Portuguesa</label>
									<input class="form-control" type="text" name="media_linguaP" placeholder="Media Lingua Portuguesa">

								</div>
								<div class="col-md-4">
								<label>Media Matemática</label>
									<input class="form-control" type="text" name="media_mat" placeholder="Media Matemática">

								</div>
								<div class="col-md-4">
								<label>Media Final</label>
									<input class="form-control" type="text" name="media_linguaP" placeholder="Media final">
								</div>
							</div>


							<div class="form-group">
								<label for="">Ano Admissão</label>
								<input name="anoAdmissao" class="form-control" type="number" min="2020" max="2099" step="1" value="2021" readonly />
								<span class="text-danger">{{ $errors->first('anoAdmissao') }}</span>
							</div>

							<div class="form-group">
								<label>Estado</label>
								<select name="estado" class="form-control">
									<option value="Candidato">Candidato</option>
									<option disabled value="Inscrito">Inscrito</option>
									<option disabled value="Reprovado">Reprovado</option>
									<option disabled value="Aprovado">Aprovado</option>

								</select>
								<span class="text-danger">{{ $errors->first('anoAcademico') }}</span>
							</div>
							<div class="form-group">
								<label>Data Nacimento</label>
								<input min="1920-01-01" max="2006-12-31" class="form-control" type="date" name="dataNac">
								<span class="text-danger">{{ $errors->first('dataNac') }}</span>
							</div>
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="form-group">
										<label>Nº do Bilhete de Identidade</label>
										<input class="form-control" type="text" id="BI" name="BI" required>
										<span class="text-danger">{{ $errors->first('BI') }}</span>
									</div>
									<div class="form-group">
										<label>Data Emissão do Bilhete de Identidade </label>
										<input min="2010-08-14" max="{{$date}}" class="form-control" type="date" name="dataEmissaoBI" required>
										<span class="text-danger">{{ $errors->first('BI') }}</span>
									</div>
									<div class="form-group">
										<label>Data de Validade do Bilhete de Identidade </label>
										<input min="{{$date}}" class="form-control" type="date" name="dataValidadeBI" required>
										<span class="text-danger">{{ $errors->first('BI') }}</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Sexo</label>
								<select name="genero" class="form-control">
									<option value="Masculino">Masculino</option>
									<option value="Feminino">Feminino</option>
								</select>
								<span class="text-danger">{{ $errors->first('genero') }}</span>
							</div>

							<div class="form-group">
								<label>Nome do pai</label>
								<input class="form-control" type="text" name="nomePai" required>
								<span class="text-danger">{{ $errors->first('nomePai') }}</span>
							</div>
							<div class="form-group">
								<label>Nome da Mae</label>
								<input class="form-control" type="text" name="nomeMai" required>
								<span class="text-danger">{{ $errors->first('nomeMai') }}</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Provincia</label>
								<select id="provRecidencia" name="provRecidencia" class="form-control">
									@foreach($provincias as $provincia)
									<option value="{{$provincia->id}}">{{$provincia->nome}}</option>
									@endforeach
								</select>
								<span class="text-danger">{{ $errors->first('provRecidencia') }}</span>
							</div>
							<div class="form-group">
								<label>Municipio</label>
								<select id="munRecidencia" name="munRecidencia" class="form-control">
									<option value="-">-</option>

								</select>

								<div class="form-group">
									<label>Nacionalidade</label>
									<input class="form-control" type="text" name="nacionalidade" required>
									<span class="text-danger">{{ $errors->first('nacionalidade') }}</span>
								</div>

								<div id="ProvMunicipio">


								</div>

								<div class="form-group">
									<label for="">Trabalhador?</label>
									<label for="">Sim</label>
									<input type="radio" name="trabalhador" value="1">
									<label for="">Não</label>
									<input type="radio" name="trabalhador" value="0" checked>
									<span class="text-danger">{{ $errors->first('trabalhador') }}</span>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group input-group">
											<span class="input-group-addon"><i class="fa fa-phone"></i></span>
											<input class="form-control" type="text" id="telefone1" name="telefone1" placeholder="Telef. 1" required>

										</div>
										<span class="text-danger">{{ $errors->first('telefone1') }}</span>
									</div>


									<div class="col-md-4">
										<div class="form-group input-group">
											<span class="input-group-addon"><i class="fa fa-phone"></i></span>
											<input class="form-control" type="tel" id="telefone2" name="telefone2" placeholder="Telef. 2" required>
											<span class="text-danger">{{ $errors->first('telefone2') }}</span>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group input-group">
											<span class="input-group-addon"><i class="fa fa-phone"></i></span>
											<input class="form-control" type="tel" id="telefoneEmergencia" name="telefoneEmergencia" placeholder="Telef. Emergência" required>
											<span class="text-danger">{{ $errors->first('telefoneEmergencia') }}</span>
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
								<br>
								<div class="panel panel-default">
									<h3 align="center">Morada</h3>
									<div class="panel-body">

										<div class="form-group">
											<label>Provincia</label>
											<select id="provEndereco" name="provEndereco" class="form-control">
												@foreach($provincias as $provincia)
												<option value="{{$provincia->id}}">{{$provincia->nome}}</option>
												@endforeach
											</select>
											<span class="text-danger">{{ $errors->first('provRecidencia') }}</span>
										</div>
										<div class="form-group">
											<label>Municipio</label>
											<select id="munEndereco" name="munEndereco" class="form-control">
												<option value="-">-</option>

											</select>
											<span class="text-danger">{{ $errors->first('munRecidencia') }}</span>
										</div>

										<div class="form-group">
											<label>Zona ou Comuna</label>
											<input class="form-control" type="text" name="endereco" required>
											<span class="text-danger">{{ $errors->first('endereco') }}</span>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-4">
													<label>Documentos entregues </label>
												</div>

											</div>

											@foreach($processoActual->documentos as $doc)
											<div class="checkbox">
												<label>
													<input required id="documentos[]" name="documentos[]" type="checkbox" value="{{$doc->id}}" data-msg-required="É Obrigatorio.">{{$doc->nome}} <span style="color: red;">*</span>
												</label>
											</div>
											@endforeach

										</div>

									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-body">
										<h3 align="center">Como conheceu ou ficou a saber da escola?</h3>
										@foreach($processoActual->contactos as $contacto)
										<div class="checkbox">
											<label>
												<input required id="contactos[]" name="contactos[]" type="checkbox" value="{{$contacto->id}}">{{$contacto->nome}}
											</label>
										</div>
										@endforeach
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">

						<div class="col-lg-12">

							<div class="col-lg-6">
								<button id="botonConfirmar" class="btn btn-primary btn-block" type="submit">Registrar</button>
							</div>
							<div class="col-lg-6">
								<button class="btn btn-outline btn-success btn-block">Cancelar</button>
							</div>
						</div>


					</div>
				</div>
			</div>

		</form>

	</div>


</div>



<div id="popup" style="display: none;">
	<div class="content-popup">
		<div class="close"><a href="#" id="close"><img src="images/close.png" /></a></div>
		<div>
			<h2>Contenido POPUP</h2>
			<p>Lorem Ipsum...</p>
			<div style="float:left; width:100%;">
			</div>
		</div>
	</div>
</div>
<div class="popup-overlay"></div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
	$(document).ready(function() {

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

				apelido: {
					required: true,
					maxlength: 500,
				},
				BI: {
					required: true,
					maxlength: 14,
					minlength: 14,

				},


			},
			messages: {

				nomeCompleto: {
					required: "É obrigatória a indicação de um valor para o campo nome.",
				},
				apelido: {
					required: "É obrigatória a indicação de um valor para o campo apelido.",
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
		})

	});

	$("#provRecidencia").change(function(event) {
		var id_prov = $(this).val();

		url = "/municipios/" + id_prov + "";

		$.getJSON(url, function(response, state) {
			$('#munRecidencia').empty();

			$.each(response, function(k, v) {
				$('#munRecidencia').append('<option value=' + v.id + '>' + v.nome + '</option>');

			});



		});

	});

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

	/*$("#BI").mask("000000000AA000", {
		translation: {
			A: {
				pattern: /['BA']/
			}
		}
	}).attr('minlength', 14);*/

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
		/*$("input[type='checkbox']").change(function(event) {
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
		});*/




	});

	function contar() {
		var checkboxes = document.getElementById("form1").checkbox; //Array que contiene los checkbox

		var cont = 0; //Variable que lleva la cuenta de los checkbox pulsados

		for (var x = 0; x < checkboxes.length; x++) {
			if (checkboxes[x].checked) {
				cont = cont + 1;
			}
		}

		alert("El número de checkbox pulsados es " + cont);
	}
</script>
@endSection


@stop