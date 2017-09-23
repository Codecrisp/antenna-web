@extends('layouts.dashboard')

@section('title', 'Race - ' . $race->flight_code . ' ' . $race->city)

@section('content')
  <div id="vue">
    <race id="{{ $race->id }}"></race>
  </div>
{{-- <div class="row">
    <div class="col-sm-6">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">Contestants
            </div>
            <div class="panel-body">
              <table class="table table-striped table-borderless">
                <thead>
                  <tr>
                    <th>Pigeon</th>
                    <th style="width:30%;">Result</th>
                    @if(auth()->user()->isAdmin())
                        <th>Secret</th>
                    @endif
                  </tr>
                </thead>
                <tbody class="no-border-x">
                  @foreach($race->entries->sortByDesc('timestamp_dec') as $entry)
                  @if($entry->pigeon)
                  <tr>
                    <td>
                      <h4>
                        <strong>
                        Pigeon '{{ $entry->pigeon->birth_year or 'XX' }}-{{ $entry->pigeon->number }}' has been basketed<br>
                        </strong>
                      </h4>
                    </td>
                    <td class="text-{{ $entry->timestamp_dec ? 'success' : 'warning' }}">
                        {{ $entry->arrived_at ? $entry->arrived_at->diffForHumans() : 'None' }}<br>
                        {{ $entry->arrived_at ? $entry->arrived_at->toDateTimeString() : ''  }}
                    </td>
                    @if(auth()->user()->isAdmin())
                        <td>{{ $entry->secret }}</td>
                    @endif
                  </tr>
                    @endif
                @endforeach
                @if($race->entries->count() == 0)
                  <tr>
                    <td class="text-center" colspan="2"><h2>No contestants found</h2></td>
                  </tr>
                @endif
                </tbody>
              </table>
            </div>
          </div>
    </div>
</div> --}}
{{-- <div id="arrivelmodal" tabindex="-1" role="dialog" class="modal fade in">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <div class="text-primary"><img class="img-responsive" style="max-height:100px; margin: 0 auto;" src="{{ asset('assets/img/pigeon.jpg') }}"></div>
          <h3>New Arrival!</h3>
          <p>12-12345678 has just arrived.</p>
          <div class="xs-mt-50">
            <button type="button" data-dismiss="modal" class="btn btn-space btn-primary">Confirm</button>
          </div>
        </div>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div> --}}
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
<script src="{{ asset('js/app.js') }}" charset="utf-8"></script>
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

//       window.Echo.private('race.' + '{{ $race->id }}')
//         .listen('Race.NewEntry', (e) => {
// //          let columns = $('.race-entries .hidden').html()
// //            .replace('{number}', e.entry.ringnumber)
// //            .replace('{humantime}', e.entry.humantime)
// //            .replace('{datetime}', e.entry.datetime)
//             $.gritter.add({
//                title:"New entry",
//                text:e.entry.ringnumber + " has just been entered.",
//                //image:"{{ asset('assets/img/pigeon.jpg') }}",
//                class_name:"color primary",
//                //sticky:true,
//                time:"5000"
//              });
//
// //          $('.race-entries').append('<tr>' + columns + '</tr>')
//         })
//         .listen('Race.EntryArrived', (e) => {
// //          let columns = $('.race-entries .hidden').html()
// //            .replace('{number}', e.entry.ringnumber)
// //            .replace('{humantime}', e.entry.humantime)
// //            .replace('{datetime}', e.entry.datetime)
//             $.gritter.add({
//                title:"New Arrival",
//                text:e.entry.ringnumber + " has just been arrived.",
//                //image:"{{ asset('assets/img/pigeon.jpg') }}",
//                class_name:"color success",
//                //sticky:true,
//                time:"5000"
//              });
//
// //          $('.race-entries').append('<tr>' + columns + '</tr>')
//         })
</script>
@endsection
