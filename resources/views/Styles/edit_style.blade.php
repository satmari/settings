@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-5 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Edit style</b></div>
				
				
				@if(Auth::check() && Auth::user()->name == "admin")
				
					{!! Form::open(['url' => 'update_style/'.$data->id]) !!}
					<input type="hidden" id="_token" value="<?php echo csrf_token(); ?>">

					<div class="panel-body">
						<p>Style:</p>
	               		{!! Form::input('style', 'style', $data->style, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
					</div>

					<div class="panel-body">
						<p>Brand:</p>
						{!! Form::input('brand','brand', $data->brand, ['class' => 'form-control']) !!}
	                </div>

					<div class="panel-body">
						<p>Cutting SMV:</p>
	               		{!! Form::input('decimal', 'cutting_smv', number_format($data->cutting_smv, 3), ['class' => 'form-control']) !!}
					</div>

					<div class="panel-body">
						<p>Claster:</p>
	               		{!! Form::input('cluster', 'cluster', $data->cluster, ['class' => 'form-control']) !!}
					</div>

					<div class="panel-body">
						<p>Order Type:</p>
	               		{!! Form::input('order_type', 'order_type', $data->order_type, ['class' => 'form-control']) !!}
					</div>


					
					<div class="panel-body">
						{!! Form::submit('Confirm', ['class' => 'btn btn-success btn-lg center-block']) !!}
					</div>

					@include('errors.list')

					{!! Form::close() !!}

				@endif


				@if(Auth::check() && Auth::user()->name == 'workstudy')

					{!! Form::open(['url' => 'update_style/'.$data->id]) !!}
					<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

					{!! Form::hidden('style', $data->style, ['class' => 'form-control']) !!}
					
					<div class="panel-body">
						<p>Brand:</p>
						{!! Form::input('brand','brand', $data->brand, ['class' => 'form-control']) !!}
	                </div>

					<div class="panel-body">
						<p>Cutting SMV:</p>
	               		{!! Form::input('decimal', 'cutting_smv', number_format($data->cutting_smv, 3) , ['class' => 'form-control']) !!}
					</div>

					<div class="panel-body">
						<p>Claster:</p>
	               		{!! Form::input('cluster', 'cluster', $data->cluster, ['class' => 'form-control']) !!}
					</div>

					<div class="panel-body">
						<p>Order Type:</p>
	               		{!! Form::input('order_type', 'order_type', $data->order_type, ['class' => 'form-control']) !!}
					</div>

					<div class="panel-body">
						{!! Form::submit('Confirm', ['class' => 'btn btn-success btn-lg center-block']) !!}
					</div>

					@include('errors.list')

					{!! Form::close() !!}
				
				@endif

				


				<br>
				<div class="">
						<a href="{{url('/')}}" class="btn btn-default btn-lg center-block">Back to main menu</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
