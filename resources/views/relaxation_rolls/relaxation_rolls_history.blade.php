@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color: #23cf01">Relaxation rolls table - last 7 days</div>

					
					<a href="javascript:history.go(-1)">Go Back</a>			
			
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
				           
				           <th>SU</th>
						   <th>Material</th>
				           <th>Mat Description</th>
				           <th>Batch</th>
				           <th>Qty</th>
				           <th>UoM</th>
				           <th>R number</th>
				           <th>Created</th>
				           
				        </tr>
				    </thead>
				    <tbody class="searchable">
				    
				    @foreach ($data as $d)
				    	
				        <tr>
				        	{{-- <td>{{ $d->id }}</td> --}}
				        	
				        	<td>{{ $d->su }} </td>
				            <td>{{ $d->material }} </td>
				            <td>{{ $d->material_desc }} </td>
				            <td>{{ $d->batch }} </td>
				            <td>{{ round($d->qty,3) }} </td>
				            <td>{{ $d->uom }} </td>				            
				            <td>{{ $d->rnumber }} </td>
				            <td>{{ $d->created_at }} </td>			

						</tr>
				    
				    @endforeach
				    </tbody>

				</table>
			</div>
		</div>
	</div>
</div>

@endsection