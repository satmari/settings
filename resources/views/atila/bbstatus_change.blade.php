@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-5 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Edit BBcreation status for all sizes on {{$pon}} !!!</b></div>
				
				
				
				
					{!! Form::open(['url' => 'update_bbstatus']) !!}
					<input type="hidden" id="_token" value="<?php echo csrf_token(); ?>">

					{!! Form::hidden('pon', $pon, ['class' => 'form-control']) !!}
						
					<div class="panel-body">
					<p>BBCreation status: </p>
					{!! Form::select('new_status', ['1' => 'Looked', '0' => 'Unlocked'] , null ,['class' => 'form-control']) !!}
					</div>

					<div class="panel-body">
						{!! Form::submit('Confirm', ['class' => 'btn btn-success btn-lg center-block']) !!}
					</div>

					@include('errors.list')

					{!! Form::close() !!}

				
				<br>
				<div class="">
						<a href="{{url('/')}}" class="btn btn-default btn-lg center-block">Back to main menu</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
