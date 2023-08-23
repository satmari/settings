@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color: #ffa90cb5">SAP Inventory table (Kikinda acc)</div>

			
					<a href="{{ url('import_inventory_p') }}" class="btn btn-info btn-xs ">Import inventory database</a>
					<a href="{{ url('inventory_scan_p') }}" class="btn btn-success btn-xs ">Inventory scan</a>
										
			
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
				           <th>Mat Description</th>
				           <th>SU</th>
				           <th>Batch</th>
				           <th>UoM</th>
				           
				           <th>Storage Bin</th>
				           <th><span style="color: red">Storage Bin Actual</span></th>
				           
				           <th>Available stock</th>
				           <th><span style="color: red">Actual Qty</span></th>
				           
				           <th>Counter</th>
				        </tr>
				    </thead>
				    <tbody class="searchable">
				    
				    @foreach ($data as $d)
				    	
				        <tr>
				        	{{-- <td>{{ $d->id }}</td> --}}
				        	
				            <td>{{ $d->material }} </td>
				            <td>{{ $d->material_desc }} </td>
				            <td>{{ $d->su }} </td>
				            <td>{{ $d->batch }} </td>
				            <td>{{ $d->uom }} </td>				            

				            <td>{{ $d->bin }} </td>
				            <td><span style="color: red">{{ $d->bin_actual }}</span></td>

				            <td>{{ round($d->qty,3) }} </td>
				            <td><span style="color: red">{{ round($d->qty_actual,3) }} </span></td>

				            <td>{{ $d->counter }} </td>
						</tr>
				    
				    @endforeach
				    </tbody>

				</table>
			</div>
		</div>
	</div>
</div>

@endsection