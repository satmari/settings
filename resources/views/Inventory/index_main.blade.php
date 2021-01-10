@extends('app')

@section('content')
<div class="container container-table">
	<div class="row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">SAP Inventory</div>
				<h3 style="color:red;"></h3>
				<p style="color:red;"></p>

				<div class="panel panel-default">
					<a href="{{url('/inventory')}}" class="btn btn-default center-block"  style="background-color: #1bff0c52">SAP Inventory Main</a>
				</div>
				<br>
				<div class="panel panel-default">
					<a href="{{url('/inventory_wh')}}" class="btn btn-default center-block"  style="background-color: #fff1d5">SAP Inventory WH</a>
				</div>
				<br>
				<div class="panel panel-default">
					<a href="{{url('/inventory_cut')}}" class="btn btn-default center-block"  style="background-color: #ff0c0c63">SAP Inventory CUT</a>
				</div>
				<br>
				<div class="panel panel-default">
					<a href="{{url('/inventory_p')}}" class="btn btn-default center-block"  style="background-color: #ffa90cb5">SAP Inventory Kikinda</a>
				</div>
				<br>
				<div class="panel panel-default">
					<a href="{{url('/inventory_bb')}}" class="btn btn-default center-block"  style="background-color: #0c35ffb5">Inventory BB1</a>
				</div>
				<br>
				<div class="panel panel-default">
					<a href="{{url('/inventory_bb_2')}}" class="btn btn-default center-block"  style="background-color: #0cb0ff63">Inventory BB2</a>
				</div>


			</div>
		</div>
		
	</div>
</div>

	

@endsection