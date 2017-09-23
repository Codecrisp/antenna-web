@extends('layouts.dashboard')

@section('title', 'Antennas')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default panel-table">
			<div class="panel-heading">
				{{-- Antennas --}}
				<div class="tools"><a href="#" data-toggle="modal" data-target="#form-bp1"><span class="icon mdi mdi-plus"></span></a></div>
			</div>
         <div class="clear"></div>
			<div class="panel-body">
				@include('layouts.partials._alerts')
                <div class="table-responsive noSwipe">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width:20%;">Name / IP</th>
                                <th class="hidden-xs" style="width:17%;">Last Action</th>
                                <th class="hidden-xs" style="width:10%;">Firmware</th>
                                <th style="width:10%;">Status</th>
                                @if(auth()->user()->isAdmin())
                                   <th style="width:20%;">Owner</th>
                                  <th style="width:10%;">Antenna Type</th>
                               @endif
                                <th style="width:10%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($antennas as $ant)
                            <tr>
                                <td class="cell-detail"><span>{{ $ant->name }}</span><span class="cell-detail-description">{{ $ant->serial }}</span></td>
                                <td class="cell-detail hidden-xs"> <span>{{ $ant->lastAction()['message'] }}</span><span class="cell-detail-description">{{ $ant->lastAction()['when'] }}</span></td>
                                <td class="cell-detail hidden-xs"><span>{{ $ant->firmware }}</span><span class="cell-detail-description"></span></td>
                                <td class="cell-detail"><span class="text-{{ $ant->getStatus()['color'] }}">{{ $ant->getStatus()['text'] }}</span></td>
								@if(auth()->user()->isAdmin())
                           {{-- <td class="cell-detail">
                              <select name="owner_id" id="owner_id" class="form-control">
                                 @foreach (App\User::all() as $user)
                                    <option {{ $user->id == $ant->user_id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->fullName }} ({{$user->email}})</option>
                                 @endforeach
                              </select>
                           </td> --}}
                        <td class="cell-detail">{{ $ant->user ? $ant->user->fullName : 'None'  }}<a href="#" onclick="$('.antenna_id').val({{ $ant->id }})" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#owner"><i class="icon mdi mdi-edit"></i></a></td>
                        <td class="cell-detail">{!! Form::select('type', [0 => 'Normal', 1 => 'Inkorf', 2 => 'Doctor'], $ant->type, ['class' => 'form-control antenna-type', 'data-id' => $ant->id]) !!}</td>
								@endif
                                <td class="text-right">
                                    <a href="{{ route('antennas.show', $ant->id) }}" class="btn btn-info">View</a>
									{{-- <a href="{{ route('antennas.edit', $ant->id) }}" class="btn">Edit</a> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
			</div>
		</div>
	</div>
</div>
<!--Form Modals-->
 <div id="form-bp1" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary">
   <div class="modal-dialog custom-width">
	 <form class="" action="{{ route('antennas.store') }}" method="post">
      {!! csrf_field() !!}
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
          <h3 class="modal-title">Antenne's</h3>
        </div>
        <div class="modal-body">
           <div class="form-group">
               <h3>Er zijn geen antenne's gevonden</h3>
           </div>
          <div class="form-group">
           <label>Antenne Serie Nummer</label>
           <input type="text" name="serial" placeholder="3P9P9P9P9P9P9P9P9P9P9P9P9" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
          <button type="submit" class="btn btn-primary">Proceed</button>
        </div>
      </div>
	 </form>
   </div>
 </div>

@if(auth()->user()->isAdmin())

	<!--Form Modals-->
	 <div id="owner" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary">
	   <div class="modal-dialog custom-width">
		 <form id="" class="" action="{{ route('antennas.setOwner') }}" method="post">
	      {!! csrf_field() !!}
         <input type="hidden" name="id" class="antenna_id">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
	          <h3 class="modal-title">Owner</h3>
	        </div>
	        <div class="modal-body">
	           <div class="form-group">
	               <h3>Choose an owner</h3>
	           </div>
	          <div class="form-group">
                <select name="user_id" id="user_id" class="form-control">
                   @foreach (App\User::all() as $user)
                      <option value="{{ $user->id }}">{{ $user->fullName }} ({{$user->email}})</option>
                   @endforeach
                </select>
	          </div>
	        </div>
	        <div class="modal-footer">
	          <button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
	          <button type="submit" class="btn btn-primary">Proceed</button>
	        </div>
	      </div>
		 </form>
	   </div>
	 </div>
@endif
@endsection


@section('footer')
<script type="text/javascript">

   $('.antenna-type').on('change', function(){
      let $this = $(this);
      console.log($this.data('id'))
      console.log($this.val())
      $.post('{{ route('antennas.setType') }}', {id: $this.data('id'), type: $this.val(), _token: '{{ csrf_token() }}'}, function(){

      })
   })
</script>
@endsection
