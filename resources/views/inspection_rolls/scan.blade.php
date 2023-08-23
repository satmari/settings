@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center">
			<div class="panel panel-default">
				<div class="panel-head ing" style="background-color:  "><br><b>R number: {{ $rnumber }}</b>
					&nbsp; &nbsp; &nbsp;<a href="{{ url('log_out_i') }}" class="btn btn-xs btn-danger">Logout</a>
				</div>
				<br>
				<div class="panel-head ing" style="background-color:  #cf0101"><b>Scan inspection roll</b>
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

				
				{!! Form::open(['url' => 'insert_inspection_roll']) !!}
					
					<table class="tab le">
					<tr>
						<td>SU &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
						<td>{!! Form::text('su_temp', null, ['class' => 'fo rm-control','autofocus' => 'autofocus']) !!}</td>
					</tr>
					<tr>
						<td>
						@if(isset($data)) 
							Number of scanned rolls: {{ count($data) }}
						@endif
						</td>
					</tr>
					
					</table>

					{{--
					<div class="panel-body">
						{!! Form::submit('Confirm', ['class' => 'btn btn-success btn-xs center-block']) !!}
					</div>
					--}}
										
					@include('errors.list')
					{!! Form::close() !!}
					
				
				@if(isset($data))

					<table class="table" style="background-color: #9fd9dc29">
						<thead>
							<tr>
								<td>SU</td>
								<td>Material</td>
								<td>Batch</td>
								<td>Qty</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
						@foreach ($data as $d)
						<tr>
							<td>{{ $d->su }}</td>
							<td>{{ $d->material }}</td>
							<td>{{ $d->batch }}</td>
							<td>{{ round($d->qty,2) }}</td>
							<td><a href="{{ url('remove_inspection_roll/'.$d->id.'/'.$d->ses) }}" class="btn btn-xs btn-danger">X</a> </td>
							
						</tr>

						@endforeach
						</tbody>
					</table>
				@endif
				<br>			
				<div>
					<!-- <a href="{{ url('#') }}" class="btn btn-xs btn-danger">Confirm all</a> -->

					@if (isset($session))
					{!! Form::open(['url' => 'confirm_inspection_roll']) !!}
					
					{!! Form::hidden('session', $session, ['class' => 'form-control']) !!}
					{!! Form::submit('Confirm all', ['class' => 'btn btn-danger btn-xs center-block']) !!}
										
					@include('errors.list')
					{!! Form::close() !!}
					@endif

				</div>
				<br>
			</div>
		</div>
	</div>
</div>
@endsection