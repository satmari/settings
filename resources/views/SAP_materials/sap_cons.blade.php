@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center">
			<div class="panel panel-default">
				<div class="panel-heading"><b>SAP Material - Consumable mat (RSCM)</b> <br><i>Last update:<span style="color:red"><b>{{ $updatedat }}</b></span></i> </div>

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
				           <th>Desc</th>
				           <th>Responsibility</th>
				           <!-- <th>Old mat</th> -->
				           
				           <th>Subotica Qty</th>
				           <th>Kikinda Qty</th>
				           <th>Total</th>
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

				        	<td>{{ round($d->Subotica,2) }}</td>
				        	<td>{{ round($d->Kikinda,2) }}</td>
				        	<td>{{ round($d->Subotica+$d->Kikinda,2)}}</td>
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