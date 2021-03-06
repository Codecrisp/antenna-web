@extends('layouts.dashboard')

@section('content')
{!! Form::model($user, [
	'route' => $user->exists ? ['user.update', $user->getRouteKeyValue()] : ['user.store'],
	'method' => $user->exists ? 'PUT' : 'POST'

	]) !!}
<div class="row" style="min-height:80px;">
	<div class="col-xs-6">
		@include('layouts.partials._alerts')
	</div>
	<div class="col-xs-6 text-right">
		<button type="submit" class="btn btn-space btn-primary btn-md-lg"><i class="icon mdi mdi-check"></i> Save </button>
		<a href="{{ route('user.index') }}" class="btn btn-space btn-default btn-md-lg">Cancel</a>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<div class="panel panel-default panel-border-color panel-border-color-primary">
			<div class="panel-heading panel-heading-divider">Account Information<span class="panel-subtitle"></span></div>
			<div class="panel-body">
				<div class="form-group xs-pt-10">
					{!! Form::label('membership') !!}
					@if($user->exists)
					{!! Form::text('membership', null, ['class' => 'form-control', 'required', 'readonly' => 'true', '']) !!}
					@else
					{!! Form::text('membership', null, ['class' => 'form-control', 'required']) !!}
					@endif
				</div>
				<div class="form-group">
					{!! Form::label('email') !!}
					{!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
				</div>
				@if(auth()->user()->role == 9)
				<div class="form-group">
					{!! Form::select('role', ['-1' => 'Inactief', '0' => 'Onbevestigd', '1' => 'Gebruiker', '7' => 'Doctor', '8' => 'View Only Admin', '9' => 'Admin'], null, ['class' => 'form-control']) !!}
				</div>
                <div class="form-group">
					{!! Form::label('club_id', 'Club') !!}
					{!! Form::select('club_id', $clubs, null, ['class' => 'form-control']) !!}
                </div>
				@endif
			</div>
		</div>
		<div class="panel panel-default panel-border-color panel-border-color-primary">
			<div class="panel-heading panel-heading-divider">Change Password<span class="panel-subtitle">Leave blank if you do not wish to change your password</span></div>
			<div class="panel-body">
					<div class="form-group xs-pt-10">
						{!! Form::label('password') !!}
						{!! Form::password('password', ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('password_confirmation') !!}
						{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
					</div>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="panel panel-default panel-border-color panel-border-color-primary">
			<div class="panel-heading panel-heading-divider">Personal Information<span class="panel-subtitle"></span></div>
			<div class="panel-body">
					<div class="form-group xs-pt-10">
						<div class="row">
							<div class="col-xs-6">
								{!! Form::label('first_name') !!}
								{!! Form::text('first_name', null, ['class' => 'form-control', 'required']) !!}
							</div>
							<div class="col-xs-6">
								{!! Form::label('last_name') !!}
								{!! Form::text('last_name', null, ['class' => 'form-control', 'required']) !!}
							</div>
						</div>
					</div>
					<div class="form-group xs-pt-10">
						{!! Form::label('address') !!}
						{!! Form::text('address', null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group xs-pt-10">
						{!! Form::label('city') !!}
						{!! Form::text('city', null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group xs-pt-10">
						{!! Form::label('country') !!}
						{!! Form::text('country', null, ['class' => 'form-control']) !!}
					</div>
			</div>
		</div>
	</div>
</div>
{!! Form::close() !!}
<div class="row" style="margin-bottom:10px;">
	<div class="col-md-12 text-right">
		<form action="{{ route('user.destroy', $user->getRouteKeyValue()) }}" method="POST">
			{{ csrf_field() }}
			<input type="hidden" name="_method" value="DELETE">
			<button class="btn btn-space btn-danger btn-md-lg">Remove</a>
		</form>
	</div>
</div>
@endsection
