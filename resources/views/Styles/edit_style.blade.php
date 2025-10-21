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
						<p>FG family:</p>
	               		{!! Form::input('fg_family', 'fg_family', $data->fg_family, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Spreading method:</p>
	               		{!! Form::input('spreading_method', 'spreading_method', $data->spreading_method, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Standard bb qty:</p>
	               		{!! Form::input('integer', 'standard_bb_qty', $data->standard_bb_qty, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Pad print:</p>
	               		{!! Form::input('pad_print', 'pad_print', $data->pad_print, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Bansek:</p>
	               		{!! Form::input('bansek', 'bansek', $data->bansek, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Adeziv:</p>
	               		{!! Form::input('adeziv', 'adeziv', $data->adeziv, ['class' => 'form-control']) !!}
					</div>

					<div class="panel-body">
						<p>Paspul:</p>
	               		{!! Form::input('paspul', 'paspul', $data->paspul, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>2nd material:</p>
	               		{!! Form::input('material_2nd', 'material_2nd', $data->material_2nd, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Bonding:</p>
	               		{!! Form::input('bonding', 'bonding', $data->bonding, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Preproduction:</p>
	               		{!! Form::input('preproduction', 'preproduction', $data->preproduction, ['class' => 'form-control']) !!}
					</div>

					<div class="panel-body">
						<p>Status:</p>
	               		{!! Form::select('status', array(''=>'','ACTIVE'=>'ACTIVE','NOT IN USE'=>'NOT IN USE'), $data->status, array('class' => 'form-control')); !!} 
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
