@extends('layouts.Main')

@section('content')


<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Ficha Candidatura</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!--<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">
			Candidato
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6">
					<h1>{{$candidato->nomeCompleto}}</h1>

				</div>
				<div class="col-md-4">
					<h1>{{$candidato->codigo}}</h1>
				</div>
			</div>
		</div>
	</div>
</div>
-->
<form role="form" action="{{route('updateCandidato')}}" id="createEstudante_form" enctype="multipart/form-data" method="POST">

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Edição
				</div>
				<div class="panel-body">

					<div class="row">
						<div class="col-md-6">

							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="id" value="{{ $candidato->id }}">
							<input type="hidden" name="idProc" value="{{ $idProc }}">

							<div class="form-group">
								<label>Codigo do Candidato</label>
								<input class="form-control" type="text" name="numero" value="{{$candidato->codigo}}" readonly>

							</div>

							<div class="form-group">
								<label>Nome Completo</label>
								<input class="form-control" type="text" name="nomeCompleto" value="{{$candidato->nomeCompleto}}" required>
								<span class="text-danger">{{ $errors->first('nome') }}</span>
							</div>
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
									<option @if($candidato->curso_id==$curso->id) selected @endif value="{{$curso->id}}">{{$curso->nome}}</option>
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
									<input class="form-control" type="text" name="media_linguaP" placeholder="Media Lingua Portuguesa" value="{{$candidato->media_linguaP }}">

								</div>
								<div class="col-md-4">
								<label>Media Matemática</label>
									<input class="form-control" type="text" name="media_mat" placeholder="Media Matemática" value="{{$candidato->media_mat }}">
								</div>
								<div class="col-md-4">
								<label>Media Final</label>
									<input class="form-control" type="text" name="media_final" placeholder="Media final" value="{{$candidato->media_final }}">
								</div>
							</div>
							<div class="form-group">
								<label for="">Ano Académico</label>
								<input name="anoAcademico" class="form-control" type="number" min="2020" max="2099" step="1" value="{{$candidato->anoAcademico}}" readonly />
								<span class="text-danger">{{ $errors->first('anoAdmissao') }}</span>
							</div>

							<div class="form-group">
								<label>Estado</label>
								<select name="estado" class="form-control">
								    <option @if($candidato->estado=="Candidato") selected @endif value="Candidato">Candidato</option>
									<option @if($candidato->estado=="Inscrito") selected @endif value="Inscrito">Inscrito</option>
									<option @if($candidato->estado=="Aprovado") selected @endif value="Aprovado">Aprovado</option>
									<option @if($candidato->estado=="Reprovado") selected @endif value="Reprovado">Reprovado</option>
								</select>
								<span class="text-danger">{{ $errors->first('estado') }}</span>
							</div>
							<div class="form-group">
								<label>Data Nascimento</label>
								<input min="1970-01-01" max="2006-12-31" class="form-control" type="date" name="dataNac" value="{{ $candidato->dataNac }}">
								<span class="text-danger">{{ $errors->first('dataNac') }}</span>
							</div>
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="form-group">
										<label>Nº do Bilhete de Identidade</label>
										<input class="form-control" type="text" name="BI" value="{{ $candidato->BI }}" required>
										<span class="text-danger">{{ $errors->first('BI') }}</span>
									</div>
									<div class="form-group">
										<label>Data Emissão do Bilhete de Identidade </label>
										<input  class="form-control" type="date" name="dataEmissaoBI" value="{{ $candidato->dataEmissaoBI }}" required>
										<span class="text-danger">{{ $errors->first('BI') }}</span>
									</div>
									<div class="form-group">
										<label>Data de Validade do Bilhete de Identidade </label>
										<input   class="form-control" type="date" name="dataEmissaoBI" value="{{ $candidato->dataValidadeBI }}" required>
										<span class="text-danger">{{ $errors->first('BI') }}</span>
									</div>
								</div>
							</div>


							<div class="form-group">
								<label>Sexo</label>
								<select name="genero" class="form-control">
									<option @if($candidato->genero=='Masculino') selected @endif value="Masculino">Masculino</option>
									<option @if($candidato->genero=='Feminino') selected @endif value="Feminino">Feminino</option>
								</select>
								<span class="text-danger">{{ $errors->first('genero') }}</span>
							</div>

							<div class="form-group">
								<label>Nome do pai</label>
								<input class="form-control" type="text" name="nomePai" value="{{ $candidato->nomePai }}" required>
								<span class="text-danger">{{ $errors->first('nomePai') }}</span>
							</div>
							<div class="form-group">
								<label>Nome da Mae</label>
								<input class="form-control" type="text" name="nomeMai" value="{{ $candidato->nomeMai  }}" required>
								<span class="text-danger">{{ $errors->first('nomeMai') }}</span>
							</div>



						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Provincia</label>
								<select id="provRecidencia" name="provRecidencia" class="form-control">
									@foreach($provincias as $provincia)
									<option @if($candidato->provincia_id==$provincia->id) selected @endif value="{{$provincia->id}}">{{$provincia->nome}}</option>
									@endforeach
								</select>
								<span class="text-danger">{{ $errors->first('provRecidencia') }}</span>
							</div>
							<div class="form-group">
								<label>Municipio</label>
								<select id="munRecidencia" name="munRecidencia" class="form-control">
									@foreach($municipios as $municipio)
									<option @if($candidato->municipio_id==$municipio->id) selected @endif value="{{$municipio->id}}">{{$municipio->nome}}</option>
									@endforeach

								</select>
								<span class="text-danger">{{ $errors->first('munRecidencia') }}</span>
							</div>

							<div class="form-group">
								<label>Nacionalidade</label>
								<input class="form-control" type="text" name="nacionalidade" value="{{ $candidato->nacionalidade  }}" required>
								<span class="text-danger">{{ $errors->first('nacionalidade') }}</span>
							</div>

							<div id="ProvMunicipio">


							</div>

							<div class="form-group">
								<label for="">Trabalhador?</label>
								<label for="">Sim</label>
								<input type="radio" name="trabalhador" value="1" @if($candidato->trabalhador==1) checked @endif>
								<label for="">Não</label>
								<input type="radio" name="trabalhador" value="0" @if($candidato->trabalhador==0) checked @endif>
								<span class="text-danger">{{ $errors->first('trabalhador') }}</span>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Telefone1</label>
										<input class="form-control" type="tel" id="telefone1" name="telefone1" value="{{ $candidato->telefone1 }}" required>
										<span class="text-danger">{{ $errors->first('telefone1') }}</span>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Telefone2</label>
										<input class="form-control" type="tel" id="telefone2" name="telefone2" value="{{ $candidato->telefone2 }}" required>
										<span class="text-danger">{{ $errors->first('telefone2') }}</span>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Telefone de Emergência</label>
										<input class="form-control" type="tel" id="telefoneEmergencia" name="telefoneEmergencia" value="{{ $candidato->telefoneEmergencia }}" required>
										<span class="text-danger">{{ $errors->first('telefone2') }}</span>
									</div>
								</div>

							</div>
							<div class="panel panel-default">
								<h3 align="center">Morada</h3>
								<div class="panel-body">

									<div class="form-group">
										<label>Provincia</label>
										<select id="provEndereco" name="provEndereco" class="form-control">
											@foreach($provincias as $provincia)
											<option @if($candidato->provinciaEndereco_id==$provincia->id) selected @endif value="{{$provincia->id}}">{{$provincia->nome}}</option>
											@endforeach
										</select>
										<span class="text-danger">{{ $errors->first('provRecidencia') }}</span>
									</div>
									<div class="form-group">
										<label>Municipio</label>
										<select id="munEndereco" name="munEndereco" class="form-control">
											@foreach($municipios as $municipio)
											<option @if($candidato->municipioEndereco_id==$municipio->id) selected @endif value="{{$municipio->id}}">{{$municipio->nome}}</option>
											@endforeach

										</select>
										<span class="text-danger">{{ $errors->first('munRecidencia') }}</span>
									</div>
									<div class="form-group">
										<label>Morada Actual</label>
										<input class="form-control" type="text" name="endereco" value="{{ $candidato->endereco }}" required>
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
											<label><input @if($candidato->estaDocumento($doc->id,$candidato->documentos)) checked @endif name="documentos[]" type="checkbox" value="{{$doc->id}}">{{$doc->nome}}</label>
										</div>
										@endforeach
									</div>

								</div>
							</div>


							<!--		<div class="form-group ">

							<label for="">Image</label>
							<input id="file-input" name="imagenperfil" type="file" />

						</div>  -->



						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">

						<div class="col-lg-12">

							<div class="col-lg-6">
								<button class="btn btn-primary btn-block" type="submit">Registrar</button>
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

				}

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
	})
</script>
@endSection


@stop