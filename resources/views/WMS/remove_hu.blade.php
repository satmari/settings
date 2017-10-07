@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center col-md-3 col-md-offset-4">
			<div class="panel panel-default">
				

				@if(Auth::check() && Auth::user()->name == "admin")

					
						<div class="panel-heading">Import list of HU from Excel file</div>
						<p></p>

						<div class="alert alert-info">
						  <strong>Info:</strong> Excel file should contain one sheet with column hu.
						</div>

						{!! Form::open(['files'=>True, 'method'=>'POST', 'action'=>['WMSController@postImportHU']]) !!}
							<div class="panel-body">
								{!! Form::file('file2', ['class' => 'center-block']) !!}
							</div>
							<div class="panel-body">
								{!! Form::submit('Import HU', ['class' => 'btn btn-warning center-block']) !!}
							</div>
							@include('errors.list')
						{!! Form::close() !!}
				
				@endif
				

			</div>
		</div>
	</div>
</div>

@endsection