@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-5 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-head ing" style="background-color: #ff16b7"><b>Scan SU LOG</b>
						@if (isset($msg))
							<small><i>&nbsp &nbsp &nbsp Msg: <span style="color:white"><b>{{ $msg }}</b></span></i></small>
						@endif
						@if (isset($msge))
							<small><i>&nbsp &nbsp &nbsp Msg: <span style="color:white"><b>{{ $msge }}</b></span></i></small>
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
				
				{!! Form::open(['url' => 'insert_temp_su_log']) !!}
					
					<table class="tab le">
					<tr>
						<td>SU &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>
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
				
				<input type="hidden" id="_token" value="<?php echo csrf_token(); ?>">

				<table class="table" style="background-color: #9fd9dc29">
				<tr>
					<td>SU</td>
					<td>{{ $data[0]->su }}</td>
				</tr>
				<tr>
					<td>Material</td>
					<td>{{ $data[0]->material }}</td>
				</tr>
				<tr>
					<td>Desc</td>
					<td>{{ $data[0]->material_desc }}</td>
				</tr>
				<tr>
					<td>Batch</td>
					<td>{{ $data[0]->batch }}</td>
				</tr>
				</table>

					@foreach($data as $d)
					<table class="ta ble" >
					@if ($d->bin_actual != '')
						<tr>
							<td>Bin &nbsp &nbsp &nbsp</td>
							<td>{!! Form::input('bin', 'bin', $d->bin_actual, ['class' => 'form-con trol', 'disabled' => 'disabled']) !!}</td>
							<!-- <td rowspan="2">{!! Form::submit('Save', ['class' => 'btn btn-success center-bl ock']) !!}</td> -->
						</tr>
					@else
						<tr>	
							<td>Bin &nbsp &nbsp &nbsp</td>
							<td>{!! Form::input('bin', 'bin', $d->bin, ['class' => 'form-co ntrol' , 'disabled' => 'disabled']) !!}</td>
							<!-- <td rowspan="2">{!! Form::submit('Save', ['class' => 'btn btn-success center-bl ock' ]) !!}</td> -->
						</tr>
					@endif

					@if ($d->qty_actual == 0)
						<tr>
							<td>Qty &nbsp &nbsp &nbsp</td>
							<td>{!! Form::input('number', 'qty', round($d->qty,3), ['class' => 'form-con trol','step' => '0.001', 'disabled' => 'disabled']) !!} </td>
						</tr>
					@else
						<tr>
							<td>Qty &nbsp &nbsp &nbsp</td>
							<td>{!! Form::input('number', 'qty', round($d->qty,3), ['class' => 'form-contr ol','step' => '0.001' ,'disabled' => 'disabled']) !!} </td>
						</tr>
					@endif
					</table>
					
					@endforeach

					<br>
					<table>
						<tr>
							<td>Remaining Qty &nbsp &nbsp &nbsp</td>
							<td><td>{!! Form::input('number', 'qty', round($data[0]->sum_qty,3), ['class' => 'form-contr ol','step' => '0.001' ,'disabled' => 'disabled']) !!} </td></td>
						</tr>
					</table>


					@if ($data[0]->sum_qty > 0)
					<br>			
					<div>
						
						<a href="{{ url('inventory_issue/'.$data[0]->su) }}" class="btn btn-danger">Issue matrerial</a>
					</div>
					<br>
					@endif
				

				@include('errors.list')
				{!! Form::close() !!}


				@endif


				
				
				<!-- <br>			
				<div> -->
					<!-- <a href="{{ url('inventory_stop_log') }}" class="btn btn-danger">Stop Inventory</a> -->
					<!-- <a href="{{ url('inventory_cancel_log') }}" class="btn btn-warning">Cancel last SU</a> -->


					<!-- <a href="{{ url('inventory_issue') }}" class="btn btn-danger">Issue matrerial</a> -->
				<!-- </div>
				<br> -->
				
			</div>
		</div>
	</div>
</div>
@endsection