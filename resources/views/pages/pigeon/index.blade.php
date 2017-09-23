@extends('layouts.dashboard')

@section('title', 'Pigeons')

@section('content')
<div class="row">
	{{-- <div class="col-xs-6 col-md-4">
			@include('layouts.partials._alerts')
	</div> --}}
	<div class="col-xs-12">
		<div class="panel panel-default panel-table">
			<div class="panel-heading">
				Pigeons

				<div class="tools">
					<div class="row">
						<div class="col-xs-10">
							<form action="">
								<input type="text" name="search" value="{{ app('request')->input('search') }}" placeholder="Search.." class="form-control">
							</form>
						</div>
						<div class="col-xs-2">
							<a href="{{ route('pigeons.create') }}"><span class="icon mdi mdi-plus"></span></a>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-body">
				@include('layouts.partials._alerts')
				<div class="table-responsive noSwipe" style="overflow-x:visible;">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th><a {!! $field == 'number' ? '' : ' style="color:inherit;"' !!} href="{{ route('pigeons.index', ['number', ($direction == 'asc' ? 'desc' : 'asc')]) }}">Ring Number <i class="icon mdi mdi-caret-{{ $direction == 'asc' ? 'up' : 'down' }}-circle"></i></a></th>
								<th class="hidden-xs">
									<a {!! $field == 'is_race_pigeon' ? '' : ' style="color:inherit;"' !!} href="{{ route('pigeons.index', ['is_race_pigeon', ($direction == 'asc' ? 'desc' : 'asc')]) }}">
										Race Pigeon <i class="icon mdi mdi-caret-{{ $direction == 'asc' ? 'up' : 'down' }}-circle"></i>
									</a>
								</th>
								<th>Gender</th>
								@if(auth()->user()->isAdmin())
								<th>Owner</th>
								@endif
								<th class="hidden-xs"><a{!! $field == 'pmv' ? '' : ' style="color:inherit;"' !!} href="{{ route('pigeons.index', ['pmv', ($direction == 'asc' ? 'desc' : 'asc')]) }}">PMV <i class="icon mdi mdi-caret-{{ $direction == 'asc' ? 'up' : 'down' }}-circle"></i></a></th>
								<th>Chip number</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($pigeons as $pigeon)
								<tr>
									<td class="cell-detail"><span>{{ $pigeon->birth_year ?: 'XXXX' }}-{{ $pigeon->number }}</span></td>
									<td class="cell-detail hidden-xs"><span>{{ $pigeon->is_race_pigeon ? 'Yes' : 'No' }}</span></td>
									<td class="cell-detail"><span>{{ $pigeon->gender }}</span></td>
									@if(auth()->user()->isAdmin())
									<td class="cell-detail"><span>{{ $pigeon->user->fullName() }}</span></td>
									@endif
									<td class="cell-detail hidden-xs{{ !isset($pigeon->pmv) ? ' text-warning' : ($pigeon->hasPmvExpired() ? ' text-danger' : ' text-success' )}}"><span><i class="icon mdi mdi-{{ !isset($pigeon->pmv) ? 'help' : ($pigeon->hasPmvExpired() ? 'alert-triangle' : 'check-circle' )}}"></i> {{ $pigeon->pmv or 'Unknown' }}</span></td>
									<td>
										@if($pigeon->chiprings->count() == 0)
											<a href="#" onclick="setRingNumber({{ $pigeon->id }}, this)" {{-- data-toggle="modal" data-target="#chiprings" --}} class="btn btn-warning btn-sm btn-space">LINK CHIPNUMBER</a>
										@else
											{{ $pigeon->chiprings->last()->number }}
											<a href="#" data-id="{{ $pigeon->id }}" data-toggle="modal" data-target="#unlink" class="unlink btn btn-danger btn-xs btn-space">UNLINK</a>
										@endif
									</td>
									<td>
										<a href="{{ route('pigeons.edit', $pigeon->id) }}" class="btn btn-primary btn-sm btn-space"><i class="icon mdi mdi-edit"></i></a>

									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					{!! $pigeons->links() !!}
				</div>
			</div>
		</div>
	</div>
</div>
<!--Form Modals-->
 <div id="chiprings" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary">
   <div class="modal-dialog custom-width">
	 <div class="modal-content">
	   <div class="modal-header">
		 <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
		 <h3 class="modal-title">Antenne's</h3>
	   </div>
      <form id="chipringForm" action="{{ route('pigeons.chip') }}" method="POST">
         {!! csrf_field() !!}
   	   <div class="modal-body">
   		 <div class="form-group">
   		   <label>Enter your chip number</label>
   		   <input type="hidden" name="pigeon_id" id="pigeon_id" placeholder="" class="form-control">
   		   <input type="text" name="chipring" placeholder="" class="form-control">
   		 </div>
   	   </div>
   	   <div class="modal-footer">
   		 <button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
   		 <button type="submit" onclick="$('#chipringForm').submit()" data-dismiss="modal" class="btn btn-primary md-close">Proceed</button>
   	   </div>
      </form>
	 </div>
   </div>
 </div>

 <div id="unlink" tabindex="-1" role="dialog" class="modal fade">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
	  </div>

	 <form id="chipringForm" action="{{ route('pigeons.chip.remove') }}" method="POST">
		{!! csrf_field() !!}
		<input type="hidden" name="pigeon_id" class="pigeon_id" placeholder="" class="form-control">
		  <div class="modal-body">
			<div class="text-center">
			  <div class="text-danger"><span class="modal-main-icon mdi mdi-alert-triangle"></span></div>
			  <h3>Warning!</h3>
			  <p>Chip number will be unlinked from this pigeon.<br></p>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
			<button type="submit" class="btn btn-danger">Proceed</button>
		  </div>
	  </form>
	</div>
  </div>
</div>
@endsection

@section('footer')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/jquery.gritter/css/jquery.gritter.css') }}"/>
<script src="{{ asset('assets/lib/jquery.gritter/js/jquery.gritter.js') }}" type="text/javascript"></script>
<script type="text/javascript">
	var actionExistsInterval;
	function actionStillExists(id, sender)
	{
		$.post("{{ route('actions.exists') }}", {_token: '{{ csrf_token() }}', action_id: id})
  		.done(function(data) {

  		})
		.fail(function(data) {
			//Action doesn't exist and therefor has been processed
			clearInterval(actionExistsInterval);
			$.gritter.add({
			  title:"Chip has been linked",
			  text:"Refresh the page to see the results",
			  class_name:"color success",
			});
			$(sender).removeClass('btn-warning').addClass('btn-success').text('Chip has been linked');
  		});
		//check if action exists
		//if not clearInterval(actionExistsInterval);
	}

	function setRingNumber(id, sender)
	{
		if($(sender).attr('disabled') == 'disabled') return;
		$(sender).attr('disabled', 'disabled');
		$(sender).text('Waiting for chipring');
	  $.post("{{ route('pigeons.chip') }}", {_token: '{{ csrf_token() }}', pigeon_id: id})
		.done(function(data) {
			$.gritter.add({
			  title:"Setting chip number",
			  text:"Move a chip across the antenna",
			  class_name:"color primary",
			});
			actionExistsInterval = setInterval(actionStillExists, 5000, data.action_id, sender);
		})
		.fail(function() {
			$.gritter.add({
			  title:"Error occured",
			  text:"Try again later or contact the administratorr if the issue persists",
			  class_name:"color danger",
			});
		});
		//Create aja
	}



	$('.unlink').on('click', function(){
		$('.pigeon_id').val($(this).data('id'))
	});
</script>
@endsection
