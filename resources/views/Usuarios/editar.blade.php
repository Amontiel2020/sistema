@extends('layouts.Main')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Editar Usuarios</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="row">
	<!-- <div class="col-lg-12">-->

	<div class="panel panel-default">
		<div class="panel-heading">
			Formulario
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-6">

					<form role="form" action="{{route('updateUsuarios',$user->id)}}" method="PUT">

						<div class="form-group">
							<label>Nome</label>
							<input class="form-control" type="text" name="name" value="{{$user->name}}">
						</div>
						<div class="form-group">
							<label>Apelidos</label>
							<input class="form-control" type="text" name="last_name" value="{{$user->last_name}}">
						</div>
						<div class="form-group input-group">

							<span class="input-group-addon">@</span>
							<input class="form-control" type="text" name="email" placeholder="email" value="{{$user->email}}">
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i>
							</span>
							<input type="text" class="form-control" placeholder="usuario" name="user" value="{{$user->user}}">
						</div>

						<div class="row">
							<div class="col-lg-12">

								<div class="col-lg-6">
									<label>Tipo</label>
									<select multiple class="form-control" name="type[]"
									@if(!Auth::user()->hasRole('Admin')) readonly @endif
									>
										@foreach($roles as $role)
										<option value="{{$role->id}}" @if($user->hasRole($role->name)) selected @endif
											>{{$role->name}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-lg-6">

									<div class="checkbox">
										<br>
										<label>
											<input name="active" type="checkbox" value="active" @if($user->active=="active") checked @endif
											>
											Activo
										</label>
									</div>
								</div>
							</div>

						</div><br>


						<div class="form-group">
							<label>Endereço</label>
							<input class="form-control" type="text" name="address" value="{{$user->address}}">
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-lg-12">

									<div class="col-lg-6">
										<button class="btn btn-primary btn-block" type="submit">Editar</button>
									</div>
									<div class="col-lg-6">
										<button class="btn btn-outline btn-success btn-block">Cancelar</button>
									</div>
								</div>

							</div>



						</div>

					</form>
				</div>
				<div class="col-md-6">
					<form action="{{route('update_passwordFromAdmin')}}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value="{{ $user->id }}">
						<div class="form-group">
							<label>Mudar Palavra passe</label>
							<input placeholder="Nova Passe" class="form-control" type="text" name="novaPasse" value="">
							<!--<input placeholder="Confirmar Passe" class="form-control" type="text" name="confPasse" value="">-->

						</div>
						<div class="form-group">
							<button type="submit">Mudar</button>
						</div>
					</form>
				</div>
			</div>


		</div>
	</div>
	<!-- </div>-->
</div>


@stop