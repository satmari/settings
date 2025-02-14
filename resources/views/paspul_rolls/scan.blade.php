@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center">
			<div class="panel panel-default">
				<div class="panel-head ing" style="background-color:  "><br><b>R number: {{ $rnumber }}</b>
					
				</div>
				<br>
				<div class="panel-head ing" style="background-color:  #af01cf8a"><b>Scan paspul roll</b>
						<br>
						@if (isset($msg))
							<small><i>&nbsp; &nbsp; &nbsp; Msg: <span style="color:black"><b>{{ $msg }}</b></span></i></small>
						@endif
						
						@if (isset($msg_r))
							<small><i>&nbsp; &nbsp; &nbsp; Msg: <span style="color:black"><b>{{ $msg_r }}</b></span></i></small><br>
						@endif
						@if (isset($msg_i))
							<small><i>&nbsp; &nbsp; &nbsp; Msg: <span style="color:black"><b>{{ $msg_i }}</b></span></i></small>
						@endif
				</div>
				
				{!! Form::open(['url' => 'insert_paspul_roll']) !!}
					{!! Form::hidden('rnumber', $rnumber, ['class' => 'form-control']) !!}

					<table class="tab le">
						<tr>
							<td>SU &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
							<td>{!! Form::text('su', null, ['class' => 'fo rm-control','autofocus' => 'autofocus']) !!}</td>
						</tr>
					</table>

					<div class="panel-body">
						{!! Form::submit('Confirm', ['class' => 'btn btn-success btn-xs center-block']) !!}
					</div>
										
					@include('errors.list')
					{!! Form::close() !!}
					
				<br>
			</div>
		</div>
	</div>
</div>
@endsection