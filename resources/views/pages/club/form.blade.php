@extends('layouts.dashboard')

@section('content')
{!! Form::model($club, [
	'route' => $club->exists ? ['clubs.update', $club->id] : ['clubs.store'],
	'method' => $club->exists ? 'PUT' : 'POST'

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
			<div class="panel-heading panel-heading-divider">{{ $club->exists ? 'Edit' : 'Create'}} Club<span class="panel-subtitle"></span></div>
			<div class="panel-body">
					@include('layouts.partials._alerts')
					<div class="form-group xs-pt-10">
						{!! Form::label('npo', 'NPO') !!}
						{!! Form::text('npo', null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('name') !!}
						{!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('address') !!}
						{!! Form::text('address', null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('zip_code') !!}
						{!! Form::text('zip_code', null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('city') !!}
						{!! Form::text('city', null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('country') !!}
						{!! Form::text('country', null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('section_id', 'Section') !!}
						{!! Form::select('section_id', $sections, null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('user_id', 'User') !!}
						{!! Form::select('user_id', $users, null, ['class' => 'form-control']) !!}
					</div>
			</div>
		</div>
	</div>
</div>
{!! Form::close() !!}
@if($club->exists)
<div class="row">
	<div class="col-xs-12 text-right">
			<form action="{{ route('clubs.destroy', $club->id) }}" method="POST">
				{{ csrf_field() }}
				<input type="hidden" name="_method" value="DELETE">
				<button class="btn btn-space btn-danger btn-md-lg">Remove</a>
			</form>
	</div>
</div>
@endif
@endsection
