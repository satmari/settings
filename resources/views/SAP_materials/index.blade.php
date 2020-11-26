@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center col-md-2 col-md-offset-5">
			<div class="panel panel-default">
				<div class="panel-heading">SAP Materials</div>

				
					<br>
					<br>
					 <div>
				    	<a href="{{ url('sap_cons') }}" class="btn-success btn center-block"><b>Consumable material</b></a></div>
				    <br>
					<div>
						<a href="{{ url('sap_spare') }}" class="btn-info btn center-block"><b>Spare part material</b></a></div>
						<br>
				   
				    <div>
				    	<a href="{{ url('sap_mech') }}" class="btn-default btn center-block"><b>Cons & Spare material (Mech)</b></a></div>
				    	<br>
				    <br>
				    
				    <br>
				    <div><a href="{{ url('sap_import') }}" class="btn-default btn center-block">SAP import</a></div>
					
							
					<p></p>
					<p></p>
					<p></p>
				
				

			</div>
		</div>

		
	</div>
</div>

@endsection