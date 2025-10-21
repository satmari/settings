@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center">
			<div class="panel panel-default">
				<div class="panel-heading">Styles table</div>

				@if(Auth::check() && Auth::user()->name == "admin")
					<a href="{{ url('add_style') }}" class="btn btn-info btn-xs ">Add new style</a>
					<a href="{{ url('import_styles') }}" class="btn btn-danger btn-xs ">Import style table</a>
					<a href="{{ url('update_status_for_styles') }}" class="btn btn-warning btn-xs ">Update style status from POsummary</a>
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
						    {{-- <th data-field="id">ID</th> --}}
						    <th data-field="style" data-sortable="true">Style</th>
						    <th data-field="brand" data-sortable="true">Brand</th>
						    <th data-field="cutting_smv" data-sortable="true">Cutting SMV</th>
						    <th data-field="cluster" data-sortable="true">Cluster</th>
						    <th data-field="order_type" data-sortable="true">Order Type</th>
						    <th data-field="fg_family" data-sortable="true">FG family</th>
						    <th data-field="sp_method" data-sortable="true">Sp method</th>
						    <th data-field="st_bb_qty" data-sortable="true">St BB qty</th>
						    <th data-field="pad_print" data-sortable="true">Pad print</th>
						    <th data-field="bansek" data-sortable="true">Bansek</th>
						    <th data-field="adeziv" data-sortable="true">Adeziv</th>
						    <th data-field="paspul" data-sortable="true">Paspul</th>
						    <th data-field="second_mat" data-sortable="true">2nd mat</th>
						    <th data-field="bonding" data-sortable="true">Bonding</th>
						    <th data-field="preprod" data-sortable="true">Preprod</th>
						    <th data-field="status" data-sortable="true">Status</th>
						    <th data-field="image_file" data-sortable="true">Image file</th>
						    <th data-field="actions1"></th> <!-- e.g. buttons or links -->
						    <th data-field="actions2"></th> <!-- e.g. buttons or links -->
						    <th data-field="actions3"></th> <!-- e.g. buttons or links -->
						</tr>
				    </thead>
				    <tbody class="searchable">
				    
				    @foreach ($data as $d)
				        <tr>
				        	{{-- <td>{{ $d->id }}</td> --}}
				        	
				        	<td>{{ $d->style }} </td>
				        	<td>{{ $d->brand }} </td>
				        	<td>{{ number_format($d->cutting_smv, 3) }} </td>
				        	<td>{{ $d->cluster }} </td>
				        	<td>{{ $d->order_type}} </td>
				        	<td>{{ $d->fg_family}} </td>
				        	<td>{{ $d->spreading_method}} </td>
				        	<td>{{ $d->standard_bb_qty}} </td>
				        	<td>{{ $d->pad_print}} </td>
				        	<td>{{ $d->bansek}} </td>
				        	<td>{{ $d->adeziv}} </td>

				        	<td>{{ $d->paspul}} </td>
				        	<td>{{ $d->material_2nd}} </td>
				        	<td>{{ $d->bonding}} </td>
				        	<td>{{ $d->preproduction}} </td>
				        	<td>{{ $d->status}} </td>
				        	<td>{{ $d->image}} </td>
				        	<td> <a href="{{ url('/public/storage/StyleImages/'.$d->image ) }}" target="_blank" onClick="javascript:window.open('{{ url('/public/storage/StyleImages/'.$d->image ) }}','Windows','width=650,height=350,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,directories=no,status=no');return false" ) >show image</a> 
				        	</td>
				        	<td>
					        	@if(Auth::check())
					        	  	<a href="{{ url('edit_style/'.$d->id) }}" class="btn btn-info btn-xs center-block">Edit</a>
					        	@endif
				        	</td>
				        	<td>
					        	@if(Auth::check())
					        		<a href="{{ url('upload_image/'.$d->id) }}" class="btn btn-info btn-xs center-block">Upload image</a>
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
