@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-5 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-head ing" style="background-color: #80808029"><b>Scan CB or PAL</b>
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
				
				{!! Form::open(['url' => 'insert_temp_su_pal']) !!}
					
					<table class="tab le">
					<tr>
						<td>SU &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
						<td>{!! Form::text('su_temp', null, ['class' => 'fo rm-control','autofocus' => 'autofocus']) !!}</td>
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
				@foreach ($data as $d)
				{!! Form::open(['url' => 'update_su_pal/'.$d->id]) !!}
				<input type="hidden" id="_token" value="<?php echo csrf_token(); ?>">

				<table class="table" style="background-color: #9fd9dc29">
				<tr>
					<td>SU</td>
					<td>{{ $d->su }}</td>
				</tr>
				<tr>
					<td>Material</td>
					<td>{{ $d->material }}</td>
				</tr>
				<tr>
					<td>Desc</td>
					<td>{{ $d->material_desc }}</td>
				</tr>
				<tr>
					<td>Batch</td>
					<td>{{ $d->batch }}</td>
				</tr>
				</table>

				<table class="ta ble" >
				@if ($d->bin_actual != '')
					<tr>
						<td>Bin &nbsp &nbsp &nbsp</td>
						<td>{!! Form::input('bin', 'bin', $d->bin_actual, ['class' => 'form-con trol']) !!}</td>
						<td rowspan="2">{!! Form::submit('Save', ['class' => 'btn btn-success center-bl ock']) !!}</td>
					</tr>
				@else
					<tr>	
						<td>Bin &nbsp &nbsp &nbsp</td>
						<td>{!! Form::input('bin', 'bin', $d->bin, ['class' => 'form-co ntrol']) !!}</td>
						<td rowspan="2">{!! Form::submit('Save', ['class' => 'btn btn-success center-bl ock']) !!}</td>
					</tr>
				@endif

				@if ($d->qty_actual == 0)
					<tr>
						<td>Qty &nbsp &nbsp &nbsp</td>
						<td>{!! Form::input('number', 'qty', round($d->qty,3), ['class' => 'form-con trol','step' => '0.001']) !!} </td>
					</tr>
				@else
					<tr>
						<td>Qty &nbsp &nbsp &nbsp</td>
						<td>{!! Form::input('number', 'qty', round($d->qty_actual,3), ['class' => 'form-contr ol','step' => '0.001']) !!} </td>
					</tr>
				@endif
				</table>

				@include('errors.list')
				{!! Form::close() !!}

				@endforeach
				@endif
				<br>			
				<div>
					<a href="{{ url('inventory_stop_pal') }}" class="btn btn-danger">Stop Inventory</a>
					<a href="{{ url('inventory_cancel_pal') }}" class="btn btn-warning">Cancel last SU</a>
				</div>
				<br>

			</div>
		</div>
	</div>
</div>
@endsection