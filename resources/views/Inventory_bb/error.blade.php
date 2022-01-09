@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">Error BB1 (Stock)</div>
				<h3 style="color:red;">Error!</h3>
				<p style="color:red;" style="background-color: #0c35ffb5">{{ $msg }}</p>
				

				<div class="panel-body">
					<div class="">
						<a href="{{url('/inventory_bb')}}" class="btn btn-default center-block">Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection