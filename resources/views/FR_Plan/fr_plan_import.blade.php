@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center col-md-3 col-md-offset-4">
			<div class="panel panel-default">
				

				@if(Auth::check() && Auth::user()->name == "admin")

					
						<div class="panel-heading">Import FR plan from Excel file</div>
						<p></p>

						<div class="alert alert-info">
						  <strong>Info:</strong> Excel file (.xlsx) should contain one sheet with coloumns:
						<i style="font-size: 10px">
						<p>module</p>
						<p>order</p>
						<p>sku</p>
						<p>plan_date [Date format]</p>
						<p>qty</p>
						</i>

						</div>

						{!! Form::open(['files'=>True, 'method'=>'POST', 'action'=>['ImportController@postImportFR_plan']]) !!}
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