@extends('layouts.dashboard')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default panel-table">
			<div class="panel-heading">
				Antennas
				<div class="tools"><a href="#" data-toggle="modal" data-target="#form-bp1"><span class="icon mdi mdi-plus"></span></a></div>
			</div>
			<div class="panel-body">
				@include('layouts.partials._alerts')
                <div class="table-responsive noSwipe">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width:20%;">Name / IP</th>
                                <th style="width:17%;">Last Activity</th>
                                <th style="width:10%;">Firmware</th>
                                <th style="width:10%;">Status</th>
                                <th style="width:10%;">Wedstrijd</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($antennas as $ant)
                            <tr>
                                <td class="cell-detail"><span>{{ $ant->name }}</span><span class="cell-detail-description">{{ $ant->serial }} ({{ $ant->ip }})</span></td>
                                <td class="cell-detail"> <span>{{ $ant->last_action }}</span><span class="cell-detail-description">{{ $ant->updated_at ? $ant->updated_at->diffForHumans() : '' }}</span></td>
                                <td class="cell-detail"><span>{{ $ant->firmware }}</span><span class="cell-detail-description"></span></td>
                                <td class="cell-detail"><span class="text-{{ $ant->getStatus()['color'] }}">{{ $ant->getStatus()['text'] }}</span></td>
                                <td class="text-right">
                                   <select class="form-control input-sm">
                                      <option selected disabled>Geen</option>
                                      @foreach(App\Race::all() as $race)
                                      <option value="{{ $race->id }}">{{ $race->flight_code }} {{ $race->city }}</option>
                                   @endforeach
                                   </select>

                                    {{-- <a href="{{ route('antennas.show', $ant->id) }}" class="btn btn-info">View</a> --}}
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
	 <div class="modal-content">
	   <div class="modal-header">
		 <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
		 <h3 class="modal-title">Antenne's</h3>
	   </div>
      <form id="inkorfPost" action="{{ route('antennes.inkorfPost') }}" method="POST">
         {!! csrf_field() !!}
   	   <div class="modal-body">
   		 <div class="form-group">
   		   <label>Antenne Serie Nummer</label>
   		   <input type="text" name="serial" placeholder="" class="form-control">
   		 </div>
   	   </div>
   	   <div class="modal-footer">
   		 <button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
   		 <button type="submit" onclick="document.getElementById('inkorfPost').submit()" data-dismiss="modal" class="btn btn-primary md-close">Proceed</button>
   	   </div>
      </form>
	 </div>
   </div>
 </div>
@endsection


@section('footer')
<script type="text/javascript">

</script>
@endsection
