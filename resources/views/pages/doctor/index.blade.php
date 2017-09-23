@extends('layouts.dashboard')

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default panel-table">
			<div class="panel-heading">
				Expired Vaccinations
			</div>
			<div class="panel-body">
				@include('layouts.partials._alerts')
				<div class="table-responsive noSwipe">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Ring Number</th>
								<th>Race Pigeon</th>
								<th>Gender</th>
								<th>Owner</th>
								<th>PMV</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($pigeons as $pigeon)
								<tr>
									<td class="cell-detail"><span>{{ $pigeon->ring_number }}</span></td>
									<td class="cell-detail"><span>{{ $pigeon->is_race_pigeon ? 'Yes' : 'No' }}</span></td>
									<td class="cell-detail"><span>{{ $pigeon->gender }}</span></td>
									<td class="cell-detail"><span>{{ $pigeon->user->fullName() }}</span></td>
									<td class="cell-detail{{ !isset($pigeon->pmv) ? ' text-warning' : ($pigeon->hasPmvExpired() ? ' text-danger' : ' text-success' )}}"><span><i class="icon mdi mdi-{{ !isset($pigeon->pmv) ? 'help' : ($pigeon->hasPmvExpired() ? 'alert-triangle' : 'check-circle' )}}"></i> {{ $pigeon->pmv or 'Unknown' }}</span></td>
									<td><a href="{{ route('vaccinate.pigeon', $pigeon->id) }}" class="btn btn-primary btn-sm btn-space">Manual Update</a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default panel-table">
			<div class="panel-heading">
				Active Vaccinations
			</div>
			<div class="panel-body">
				@include('layouts.partials._alerts')
				<div class="table-responsive noSwipe">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Ring Number</th>
								<th>Race Pigeon</th>
								<th>Gender</th>
								<th>Owner</th>
								<th>PMV</th>
								<th style="width:10%;"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($pigeonsVaccinated as $pigeon)
								<tr>
									<td class="cell-detail"><span>{{ $pigeon->ring_number }}</span></td>
									<td class="cell-detail"><span>{{ $pigeon->is_race_pigeon ? 'Yes' : 'No' }}</span></td>
									<td class="cell-detail"><span>{{ $pigeon->gender }}</span></td>
									<td class="cell-detail"><span>{{ $pigeon->user->fullName() }}</span></td>
									<td class="cell-detail{{ !isset($pigeon->pmv) ? ' text-warning' : ($pigeon->hasPmvExpired() ? ' text-danger' : ' text-success' )}}"><span><i class="icon mdi mdi-{{ !isset($pigeon->pmv) ? 'help' : ($pigeon->hasPmvExpired() ? 'alert-triangle' : 'check-circle' )}}"></i> {{ $pigeon->pmv or 'Unknown' }}</span></td>
									<td><a href="{{ route('vaccinate.pigeon', $pigeon->id) }}" class="btn btn-primary btn-sm btn-space">Manual Update</a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="scanmodal" tabindex="-1" role="dialog" class="modal fade in">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <div class="text-primary"><img class="img-responsive" style="max-height:100px; margin: 0 auto;" src="{{ asset('assets/img/pigeon.jpg') }}"></div>
          <h3>Pigeon scanned!</h3>
          <p>12-12345678 has been found. Click confirm if this is correct.</p>
          <div class="xs-mt-50">
            <button type="button" data-dismiss="modal" class="btn btn-space btn-default">Cancel</button>
            <button type="button" data-dismiss="modal" class="btn btn-space btn-primary">Confirm</button>
          </div>
        </div>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>
@endsection

@section('footer')
<script>
    setTimeout(function(){
        $('#scanmodal').modal('show');
    }, 3000);
</script>
@endsection
