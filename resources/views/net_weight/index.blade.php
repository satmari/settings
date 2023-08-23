@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center">
			<div class="panel panel-default">
				<div class="panel-heading">Net weight comparison
					<a href="{{ url('net_weight_save') }}" class="btn btn-info btn-xs ">Refresh table</a>
					<a href="{{ url('net_weight_int') }}" class="btn btn-info btn-xs ">Int table</a>
				</div>

				@if(Auth::check() && Auth::user()->name == "admin")
					 
				@endif

                <div class="input-group"> <span class="input-group-addon">Filter</span>
                    <input id="filter" type="text" class="form-control" placeholder="Type here...">
                </div>
                <table class="table table-striped table-bordered" id="sort" 
                data-show-export="true"
                data-export-types="['excel','csv','txt']"
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
				           
				           <th>(box) Material</th>

				           <th>(box) Brand</th>
				           <th>(box) Weight Poly</th>
				           <th>(box) Weight PCS</th>
				           
				           <th>(int) Material</th>
				           <th>(int) Material2</th>
				           <th>(int) Weight</th>
				           
				           <th>(sap) Material</th>
				           <th>(sap) Weight</th>

				           <th>(int)-(sap)</th>
				           <th>(int)-(box)</th>
				           <th>(box)-(sap)</th>
				           
				           <!-- <th></th> -->
				        </tr>
				    </thead>
				    <tbody class="searchable">
				    
				    @foreach ($data as $d)
				    	
				        <tr>
				        	{{-- <td>{{ $d->id }}</td> --}}
				        	
				        	<td><span style="color:blue">{{ str_replace(' ', '&nbsp;' , $d->box_sku) }}</span></td>

				        	<td><span style="color:blue">{{ $d->brand }}</span></td>
				        	<td><span style="color:blue">{{ number_format($d->box_weight_poly,3) }}</span></td>
				        	<td><span style="color:blue">{{ number_format($d->box_weight,3) }}</span></td>

				        	<td><span style="color:green">{{ str_replace(' ', '&nbsp;' , $d->int_sku)}}</span></td>
				        	<td><span style="color:green">{{ $d->StyCod.' '.$d->Variant}}</span></td>
				        	<td><span style="color:green">{{ number_format($d->int_weight,3) }}</span></td>

				        	<td><span style="color:orange">{{ str_replace(' ', '&nbsp;' , $d->sap_material) }}</span></td>
				        	<td><span style="color:orange">{{ number_format($d->sap_net_weight,3) }}</span></td>

				        	
				        	<td><span style="color:red">{{ round(number_format($d->int_weight,3)-number_format($d->sap_net_weight,3),3) }}</span></td>
				        	<td><span style="color:red">{{ round(number_format($d->int_weight,3)-number_format($d->box_weight,3),3) }}</span></td>
				        	
				        	<td><span style="color:red">{{ round(number_format($d->box_weight,3)-number_format($d->sap_net_weight,3),3) }}</span></td>
				   
						</tr>
				    
				    @endforeach
				    </tbody>

				</table>
			</div>
		</div>
	</div>
</div>

@endsection