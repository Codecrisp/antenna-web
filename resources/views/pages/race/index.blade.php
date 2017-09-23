@extends('layouts.dashboard')

@section('title', 'Races')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default panel-table">
			<div class="panel-heading">
				Races
				<div class="tools pull-right">
					<a href="{{ route('races.create') }}"><span class="icon mdi mdi-plus"></span></a>
				</div>
			</div>
			<div class="panel-body">
				@include('layouts.partials._alerts')
				<div class="table-responsive noSwipe">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Flight Code & City</th>
								{{-- <th>City</th> --}}
								<th>When</th>
								{{-- <th>Longitude & Latitude</th> --}}
								@if(auth()->user()->isAdmin())
								<th class="hidden-xs">Section</th>
								@endif
								<th></th>
							</tr>
						</thead>
						<tbody>
                            @if($races)
							@foreach($races as $race)
								<tr>
									<td class="cell-detail"><span>{{ $race->flight_code }} - {{ $race->city }}</span></td>
									{{-- <td class="cell-detail"><span>{{ $race->city }}</span></td> --}}
									<td class="cell-detail"><span class="hidden-xs">{{ $race->starts_on->toDateTimeString() }}<br></span><span>{{ $race->starts_on->diffForHumans() }}</span></td>
									{{-- <td class="cell-detail"><span>{{ $race->longitude }}<br/>{{ $race->latitude }}</span></td> --}}
									@if(auth()->user()->isAdmin())
									<td class="cell-detail hidden-xs"><span>{{ $race->section ? $race->section->name : 'Geen'  }}</span></td>
									@endif
									<td>
										<a href="{{ route('races.edit', $race->id) }}" class="btn btn-primary btn-sm btn-space"><i class="icon mdi mdi-edit"></i></a>
										<a href="{{ route('races.show', $race->id) }}" class="btn btn-primary btn-sm btn-space">View</a>
									</td>
								</tr>
							@endforeach
                            @endif
						</tbody>
					</table>
				</div>
			</div>
			@if($races)
			<span style="padding-left:20px;">
				{!! $races->render() !!}
			</span>
			@endif
		</div>
	</div>
</div>
@endsection
