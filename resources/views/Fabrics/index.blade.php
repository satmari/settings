@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center">
			<div class="panel panel-default">
				<div class="panel-heading">Fabrics table</div>

				@if(Auth::check() && Auth::user()->name == "admin")
					<a href="{{ url('add_fabric') }}" class="btn btn-info btn-xs ">Add new fabric</a>
					<p><a href="{{ url('refreshfabrics') }}" class="btn btn-warning btn-xs ">Refresh data</a></p>
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
				           
				           <th>Fabric</th>
				           <th>Supplier</th>
				           <th>Material desc</th>
				           <th style="background-color:#efefff">Mat1</th>
				           <th style="background-color:#efefff">Mat1 desc</th>
				           <th style="background-color:#efefff">Mat1 [%]</th>
				           <th style="background-color:#effff5">Mat2</th>
				           <th style="background-color:#effff5">Mat2 desc</th>
				           <th style="background-color:#effff5">Mat2 [%]</th>
				           <th style="background-color:#fbffef">Mat3</th>
				           <th style="background-color:#fbffef">Mat3 desc</th>
				           <th style="background-color:#fbffef">Mat3 [%]</th>
				           <th style="background-color:#fff6ef">Mat4</th>
				           <th style="background-color:#fff6ef">Mat4 desc</th>
				           <th style="background-color:#fff6ef">Mat4 [%]</th>
				           <th>Tot width</th>
				           <th>Usable width</th>
				           <th>Shr.dry O [%]</th>
				           <th>Shr.dry W [%]</th>
				           <th>Shr.dry Tol</th>
				           <th>Shr.steam O [%]</th>
				           <th>Shr.steam W [%]</th>
				           <th>Shr.steam Tol</th>
				           <th>Relax.</th>
				           <th>To be checked on QC [%]</th>
				           <th>Date of update QC</th>
				           <th>Supplier truck</th>
				           <!-- <th>Labels to gen.</th> -->
				           <th>Daying type</th>
				           
				           <th></th>
				        </tr>
				    </thead>
				    <tbody class="searchable">
				    
				    @foreach ($data as $d)
				    	
				        <tr>
				        	{{-- <td>{{ $d->id }}</td> --}}
				        	
				            <td>{{ $d->fabric }} </td>
				        	<td>{{ $d->supplier }} </td>
				        	<td>{{ $d->material_description }} </td>
				        	<td style="background-color:#efefff">{{ $d->mat1 }} </td>
				        	<td style="background-color:#efefff">{{ $d->mat1_description }} </td>
				        	<td style="background-color:#efefff">{{ number_format($d->mat1_p,2)*100 }}</td>
				        	<td style="background-color:#effff5">{{ $d->mat2 }} </td>
				        	<td style="background-color:#effff5">{{ $d->mat2_description }} </td>
				        	<td style="background-color:#effff5">{{ number_format($d->mat2_p,2)*100 }} </td>
				        	<td style="background-color:#fbffef">{{ $d->mat3 }} </td>
				        	<td style="background-color:#fbffef">{{ $d->mat3_description }} </td>
				        	<td style="background-color:#fbffef">{{ number_format($d->mat3_p,2)*100 }} </td>
				        	<td style="background-color:#fff6ef">{{ $d->mat4 }} </td>
				        	<td style="background-color:#fff6ef">{{ $d->mat4_description }} </td>
				        	<td style="background-color:#fff6ef">{{ number_format($d->mat4_p,2)*100 }} </td>
				        	<td>{{ number_format($d->tot_width,2) }} </td>
				        	<td>{{ number_format($d->usable_width,2) }} </td>
				        	<td>{{ number_format($d->shrinkage_dry_o,2)*100 }} </td>
				        	<td>{{ number_format($d->shrinkage_dry_w,2)*100 }} </td>
				        	<td>{{ $d->shrinkage_dry_tol }} </td>
				        	<td>{{ number_format($d->shrinkage_steam_o,2)*100 }} </td>
				        	<td>{{ number_format($d->shrinkage_steam_w,2)*100 }} </td>
				        	<td>{{ $d->shrinkage_steam_tol }} </td>
				        	<td>{{ $d->relaxation }} </td>
				        	<td>{{ number_format($d->to_be_checked_on_qc_p,2)*100 }} </td>
				        	<td>{{ $d->date_of_update_qc_p }} </td>
				        	<td>{{ $d->supplier_truck }} </td>
				        	{{-- <td>{{ $d->labels_to_genetate }} </td> --}}
				        	<td>{{ $d->daying_type }} </td>

				        	<td>
				        	@if(Auth::check())
				        	  	<a href="{{ url('edit_fabric/'.$d->id) }}" class="btn btn-info btn-xs center-block">Edit</a>
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