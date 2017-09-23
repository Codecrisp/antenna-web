@extends('layouts.dashboard')

@section('content')
	<h1>Incoming</h1> <a href="{{ route('invoice.show', 1) }}" class="btn btn-primary">View Invoice</a>
@endsection
