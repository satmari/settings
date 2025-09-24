@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center">
			<div class="panel panel-default">
				<div class="panel-heading">Z radnice table</div>

				@if(Auth::check() && Auth::user()->name == "admin")
					<a href="{{ url('zradnice') }}" class="btn btn-info btn-xs ">Update list of Z radnica from Inteos</a>&nbsp;&nbsp;
					<a href="{{ url('update_status_radnice') }}" class="btn btn-info btn-xs ">Update status of R radnica from Inteos</a>
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
				           
				           <th>Z number</th>
				           <th>Z name</th>
				           <th>Z status</th>
				           <th>R number</th>
				           <th>R name </th>
				           <th>R status</th>

				           <th>Comment</th>
				           <th>From</th>
				           <th>To</th>
				           <th>Final Status</th>
				           <th>Updated</th>
				           
				           <th></th>
				        </tr>
				    </thead>
				    <tbody class="searchable">
				    
				    @foreach ($data as $d)
				    	
				        <tr>
				        	{{-- <td>{{ $d->id }}</td> --}}
				        	
				        	<td>{{ $d->z_number }} </td>
				        	<td>{{ $d->z_name }} </td>
				        	<td>{{ $d->z_status }} </td>
				        	<td>{{ $d->r_number }} </td>
				        	<td>{{ $d->r_name }} </td>
				        	<td>{{ $d->r_status }} </td>

				        	<td>{{ $d->comment }} </td>
				        	<td>{{ substr($d->fromDate,0,10) }} </td>
				        	<td>{{ substr($d->toDate,0,10) }} </td>
				        	
				        	<td>{{ $d->final_status}} </td>
				        	
				        	<td>{{ $d->updated_at }}</td>

				        	<td>
				        	@if(Auth::check())
				        	  	<a href="{{ url('edit_zradnica/'.$d->id) }}" class="btn btn-info btn-xs center-block">Edit</a>
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