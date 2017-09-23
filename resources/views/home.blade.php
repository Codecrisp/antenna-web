@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="row">
  <div class="col-xs-12 col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">Latest Activity</div>
      <div class="panel-body">
        <ul class="user-timeline user-timeline-compact">
          {{-- <li class="latest">
            <div class="user-timeline-date">Just Now</div>
            <div class="user-timeline-title">Pigeon has arrived on 'Antenne Name'</div>
            <div class="user-timeline-description">More details about the pigeon that has arrived.</div>
          </li>
          <li>
            <div class="user-timeline-date">Today - 15:35</div>
            <div class="user-timeline-title">Antenne Name's firmware has been updated</div>
            <div class="user-timeline-description">Firmware has been update from version 1.0.2 to 1.0.4</div>
          </li> --}}
        </ul>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-md-3">
    <div class="panel panel-default">
      <div class="panel-heading">Antennes</div>
      <div class="panel-body table-responsive">
      <table class="table table-striped table-borderless">
        <thead>
          <tr>
            <th style="width:40%;">Name / IP</th>
            <th>Status</th>
            <th style="width:5%;" class="actions"></th>
          </tr>
        </thead>
        <tbody class="no-border-x">
			       @foreach($antennas as $antenna)
	          <tr>
	            <td class="cell-detail">{{ $antenna->name }}<span class="cell-detail-description">{{ $antenna->ip }}</span></td>
	            <td><span class="label label-{{ $antenna->getStatus()['color'] }}">{{ $antenna->getStatus()['text'] }}</span></td>
	            <td class="actions"><a href="{{ route('antennas.show', $antenna->id) }}" class="icon"><i class="mdi mdi-eye"></i></a></td>
	          </tr>
		        @endforeach
        </tbody>
      </table>
    </div>
    </div>
  </div>
</div>
@endsection
