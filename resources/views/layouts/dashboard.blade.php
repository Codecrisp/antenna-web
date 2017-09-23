@extends('layouts.base')

@section('body')
    <div class="be-wrapper">
      <nav class="navbar navbar-default navbar-fixed-top be-top-header">
        <div class="container-fluid">
          <div class="navbar-header"><a href="index.html" class="navbar-brand"></a></div>
          <div class="be-right-navbar">
            <ul class="nav navbar-nav navbar-right be-user-nav">
              <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><img src="{{ url('assets/img/avatar.png') }}" alt="Avatar"><span class="user-name">{{ auth()->user()->fullName() }}</span></a>
                <ul role="menu" class="dropdown-menu">
                  <li>
                    <div class="user-info">
                      <div class="user-name">{{ auth()->user()->fullName() }}</div>
                      <div class="user-position online">Online</div>
                    </div>
                  </li>
                  <li><a href="{{ route('user.edit', auth()->user()->getRouteKeyValue()) }}"><span class="icon mdi mdi-face"></span> Account</a></li>
                  <li><a onclick="document.getElementById('logout').submit();" href="#"><span class="icon mdi mdi-power"></span>Logout</a>{!! Form::open(['id'=>'logout', 'url' => 'logout']) !!}{!! csrf_field() !!}{!! Form::close() !!}</li>
                </ul>
              </li>
            </ul>
            <div class="page-title"><span>@yield('title')</span></div>
            <ul class="nav navbar-nav navbar-right be-icons-nav">
            </ul>
          </div>
        </div>
      </nav>
      @include('layouts.partials.menu.left')
      <div class="be-content">
		 <div class="page-head"><h2 class="page-head-title">@yield('title')</h2></div>
        <div class="main-content container-fluid">
          @yield('content')
        </div>
      </div>
  </div>
@endsection
