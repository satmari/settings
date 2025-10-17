@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-5 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Add style</b></div>
				
				{!! Form::open(['url' => 'insert_style']) !!}
				<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

				<div class="panel-body">
				<p>Style: </p>
					{!! Form::text('style', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
				</div>

				<div class="panel-body">
				<p>Brand: </p>
					{!! Form::text('brand', null, ['class' => 'form-control']) !!}
				</div>

				<div class="panel-body">
				<p>Cutting SMV: </p>
					{!! Form::input('decimal','cutting_smv', null, ['class' => 'form-control']) !!}
				</div>

				<div class="panel-body">
				<p>Cluster: </p>
					{!! Form::text('cluster', null, ['class' => 'form-control']) !!}
				</div>

				<div class="panel-body">
				<p>Order Type: </p>
					{!! Form::text('order_type', null, ['class' => 'form-control']) !!}
				</div>

				<div class="panel-body">
				<p>Paspul: </p>
					{!! Form::text('paspul', null, ['class' => 'form-control']) !!}
				</div>

				<div class="panel-body">
				<p>2nd material Type: </p>
					{!! Form::text('material_2nd', null, ['class' => 'form-control']) !!}
				</div>

				<div class="panel-body">
				<p>Bonding: </p>
					{!! Form::text('bonding', null, ['class' => 'form-control']) !!}
				</div>

				<div class="panel-body">
				<p>Preproduction: </p>
					{!! Form::text('preproduction', null, ['class' => 'form-control']) !!}
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