@extends('layouts.dashboard')

@section('content')
<div class="row">
	<div class="col-md-4">
		@include('layouts.partials._alerts')
	</div>
	<div class="col-md-12">
		<div class="panel panel-default panel-table">
			<div class="panel-heading">
				Users
				<div class="tools"><a href="{{ route('user.create') }}"><span class="icon mdi mdi-account-add"></span></a></div>
			</div>
			<div class="panel-body">
				<div class="table-responsive noSwipe">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th style="width:20%;">Full Name</th>
								<th>Membership</th>
								<th>Address</th>
								<th>Created At</th>
								<th style="width:5%"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($users as $user)
								<tr>
									<td class="user-avatar cell-detail user-info"><img src="assets/img/avatar1.png" alt="Avatar"><span>{{ $user->fullName() }}</span><span style="font-size:12px;" class="cell-detail-description">{{ $user->email }}</span></td>
									<td class="cell-detail">{{ $user->membership }}</td>
									<td class="cell-detail">
										<span>{{ $user->address or 'Unknown' }}</span>
										<span class="cell-detail-description">{{ $user->zip_code }} {{ $user->city }}</span>
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
