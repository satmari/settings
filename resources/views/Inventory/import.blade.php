@extends('app')

@section('content')
<div class="container container-table">
	<div class="row">
		<div class="text-center col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Import</div>
				<h3 style="color:red;"></h3>
				<p style="color:red;"></p>

				<div class="panel panel-default">

					<div class="panel-heading">Import sap inventory table (MAIN)</div>
					
						{!! Form::open(['files'=>'True', 'method'=>'POST', 'action'=>['ImportController@import_post'] ]) !!}
							<div class="panel-body">
								{!! Form::file('file1', ['class' => 'center-block']) !!}
							</div>
							<div class="panel-body">
								{!! Form::submit('Import', ['class' => 'btn btn-warning center-block']) !!}
							</div>
							
						{!! Form::close() !!}


					<div class="panel-heading">Import sap inventory table (WH)</div>
				
						{!! Form::open(['files'=>'True', 'method'=>'POST', 'action'=>['ImportController@import_post_wh'] ]) !!}
							<div class="panel-body">
								{!! Form::file('file2', ['class' => 'center-block']) !!}
							</div>
							<div class="panel-body">
								{!! Form::submit('Import', ['class' => 'btn btn-warning center-block']) !!}
							</div>
							
						{!! Form::close() !!}

					<div class="panel-heading">Import sap inventory table (CUT)</div>
				
						{!! Form::open(['files'=>'True', 'method'=>'POST', 'action'=>['ImportController@import_post_cut'] ]) !!}
							<div class="panel-body">
								{!! Form::file('file3', ['class' => 'center-block']) !!}
							</div>
							<div class="panel-body">
								{!! Form::submit('Import', ['class' => 'btn btn-warning center-block']) !!}
							</div>
							
						{!! Form::close() !!}

					<div class="panel-heading">Import sap inventory table (KIK)</div>
				
						{!! Form::open(['files'=>'True', 'method'=>'POST', 'action'=>['ImportController@import_post_p'] ]) !!}
							<div class="panel-body">
								{!! Form::file('file4', ['class' => 'center-block']) !!}
							</div>
							<div class="panel-body">
								{!! Form::submit('Import', ['class' => 'btn btn-warning center-block']) !!}
							</div>
							
						{!! Form::close() !!}
					

					<div class="panel-heading">Import sap inventory table (BB1)</div>
				
						{!! Form::open(['files'=>'True', 'method'=>'POST', 'action'=>['ImportController@import_post_bb'] ]) !!}
							<div class="panel-body">
								{!! Form::file('file5', ['class' => 'center-block']) !!}
							</div>
							<div class="panel-body">
								{!! Form::submit('Import', ['class' => 'btn btn-warning center-block']) !!}
							</div>
							
						{!! Form::close() !!}
					

					<div class="panel-heading">Import sap inventory table (BB2)</div>
				
						{!! Form::open(['files'=>'True', 'method'=>'POST', 'action'=>['ImportController@import_post_bb_2'] ]) !!}
							<div class="panel-body">
								{!! Form::file('file6', ['class' => 'center-block']) !!}
							</div>
							<div class="panel-body">
								{!! Form::submit('Import', ['class' => 'btn btn-warning center-block']) !!}
							</div>
							
						{!! Form::close() !!}
					
				</div>

			</div>
		</div>
	</div>
</div>
	

@endsection