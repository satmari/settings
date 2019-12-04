@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center">
			<div class="panel panel-default">
				<div class="panel-heading">Inteos PO table</div>

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
				           
				           <th>PO</th>
				           <th>Variant</th>
				           <th>PO Status</th>
				           <th>BB Creation Status</th>
				           
				           
				           
				           <th></th>
				        </tr>
				    </thead>
				    <tbody class="searchable">
				    
				    @foreach ($data as $d)
				    	
				        <tr>
				        	{{-- <td>{{ $d->intkey }}</td> --}}
				        	
				        	<td>{{ $d->pon}} </td>
				        	<td>{{ $d->variant }} </td>
				        	<td>
				        		@if ($d->poclose == "1")
				        		Closed
				        		@else
				        		Open
				        		@endif

				        	</td>
				        	<td>
				        		@if ($d->bbstatus == "1")
				        		Looked
				        		@else
				        		Unloocked
				        		@endif
				        	</td>
				        	
				        	
				        	<td>
				        	@if(Auth::check())
				        	  	<a href="{{ url('edit_po_bbstatus/'.$d->pon) }}" class="btn btn-info btn-xs center-block">Edit</a>
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