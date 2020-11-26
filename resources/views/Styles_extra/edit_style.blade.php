@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-5 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Edit style (extra)</b></div>
				
			
				{!! Form::open(['url' => 'update_style_extra/'.$data->id]) !!}
				<input type="hidden" id="_token" value="<?php echo csrf_token(); ?>">

				{!! Form::hidden('style', $data->style, ['class' => 'form-control']) !!}

				<div class="panel-body">
					<p>Style Extra:</p>
               		{!! Form::input('text', 'style_extra', $data->style_extra, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
				</div>

				<div class="panel-body">
					<p>Style:</p>
               		{!! Form::input('text', 'style', $data->style, ['class' => 'form-control']) !!}
				</div>

				<div class="panel-body">
					<p>Color:</p>
               		{!! Form::input('text', 'color', $data->color, ['class' => 'form-control']) !!}
				</div>

				<div class="panel-body">
					<p>Size:</p>
               		{!! Form::input('text', 'size', $data->size, ['class' => 'form-control']) !!}
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
