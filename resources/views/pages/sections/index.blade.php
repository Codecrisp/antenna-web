@extends('layouts.dashboard')

@section('title', 'Sections')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default panel-table">
			<div class="panel-heading">
				{{-- Sections --}}
				&nbsp;
				<div class="tools"><a href="{{ route('sections.create') }}"><span class="icon mdi mdi-plus"></span></a></div>
			</div>
			<div class="panel-body">
				@include('layouts.partials._alerts')
				<div class="table-responsive noSwipe">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Name</th>
								<th>Api</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($sections as $section)
								<tr>
									<td class="cell-detail"><span>{{ $section->name }}</span></td>
									<td class="cell-detail"><span>{{ $section->api_url }}</span></td>
									<td><a href="{{ route('sections.edit', $section->id) }}" class="btn btn-primary btn-sm btn-space"><i class="icon mdi mdi-edit"></i></a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
