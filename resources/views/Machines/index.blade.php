@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center col-md-2 col-md-offset-5">
			<div class="panel panel-default">
				<div class="panel-heading">Transfer machines</div>

				
					<br>
					<br>
					<div>
						<a href="{{ url('transferg_k_get') }}" class="btn-info btn center-block"><b>SUBOTICA TO KIKINDA</b></a></div>
						<br>
				    <div>
				    	<a href="{{ url('transferk_g_get') }}" class="btn-success btn center-block"><b>KIKINDA TO SUBOTICA</b></a></div>
				    	<br>
				    <br>
				    <br>
				<div class="panel-heading">Tables</div>
				    <br>
				    <div><a href="{{ url('machines_table') }}" class="btn-danger btn center-block">Machine table</a></div>
					
							
					<p></p>
					<p></p>
					<p></p>
				
				

			</div>
		</div>

		
	</div>
</div>

@endsection