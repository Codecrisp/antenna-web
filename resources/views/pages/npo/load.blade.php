@extends('layouts.dashboard')

@section('title', 'Load Pigeons')

@section('content')
<div class="row">
	<div class="col-sm-4">
		<div class="panel panel-default panel-border-color panel-border-color-primary">
			<div class="panel-heading panel-heading-divider">Login with your NPO information<span class="panel-subtitle"></span></div>
			<div class="panel-body">
					@include('layouts.partials._alerts')
					<div id="loginAlert" role="alert" class="alert alert-danger alert-dismissible" style="display:none;" >
						<button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button>
						<span class="icon mdi mdi-close-circle"></span>
						<span class="text">text</span>
					</div>
					{!! Form::open(['url' => url('npo/pigeons/'), 'id' => 'loginForm']) !!}
					<div class="form-group xs-pt-10">
						{!! Form::label('lidnummer') !!}
						{!! Form::text('lidnummer', null, ['class' => 'form-control', 'required']) !!}
					</div>
					<div class="form-group xs-pt-10">
						{!! Form::label('password') !!}
						{!! Form::password('password', ['class' => 'form-control', 'required']) !!}
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-space btn-primary btn-md-lg">Import Pigeons</button>
					</div>
					{!! Form::close() !!}
			</div>
		</div>
	</div>
	<div class="col-sm-4 results" >
		<div class="panel panel-default panel-table panel-border-color panel-border-color-primary">
			<div class="panel-heading">Loading pages 0 / 0<span class="panel-subtitle"></span></div>
			<div class="panel-body">
					@include('layouts.partials._alerts')
					<table class="table table-striped table-borderless">
						<thead>
							<tr>
								<th>Page</th>
								<th>Pigeons</th>
							</tr>
						</thead>
						<tbody class="no-border-x">
						</tbody>
					</table>
			</div>
		</div>
	</div>
</div>
@endsection

@section('footer')
<script>
var url = $('#loginForm').attr('action');
var lidnummer, password;

$('#loginForm').on('submit', function(e){
	e.preventDefault();
	$('#loginAlert').slideUp();
	loadResultsByPageNumber(1);
});

function loadResultsByPageNumber(number)
{
	$.ajax({
		type: "POST",
		url: url + "/" + number,
		data: $('#loginForm').serialize(),
		success: function(data){
			$('#loginForm').slideUp();
			$('#loginAlert').removeClass('alert-danger').addClass('alert-success').text('Logged in succesfully!').slideDown();
			$('div.results').slideDown();

			$('<tr class="display:none;"><td>' + data.currentPage + '</td><td>' + data.ringNumbers.length + '</td></tr>').appendTo($('.results tbody')).slideDown();
			//$('.results tbody').append('<tr><td>' + data.currentPage + '</td><td>' + data.ringNumbers.length + '</td></tr>');
			if(data.currentPage != data.pageCount)
			{
				$('div.results .panel-heading').text('Loading page ' + (parseInt(data.currentPage) + 1) + ' / ' + data.pageCount);
				loadResultsByPageNumber(parseInt(data.currentPage) + 1)
			}
		},
		error: function(data){
			if(data.status == 401)
			{
				$('#loginAlert span.text').text('Couldn\'t login with these values');
				$('#loginAlert').slideDown();
			}
		},
		dataType: 'json'
	});
}
</script>
@endsection
