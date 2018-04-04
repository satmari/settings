@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-5 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Add new Budget line</b></div>
				
				{!! Form::open(['url' => 'insert_budget']) !!}
				<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

				<div class="panel-body">
				<p>YMW: </p>
					{!! Form::text('ymw', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Year: </p>
					{!! Form::text('year', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Month: </p>
					{!! Form::text('month', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Week: </p>
					{!! Form::text('week', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Worked days:</p>
					{!! Form::input('integer','worked_days', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>New modules:</p>
					{!! Form::input('decimal','new_modules', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Modules total:</p>
					{!! Form::input('decimal','modules_total', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Operators:</p>
					{!! Form::input('integer','operators', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Available minutes:</p>
					{!! Form::input('decimal','available_minutes', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Absenteeism:</p>
					{!! Form::input('decimal','absenteeism', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Turnover gap:</p>
					{!! Form::input('decimal','turnover_gap', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Available minutes abs gap:</p>
					{!! Form::input('decimal','available_minutes_abs_gap', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Budget eff:</p>
					{!! Form::input('decimal','budget_eff', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Worked minutes:</p>
					{!! Form::input('decimal','worked_minutes', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Pieces produced:</p>
					{!! Form::input('decimal','pieces_produced', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Prod cap new modules:</p>
					{!! Form::input('decimal','prod_cap_new_modules', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Prod cap flash:</p>
					{!! Form::input('decimal','prod_cap_flash', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Prod cap fashion:</p>
					{!! Form::input('decimal','prod_cap_fashion', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Prod cap basic:</p>
					{!! Form::input('decimal','prod_cap_basic', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Eff new modules:</p>
					{!! Form::input('decimal','eff_new_modules', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Eff flash:</p>
					{!! Form::input('decimal','eff_flash', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Eff fashion:</p>
					{!! Form::input('decimal','eff_fashion', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Eff basic:</p>
					{!! Form::input('decimal','eff_basic', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>First work day:</p>
					{!! Form::input('date','first_work_day', null, ['class' => 'form-control']) !!}
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