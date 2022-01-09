@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color: #1bff0c52">Error (FG)</div>
				<h3 style="color:red;">Error!</h3>
				<p style="color:red;">{{ $msg }}</p>
				

				<div class="panel-body">
					<div class="">
						<a href="{{url('/inventory')}}" class="btn btn-default center-block">Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection