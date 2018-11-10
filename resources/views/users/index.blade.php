@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card card-default">
		<div class="card-body">
			<h3 class="card-title pull-left">Users ({{ $users->count() }})</h3>
			<div class="clearfix"></div>
		</div>

		<table class="table table-striped table-hover" id="users">
			<thead>
				<tr>
					<th>Role</th>
					<th>Name</th>
					<th>E-mail</th>
					<th>Provider</th>
					<th>Date de création</th>
					<th class="col-md-2">Actions</th>
				</tr>
			</thead>
			<tbody data-link="row" class="rowlink">
				@forelse($users as $user)
					<tr>
						<td>
							@forelse($user->roles as $role)
								<span class="label @if($user->hasRole('admin')) label-danger @endif @if($user->hasRole('creator')) label-info @endif">{{$role->name}}</span>
							@empty
							@endforelse
						</td>
						<td><a href="/users/{{ $user->id }}/update" title="Show this user">{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ $user->provider }}</td>
						<td>{{ $user->created_at }}</td>
						<td class="rowlink-skip">
							<div class="btn-group ">
								<a href="/users/{{ $user->id }}/update" class="btn btn-sm btn-info text-center" title="Edit this user"><span class="fa fa-pencil"></span></a>
							</div>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="5">Aucun user. Comment êtes-vous arrivé ici d'ailleurs ?</td>
					</tr>
				@endforelse
			</tbody>
		</table>

		<div class="card-footer">
			<div class="text-center">{{$users->render()}}</div>
		</div>
	</div>
</div>
@endsection
