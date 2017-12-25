@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center col-md-3 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">WMS Function List</div>

				@if(Auth::check() && Auth::user()->name == "admin")
				<p></p>
				<ul class="nav nav-pills nav-stacked">

					<div><a href="{{ url('remove_nothu') }}" class="btn-default btn center-block"><b>Delete (decrease) NOT HU material from HU table</b></a></div>
				    <div><a href="{{ url('remove_hu') }}" class="btn-default btn center-block"><b>Delete (decrease) HU material from HU table</b></a></div>
					
				</ul>
				
					<p></p>
					<p></p>
					<p></p>
				@endif
				

			</div>
		</div>

		<div class="text-center col-md-3 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">WMS Tables (log)</div>

				@if(Auth::check() && Auth::user()->name == "admin")
				<p></p>
				<ul class="nav nav-pills nav-stacked">

					<div><a href="{{ url('removed_nothu') }}" class="btn-info btn center-block"><b>Table of Deleted NOT HU material from HU table</b></a></li>
				    <div><a href="{{ url('removed_hu') }}" class="btn-info btn center-block"><b>Table of Deleted HU material from HU table</b></a></li>
					
				</ul>
				
					<p></p>
					<p></p>
					<p></p>
				@endif
				

			</div>
		</div>
	</div>
</div>

@endsection