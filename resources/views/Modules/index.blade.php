@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center">
			<div class="panel panel-default">
				<div class="panel-heading">Lines table</div>

				@if(Auth::check() && Auth::user()->name == "admin")
					<a href="{{ url('add_module') }}" class="btn btn-info btn-xs ">Add new line</a>
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
				           
				           <th>Sort Order</th>
				           <th>Line/Module</th>
				           <th>Team/Shift</th>
				           <th>Row</th>
				           <th>Column Group</th>
				           <th>Sector</th>
				           <th>Workstudy</th>
				           <th>Line leader</th>
				           <th>Supervisor</th>
				           <th>Updated</th>
				           
				           <th></th>
				        </tr>
				    </thead>
				    <tbody class="searchable">
				    
				    @foreach ($data as $d)
				    	
				        <tr>
				        	{{-- <td>{{ $d->id }}</td> --}}
				        	
				        	<td>{{ $d->sort_order }} </td>
				        	<td>{{ $d->module }} </td>
				        	<td>{{ $d->team }} </td>
				        	<td>{{ $d->row }} </td>
				        	<td>{{ $d->column_group }} </td>
				        	<td>{{ $d->sector }} </td>
				        	<td>{{ $d->workstudy }} </td>
				        	<td>{{ $d->line_leader }} </td>
				        	<td>{{ $d->supervisor }} </td>
				        	<td>{{ $d->updated_at }}</td>

				        	<td>
				        	@if(Auth::check())
				        	  	<a href="{{ url('edit_module/'.$d->id) }}" class="btn btn-info btn-xs center-block">Edit</a>
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