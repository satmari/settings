@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center">
			<div class="panel panel-default">
				<div class="panel-heading"><b>SAP Material - Spare Part mat (RSSP)</b> <br><i>Last update:<span style="color:red"> <b>{{ $updatedat }}</b></span></i></div>

				<div class="input-group"> <span class="input-group-addon">Filter</span>
                    <input id="filter" type="text" class="form-control" placeholder="Type here...">
                </div>
                <table class="table table-striped table-bordered" id="sort" 
                data-show-export="true"
                data-export-types="['excel']"
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
				           {{-- <th>id</th> --}}
				           
				           <th>Material</th>
				           <th>Type</th>
				           <th>Description</th>
				           <th>Responsibility</th>
				           <!-- <th>Old mat</th> -->
				           <th><b>Spare NEW (all)</b></th>
				           <th><i>Spare NEW (Subotica)</i></th>
				           <th><i>Spare NEW (Kikinda)</i></th>
				           <th><b>Spare USED (all)</b></th>
				           <th><b>Total</b></th>
				           <th>Uom</th>
				        </tr>
				    </thead>
				    <tbody class="searchable">
				    
				    @foreach ($data as $d)
				    	
				        <tr>
				        	{{-- <td>{{ $d->id }}</td> --}}
				        	
				        	<td>{{ $d->material }} </td>
				        	<td>{{ $d->material_type }} </td>
				        	<td>{{ $d->material_desc }} </td>
				        	<td>{{ $d->material_res }} </td>
				        	<!-- <td>{{-- $d->material_old --}} </td> -->
				        	<td><b><span style="color:red">{{ $d->spare_new }} </span></b></td>
				        	<td>{{ round($d->Subotica,2) }}</td>
				        	<td>{{ round($d->Kikinda,2) }}</td>
				        	<td><b><span style="color:blue">{{ $d->spare_used }} </span></b></td>
				        	<td><b>{{ $d->spare_new + $d->spare_used }}</b></td>
				        	<td>{{ $d->uom }}</td>

						</tr>	
				    
				    @endforeach
				    </tbody>


				</table>
			</div>
		</div>
	</div>
</div>

@endsection