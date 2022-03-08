@extends('layouts.Main')

@section('content')


<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Ficha Matricula</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Estudante
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">

						<form role="form" action="{{route('storeEstudantes')}}" id="createEstudante_form" enctype="multipart/form-data" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label>Nome</label>
								<input class="form-control" type="text" name="nome" value="{{ old('nome') }}" required>
								<span class="text-danger">{{ $errors->first('nome') }}</span>
							</div>
							<div class="form-group">
								<label>Apelidos</label>
								<input class="form-control" type="text" name="apelido" value="{{ old('apelido') }}" required>
								<span class="text-danger">{{ $errors->first('apelido') }}</span>
							</div>
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
							<div class="form-group">
								<label>Turma</label>
								<select name="turma" class="form-control">
									@foreach($turmas as $turma)
									<option value="{{$turma->id}}">{{$turma->identificador}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="">Ano Admissão</label>
								<input name="anoAdmissao" class="form-control" type="number" min="2020" max="2099" step="1" value="2020" />
								<span class="text-danger">{{ $errors->first('anoAdmissao') }}</span>
							</div>
							<div class="form-group">
								<label>Ano Acadêmico</label>
								<select name="anoAcademico" class="form-control">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
								<span class="text-danger">{{ $errors->first('anoAcademico') }}</span>
							</div>
							<div class="form-group">
								<label>Estado</label>
								<select name="estado" class="form-control">
									<option value="Activo">Activo</option>
									<option value="Novo Ingreso">Novo Ingreso</option>
									<option value="Em Continuação de Estudos">Em Continuação de Estudos</option>
									<option value="Re">Em Continuação de Estudos</option>
									<option value="Repetente">Repetente</option>
									<option value="Em preparação da Monografia">Em preparação da Monografia</option>
									<option value="Reingreso">Reingreso</option>
									<option value="Preescrito">Preescrito</option>
									<option value="Interrupção Temporaria">Interrupção Temporaria</option>

								</select>
								<span class="text-danger">{{ $errors->first('anoAcademico') }}</span>
							</div>
							<div class="form-group">
								<label>Data Nacimento</label>
								<input class="form-control" type="date" name="dataNac" value="{{ old('dataNac') }}">
								<span class="text-danger">{{ $errors->first('dataNac') }}</span>
							</div>
							<div class="form-group">
								<label>BI</label>
								<input class="form-control" type="text" name="BI" value="{{ old('BI') }}">
								<span class="text-danger">{{ $errors->first('BI') }}</span>
							</div>
							<div class="form-group">
								<label>Genero</label>
								<select name="genero" class="form-control">
									<option value="Masculino">Masculino</option>
									<option value="Feminino">Feminino</option>
								</select>
								<span class="text-danger">{{ $errors->first('genero') }}</span>
							</div>


					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Natural de</label>
							<input class="form-control" type="text" name="naturalDe" value="{{ old('naturalDe') }}">
							<span class="text-danger">{{ $errors->first('naturalDE') }}</span>
						</div>
						<div class="form-group">
							<label>Nacionalidade</label>
							<input class="form-control" type="text" name="nacionalidade" value="{{ old('nacionalidade') }}">
							<span class="text-danger">{{ $errors->first('nacionalidade') }}</span>
						</div>
						<div class="form-group">
							<label>Pais Origem</label>

							{!! Form::select('pais',$pais,null,['class'=>'form-control','id'=>'paisOrigem','style'=>'width: 50%']) !!}

							<span class="text-danger">{{ $errors->first('paisOrigem') }}</span>
						</div>
						<div id="ProvMunicipio" style="display: none">
							<div class="form-group">
								<label>Provincia de recidência</label>
								<select name="provRecidencia" class="form-control">
									<option value="-">-</option>
									<option value="Bengo">Bengo</option>
									<option value="Benguela">Benguela</option>
									<option value="Bié">Bié</option>
									<option value="Cabinda">Cabinda</option>
									<option value="Cuando Cubango">Cuando Cubango</option>
									<option value="Cuanza Norte">Cuanza Norte</option>
									<option value="Cuanza Sul">Cuanza Sul</option>
									<option value="Cunene">Cunene</option>
									<option value="Huambo">Huambo</option>
									<option value="Huíla">Huíla</option>
									<option value="Luanda">Luanda</option>
									<option value="Lunda Norte">Lunda Norte</option>
									<option value="Malanje">Malanje</option>
									<option value="Moxico">Moxico</option>
									<option value="Namibe">Namibe</option>
									<option value="Uíge">Uíge</option>
									<option value="Zaire">Zaire</option>
								</select>
								<span class="text-danger">{{ $errors->first('provRecidencia') }}</span>
							</div>
							<div class="form-group">
								<label>Municipio de recidência</label>
								<select name="munRecidencia" class="form-control">
									<option value="-">-</option>
									<option value="Cabinda Cabinda">Cabinda Cabinda</option>
									<option value="Cabinda Cacongo(Ex Landana)">Cabinda Cacongo(Ex Landana)</option>
									<option value="Cabinda Belize">Cabinda Belize</option>
									<option value="Zaire M'Banza Kongo">Zaire M'Banza Kongo</option>
									<option value="Zaire Soyo">Zaire Soyo</option>
									<option value="Zaire N'Zeto">Zaire N'Zeto</option>
									<option value="Zaire Tomboco">Zaire Tomboco</option>
									<option value="Zaire Noqui">Zaire Noqui</option>
									<option value="Zaire Kuimba">Zaire Kuimba</option>
									<option value="Uíge Uíge">Uíge Uíge</option>
									<option value="Uíge Ambuíla">Uíge Ambuíla</option>
									<option value="Uíge Songo">Uíge Songo</option>
									<option value="Uíge Bembe">Uíge Bembe</option>
									<option value="Uíge Negage">Uíge Negage</option>
									<option value="Uíge Bungo">Uíge Bungo</option>
									<option value="Uíge Maquela do Zombo">Uíge Maquela do Zombo</option>
									<option value="Uíge Damba">Uíge Damba</option>
									<option value="Uíge Kangola">Uíge Kangola</option>
									<option value="Uíge Kangola">Uíge Kangola</option>
									<option value="Uíge Sanza Pombo">Uíge Sanza Pombo</option>
									<option value="Uíge Quitexe">Uíge Quitexe</option>
									<option value="Uíge Quimbele">Uíge Quimbele</option>
									<option value="Uíge Santa Cruz">Uíge Santa Cruz</option>
									<option value="Uíge Puri">Uíge Puri</option>
									<option value="Uíge Mucaba (Ex Quinzala)">Uíge Mucaba (Ex Quinzala)</option>
									<option value="Uíge Buengas (Ex Nova Esperança)">Uíge Buengas (Ex Nova Esperança)</option>
									<option value="Luanda Luanda">Luanda Cazenga</option>
									<option value="Luanda Cacuaco">Luanda Cacuaco</option>
									<option value="Luanda Viana">Luanda Viana</option>
									<option value="Luanda Belas">Luanda Belas</option>
									<option value="Luanda Icolo Bengo">Luanda Icolo Bengo</option>
									<option value="Luanda Quissama">Luanda Quissama</option>
									<option value="Cuanza Norte Cazengo">Cuanza Norte Cazengo</option>
									<option value="Cuanza Norte Lucala">Cuanza Norte Lucala</option>
									<option value="Cuanza Norte Kambambe">Cuanza Norte Kambambe</option>
									<option value="Cuanza Norte Ambaca">Cuanza Norte Ambaca</option>
									<option value="Cuanza Norte Kiculungo">Cuanza Norte Kiculungo</option>
									<option value="Cuanza Norte Bolongongo">Cuanza Norte Bolongongo</option>
									<option value="Cuanza Norte Banga">Cuanza Norte Banga</option>
									<option value="Cuanza Norte Samba Caju">Cuanza Norte Samba Caju</option>
									<option value="Cuanza Norte Ngonguembo (Ex Quilombo dos Dembos)">Cuanza Norte Ngonguembo (Ex Quilombo dos Dembos)</option>
									<option value="Cuanza Sul Sumbe (Ex Ngunza)">Cuanza Sul Sumbe (Ex Ngunza)</option>
									<option value="Cuanza Sul Amboin (Ex Gabela)">Cuanza Sul Amboin (Ex Gabela)</option>
									<option value="Cuanza Sul Quilenda">Cuanza Sul Quilenda</option>
									<option value="Cuanza Sul Porto Amboim">Cuanza Sul Porto Amboim</option>
									<option value="Cuanza Sul Libolo (Ex Caculo)">Cuanza Sul Libolo (Ex Caculo)</option>
									<option value="Cuanza Sul Kibala">Cuanza Sul Kibala</option>
									<option value="Cuanza Sul Mussende">Cuanza Sul Mussende</option>
									<option value="Cuanza Sul Seles (Ex Uku-Seles)">Cuanza Sul Seles (Ex Uku-Seles)</option>
									<option value="Cuanza Sul Conda">Cuanza Sul Conda</option>
									<option value="Cuanza Sul Cassongue">Cuanza Sul Cassongue</option>
									<option value="Cuanza Sul Cela (Ex Waku-Kungo)">Cuanza Sul Cela (Ex Waku-Kungo)</option>
									<option value="Cuanza Sul Ebo">Cuanza Sul Ebo</option>
									<option value="Malanje Malanje">Malanje Malanje</option>
									<option value="Malanje Cacuso">Malanje Cacuso</option>
									<option value="Malanje Calandula">Malanje Calandula</option>
									<option value="Malanje Cambundi-Catembo">Malanje Cambundi-Catembo</option>
									<option value="Malanje Quela">Malanje Quela</option>
									<option value="Malanje Kahombo">Malanje Kahombo</option>
									<option value="Malanje Massango">Malanje Massango</option>
									<option value="Malanje Luquembo">Malanje Luquembo</option>
									<option value="Malanje Marimba">Malanje Marimba</option>
									<option value="Malanje Kunda-Dia-Baze">Malanje Kunda-Dia-Baze</option>
									<option value="Malanje Kirima">Malanje Kirima</option>
									<option value="Malanje Mucari">Malanje Mucari</option>
									<option value="Malanje Cangandala">Malanje Cangandala</option>
									<option value="Malanje Kiwaba-Nzogi">Malanje Kiwaba-Nzogi</option>
									<option value="Lunda Norte Lucapa">Lunda Norte Lucapa</option>
									<option value="Lunda Norte Cambulo">Lunda Norte Cambulo</option>
									<option value="Lunda Norte Chitato">Lunda Norte Chitato</option>
									<option value="Lunda Norte Cuilo">Lunda Norte Cuilo</option>
									<option value="Lunda Norte Caungula">Lunda Norte Caungula</option>
									<option value="Lunda Norte Cuango">Lunda Norte Cuango</option>
									<option value="Lunda Norte Lubalo">Lunda Norte Lubalo</option>
									<option value="Lunda Norte Capenda-Camulemba">Lunda Norte Capenda-Camulemba</option>
									<option value="Lunda Norte Xá-Muteba">Lunda Norte Xá-Muteba</option>
									<option value="Benguela Benguela">Benguela Benguela</option>
									<option value="Benguela Baía Farta">Benguela Baía Farta</option>
									<option value="Benguela Lobito">Benguela Lobito</option>
									<option value="Benguela Catumbela">Benguela Catumbela</option>
									<option value="Benguela Cubal">Benguela Cubal</option>
									<option value="Benguela Ganda">Benguela Ganda</option>
									<option value="Benguela Balombo">Benguela Balombo</option>
									<option value="Benguela Bocoio">Benguela Bocoio</option>
									<option value="Benguela Caimbambo">Benguela Caimbambo</option>
									<option value="Benguela Chongoroi">Benguela Chongoroi</option>
									<option value="Huambo Huambo">Huambo Huambo</option>
									<option value="Huambo Tchipipa-Tcholohanga">Huambo Tchipipa-Tcholohanga</option>
									<option value="Huambo Katchiungo">Huambo Katchiungo</option>
									<option value="Huambo Bailumbo">Huambo Bailumbo</option>
									<option value="Huambo Caála">Huambo Caála</option>
									<option value="Huambo Ecunha">Huambo Ecunha</option>
									<option value="Huambo Ukuma">Huambo Ukuma</option>
									<option value="Huambo Longonjo">Huambo Longonjo</option>
								</select>
								<span class="text-danger">{{ $errors->first('munRecidencia') }}</span>
							</div>
						</div>

						<div class="form-group">
							<label>Nome do pai</label>
							<input class="form-control" type="text" name="nomePai" value="{{ old('nomePai') }}">
							<span class="text-danger">{{ $errors->first('nomePai') }}</span>
						</div>
						<div class="form-group">
							<label>Nome Mae</label>
							<input class="form-control" type="text" name="nomeMai" value="{{ old('nomeMai') }}">
							<span class="text-danger">{{ $errors->first('nomeMai') }}</span>
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
								<div class="form-group">
									<label>Telefone1</label>
									<input class="form-control" type="tel" id="telefone1" name="telefone1" value="{{ old('telefone1') }}" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}">
									<span class="text-danger">{{ $errors->first('telefone1') }}</span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Telefone2</label>
									<input class="form-control" type="tel" id="telefone2" name="telefone2" value="{{ old('telefone2') }}" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}">
									<span class="text-danger">{{ $errors->first('telefone2') }}</span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Telefone de Emergencia</label>
									<input class="form-control" type="tel" id="telefone3" name="telefone3" value="{{ old('telefone2') }}" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}">
									<span class="text-danger">{{ $errors->first('telefone2') }}</span>
								</div>
							</div>

						</div>


						<div class="form-group">
							<label>Endereço</label>
							<input class="form-control" type="text" name="endereco" value="{{ old('endereco') }}">
							<span class="text-danger">{{ $errors->first('endereco') }}</span>
						</div>
						<div class="form-group">
							<label>Documentos entregues</label>
							<div class="checkbox">
								<label><input type="checkbox" value="">Documento 1</label>
							</div>
							<div class="checkbox">
								<label><input type="checkbox" value="">Documento 2</label>
							</div>
							<div class="checkbox disabled">
								<label><input type="checkbox" value="" disabled>Documento 3</label>
							</div>
						</div>

						<div class="form-group ">

							<label for="">Imagem</label>
							<input id="file-input" name="imagenperfil" type="file" />

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
	if ($("#createEstudante_form").length > 0) {
		$('#createEstudante_form').find('.error').val(' ');
		jQuery.validator.addMethod("lettersonly", function(value, element) {
			return this.optional(element) || /^[a-z]+$/i.test(value);
		}, "Solo letras");

		$("#createEstudante_form").validate({

			rules: {
				nome: {
					required: true,
					maxlength: 50,
					//lettersonly: true 
				},

				/*     email: {
                    required: true,
                    maxlength: 50,
                    email: true,
				
                },*/

				apelido: {
					required: true,
					maxlength: 500,
				},
			},
			messages: {

				nome: {
					required: "É obrigatória a indicação de um valor para o campo nome.",
				},
				apelido: {
					required: "É obrigatória a indicação de um valor para o campo apelido.",
				},
				email: {
					required: "É obrigatória a indicação de um valor para o campo email.",
					email: "Email não valido",
					maxlength: "The email name should less than or equal to 50 characters",
				},

			},
		})
	}

	$('#paisOrigem').change(function() {

		var pais = $(this).val()
		if (pais == 8) {
			$('#ProvMunicipio').show();
		}
		if (pais != 8) {
			$('#ProvMunicipio').hide();
		}

		//	alert('Has seleccionado ' + pais);

	});

	$("#telefone1, #telefone2, #telefone3").mask("000-000-000");
</script>
@endSection


@stop