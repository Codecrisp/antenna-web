@extends('layouts.dashboard')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default panel-table">
			<div class="panel-heading">
				Users
				<div class="tools"><span class="icon mdi mdi-account-add"></span></div>
			</div>
			<div class="panel-body">
				<div class="table-responsive noSwipe">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th style="width:20%;">Full Name</th>
								<th style="width:17%;">Last Update</th>
								<th style="width:10%;">Address</th>
								<th style="width:10%;">Created At</th>
								<th style="width:5%"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($users as $user)
								<tr>
									<td class="user-avatar cell-detail user-info"><img src="assets/img/avatar4.png" alt="Avatar"><span>{{ $user->fullName() }}</span></td>
									<td class="cell-detail"><span>{{ $user->updated_at->toFormattedDateString() }}</span><span class="cell-detail-description">{{ $user->updated_at->toTimeString() }}</span></td>
									<td class="cell-detail">
										<span>{{ $user->address or 'Unknown' }}</span>
										@if($user->city || $user->country)
											<span class="cell-detail-description">{{ $user->city }}, {{ $user->country }}</span>
										@endif
									</td>
									<td class="cell-detail"><span>{{ $user->created_at->toFormattedDateString() }}</span><span class="cell-detail-description">{{ $user->created_at->toTimeString() }}</span></td>
									<td><a href="{{ route('user.edit', $user->getRouteKeyValue()) }}" class="btn btn-primary btn-sm btn-space"><i class="icon mdi mdi-edit"></i></a></td>
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
