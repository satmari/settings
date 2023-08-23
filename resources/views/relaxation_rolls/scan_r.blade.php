@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-5 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-head ing" style="background-color:  #23cf01"><b>Scan R number</b>
						<br>
						@if (isset($msg))
							<small><i>&nbsp; &nbsp; &nbsp; Msg: <span style="color:black"><b>{{ $msg }}</b></span></i></small>
						@endif
						@if (isset($msge))
							<small><i>&nbsp; &nbsp; &nbsp; Msg: <span style="color:white"><b>{{ $msge }}</b></span></i></small>
							<audio autoplay="true" style="display:none;">
					        	<!-- <source src="{{ asset('/css/2.wav') }}" type="audio/wav"> -->
					       	</audio>
						@endif
						@if (isset($msgs))
							<audio autoplay="true" style="display:none;">
					        	<!-- <source src="{{ asset('/css/1.wav') }}" type="audio/wav"> -->
					       	</audio>
						@endif
						@if (isset($msgbin))
							<audio autoplay="true" style="display:none;">
					        	<!-- <source src="{{ asset('/css/3.wav') }}" type="audio/wav"> -->
					       	</audio>
						@endif
					
				</div>
				
				{!! Form::open(['url' => 'insert_relaxation_roll_r']) !!}
					
					<table class="tab le">
					<tr>
						<td>Scan R number</td>
						<td>{!! Form::text('rnumber', null, ['class' => 'fo rm-control','autofocus' => 'autofocus']) !!}</td>
					</tr>
					
					</table>

					{{--
					<div class="panel-body">
						{!! Form::submit('Confirm', ['class' => 'btn btn-success btn-xs center-block']) !!}
					</div>
					--}}
										
					@include('errors.list')
					{!! Form::close() !!}
					
				
				

				</div>
				<br>
			</div>
		</div>
	</div>
</div>
@endsection