@extends('layouts.dashboard')

@section('title', 'Antenna')

@section('content')
<div class="row">
    <div class="col-sm-6">
        @include('layouts.partials._alerts')
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-divider">
                <span style="font-size:24px;">{{ $antenna->name or 'No name' }}</span>
                {{-- <a href="{{ route('antennas.refresh', $antenna->id) }}" class="btn pull-right">
                    <div><span class="icon mdi mdi-refresh"></span></div>
                    <small class="text-muted">last updated {{ $antenna->updated_at ? $antenna->updated_at->diffForHumans() : 'Never' }}</small>
                </a> --}}
                <span class="panel-subtitle">{{ $antenna->serial }}</span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-5"><strong>Status</strong></div>
                    <div class="col-xs-5">{{ $antenna->lastAction()['message'] }}</div>
                </div>
                <div class="row">
                    <div class="col-xs-5"><strong>Firmware Date</strong></div>
                    <div class="col-xs-5">{{ $antenna->firmware }}</div>
                    {{-- <div class="col-xs-2"><a href="#" data-toggle="modal" data-target="#uploadmodal"><small>Update now</small></a></div> --}}
                </div>
            </div>
        </div>
    @if($antenna->type == 1)
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-divider">
                <span style="font-size:24px;">Competition Entries</span>
                <div class="pull-right">
                    @if($antenna->inkorf_enabled)
                    <a data-toggle="modal" data-target="#stopbasketting" class="btn btn-danger">Disable basketting</a>
                    @else
                    <a href="{{ route('antennas.toggle', $antenna->id) }}" class="btn btn-success">Enable basketting</a>
                    @endif
                    @if(!$antenna->inkorf_enabled)
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#gamemodal">Set a competition</a>
                    @endif
                </div>
                <span class="panel-subtitle">{{ $antenna->race ? $antenna->race->flight_code . ' ' . $antenna->race->city  : 'No game has been selected yet' }}</span>
            </div>
            <div class="panel-body">

                @if($antenna->race)
                <table class="table table-striped table-borderless">
                <thead>
                    <tr>
                        <th style="width:50%;">Ringnumber</th>
                        <th style="width:10%;">When</th>
                    </tr>
                </thead>
                <tbody class="no-border-x race-entries">
                    <tr class="hidden">
                        <td>
                        <h4><strong>
                        {number}
                        </strong></h4>
                        </td>
                        <td style="min-width:140px;">
                        {humantime}<br><small>{datetime}</small>
                        </td>
                    </tr>
                @foreach($antenna->race->entries as $entry)
                    @if($entry->pigeon)
                        <tr>
                            <td>
                            <h4><strong>
                            {{ $entry->pigeon->birth_year }} - {{$entry->pigeon->number}}
                            </strong></h4>
                            </td>
                            <td style="min-width:140px;">
                            {{ $entry->created_at->diffForHumans() }}<br><small>{{ $entry->created_at }}</small>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
              </table>
          @endif
            </div>
        </div>
    @endif
    </div>
    <div class="col-sm-6">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">Latest Activity
            </div>
            <div class="panel-body">
              <table class="table table-striped table-borderless">
                <thead>
                  <tr>
                    <th style="width:50%;">Description</th>
                    @if(auth()->user()->isAdmin())
                    <th style="width:10%;">When</th>
                    @endif
                  </tr>
                </thead>
                <tbody class="no-border-x">
                  @foreach($antenna->records->take(10) as $record)
                  @if($record->chipring->pigeons->count() > 0)
                  <tr>
                    <td>
                      <h4><strong>
                        Pigeon '{{ $record->chipring->pigeons->last()->birth_year or 'XX' }}-{{ $record->chipring->pigeons->last()->number }}' has been detected <br>

                    </strong></h4>
                      Timestamp: {{ \Carbon\Carbon::createFromTimestampUTC($record->timestamp)->diffForHumans() }} ({{ \Carbon\Carbon::createFromTimestampUTC($record->timestamp)->toDateTimeString() }}) <br>
                      GPS timestamp: {{ \Carbon\Carbon::createFromTimestampUTC($record->timestamp)->diffForHumans() }} ({{ \Carbon\Carbon::createFromTimestampUTC($record->timestamp)->toDateTimeString() }})
                    </td>
                    @if(auth()->user()->isAdmin())
                    <td style="min-width:140px;">
                      {{ $record->created_at ? $record->created_at->diffForHumans() : '' }}<br><small>{{ $record->created_at ? $record->created_at->toDateTimeString() : '' }}</small>
                    </td>
                    @endif
                  </tr>
                    @endif
                @endforeach
                @if($antenna->records->count() == 0)
                  <tr>
                    <td class="text-center" colspan="2"><h2>No activity found</h2></td>
                  </tr>
                @endif
                </tbody>
              </table>
            </div>
          </div>
    </div>
