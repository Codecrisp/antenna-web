@extends('layouts.dashboard')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default panel-table">
			<div class="panel-heading">
				Clubs
				<div class="tools"><a href="{{ route('clubs.create') }}"><span class="icon mdi mdi-plus"></span></a></div>
			</div>
			<div class="panel-body">
				@include('layouts.partials._alerts')
				<div class="table-responsive noSwipe">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>NPO</th>
								<th>Name</th>
								<th>Address</th>
								<th>Zip Code</th>
								<th>City</th>
								<th>Country</th>
								<th>Section</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($clubs as $club)
								<tr>
									<td class="cell-detail"><span>{{ $club->npo }}</span></td>
									<td class="cell-detail"><span>{{ $club->name }}</span></td>
									<td class="cell-detail"><span>{{ $club->address }}</span></td>
									<td class="cell-detail"><span>{{ $club->zip_code }}</span></td>
									<td class="cell-detail"><span>{{ $club->city }}</span></td>
									<td class="cell-detail"><span>{{ $club->country }}</span></td>
									<td class="cell-detail"><span>{{ $club->section ? $club->section->name : 'None' }}</span></td>
									<td><a href="{{ route('clubs.edit', $club->id) }}" class="btn btn-primary btn-sm btn-space"><i class="icon mdi mdi-edit"></i></a></td>
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
