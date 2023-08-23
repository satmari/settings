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
							<!-- <audio autoplay="true" style="display:none;">
					        	<source src="{{ asset('/css/2.wav') }}" type="audio/wav">
					       	</audio> -->
						@endif
						@if (isset($msgs))
							<!-- audio autoplay="true" style="display:none;">
					        	<source src="{{ asset('/css/1.wav') }}" type="audio/wav">
					       	</audio> -->
						@endif
						@if (isset($msgbin))
							<!-- <audio autoplay="true" style="display:none;">
					        	<source src="{{ asset('/css/3.wav') }}" type="audio/wav">
					       	</audio> -->
						@endif
					
				</div>
				
				
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
				<tr>
					<td>Remaining Qty</td>
					<td>{{ round($data[0]->sum_qty,3) }}</td>
				</tr>
				</table>
				<br>

				{!! Form::open(['url' => 'inventory_issue_next']) !!}

				{!! Form::hidden('su', $data[0]->su, ['class' => 'form-control']) !!}


				<table class="tab le">
					<tr>
						<td>Scan new location barcode &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>
						<td>{!! Form::text('su_new_location', null, ['class' => 'fo rm-control','autofocus' => 'autofocus']) !!}</td>
					</tr>
				</table>

				<div class="panel-body">
					{!! Form::submit('Next', ['class' => 'btn btn-success center-block']) !!}
				</div>
					

				@include('errors.list')
				{!! Form::close() !!}

				
				@else 

				<p>SU wos not found </p>

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