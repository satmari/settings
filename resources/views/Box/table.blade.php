@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center">
			<div class="panel panel-default">
				<div class="panel-heading">Box configuretion table</div>

				@if((Auth::check() && Auth::user()->name == "admin") OR ( Auth::check() && Auth::user()->name == "magacin"))
					<a href="{{ url('add_box') }}" class="btn btn-info btn-xs ">Add new box configuration</a>
					<a href="{{ url('box') }}" class="btn btn-success btn-xs ">Back</a>
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
				           
				           {{--<th>SAP code</th>--}}
				           <th>Style</th>
				           <th>Color</th>
				           <th>Size</th>
				           <th>Brand</th>

				           <th>Pcs per polybag</th>
				           <th>Weight of polybag</th>
				           <th>Weight of 1 pcs</th>

				           <th>Pcs per box</th>
				           <th>Status</th>

				           <th>Created at</th>
				           <th>Updated at</th>

				           <th>Edit</th>

				        </tr>
				    </thead>
				    <tbody class="searchable">
				    
				    @foreach ($data as $d)
				    	
				        <tr>
				        	{{-- <td>{{ $d->id }}</td> --}}

				        	{{--<td>{{ $d->material }}</td>--}}
							<td>{{ $d->style }}</td>
				        	<td>{{ $d->color }}</td>
				        	<td>{{ $d->size }}</td>
				        	<td>{{ $d->brand }} </td>

				        	<td>{{ $d->pcs_per_polybag }}</td>
				        	<td>{{ round($d->weight_of_polybag,3) }}</td>
				        	<td>{{ round($d->weight_of_pcs,3) }}</td>

				        	<td>{{ $d->pcs_per_box }}</td>
				        	<td>{{ $d->status }}</td>

				        	<td>{{ substr($d->created_at,0 , 10) }}</td>
				        	<td>{{ substr($d->updated_at,0 , 10) }}</td>
				        	
				        	<td>
				        	@if(Auth::check())
				        	  	<a href="{{ url('edit_box/'.$d->id) }}" class="btn btn-info btn-xs center-block">Edit</a>
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
