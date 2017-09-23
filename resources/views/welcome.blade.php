@extends('layouts.home')

@section('content')
<section id="intro">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="content">
                    <p>There’s Something In The Air...............</p>
					<p><a href="#">CTS (Cloud Timing System)</a></p>
					<p>
                        {{-- <a id="buy" href="#purchase" class="btn btn-primary">{{ trans('home.preorder') }}</a> --}}
						<a href="#purchase" class="btn btn-info">{{ trans('home.newsletter') }}</a>
                    </p>
                </div>
                <div class="laptop"><img src="{{ asset('img/laptop.png') }}" alt="Laptop"></div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</section>

<section id="features" class="section light">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="content">
                    <h2>{{ trans('home.features') }}</h2>
                    <div class="row">
						@include('layouts.partials.feature', [
							'icon' => 'icon-clock',
							'text' => trans('home.feature_1')
						])
						@include('layouts.partials.feature', [
							'icon' => 'icon-key',
							'text' => trans('home.feature_2')
						])
						@include('layouts.partials.feature', [
							'icon' => 'icon-cycle',
							'text' => trans('home.feature_3')
						])
						@include('layouts.partials.feature', [
							'icon' => 'icon-cloud',
							'text' => trans('home.feature_4')
						])
						@include('layouts.partials.feature', [
							'icon' => 'icon-location',
							'text' => trans('home.feature_5')
						])
						@include('layouts.partials.feature', [
							'icon' => 'icon-mobile',
							'text' => trans('home.feature_6')
						])
						@include('layouts.partials.feature', [
							'icon' => 'icon-pictures',
							'text' => trans('home.feature_7')
						])
						@include('layouts.partials.feature', [
							'icon' => 'icon-download',
							'text' => trans('home.feature_8')
						])
					</div>
                </div>
                <div class="iphones"><img src="{{ asset('img/iphones.png') }}" alt="iPhones"></div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</section>
<section id="purchase">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>{{ trans('home.preorder') }}</h1>
                <p>
					{!! trans('home.preorder_text') !!}
				</p>
                <div class="row" style="min-height:300px;">
                </div>
            </div>
        </div>
    </div>
</section>
<section id="preorder">
	<div class="container">
		<div class="row">
            <div class="col-xs-12">
                <div class="simple-form">
                    <div class="form-toggle delay"><i class="icon-mail"></i></div>
                    <form id="form" action="#" method="POST" class="simform" autocomplete="off" style="display: block;">
                        {!! csrf_field() !!}
                        <div class="simform-inner">
                            <ol class="questions">
                                {{-- <li class="current">
                                    <span><label for="name">{{ trans('home.q_name') }}</label></span>
                                    <input id="name" name="name" type="text">
                                </li>
                                <li>
                                    <span><label for="adress">{{ trans('home.q_adress') }}</label></span>
                                    <input id="adress" name="adress" type="text">
                                </li>
                                <li>
                                    <span><label for="zipcode">{{ trans('home.q_zipcode') }}</label></span>
                                    <input id="zipcode" name="zipcode" type="text">
                                </li>
                                <li>
                                    <span><label for="city">{{ trans('home.q_city') }}</label></span>
                                    <input id="city" name="city" type="text">
                                </li>
                                <li>
                                    <span><label for="country">{{ trans('home.q_country') }}</label></span>
                                    <input id="country" name="country" type="text">
                                </li> --}}
                                <li class="current">
                                    <span><label for="email">{{ trans('home.q_email') }}</label></span>
                                    <input id="email" name="email" type="email">
                                </li>
                            </ol>
                            <button class="submit" type="submit">{{ trans('home.q_send') }}</button>
                            <div class="controls">
                                <button class="next"></button>
                                <div class="progress"></div>
                                <span class="number">
                                    <span class="number-current"></span>
                                    <span class="number-total"></span>
                                </span>
                                <span class="error-message"></span>
                            </div>
                        </div>
                        <span class="final-message"></span>
                    </form>
                </div>
            </div>
        </div>
	</div>
