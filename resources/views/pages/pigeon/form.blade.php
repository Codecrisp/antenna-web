@extends('layouts.dashboard')

@section('title', 'Pigeons')

@section('content')
{!! Form::model($pigeon, [
	'route' => $pigeon->exists ? ['pigeons.update', $pigeon->id] : ['pigeons.store'],
	'method' => $pigeon->exists ? 'PUT' : 'POST'

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
			<div class="panel-heading panel-heading-divider">{{ $pigeon->exists ? 'Edit' : 'Create'}} Pigeon<span class="panel-subtitle"></span></div>
			<div class="panel-body">
					@include('layouts.partials._alerts')
					<div class="form-group xs-pt-10">
						{!! Form::label('birth_year') !!}
						{!! Form::number('birth_year', null, ['class' => 'form-control', 'required']) !!}
					</div>
					<div class="form-group xs-pt-10">
						{!! Form::label('number') !!}
						{!! Form::text('number', null, ['class' => 'form-control', 'required']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('gender') !!}
						{!! Form::select('gender',['Male'=>'Male','Female'=>'Female', 'Other' => 'Other'], null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						<div class="be-checkbox">
							{{ Form::checkbox('is_race_pigeon', 1, null, ['id' => 'is_race_pigeon']) }}
							<label for="is_race_pigeon">Is Race Pigeon</label>
						</div>
					</div>
					<div class="form-group">
						<div class="be-checkbox">
							<label for="pmv">PMV End Date</label>
							<div data-min-view="2" data-date-format="yyyy-mm-dd" class="input-group date datetimepicker">
								{{ Form::text('pmv', null, ['size' => '16','class' => 'form-control']) }}
								<span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
							</div>

						</div>
					</div>
			</div>
		</div>
	</div>
</div>
{!! Form::close() !!}
@if($pigeon->exists)
<div class="row">
	<div class="col-xs-12 text-right">
			<form action="{{ route('pigeons.destroy', $pigeon->id) }}" method="POST">
				{{ csrf_field() }}
				<input type="hidden" name="_method" value="DELETE">
				<button class="btn btn-space btn-danger btn-md-lg">Remove</a>
			</form>
	</div>
</div>
@endif
@endsection

@section('footer')
<link rel="stylesheet" href="{{ asset('assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
<script src="{{ asset('assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript">
$(".datetimepicker").datetimepicker({
	   autoclose: true,
	   componentIcon: '.mdi.mdi-calendar',
	   navIcons:{
		   rightIcon: 'mdi mdi-chevron-right',
		   leftIcon: 'mdi mdi-chevron-left'
	   }
   });
</script>
@endsection
