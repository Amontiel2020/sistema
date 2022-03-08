@extends('layouts.Main')

@section('content')


<div class="panel panel-default">
	<div class="panel-heading">
		<h3>Ficha de estudante</h3>
	</div>
	<div class="panel-body">
		<div class="row">

			<div class="row">
				<div class="col-xs-12" align="center">

					<img width="100px" height="100px" src="{{url('/storage/'.'logo.png') }}">

					<!--  <p>MINISTERIO DO ENSINO SUPERIOR CIÊNCIA, TECNOLOGIA E INOVAÇÃO</p> -->

					<p><b>ESCOLA SUPERIOR POLITÉCNICA DE BENGUELA</b></p>
					<p><b> Decreto Presidencial nº 168/12 de 24 de Julho</b></p>
					<p><b>Bairro da Graça, Benguela - A n g o l a</b></p>

				</div>



			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<img width="150px" height="150px" src="{{url('/storage/'.$estudante->pathImage) }}" alt="">
				<br>
				<p>Nº Estudante: {{$estudante->codigo}}</p>
			</div>
			<div class="col-md-8">
				<br>
				<br>
				<div style="font-size: large;">
					<p><b>Curso:</b> {{\App\Curso::toString($estudante->curso_id)}}</p>
					<p><b>Nome:</b> {{$estudante->nome}} {{$estudante->apelido}}</p>
					<p><b>Filhação:</b> {{$estudante->nomePai}} e {{$estudante->nomeMai}} </p>
					<p><b>Natural de </b> {{\App\Municipio::toString($estudante->municipio_id)}} <b>Munícipio de</b> {{\App\Municipio::toString($estudante->municipio_id)}} </p>
					<p> <b>Província de</b> {{\App\Provincia::toString($estudante->provincia_id)}} <b>Nascido em </b> {{$estudante->dataNac}}</p>
					<p><b>Matrícula</b> <b>Renovação da Matrícula*</b></p>
				</div>


			</div>
		</div>

		<br>
		<table class="table table-bordered table-striped">
			@foreach($estudante->inscricoes as $inscricao)

			<tr>
				<th></th>
				<th colspan="2">INSCRIÇÕES</th>
				<th></th>
				<th></th>
				<th colspan="3">FREQUENCIA</th>
				<th></th>
				<th colspan="3">EXAMES</th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
			<tr>
				<th>Ano curricular</th>
				<th>Nº</th>
				<th>Ano Acadêmico</th>
				<th>UNIDADE CURRICULAR</th>
				<th>SEMESTRE</th>
				<th>F1</th>
				<th>F2</th>
				<th>MAC</th>
				<th>M</th>
				<th>Ex1</th>
				<th>Ex2</th>
				<th>Ex3</th>
				<th>MÉDIA FINAL</th>
				<th>CONFIRMADO POR</th>
				<th>OBSERVAÇÕES</th>
			</tr>


			@foreach($inscricao->disciplinas as $i=> $disciplina)
			<tr>
				<td>{{$disciplina->ano}}</td>
				<td>{{$i+1}}</td>
				<td>{{$inscricao->anoAcademico}}</td>
				<td>
					{{\App\Disciplina::toString($disciplina->pivot->disciplina_id)}}

				</td>
				<td align="center">{{$disciplina->semestre}}</td>
				<td>{{\App\Pauta::obterAvaliacao($estudante->id,$disciplina->id,"F1",$inscricao->anoAcademico)}}</td>
				<td>{{\App\Pauta::obterAvaliacao($estudante->id,$disciplina->id,"F2",$inscricao->anoAcademico)}}</td>
				<td>{{\App\Pauta::obterAvaliacao($estudante->id,$disciplina->id,"MAC",$inscricao->anoAcademico)}}</td>
				<td>{{\App\Pauta::obterMedia($estudante->id,$disciplina->id,$inscricao->anoAcademico)}}</td>
				<td>{{\App\Pauta::obterAvaliacao($estudante->id,$disciplina->id,"Ex1",$inscricao->anoAcademico)}}</td>
				<td>{{\App\Pauta::obterAvaliacao($estudante->id,$disciplina->id,"Ex2",$inscricao->anoAcademico)}}</td>
				<td>{{\App\Pauta::obterAvaliacao($estudante->id,$disciplina->id,"Ex3",$inscricao->anoAcademico)}}</td>
				<td>{{\App\Pauta::obterMediaFinal($estudante->id,$disciplina->id,$inscricao->anoAcademico)}}</td>
				<td></td>
				<td></td>

			</tr>


			@endforeach
			@endforeach

		</table>


	</div>
</div>









@stop