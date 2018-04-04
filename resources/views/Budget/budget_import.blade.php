@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center col-md-3 col-md-offset-4">
			<div class="panel panel-default">
				

				@if(Auth::check() && Auth::user()->name == "admin")

					
						<div class="panel-heading">Import Budget from Excel file</div>
						<p></p>

						<div class="alert alert-info">
						  <strong>Info:</strong> Excel file should contain one sheet with columns:
						<i style="font-size: 10px">
						<p>ymw with format like 2017-01-12</p>
						<p>year</p>
						<p>month</p>
						<p>week</p>
						<p>worked_days</p>
						<p>new_modules</p>
						<p>modules_total</p>
						<p>operators</p>
						<p>available_minutes</p>
						<p>absenteeism</p>
						<p>turnover_gap</p>
						<p>available_minutes_abs_gap</p>
						<p>budget_eff</p>
						<p>worked_minutes</p>
						<p>pieces_produced</p>
						<p>prod_cap_new_modules</p>
						<p>prod_cap_flash</p>
						<p>prod_cap_fashion</p>
						<p>prod_cap_basic</p>
						<p>eff_new_modules</p>
						<p>eff_flash</p>
						<p>eff_fashion</p>
						<p>eff_basic</p>
						<p>first_work_day</p>
						</i>

						</div>

						{!! Form::open(['files'=>True, 'method'=>'POST', 'action'=>['ImportController@postImportBudget']]) !!}
							<div class="panel-body">
								{!! Form::file('file', ['class' => 'center-block']) !!}
							</div>
							<div class="panel-body">
								{!! Form::submit('Import', ['class' => 'btn btn-warning center-block']) !!}
							</div>
							@include('errors.list')
						{!! Form::close() !!}
				
				@endif
				

			</div>
		</div>
	</div>
</div>

@endsection