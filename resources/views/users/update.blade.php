@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title">Modifier l'utilisateur {{ $user->name }}</h3></div>
			<div class="panel-body">
				{!! Form::open(['url' => '/users/'.$user->id.'/update/', 'class' => 'form-horizontal', 'method' => 'PUT', 'id' => 'userForm']) !!}

					<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
						{!! Form::label('name', 'Nom complet', ['class' => 'col-md-4 control-label']) !!}
						<div class="col-md-6">
							{!! Form::input('text', 'name', $user->name, ['class' => 'form-control', 'placeholder' => 'Ex: John Doe']) !!}
							<small class="text-danger">{{ $errors->first('name') }}</small>
						</div>
					</div>

					<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
						{!! Form::label('email', 'Email', ['class' => 'col-md-4 control-label']) !!}
						<div class="col-md-6">
							{!! Form::input('email', 'email', $user->email, ['class' => 'form-control', 'placeholder' => 'Ex: johndoe@gmail.com']) !!}
							<small class="text-danger">{{ $errors->first('email') }}</small>
						</div>
					</div>

					<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
						{!! Form::label('password', 'Mot de passe', ['class' => 'col-md-4 control-label']) !!}
						<div class="col-md-6">
							{!! Form::input('text', 'password', null, ['class' => 'form-control', 'placeholder' => '*******']) !!}
							<small>Laisser vide pour garder le mot de passe actuel.</small>
							<small class="text-danger">{{ $errors->first('password') }}</small>
						</div>
					</div>

					<div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
						{!! Form::label('role', 'Rôle', ['class' => 'col-md-4 control-label']) !!}
						<div class="col-md-6">
		                	{!! Form::select('role', $roles, $user->roles()->first()->id, ['class' => 'form-control', 'required']) !!}
							<small class="text-danger">{{ $errors->first('role') }}</small>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-9 col-md-offset-4">
							<button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Enregistrer</button>
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endsection