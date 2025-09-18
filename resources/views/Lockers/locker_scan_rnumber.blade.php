@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-6 col-md-offset-3">
			<br>
			<div class="panel panel-default">
				<div class="panel-head ing" style="background-color: yellow"><b>Choose locke number and location for employee: <span style="color:red"> {{ $employee }} </span></b>
						
					
				</div>

				@if (isset($msg))
					<i>&nbsp &nbsp &nbsp <span style="color:green"><b>{{ $msg }}</b></span></i>
				@endif
				@if (isset($msge))
					<i>&nbsp &nbsp &nbsp <span style="color:red"><b>{{ $msge }}</b></span></i>
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
				
				{!! Form::open(['url' => 'locker_scan_locker']) !!}
					
					{!! Form::hidden('r_number', $r_number, ['class' => 'form-control']) !!}
					{!! Form::hidden('employee', $employee, ['class' => 'form-control']) !!}
					<br>
					<!-- <p>R number &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp -->
					<br>
					<!-- {!! Form::text('r_number', null, ['class' => 'form-control','autofocus' => 'autofocus']) !!}</td> -->

					<p>Locker number: </p>
						<!-- <select name="number" class="chosen narrow-chosen" required>
		                	<option value="" selected></option>
		                	
		                	@foreach ($locker_number as $line)
		                	<option value="{{$line->number}}">
			                        {{ $line->number}}
			                    </option>
			                @endforeach
		               	</select> -->

						<!-- {!! Form::text('number', null, ['class' => 'form-control','autofocus' => 'autofocus','required'=>'required']) !!} -->
						
						<input type="number" name="number" class="form-control" autofocus required>
					</p>
					<br>

					<p>Locker place: </p>
						<!-- <select name="place" class="cho sen narrow-chosen" required>
		                	<option value="" selected></option>
		                	
		                	@foreach ($locker_place as $line)
		                	<option value="{{$line->place}}">
			                        {{ $line->place}}
			                    </option>
			                @endforeach
		               	</select> -->
		               	{!! Form::select('place', array(''=>'','ZENSKA SVLACIONICA GORE'=>'ZENSKA SVLACIONICA GORE','ZENSKA SVLACIONICA DOLE'=>'ZENSKA SVLACIONICA DOLE','MUSKA SVLACIONICA DOLE'=>'MUSKA SVLACIONICA DOLE'), '', array('class' => 'form-control','required'=>'required')); !!} 
					</p>
						
					
					<br>

					<div class="panel-body">
						{!! Form::submit('Save', ['class' => 'btn btn-success btn center-block']) !!}
					</div>
					
					@include('errors.list')
					{!! Form::close() !!}
				
			</div>
		</div>
	</div>
</div>
@endsection