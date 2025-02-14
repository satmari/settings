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
                <table class="table table-striped table-bordered" id="sort" style="font-size: 9px !important;"
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
				           <th>Mat desc</th>
				           <th>Fab type</th>
				           <th style="background-color: aliceblue">Mat1</th>
				           <th style="background-color: aliceblue">Mat1 desc</th>
				           <th style="background-color: aliceblue">Mat1 [%]</th>
				           <th>Mat2</th>
				           <th>Mat2 desc</th>
				           <th>Mat2 [%]</th>
				           <th style="background-color: aliceblue">Mat3</th>
				           <th style="background-color: aliceblue">Mat3 desc</th>
				           <th style="background-color: aliceblue">Mat3 [%]</th>
				           <th>Mat4</th>
				           <th>Mat4 desc</th>
				           <th>Mat4 [%]</th>
				           <th style="background-color: aliceblue;">Tot width</th>
				           <th style="background-color: aliceblue;">Usable width</th>
				           <th style="background-color: aliceblue;">Actual width</th>
				           <th style="background-color: aliceblue;">Average length</th>
				           <th>Shr.dry O [%]</th>
				           <th>Shr.dry W [%]</th>
				           <th>Shr.dry Tol</th>
				           <th>Shr.st O [%]</th>
				           <th>Shr.st W [%]</th>
				           <th>Shr.st Tol</th>
				           <th style="background-color: aliceblue;">Relax.</th>
				           <th>MQ Weight</th>
				           <th>QC [%]</th>
				           <th style="background-color: aliceblue;">Date of up QC</th>
				           <th>Supplier</th>
				           <th>Sample</th>
				           {{-- <th>Labels to gen.</th> --}}
				           <th>Daying type</th>
				           <th>Main mat</th>
				           <th>SP parameter</th>
				           <th>Info for SP and CUT</th>
				           <th>Fab Family</th>

				           
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
				        	<td>{{ $d->fabric_type }} </td>
				        	<td style="background-color: aliceblue;">{{ $d->mat1 }} </td>
				        	<td style="background-color: aliceblue">{{ $d->mat1_description }} </td>
				        	<td style="background-color: aliceblue">{{ number_format($d->mat1_p,2)*100 }}</td>
				        	<td>{{ $d->mat2 }} </td>
				        	<td>{{ $d->mat2_description }} </td>
				        	<td>{{ number_format($d->mat2_p,2)*100 }} </td>
				        	<td style="background-color: aliceblue">{{ $d->mat3 }} </td>
				        	<td style="background-color: aliceblue">{{ $d->mat3_description }} </td>
				        	<td style="background-color: aliceblue">{{ number_format($d->mat3_p,2)*100 }} </td>
				        	<td>{{ $d->mat4 }} </td>
				        	<td>{{ $d->mat4_description }} </td>
				        	<td>{{ number_format($d->mat4_p,2)*100 }} </td>
				        	<td style="background-color: aliceblue;">{{ number_format($d->tot_width,2) }} </td>
				        	<td style="background-color: aliceblue;">{{ number_format($d->usable_width,2) }} </td>
				        	<td style="background-color: aliceblue;">{{ number_format($d->actual_width,2) }} </td>
				        	<td style="background-color: aliceblue;">{{ number_format($d->avg_length,2) }} </td>
				        	<td>{{ number_format($d->shrinkage_dry_o,2)*100 }} </td>
				        	<td>{{ number_format($d->shrinkage_dry_w,2)*100 }} </td>
				        	<td>{{ $d->shrinkage_dry_tol }} </td>
				        	<td>{{ number_format($d->shrinkage_steam_o,2)*100 }} </td>
				        	<td>{{ number_format($d->shrinkage_steam_w,2)*100 }} </td>
				        	<td>{{ $d->shrinkage_steam_tol }} </td>
				        	<td style="background-color: aliceblue;">{{ $d->relaxation }} </td>
				        	<td>{{ $d->mq_weight }} </td>
				        	<td>{{ number_format($d->to_be_checked_on_qc_p,2)*100 }} </td>
				        	<td style="background-color: aliceblue;">{{ $d->date_of_update_qc_p }} </td>
				        	<td>{{ $d->supplier_truck }} </td>
				        	{{--<td>{{ $d->labels_to_genetate }} </td> --}}
				        	<td>{{ $d->sample }} </td>
				        	<td>{{ $d->daying_type }} </td>
				        	<td>{{ $d->main_material }} </td>
				        	<td>{{ $d->sp_parameter }} </td>
				        	<td>{{ $d->info_for_sp_and_cut }} </td>
				        	<td>{{ $d->fabric_family }} </td>

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