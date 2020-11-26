@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-5 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Scan SU</b>
					@if (isset($msg))
							<small><i>&nbsp &nbsp &nbsp Msg: {{ $msg }}</i></small>
						@endif
					
				</div>
				
				{!! Form::open(['url' => 'insert_temp_su']) !!}
				
					<div class="panel-body" style="padding: 10px !important;">
					Storage Unit:  
						{!! Form::text('su_temp', null, ['class' => 'form-con trol','autofocus' => 'autofocus']) !!}
					</div>
					@include('errors.list')
					{!! Form::close() !!}
					{{--
					<div class="panel-body">
						{!! Form::submit('Confirm', ['class' => 'btn btn-success btn-s center-block']) !!}
					</div>
					--}}
				
				<hr style="margin-top: 1px !important;  margin-bottom: 1px !important;">
				@foreach ($data as $d)
				

				{!! Form::open(['url' => 'update_su/'.$d->id]) !!}
				<input type="hidden" id="_token" value="<?php echo csrf_token(); ?>">

				@if ($d->bin_actual != '')
					<div class="panel-body" style="padding: 10px !important;">
						Actual Bin: <span style="color:red"><i><small>If you modify this value click on Save</small></i></span>
	               		{!! Form::input('bin', 'bin', $d->bin_actual, ['class' => 'f orm-control']) !!}
	        		</div>
				@else
					<div class="panel-body" style="padding: 10px !important;">
						Bin: <span style="color:red"><i><small>If you modify this value click on Save</small></i></span>
	               		{!! Form::input('bin', 'bin', $d->bin, ['class' => 'fo rm-control']) !!}
	               		</p>
					</div>
				@endif

				@if ($d->qty_actual == 0)
					<div class="panel-body">
						Qty: <span style="color:red" style="padding: 10px !important;"><i><small>If you modify this value click on Save</small></i></span>
	               		{!! Form::input('qty', 'qty', $d->qty, ['class' => 'form-c ontrol']) !!} {{ $d->uom }}
					</div>
				@else
					<div class="panel-body">
						Actual qty: <span style="color:red" style="padding: 10px !important;"><i><small>If you modify this value click on Save</small></i></span>
	               		{!! Form::input('qty', 'qty', $d->qty_actual, ['class' => 'f orm-control']) !!} {{ $d->uom }}
					</div>
				@endif

				<div class="panel-b ody">
					{!! Form::submit(' --- Save --- ', ['class' => 'btn btn-danger btn-xs center-block']) !!}
				</div>

				
				<br>
				<table class="table">

				<tr>
					<td>SU</td>
					<td>{{ $d->su }}</td>
				</tr>
				<tr>
					<td>Material</td>
					<td>{{ $d->material }}</td>
				</tr>
				<tr>
					<td>Material Desc</td>
					<td>{{ $d->material_desc }}</td>
				</tr>
				<tr>
					<td>Batch</td>
					<td>{{ $d->batch }}</td>
				</tr>
				</table>

				@include('errors.list')
				{!! Form::close() !!}

				@endforeach
				
				<hr>
				<div>
					<a href="{{ url('inventory_stop') }}" class="btn btn-danger btn-xs">Stop Inventory scan</a>
				</div>
				<br>
				
			</div>
		</div>
	</div>
</div>
@endsection