</section>
<section id="maps" class="section" style="border-top:10px solid #dcdde4;">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>{{ trans('home.inschrijvingen') }} & World Clock</h1>
                <div class="worldclock" style="margin: 15px 0px 0px; display: inline-block; text-align: center;">
                    <script type="text/javascript" src="https://localtimes.info/world_clock2.php?&cp1_Hex=000000&cp2_Hex=FFFFFF&cp3_Hex=000000&fwdt=110&ham=0&hbg=0&hfg=0&sid=0&mon=0&wek=0&wkf=0&sep=0&widget_number=21000&lcid=NLXX0002,USNY0996,ARBA0009,RPXX0017,ASXX0075,AEXX0004,JAXX0099,SFXX0010"></script>
                </div>
                <div id="gmaps" style="margin-top:10px;height:375px;">

                </div>
            </div>
        </div>
    </div>
</section>
{{-- <section id="prospects" class="section light">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>{{ trans('home.prospects') }}</h1>
                <div class="table-responsive">
                    <table class="table" style="font-size:15px; text-align:center !important;">
                        <thead>
                            <tr>
                                <th class="text-left">{{ trans('home.name') }}</th>
                                <th style="text-align:center;">{{ trans('home.participants') }}</th>
                                <th style="text-align:center;">{{ trans('home.country') }}</th>
                                <th style="text-align:center;">{{ trans('home.agent') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prospects as $prospect)
                                <tr>
                                    <td class="text-left">{{ $prospect->name }}</td>
                                    <td>{{ $prospect->participants }}</td>
                                    <td>{{ $prospect->country }}</td>
                                    <td>{{ $prospect->agent }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
{{-- <section id="gps" class="section">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1>{{ trans('home.postduiven_gps') }}</h1>
            </div>
			<div class="col-xs-12 col-md-6">
				<p>{{ trans('home.postduiven_p_1') }}</p>
				<img src="{{ asset('img/skyleader.png') }}" class="img-responsive">
				<p>{{ trans('home.postduiven_p_2') }}</p>
			</div>
			<div class="col-xs-12 col-md-6">
                <p>{{ trans('home.postduiven_p_3') }}</p>
                <p>{{ trans('home.postduiven_p_4') }}</p>
				<p>{!! trans('home.postduiven_p_5') !!}</p>
			</div>
        </div>
        <div class="row">
			<div class="col-xs-12 col-md-6">
                <iframe width="100%" height="300" src="https://www.youtube.com/embed/m3DXuKgvWMA" frameborder="0" allowfullscreen></iframe>
            </div>
			<div class="col-xs-12 col-md-6">
                <iframe width="100%" height="300" src="https://www.youtube.com/embed/bv2KKYYdCyw" frameborder="0" allowfullscreen></iframe>
                <div class="description">
                    <small>{{ trans('home.postduiven_p_6') }}</small>
                </div>
            </div>
        </div>
        {{-- && Auth::user()->preorder() && ! Auth::user()->preorder()->ordered --}}
        {{-- @if(Auth::user())
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-2 col-md-offset-5">
                <a href="{{ url('preorder') }}" class="btn btn-primary">Pre-order GPS</a>
            </div>
            <div class="col-xs-10 col-xs-offset-1">
                <div class="description">
                    <small>
                        This pre-oreder doesn’t commit you to anything. A separate email will be send to confirm if you still want to order the GPS-logger Ring Set.
                    </small>
                </div>
            </div>
        </div>
        @endif --}}
        {{-- @if(auth()->user())
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1>{{ trans('home.upload_gps') }}</h1>
            </div>
			<div class="col-xs-12 col-sm-6 col-sm-offset-3">
                <form action="{{ route('uploadGPS') }}" role="form" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
					<div class="form-group">
						<label for="gps">{{ trans('home.bestand') }}</label>
						<input type="file" class="form-control" id="gps" name="gps" required>
					</div>
					<div class="form-group">
						<label for="losplaats">{{ trans('home.losplaats') }}:</label>
						<input type="text" class="form-control" id="losplaats" name="losplaats" required>
					</div>
					<div class="form-group">
						<label for="ringnumber">{{ trans('home.ringnumber') }}:</label>
						<input type="text" class="form-control" id="ringnumber" name="ringnumber" required>
					</div><!--
					<div class="form-group">
						<label for="lossingstijd">{{ trans('home.lossingstijd') }}:</label>
						<input type="time" class="form-control" id="lossingstijd" name="lossingstijd" required>
					</div>
					<div class="form-group">
						<label for="date">{{ trans('home.datum') }}:</label>
						<input type="date" class="form-control" id="date" name="date" required>
					</div>-->
					<div class="form-group">
						<label for="date">{{ trans('home.losdatumtijd') }}:</label>
						<input type="text" class="form-control" id="date" name="date" required>
					</div>
					<button type="submit" class="btn btn-info">{{ trans('home.upload') }}</button>
				</form>
                <p><!-- Creates small padding between submit button and next section--><p>
			</div>
        </div>
        @endif
    </div>
</section> --}}
<section id="contact" class="section light">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-xs-12">
                <h1>{{ trans('home.contact') }}</h1>
				<form role="form" action="{{ url('contact') }}" method="POST">
                    {!! csrf_field() !!}
					<div class="form-group">
						<label for="email">E-Mail:</label>
						<input type="email" class="form-control" name="email" id="email" required>
					</div>
					<div class="form-group">
						<label for="name">{{ trans('home.name') }}:</label>
						<input type="name" class="form-control" name="name" id="name">
					</div>
					<div class="form-group">
						<label for="pwd">{{ trans('home.message') }}:</label>
						<textarea class="form-control" name="content" placeholder="Type hier uw bericht" required></textarea>
					</div>
					<button type="submit" class="btn btn-info">{{ trans('home.q_send') }}</button>
				</form>
                <div class="row" style="min-height:10px;">
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                    <img class="img-responsive" src="{{ asset('img/logo.png') }}">
            </div>
        </div>
    </div>
</section>
@endsection

@section('footer')
<script src="https://maps.google.com/maps/api/js?key=AIzaSyCaUvZFvolRbAJ8yXeomZTgR1VGSchbG44"></script>

<script src="{{ asset('assets/js/stepsform.min.js') }}"></script>
<script src="{{ asset('js/scripts.min.js') }}"></script>

<script src="{{ asset('js/gmaps.min.js') }}"></script>
<script>
console.log('hiii');
$(document).ready(function(){
	map = new GMaps({
		el: '#gmaps',
		zoom: 3,
		lat: 52.132633,
		lng: 5.291266,
	});
   @foreach(\App\User::all() as $user)
	   @if($user->lat && $user->long)
        map.addMarker({
            lat: {{ $user->lat }},
            lng: {{ $user->long }}
        });
       @else
           GMaps.geocode({
               address: "{{ $user->zip_code }}, {{ $user->city }}",
               callback: function(results, status) {
                   if (status == 'OK') {
                       //Do ajax request to save lat and long
                       var latlng = results[0].geometry.location;
                       //$.post( "", { lat: latlng.lat(), long: latlng.lng(), _token: "{{ csrf_token() }}" } );
                       map.addMarker({
                           lat: latlng.lat(),
                           lng: latlng.lng()
                       });
                   }
                   else
                   {
                       console.log('Could not load "{{ $user->city }}". Received status: ' + status);
                   }
               }
           });
       @endif
    @endforeach
});

    $('.worldclock').on('click', 'a', function(e){
        e.preventDefault();
    });


//    jQuery('#date').datetimepicker();

    @if(Session::has('msg'))
        swal({
            title: 'Success',
            text: '{!! Session::get('msg') !!}',
            type: 'success',
            html: true
        });
//        sweetAlert('Success', '{!! Session::get('msg') !!}', 'success');
    @endif
</script>
@endsection

@section('footer')

    <script src="{{ asset('assets/js/stepsform.min.js') }}"></script>
    <script src="{{ asset('js/scripts.min.js') }}"></script>
@endsection
