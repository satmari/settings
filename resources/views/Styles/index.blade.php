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
				           
				           <th data-sortable="true">Style</th>
				           <th data-sortable="true">Brand</th>
				           <th data-sortable="true">Cutting SMV</th>
				           <th data-sortable="true">Cluster</th>
				           <th data-sortable="true">Order Type</th>
				           <th data-sortable="true">FG family</th>
				           <th data-sortable="true">Spreading method</th>
				           <th data-sortable="true">Standard BB qty</th>
				           <th data-sortable="true">Pad print</th>
				           <th data-sortable="true">Bansek</th>
				           <th data-sortable="true">Adeziv</th>
				           <th data-sortable="true">Status</th>
				           <th data-sortable="true">Image file</th>
				           
				           <th></th>
				           
				           <th></th>
				           <th></th>
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

				        	<td>{{ $d->status}} </td>
				        	<td>{{ $d->image}} </td>
				        	<td> <a href="{{ url('/public/storage/StyleImages/'.$d->image ) }}" target="_blank" onClick="javascript:window.open('{{ url('/public/storage/StyleImages/'.$d->image ) }}','Windows','width=650,height=350,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,directories=no,status=no');return false" ) >show image</a> </td>

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
