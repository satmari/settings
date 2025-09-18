@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-6 col-md-offset-3">
			<br>
			<div class="panel panel-default">
				<div class="panel-head ing" style="background-color: yellow"><b>Scan or insert R number</b>
						
					
				</div>

				@if (isset($msg))
					<small><i>&nbsp &nbsp &nbsp Msg: <span style="color:green"><b>{{ $msg }}</b></span></i></small>
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
		
				{!! Form::open(['url' => 'locker_scan_rnumber']) !!}
					
					
					<br>
					<!-- <p>R number &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp -->
					<br>
					<!-- {!! Form::text('r_number', null, ['class' => 'form-control','autofocus' => 'autofocus']) !!}</td> -->

					<p>Employee : </p>
						<!-- <select name="r_number" class="chosen narrow-chosen" required>
		                	<option value="" selected></option>
		                	
		                	@foreach ($operators as $line)
		                	<option value="{{$line->r_number}}-{{$line->employee}}">
			                        {{ $line->r_number  }} - {{ $line->employee }}
			                    </option>
			                @endforeach
		               	</select> -->
						
						{!! Form::text('r_number', null, ['class' => 'form-control','autofocus' => 'autofocus','required' => 'required']) !!}
						
					</p>
						
					
					</table>

					<div class="panel-body">
						{!! Form::submit('Next', ['class' => 'btn btn-success btn center-block']) !!}
					</div>
					
					@include('errors.list')
					{!! Form::close() !!}
				
			</div>
		</div>
	</div>
</div>
@endsection