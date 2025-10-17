@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center">
			<div class="panel panel-default">
				<div class="panel-heading">
					&nbsp;&nbsp;&nbsp;
				
					<a href="{{ url('lockers_ki') }}" class="btn btn-warning btn-xs " disabled>List with all lockers</a>
					&nbsp;&nbsp;&nbsp;
					<a href="{{ url('lockers_ki_empty') }}" class="btn btn-warning btn-xs ">List with available lockers</a>
				</div>
				<br>
				
				@if(Auth::check() && Auth::user()->name == "maja")
					<a href="{{ url('lockers_ki_add') }}" class="btn btn-danger btn-xs ">Add new locker to list</a>
				@endif
				&nbsp;&nbsp;&nbsp;

				<a href="{{ url('lockers_ki_scan') }}" class="btn btn-info btn-xs ">Assign locker to employee (with scanner)</a>

                <div class="input-group"> <span class="input-group-addon">Filter</span>
                    <input id="filter" type="text" class="form-control" placeholder="Type here...">
                </div>
                <table class="table table-striped table-bordered" id="sort" style="font-size: 18px !important;"
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
				           
				           <!-- <th>id</th> -->
				           <!-- <th>Locker</th> -->
				           <th>Locker Number</th>
				           <th>Place</th>
				           <th>R number</th>
				           <th>Employee</th>
				           <th></th>
				        </tr>
				    </thead>
				    <tbody class="searchable">
				    
				    @foreach ($data as $d)
				    	
				        <tr>
				        	<!-- <td>{{ $d->id }}</td> -->
				        	
				            <!-- <td>{{ $d->locker }} </td> -->
				            <td>{{ $d->number }} </td>
				        	<td>{{ $d->place }} </td>
				        	<td>{{ $d->r_number }} </td>
				        	<td>{{ $d->employee }} </td>
				        	
				        	<td>
				        	@if(Auth::check() && Auth::user()->name == "maja")
				        	  	<a href="{{ url('locker_ki_edit/'.$d->id) }}" class="btn btn-info btn-xs center-block">Edit</a>
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