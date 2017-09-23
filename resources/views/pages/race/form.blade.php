@extends('layouts.dashboard')

@section('title', 'Races')

@section('content')
{!! Form::model($race, [
	'route' => $race->exists ? ['races.update', $race->id] : ['races.store'],
	'method' => $race->exists ? 'PUT' : 'POST'

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
			<div class="panel-heading panel-heading-divider">{{ $race->exists ? 'Edit' : 'Create'}} Race<span class="panel-subtitle"></span></div>
			<div class="panel-body">
					@include('layouts.partials._alerts')
					<div class="form-group xs-pt-10">
						{!! Form::label('flight_code') !!}
						{!! Form::text('flight_code', null, ['class' => 'form-control', 'required']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('city') !!}
						{!! Form::text('city', null, ['class' => 'form-control', 'required']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('starts_on') !!}
						{!! Form::date('starts_on', (isset($race->starts_on) ? $race->starts_on : \Carbon\Carbon::now()), ['class' => 'form-control', 'required']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('longitude') !!}
						{!! Form::text('longitude', null, ['class' => 'form-control', 'required']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('latitude') !!}
						{!! Form::text('latitude', null, ['class' => 'form-control', 'required']) !!}
					</div>
			</div>
		</div>
	</div>
</div>
{!! Form::close() !!}
@if($race->exists)
<div class="row">
	<div class="col-xs-12 text-right">
			<form action="{{ route('races.destroy', $race->id) }}" method="POST">
				{{ csrf_field() }}
				<input type="hidden" name="_method" value="DELETE">
				<button class="btn btn-space btn-danger btn-md-lg">Remove</a>
			</form>
	</div>
</div>
@endif
@endsection
