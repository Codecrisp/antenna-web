@if(session('success'))
<div role="alert" class="alert alert-success alert-dismissible">
    <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button>
    <span class="icon mdi mdi-check"></span>
    {!! session('success') !!}
</div>
@endif

@if(session('info'))
    <div role="alert" class="alert alert-primary alert-dismissible">
        <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button>
        <span class="icon mdi mdi-info"></span>
        {!! session('info') !!}
    </div>
@endif

@if(session('error'))
    <div role="alert" class="alert alert-danger alert-dismissible">
        <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button>
        <span class="icon mdi mdi-alert-triangle"></span>
        {!! session('error') !!}
    </div>
@endif

@if(session('warning'))
    <div role="alert" class="alert alert-warning alert-dismissible">
        <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button>
        <span class="icon mdi mdi-alert-triangle"></span>
        {!! session('warning') !!}
    </div>
@endif

@if($errors->any())
	<div role="alert" class="alert alert-danger alert-dismissible">
		<button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button>
		<strong>Whoops!</strong><br>
		@if($errors->count() > 1)
			<ul>
				@foreach($errors->all() as $error)
					<li>{!! $error !!}</li>
				@endforeach
			</ul>
		@else
	 		{!! $errors->first() !!}
		@endif
	</div>
@endif
