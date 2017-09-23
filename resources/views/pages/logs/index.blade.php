@extends('layouts.dashboard')

@section('title', 'Logs')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default panel-table">
			<div class="panel-heading">
				Logs
			</div>
		<div class="panel-body">
				@include('layouts.partials._alerts')
                <div class="table-responsive noSwipe">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width:20%;">Antenne</th>
                                <th style="width:17%;">Gebeurtenis</th>
                                <th style="width:10%;">Type</th>
                                <th style="width:10%;">Datum</th>
                                <th style="width:10%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                            <tr>
                                <td class="cell-detail"><span>{{ $log->antenne ? $log->antenne->serial : 'Geen' }}</span><span class="cell-detail-description">{{ $log->ip }}</span></td>
                                <td class="cell-detail"> <span>{{ $log->message }}</span></td>
                                <td class="cell-detail"><span>{{ $log->type }}</span></td>
                                <td class="milestone">
                                    <span>
                                        {{ $log->created_at->diffForHumans() }}
                                    </span>
                                </td>
                                <td class="text-right">
                                    {{-- <a href="{{ route('antennas.show', $ant->id) }}" class="btn btn-info">View</a> --}}
									{{-- <a href="{{ route('antennas.edit', $ant->id) }}" class="btn">Edit</a> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $logs->render() !!}
                </div>
			</div>
		</div>
	</div>
</div>
@endsection


@section('footer')
<script type="text/javascript">

</script>
@endsection
