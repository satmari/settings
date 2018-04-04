@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center">
			<div class="panel panel-default">
				<div class="panel-heading">Fast React plan table</div>

				@if(Auth::check() && Auth::user()->name == "admin")
					<p><a href="{{ url('fr_plan_import') }}" class="btn btn-info btn-xs ">Import/Update FR plan from Excel file</a>
					</p>
					<a href="{{ url('add_fr_plan') }}" class="btn btn-info btn-xs ">Add new line</a>
					
					
				@endif

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
				           
				           <th>Plan key</th>
				           <th>Module</th>
				           <th>Order</th>
				           <th>SKU</th>
				           <th>Date</th>
				           <th>Qty</th>
				           
				           <th></th>
				        </tr>
				    </thead>
				    <tbody class="searchable">
				    
				    @foreach ($data as $d)
				    	
				        <tr>
				        	{{-- <td>{{ $d->id }}</td> --}}
				        	
				            <td>{{ $d->plan_key }} </td>
				            <td>{{ $d->module }} </td>
				            <td>{{ $d->order }} </td>
				            <td>{{ $d->sku }} </td>
				            <td>{{ $d->plan_date }} </td>
				            <td>{{ $d->qty }} </td>
				            

				        	<td>
				        	@if(Auth::check())
				        	  	<a href="{{ url('edit_fr_plan/'.$d->id) }}" class="btn btn-info btn-xs center-block">Edit</a>
				        	@endif
				        	</td>
						</tr>
				    
				    @endforeach
				    </tbody>

				</table>
			</div>
		</div>
	</div>
</div>

@endsection