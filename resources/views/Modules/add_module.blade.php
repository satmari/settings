@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-5 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Add line</b></div>
				
				{!! Form::open(['url' => 'insert_module']) !!}
				<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

				<div class="panel-body">
				<p>Line name: </p>
					{!! Form::text('module', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
				</div>
				<div class="panel-body">
				<p>Team / Shift: </p>
					{!! Form::select('team', array('A'=>'A','B'=>'B'), '', array('class' => 'form-control')); !!} 
				</div>

				<div class="panel-body">
				<p>Sort order: </p>
					{{-- {!! Form::integer('sort_order', null, ['class' => 'form-control']) !!} --}}
					{!! Form::input('number','sort_order', null, ['class' => 'form-control']) !!}
				</div>

				<div class="panel-body">
				<p>Row: </p>
					{!! Form::text('row', null, ['class' => 'form-control']) !!}
				</div>

				<div class="panel-body">
				<p>Column group: </p>
					{!! Form::text('column_group', null, ['class' => 'form-control']) !!}
				</div>

				<div class="panel-body">
				<p>Sector: </p>
					{!! Form::text('sector', null, ['class' => 'form-control']) !!}
				</div>

				<div class="panel-body">
				<p>Workstudy name: </p>
					{!! Form::text('workstudy', null, ['class' => 'form-control']) !!}
				</div>

				<div class="panel-body">
				<p>Line leader name: </p>
					{!! Form::text('line_leader', null, ['class' => 'form-control']) !!}
				</div>

				<div class="panel-body">
					{!! Form::submit('Confirm', ['class' => 'btn btn-success btn-lg center-block']) !!}
				</div>

				@include('errors.list')

				{!! Form::close() !!}


				<br>
				<div class="">
						<a href="{{url('/module')}}" class="btn btn-default btn-lg center-block">Back to main menu</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection