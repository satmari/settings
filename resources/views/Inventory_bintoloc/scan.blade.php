@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-5 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-head ing" style="background-color: #999"><b>Scan BIN and LOCATION</b>
						@if (isset($msg))
							<small><i>&nbsp &nbsp &nbsp Msg: <span style="color:blue"><b>{{ $msg }}</b></span></i></small>
						@endif
						@if (isset($msge))
							<small><i>&nbsp &nbsp &nbsp Msg: <span style="color:red"><b>{{ $msge }}</b></span></i></small>
							<audio autoplay="true" style="display:none;">
					        	<source src="{{ asset('/css/2.wav') }}" type="audio/wav">
					       	</audio>
						@endif
						@if (isset($msgs))
							<audio autoplay="true" style="display:none;">
					        	<source src="{{ asset('/css/1.wav') }}" type="audio/wav">
					       	</audio>
						@endif
						@if (isset($msgbin))
							<audio autoplay="true" style="display:none;">
					        	<source src="{{ asset('/css/3.wav') }}" type="audio/wav">
					       	</audio>
						@endif
					
				</div>
				
				{!! Form::open(['url' => 'inventory_bintoloc_post']) !!}
					
					<table class="tab le">
					<tr>
						<td>BIN &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>
						<td>{!! Form::text('bin', null, ['class' => 'fo rm-control','autofocus' => 'autofocus']) !!}</td>
					</tr>
					
					</table>

					
					<div class="panel-body">
						{!! Form::submit('Confirm', ['class' => 'btn btn-success btn-xs center-block']) !!}
					</div>
					
					
				@include('errors.list')
				{!! Form::close() !!}
					
				
				
				<br>			
				<div>
					<!-- <a href="{{ url('inventory_bintoloc_stop') }}" class="btn btn-danger">Stop</a>
					<a href="{{ url('inventory_bintoloc_cancel') }}" class="btn btn-warning">Cancel</a> -->
				</div>
				<br>
				
			</div>
		</div>
	</div>
</div>
@endsection