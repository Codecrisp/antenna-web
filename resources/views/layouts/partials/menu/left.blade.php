<div class="be-left-sidebar">
  <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">@yield('title')</a>
	<div class="left-sidebar-spacer">
	  <div class="left-sidebar-scroll">
		<div class="left-sidebar-content">
		  <ul class="sidebar-elements">
			<li class="divider">Menu</li>
			<li><a href="{{ url('home') }}"><i class="icon mdi mdi-view-dashboard"></i><span>Dashboard</span></a>
			<li><a href="{{ route('antennas.index') }}"><i class="icon mdi mdi-router"></i><span>Antennas</span></a></li>
			<li><a href="{{ route('pigeons.index') }}"><i class="icon mdi mdi-inbox"></i><span>Pigeons</span></a></li>
			<li><a href="{{ route('races.index') }}"><i class="icon mdi mdi-storage"></i><span>Races</span></a></li>
			<li><a href="{{ url('npo/pigeons/load') }}"><i class="icon mdi mdi-case-download"></i><span>Mijn NPO</span></a></li>
			</li>
			@if(auth()->user()->role >= 7)
			<li class="divider">Veterinarian Menu</li>
			<li><a href="{{ url('doctor/vaccinate') }}"><i class="icon mdi mdi-scanner"></i><span>Vaccinate</span></a></li>
			@endif
			{{-- @if(auth()->user()->clubs->count() > 0 || auth()->user()->role >= 8)
			<li class="divider">Club Menu</li>
			<li><a href="{{ route('races.index') }}"><i class="icon mdi mdi-inbox"></i><span>Races</span></a></li>
			@endif --}}
			@if(auth()->user()->role >= 8)
			<li class="divider">Admin Menu</li>
			<li><a href="{{ route('antennas.all') }}"><i class="icon mdi mdi-remote-control"></i><span>All Antennas</span></a></li>
			<li><a href="{{ route('sections.index') }}"><i class="icon mdi mdi-remote-control"></i><span>Sections</span></a></li>
			<li><a href="{{ route('antennas.logs') }}"><i class="icon mdi mdi-file-text"></i><span>Logs</span></a></li>
			<li><a href="{{ route('clubs.index') }}"><i class="icon mdi mdi-inbox"></i><span>Clubs</span></a></li>
			<li><a href="{{ route('user.index') }}"><i class="icon mdi mdi-accounts"></i><span>Users</span></a></li>
			@endif
		  </ul>
		</div>
	  </div>
	</div>
  </div>
</div>
