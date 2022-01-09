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

					<div class="panel-heading" style="background-color: #1bff0c52">Import sap inventory table (FG)</div>
					
						{!! Form::open(['files'=>'True', 'method'=>'POST', 'action'=>['ImportController@import_post'] ]) !!}
							<div class="panel-body">
								{!! Form::file('file1', ['class' => 'center-block']) !!}
							</div>
							<div class="panel-body">
								{!! Form::submit('Import', ['class' => 'btn btn-warning center-block']) !!}
							</div>
							
						{!! Form::close() !!}


					<div class="panel-heading" style="background-color: #fff1d5">Import sap inventory table (Subotica acc)</div>
				
						{!! Form::open(['files'=>'True', 'method'=>'POST', 'action'=>['ImportController@import_post_wh'] ]) !!}
							<div class="panel-body">
								{!! Form::file('file2', ['class' => 'center-block']) !!}
							</div>
							<div class="panel-body">
								{!! Form::submit('Import', ['class' => 'btn btn-warning center-block']) !!}
							</div>
							
						{!! Form::close() !!}

					<div class="panel-heading" style="background-color: #ff0c0c63">Import sap inventory table (Subotica fab)</div>
				
						{!! Form::open(['files'=>'True', 'method'=>'POST', 'action'=>['ImportController@import_post_cut'] ]) !!}
							<div class="panel-body">
								{!! Form::file('file3', ['class' => 'center-block']) !!}
							</div>
							<div class="panel-body">
								{!! Form::submit('Import', ['class' => 'btn btn-warning center-block']) !!}
							</div>
							
						{!! Form::close() !!}

					<div class="panel-heading" style="background-color: #ffa90cb5">Import sap inventory table (Kikinda)</div>
				
						{!! Form::open(['files'=>'True', 'method'=>'POST', 'action'=>['ImportController@import_post_p'] ]) !!}
							<div class="panel-body">
								{!! Form::file('file4', ['class' => 'center-block']) !!}
							</div>
							<div class="panel-body">
								{!! Form::submit('Import', ['class' => 'btn btn-warning center-block']) !!}
							</div>
							
						{!! Form::close() !!}

					<div class="panel-heading" style="background-color: #ff5b0ca1">Import sap inventory table (Senta)</div>
				
						{!! Form::open(['files'=>'True', 'method'=>'POST', 'action'=>['ImportController@import_post_senta'] ]) !!}
							<div class="panel-body">
								{!! Form::file('file9', ['class' => 'center-block']) !!}
							</div>
							<div class="panel-body">
								{!! Form::submit('Import', ['class' => 'btn btn-warning center-block']) !!}
							</div>
							
						{!! Form::close() !!}
					

					<div class="panel-heading" style="background-color: #0c35ffb5">Import sap inventory table BB1 (Stock)</div>
				
						{!! Form::open(['files'=>'True', 'method'=>'POST', 'action'=>['ImportController@import_post_bb'] ]) !!}
							<div class="panel-body">
								{!! Form::file('file5', ['class' => 'center-block']) !!}
							</div>
							<div class="panel-body">
								{!! Form::submit('Import', ['class' => 'btn btn-warning center-block']) !!}
							</div>
							
						{!! Form::close() !!}
					

					<div class="panel-heading" style="background-color: #0cb0ff63">Import sap inventory table BB2 (Subotica)</div>
				
						{!! Form::open(['files'=>'True', 'method'=>'POST', 'action'=>['ImportController@import_post_bb_2'] ]) !!}
							<div class="panel-body">
								{!! Form::file('file6', ['class' => 'center-block']) !!}
							</div>
							<div class="panel-body">
								{!! Form::submit('Import', ['class' => 'btn btn-warning center-block']) !!}
							</div>
							
						{!! Form::close() !!}

					<div class="panel-heading" style="background-color: #03202e63">Import sap inventory table BB3 (Kikinda)</div>
				
						{!! Form::open(['files'=>'True', 'method'=>'POST', 'action'=>['ImportController@import_post_bb_3'] ]) !!}
							<div class="panel-body">
								{!! Form::file('file10', ['class' => 'center-block']) !!}
							</div>
							<div class="panel-body">
								{!! Form::submit('Import', ['class' => 'btn btn-warning center-block']) !!}
							</div>
							
						{!! Form::close() !!}

					<div class="panel-heading" style="background-color: #6e432463">Import sap inventory table BB4 (Senta)</div>
				
						{!! Form::open(['files'=>'True', 'method'=>'POST', 'action'=>['ImportController@import_post_bb_4'] ]) !!}
							<div class="panel-body">
								{!! Form::file('file11', ['class' => 'center-block']) !!}
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