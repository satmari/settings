@extends('app')

@section('content')
<div class="container container-table">
	<div class="row">
		<div class="text-center col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Options</div>
				<h3 style="color:red;"></h3>
				<p style="color:red;"></p>

				<div class="panel-body">
					<div class="">
						<a href="{{url('/truncate_local_cc')}}" class="btn btn-default center-block">Truncate "local CC" table</a>
					</div>
				</div>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/copy_cc_from_nav')}}" class="btn btn-default center-block">Copy from "Navision CC" table to "local CC" table</a>
					</div>
				</div>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/delete_nav_cc')}}" class="btn btn-default center-block">Remove "Navision CC" table</a>
					</div>
				</div>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/copy_cc_from_local')}}" class="btn btn-default center-block">Restore from "local CC" table to "Navision CC" table</a>
					</div>
				</div>
				
				<br>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/')}}" class="btn btn-default center-block">Back</a>
					</div>
				</div>

			</div>
		</div>
		
	</div>

	<div class="">
		<div class="text-center col-md-6 col-md-offset-0">
				<div class="panel panel-default">
				In Navision db
				</div>

				<table class="" id="sort" 
       			>
				<!--
				data-show-export="true"
       			data-export-types="['excel']"
				data-search="true"
		       	data-show-refresh="true"
		       	data-show-toggle="true"
		       	data-query-params="queryParams" 
		       	data-pagination="true"
		       	data-height="300"
		       	data-show-columns="true" 
		       	data-export-options='{
				         "fileName": "preparation_app", 
				         "worksheetName": "test1",         
				         "jspdf": {                  
				           "autotable": {
				             "styles": { "rowHeight": 20, "fontSize": 10 },
				             "headerStyles": { "fillColor": 255, "textColor": 0 },
				             "alternateRowStyles": { "fillColor": [60, 69, 79], "textColor": 255 }
				           }
				         }
				       }'
		       	-->
				    <thead>
				        <tr>
				           <th>Nav - No</th>
				           <th>Nav - Value posting</th>
				            
				        </tr>
				    </thead>
				    <tbody class="">
				    
				    @foreach ($data as $d)
				        <tr>
				        	
				        	<td>{{ $d->no }}</td>
				        	<td>{{ $d->value_posting }}</td>
				        	
						</tr>
				    @endforeach
				    </tbody>
				</table>


		</div>
		<div class="text-center col-md-6 col-md-offset-0">
				<div class="panel panel-default">
				In Local db
				</div>

				<table class="" id="sort" 
       			>
				<!--
				data-show-export="true"
       			data-export-types="['excel']"
				data-search="true"
		       	data-show-refresh="true"
		       	data-show-toggle="true"
		       	data-query-params="queryParams" 
		       	data-pagination="true"
		       	data-height="300"
		       	data-show-columns="true" 
		       	data-export-options='{
				         "fileName": "preparation_app", 
				         "worksheetName": "test1",         
				         "jspdf": {                  
				           "autotable": {
				             "styles": { "rowHeight": 20, "fontSize": 10 },
				             "headerStyles": { "fillColor": 255, "textColor": 0 },
				             "alternateRowStyles": { "fillColor": [60, 69, 79], "textColor": 255 }
				           }
				         }
				       }'
		       	-->
				    <thead>
				        <tr>
				           <th>Loc - No</th>
				           <th>Loc - Value posting</th>
				            
				        </tr>
				    </thead>
				    <tbody class="">
					
					@if ($data1)				    
				    @foreach ($data1 as $d1)
				        <tr>
				        	
				        	<td>{{ $d1->no }}</td>
				        	<td>{{ $d1->value_posting }}</td>
				        	
						</tr>
				    @endforeach
				    @endif
				    </tbody>
				</table>



		</div>

	</div>

	

</div>


@endsection