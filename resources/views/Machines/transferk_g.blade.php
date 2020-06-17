@extends('app')

@section('content')

<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center col-md-4 col-md-offset-4">
            <div class="panel panel-default">
				<div class="panel-heading">Machines to transfer from KIKINDA TO SUBOTICA</div>
				<br>
					{!! Form::open(['method'=>'POST', 'url'=>'/transferk_g']) !!}

						<div class="panel-body">
						<p>Skenirati ili upisati OS broj: </p>
							{!! Form::text('osnumber', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
						</div>
						
						<br>
						
						{!! Form::submit('Confirm', ['class' => 'btn  btn-success center-block']) !!}

						@include('errors.list')

					{!! Form::close() !!}

						<hr>
		                  @if (isset($msg1))
		                 <div class="panel-body">
		                    <p style="color:red;"><b>{{ $msg1 }}</b></p>
		                 </div>
		                 @endif

		                 @if (isset($msg2))
		                 <div class="panel-body">
		                    <p style="color:red;"><b></b></p>
		                 </div>
		                 @endif

		                 @if (isset($msg3))
		                 <div class="panel-body">
		                    <p style="color:red;"><b></b></p>
		                 </div>
		                 @endif

		                 @if (isset($msg4))
		                 <div class="panel-body">
		                    <p style="color:green;"><b>{{ $msg4 }}</b></p>
		                 </div>
		                 @endif

				
				@if(isset($osarray))
					<table class="table">
						<thead>
							<td>OS lista</td>
							
						</thead>

					@foreach($osarray as $array)
						<tr>
							@foreach($array as $key => $value)
							<td>
								@if($key == 'os')
						    		<b>{{ $value }}</b>
						    	@endif
						    </td>
					   		<td>
					   			@if($key == 'os')
					   			<a href="{{url('/transferk_g_delete/'.$value )}}" class="btn btn-danger btn-xs">X</a>
					   			@endif
					   		</td>

					   		@endforeach
					    </tr>

					@endforeach

					</table>
				@endif


				<hr>
				{!! Form::open(['url' => 'transferk_g_post']) !!}
				<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">


				<div class="panel-body">
					{!! Form::submit('Confirm list', ['class' => 'btn btn-danger center-block']) !!}
				</div>

				@include('errors.list')

				{!! Form::close() !!}
				
				
		</div>
	</div>
</div>

@endsection