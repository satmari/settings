@extends('app')

@section('content')
<div class="container container-table">
	<div class="row">
		<div class="text-center col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"></div>
				<h3 style="color:red;"></h3>
				<p style="color:red;"></p>

				<div class="panel panel-default">
					<div class="panel-heading">Import from SAP - MATERIAL MASTER (ZISR_ARTICOLI_DATIBA)</div>
					
						{!! Form::open(['files'=>'True', 'method'=>'POST', 'action'=>['importController@sap_import_post_mm'] ]) !!}
							<div class="panel-body">
								{!! Form::file('file', ['class' => 'center-block']) !!}
							</div>
							<div class="panel-body">
								{!! Form::submit('Import', ['class' => 'btn btn-warning center-block']) !!}
							</div>
							
						{!! Form::close() !!}
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">Import from SAP - STOCK (MB52)</div>
					
						{!! Form::open(['files'=>'True', 'method'=>'POST', 'action'=>['importController@sap_import_post_s'] ]) !!}
							<div class="panel-body">
								{!! Form::file('file1', ['class' => 'center-block']) !!}
							</div>
							<div class="panel-body">
								{!! Form::submit('Import', ['class' => 'btn btn-warning center-block']) !!}
							</div>
							
						{!! Form::close() !!}
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">Import from SAP USED material (IE05)</div>
					
						{!! Form::open(['files'=>'True', 'method'=>'POST', 'action'=>['importController@sap_import_post_u'] ]) !!}
							<div class="panel-body">
								{!! Form::file('file2', ['class' => 'center-block']) !!}
							</div>
							<div class="panel-body">
								{!! Form::submit('Import', ['class' => 'btn btn-warning center-block']) !!}
							</div>
							
						{!! Form::close() !!}
				</div>
		</div>
	</div>
</div>
	

@endsection