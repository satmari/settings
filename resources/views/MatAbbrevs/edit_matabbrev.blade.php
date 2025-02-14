@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-5 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Edit Material Abbreviation</b></div>
				
				
				@if(Auth::check() && Auth::user()->name == "admin")
				
					{!! Form::open(['url' => 'update_matabbrev/'.$data->id]) !!}
					<input type="hidden" id="_token" value="<?php echo csrf_token(); ?>">

					<div class="panel-body">
						<p>Abbreviation:</p>
	               		{!! Form::input('abbreviation', 'abbreviation', $data->abbreviation, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
					</div>

					<div class="panel-body">
						<p>Description:</p>
	               		{!! Form::input('description', 'description', $data->description, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Description EN:</p>
	               		{!! Form::input('description_en', 'description_en', $data->description_en, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Description:</p>
	               		{!! Form::input('description_rs', 'description_rs', $data->description_rs, ['class' => 'form-control']) !!}
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
