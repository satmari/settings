@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center">
			<div class="panel panel-default">
				<div class="panel-heading">Machies table</div>

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
				           
				           <th>OS</th>
				           <th>Brand</th>
				           <th>Type</th>
				           <th>Code</th>
				           <th ><span>Sub. Status</span></th>
				           <th ><span>Sub. Machine Status</span></th>
				           <th ><span>Sub. Line</span></th>
				           <th ><span>Sub. Pos.</span></th>
				           <th ><span>Kik. Status</span></th>
				           <th ><span>Kik. Machine Status</span></th>
				           <th ><span>Kik. Line</span></th>
				           <th ><span>Kik. Pos.</span></th>
				           <th>Problems</th>
				           
				        </tr>
				    </thead>
				    <tbody class="searchable">
				    
				    @foreach ($os as $d)
				    	
				        <tr>
				        	{{-- <td>{{ $d->id }}</td> --}}
				        	
				        	<td><b>{{ $d->MachNum }}</b> </td>
				        	<td>{{ $d->Brand }} </td>
				        	<td>{{ $d->MaTyp }} </td>
				        	<td>{{ $d->MaCod }} </td>
				        	<td ><span style="color: blue"><b>{{ $d->Subotica_main_status }}</b> </span></td>
				        	<td ><span style="color: blue">{{ $d->Subotica_status }} </span></td>
				        	<td ><span style="color: blue">{{ $d->Subotica_line }} </span></td>
				        	<td ><span style="color: blue">{{ $d->Subotica_pos }} </span></td>
				        	<td ><span style="color: green"><b>{{ $d->Kikinda_main_status }} </b></span></td>
				        	<td ><span style="color: green">{{ $d->Kikinda_status }} </span></td>
				        	<td ><span style="color: green">{{ $d->Kikinda_line }} </span></td>
				        	<td ><span style="color: green">{{ $d->Kikinda_pos }} </span></td>
				        	<td> 

				        		@if ($d->Subotica_main_status == $d->Kikinda_main_status)
				        			<span style='color:red'>Problem in Status</span>
				        		@endif
				        		@if (($d->Subotica_line !=  '') AND ($d->Kikinda_line != '') )
				        			<span style='color:red'>Problem with link</span>
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