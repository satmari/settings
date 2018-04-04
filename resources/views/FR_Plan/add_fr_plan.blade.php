@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-5 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Add new FR plan line</b></div>
				
				{!! Form::open(['url' => 'insert_fr_plan']) !!}
				<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

				{{--
				<div class="panel-body">
				<p>Plan key: <span style="color:red">*</span></p>
					{!! Form::text('plan_key', null, ['class' => 'form-control']) !!}
				</div>
				--}}

				<div class="panel-body">
				<p>Module: </p>
					{!! Form::text('module', null, ['class' => 'form-control']) !!}
				</div>

				<div class="panel-body">
				<p>Order: </p>
					{!! Form::text('order', null, ['class' => 'form-control']) !!}
				</div>

				<div class="panel-body">
				<p>Sku: </p>
					{!! Form::text('sku', null, ['class' => 'form-control']) !!}
				</div>

				<div class="panel-body">
				<p>Plan date: </p>
					{!! Form::input('date','plan_date', null, ['class' => 'form-control']) !!}
				</div>

				<div class="panel-body">
				<p>Quantity:</p>
					{!! Form::input('number','qty', null, ['class' => 'form-control']) !!}
				</div>
				
				<div class="panel-body">
					{!! Form::submit('Confirm', ['class' => 'btn btn-success btn-lg center-block']) !!}
				</div>

				@include('errors.list')

				{!! Form::close() !!}


				<br>
				<div class="">
						<a href="{{url('/fr_plan')}}" class="btn btn-default btn-lg center-block">Back to main menu</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection