@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-5 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-head ing" style="background-color: #80808029"><b>Scan SU</b>
					@if (isset($msg))
							<small><i>&nbsp &nbsp &nbsp Msg: {{ $msg }}</i></small>
						@endif
					
				</div>
				
				{!! Form::open(['url' => 'insert_temp_su']) !!}
					
					<table class="table">
					<tr>
						<td>Storage Unit</td>
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
					
				
				<hr style="margin-top: 1px !important;  margin-bottom: 1px !important;">
				
				@foreach ($data as $d)
				{!! Form::open(['url' => 'update_su/'.$d->id]) !!}
				<input type="hidden" id="_token" value="<?php echo csrf_token(); ?>">
				<span style="color:red"><i><small>If you modify this value click on Save</small></i></span>

				@if ($d->bin_actual != '')
					<table class="table">
					<tr>
						<td>Storage Unit</td>
						<td>{!! Form::input('bin', 'bin', $d->bin_actual, ['class' => 'form-control']) !!}</td>
					</tr>
					<tr>	
						<td></td>


					</tr>



					</table>
				@else
					<div class="panel-body" style="padding: 10px !important;">
						Bin: <span style="color:red"><i><small>If you modify this value click on Save</small></i></span>
	               		{!! Form::input('bin', 'bin', $d->bin, ['class' => 'form-control']) !!}
	               		</p>
					</div>
				@endif

				@if ($d->qty_actual == 0)
					<div class="panel-body">
						Qty: <span style="color:red" style="padding: 10px !important;"><i><small>If you modify this value click on Save</small></i></span>
	               		{!! Form::input('qty', 'qty', $d->qty, ['class' => 'form-control']) !!} {{ $d->uom }}
					</div>
				@else
					<div class="panel-body">
						Actual qty: <span style="color:red" style="padding: 10px !important;"><i><small>If you modify this value click on Save</small></i></span>
	               		{!! Form::input('qty', 'qty', $d->qty_actual, ['class' => 'form-control']) !!} {{ $d->uom }}
					</div>
				@endif

				<div class="panel-b ody">
					{!! Form::submit(' --- Save --- ', ['class' => 'btn btn-danger center-block']) !!}
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
					<a href="{{ url('inventory_stop') }}" class="btn btn-danger">Stop Inventory scan</a>
				</div>
				<br>
				
			</div>
		</div>
	</div>
</div>
@endsection