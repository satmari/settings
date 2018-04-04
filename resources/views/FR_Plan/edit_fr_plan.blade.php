@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-5 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Edit FR plan line</b></div>
				
				
				@if(Auth::check() && Auth::user()->name == "admin")
				
					{!! Form::open(['url' => 'update_fr_plan/'.$data->id]) !!}
					<input type="hidden" id="_token" value="<?php echo csrf_token(); ?>">

					<div class="panel-body">
						<p>Plan KEY:<span style="color:red;">*</span></p>
	               		{!! Form::input('string', 'plan_key', $data->plan_key, ['class' => 'form-control', 'disabled'=>'disabled']) !!}
					</div>
					{!! Form::hidden('plan_key', $data->plan_key, ['class' => 'form-control']) !!}

					<div class="panel-body">
						<p>Module:</p>
	               		{!! Form::input('string', 'module', $data->module, ['class' => 'form-control', 'disabled'=>'disabled']) !!}
					</div>
					{!! Form::hidden('module', $data->module, ['class' => 'form-control']) !!}
					<div class="panel-body">
						<p>Order:</p>
	               		{!! Form::input('string', 'order', $data->order, ['class' => 'form-control', 'disabled'=>'disabled']) !!}
					</div>
					{!! Form::hidden('order', $data->order, ['class' => 'form-control']) !!}
					<div class="panel-body">
						<p>Sku:</p>
	               		{!! Form::input('string', 'sku', $data->sku, ['class' => 'form-control', 'disabled'=>'disabled']) !!}
					</div>
					{!! Form::hidden('sku', $data->sku, ['class' => 'form-control']) !!}

					<div class="panel-body">
						<p>Plan date:</p>
						{!! Form::input('date','plan_date', $data->plan_date, ['class' => 'form-control', 'disabled'=>'disabled']) !!}
					</div>
					{!! Form::hidden('plan_date', $data->plan_date, ['class' => 'form-control']) !!}
					
					<div class="panel-body">
						<p>Quantity:</p>
	               		{!! Form::input('number', 'qty', $data->qty, ['class' => 'form-control']) !!}
					</div>
					

					<div class="panel-body">
						{!! Form::submit('Confirm', ['class' => 'btn btn-success btn-lg center-block']) !!}
					</div>

					@include('errors.list')

					{!! Form::close() !!}

				@endif

				<br>
				<div class="">
						<a href="{{url('/fr_plan')}}" class="btn btn-default btn-lg center-block">Back to main menu</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
