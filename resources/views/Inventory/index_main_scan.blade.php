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
					<a href="{{url('/inventory')}}" class="btn btn-default center-block"  style="background-color: #1bff0c52">SAP Inventory (FG)</a>
				</div>
				<br>
				<div class="panel panel-default">
					<a href="{{url('/inventory_wh')}}" class="btn btn-default center-block"  style="background-color: #fff1d5">SAP Inventory (Subotica acc)</a>
				</div>
				<br>
				<div class="panel panel-default">
					<a href="{{url('/inventory_cut')}}" class="btn btn-default center-block"  style="background-color: #ff0c0c63">SAP Inventory (Subotica fab)</a>
				</div>
				<br>
				<div class="panel panel-default">
					<a href="{{url('/inventory_p')}}" class="btn btn-default center-block"  style="background-color: #ffa90cb5">SAP Inventory (Kikinda acc)</a>
				</div>
				<br>
				<div class="panel panel-default">
					<a href="{{url('/inventory_senta')}}" class="btn btn-default center-block"  style="background-color: #ff5b0ca1">SAP Inventory (Senta acc)</a>
				</div>
				<br>
				<div class="panel panel-default">
					<a href="{{url('/inventory_bb')}}" class="btn btn-default center-block"  style="background-color: #0c35ffb5">Inventory BB1 (Subotica Stock)</a>
				</div>
				<br>
				<div class="panel panel-default">
					<a href="{{url('/inventory_bb_2')}}" class="btn btn-default center-block"  style="background-color: #0cb0ff63">Inventory BB2 (Subotica Lines)</a>
				</div>
				<br>
				<div class="panel panel-default">
					<a href="{{url('/inventory_bb_3')}}" class="btn btn-default center-block"  style="background-color: #03202e63">Inventory BB3 (Kikinda all)</a>
				</div>
				<br>
				<div class="panel panel-default">
					<a href="{{url('/inventory_bb_4')}}" class="btn btn-default center-block"  style="background-color: #6e432463">Inventory BB4 (Senta all)</a>
				</div>
				<br>
				<!-- <div class="panel panel-default">
					<a href="{{url('/inventory_log')}}" class="btn btn-default center-block"  style="background-color: #ff16b7">Inventory LOG</a>
				</div>
				<br> -->
				<div class="panel panel-default">
					<a href="{{url('/inspection_rolls_scan_r')}}" class="btn btn-default center-block"  style="background-color: #cf0101">Inspection rolls</a>
				</div>
				<br>
				<div class="panel panel-default">
					<a href="{{url('/relaxation_rolls_scan_r')}}" class="btn btn-default center-block"  style="background-color: #23cf01">Relaxation rolls</a>
				</div>
				<br>



			</div>
		</div>
		
	</div>
</div>

	

@endsection