@extends('layouts.dashboard')

@section('content')
{!! Form::model($section, [
	'route' => $section->exists ? ['sections.update', $section->id] : ['sections.store'],
	'method' => $section->exists ? 'PUT' : 'POST'

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
			<div class="panel-heading panel-heading-divider">{{ $section->exists ? 'Edit' : 'Create'}} Section<span class="panel-subtitle"></span></div>
			<div class="panel-body">
					@include('layouts.partials._alerts')
					<div class="form-group xs-pt-10">
						{!! Form::label('name') !!}
						{!! Form::text('name', null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('api_url') !!}
						{!! Form::text('api_url', null, ['class' => 'form-control', 'required']) !!}
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-space btn-primary btn-md-lg"><i class="icon mdi mdi-check"></i> {{ $section->exists ? 'Save' : 'Create' }} </button>
						<a href="{{ route('sections.index') }}" class="btn btn-space btn-default btn-md-lg">Cancel</a>
					</div>
			</div>
		</div>
	</div>
</div>
{!! Form::close() !!}
@if($section->exists)
<div class="row">
	<div class="col-xs-12 text-right">
			<form action="{{ route('sections.destroy', $section->id) }}" method="POST">
				{{ csrf_field() }}
				<input type="hidden" name="_method" value="DELETE">
				<button class="btn btn-space btn-danger btn-md-lg">Remove</a>
			</form>
	</div>
</div>
@endif
@endsection