</div>
<div id="stopbasketting" tabindex="-1" role="dialog" class="modal fade in">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <h3>Are you sure?</h3>
          <p>You will not be able to start basketting again!</p>
          <div class="xs-mt-50">
            <a href="{{ route('antennas.toggle', $antenna->id) }}" class="btn btn-space btn-danger">Confirm</a>
            <button type="button" data-dismiss="modal" class="btn btn-space btn-info">Cancel</button>
          </div>
        </div>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>

<!--Form Modals-->
<div id="uploadmodal" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary">
  <div class="modal-dialog custom-width">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
        <h3 class="modal-title">Update Firmware</h3>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Firmware Package(.zip)</label>
          <input type="email" placeholder="Choose a file.." class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
        <button type="button" data-dismiss="modal" class="btn btn-primary md-close">Update</button>
      </div>
    </div>
  </div>
</div>
    <div id="gamemodal" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary">
  <div class="modal-dialog custom-width">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
        <h3 class="modal-title">Set active race</h3>
      </div>
      <form class="" action="race" method="post">
          {!! csrf_field() !!}
          {!! Form::hidden('id', $antenna->id) !!}
      <div class="modal-body">
        <div class="form-group">
              <label>Races</label>
              <select name="race_id" id="" class="form-control">
                  @foreach(App\Race::all() as $race)
                  <option value="{{ $race->id }}">{{ $race->flight_code }} {{ $race->city }}</option>
                @endforeach
              </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
        <button type="submit" class="btn btn-primary md-close">Save</button>
      </div>
  </form>
    </div>
  </div>
</div>
@endsection

@section('footer')
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/jquery.gritter/css/jquery.gritter.css') }}"/>
<script src="{{ asset('assets/lib/jquery.gritter/js/jquery.gritter.js') }}" type="text/javascript"></script>
<style>
#gritter-notice-wrapper{
  width:355px !important;
  margin-top: 70px;
}
</style>
<script>
    setTimeout(function(){

      // $.gritter.add({
      //   title:"New arrival",
      //   text:"12-12345678 has just arrived with a time of 1 hour and 2 seconds.",
      //   image:"{{ asset('assets/img/pigeon.jpg') }}",
      //   class_name:"clean",
      //   sticky:true,
      //   time:""
      // });
  }, 3000);
</script>
@if($antenna->type == 1 && $antenna->race)
<script src="{{ asset('js/app.js') }}" charset="utf-8"></script>
<script type="text/javascript">

  window.Echo.private('race.' + '{{ $antenna->race->id }}')
    .listen('Race.NewEntry', (e) => {
      let columns = $('.race-entries .hidden').html()
        .replace('{number}', e.entry.ringnumber)
        .replace('{humantime}', e.entry.humantime)
        .replace('{datetime}', e.entry.datetime)
        $.gritter.add({
           title:"New entry",
           text:e.entry.ringnumber + " has just been entered.",
           //image:"{{ asset('assets/img/pigeon.jpg') }}",
           class_name:"color primary",
           //sticky:true,
           time:"5000"
         });

      $('.race-entries').append('<tr>' + columns + '</tr>')
    })
</script>
@endif
@endsection
