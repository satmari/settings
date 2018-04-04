@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-5 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Edit Budget line</b></div>
				
				
				@if(Auth::check() && Auth::user()->name == "admin")
				
					{!! Form::open(['url' => 'update_budget/'.$data->id]) !!}
					<input type="hidden" id="_token" value="<?php echo csrf_token(); ?>">

					<div class="panel-body">
						<p>YMW:</p>
	               		{!! Form::input('string', 'ymw', $data->ymw, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Year:</p>
	               		{!! Form::input('string', 'year', $data->year, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Month:</p>
	               		{!! Form::input('string', 'month', $data->month, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Week:</p>
	               		{!! Form::input('string', 'week', $data->week, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Worked days:</p>
	               		{!! Form::input('number', 'worked_days', $data->worked_days, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>New modules:</p>
	               		{!! Form::input('decimal', 'new_modules', $data->new_modules, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Modules total:</p>
	               		{!! Form::input('decimal', 'modules_total', $data->modules_total, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Operators:</p>
	               		{!! Form::input('number', 'operators', $data->operators, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Available minutes:</p>
	               		{!! Form::input('decimal', 'available_minutes', $data->available_minutes, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Absenteeism:</p>
	               		{!! Form::input('decimal', 'absenteeism', number_format($data->absenteeism,2)*100, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Turnover gap:</p>
	               		{!! Form::input('decimal', 'turnover_gap', number_format($data->turnover_gap,2)*100, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Available minutes abs gap:</p>
	               		{!! Form::input('decimal', 'available_minutes_abs_gap', $data->available_minutes_abs_gap, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Budget eff:</p>
	               		{!! Form::input('decimal', 'budget_eff', number_format($data->budget_eff,2)*100, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Worked minutes:</p>
	               		{!! Form::input('decimal', 'worked_minutes', $data->worked_minutes, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Pieces produced:</p>
	               		{!! Form::input('decimal', 'pieces_produced', $data->pieces_produced, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Prod cap new modules:</p>
	               		{!! Form::input('decimal', 'prod_cap_new_modules', number_format($data->prod_cap_new_modules,2)*100, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Prod cap flash:</p>
	               		{!! Form::input('decimal', 'prod_cap_flash', number_format($data->prod_cap_flash,2)*100, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Prod cap fashion:</p>
	               		{!! Form::input('decimal', 'prod_cap_fashion', number_format($data->prod_cap_fashion,2)*100, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Prod cap basic:</p>
	               		{!! Form::input('decimal', 'prod_cap_basic', number_format($data->prod_cap_basic,2)*100, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Eff new modules:</p>
	               		{!! Form::input('decimal', 'eff_new_modules', number_format($data->eff_new_modules,2)*100, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Eff flash:</p>
	               		{!! Form::input('decimal', 'eff_flash', number_format($data->eff_flash,2)*100, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Eff fashion:</p>
	               		{!! Form::input('decimal', 'eff_fashion', number_format($data->eff_fashion,2)*100, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>Eff basic:</p>
	               		{!! Form::input('decimal', 'eff_basic', number_format($data->eff_basic,2)*100, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<p>First work day:</p>
						{!! Form::input('date','first_work_day', $data->first_work_day, ['class' => 'form-control']) !!}
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
