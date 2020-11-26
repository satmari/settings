@extends('app')

@section('content')
<div class="container container-table">
	<div class="row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">SAP Inventory (scan)</div>
				<h3 style="color:red;"></h3>
				<p style="color:red;"></p>

				<div class="panel panel-default">
					<a href="{{url('/inventory_scan')}}" class="btn btn-default center-block"  style="background-color: #1bff0c52">SAP Inventory main</a>
				</div>
				<br>
				<div class="panel panel-default">
					<a href="{{url('/inventory_scan_wh')}}" class="btn btn-default center-block"  style="background-color: #fff1d5">SAP Inventory WH</a>
				</div>
				<br>
				<div class="panel panel-default">
					<a href="{{url('/inventory_scan_cut')}}" class="btn btn-default center-block"  style="background-color: #0cb0ff63">SAP Inventory CUT</a>
				</div>
				<br>
				<div class="panel panel-default">
					<a href="{{url('/inventory_scan_p')}}" class="btn btn-default center-block"  style="background-color: #ffa90cb5">SAP Inventory Kikinda</a>
				</div>


			</div>
		</div>
		
	</div>
</div>

	

@endsection