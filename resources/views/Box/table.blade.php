@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center">
			<div class="panel panel-default">
				<div class="panel-heading">Box configuration table</div>

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
				           <th><span style="color:green">SKU</span></th>
				           <th>Brand</th>

				           <th><span style="color:green">Pcs per polybag</span></th>
				           <th><span style="color:green">Pcs per box</span></th>

				           <th>Weight of polybag</th>
				           <th>Weight of 1 pcs</th>

				           <th>Status</th>

				           <th>Created at</th>
				           <th>Updated at</th>

				           <th><span style="color:red">SKU (2Q)</span></th>
				           <th><span style="color:red">Ean(2Q)</span></th>

				           <th><span style="color:red">Pcs per polybag(2Q)</span></th>
				           <th><span style="color:red">Pcs per box(2Q)</span></th>
				           <th><span style="color:red">Barcode type</span></th>



				           <th></th>
				           <th></th>

				        </tr>
				    </thead>
				    <tbody class="searchable">
				    
				    @foreach ($data as $d)
				    	
				        <tr>
				        	{{-- <td>{{ $d->id }}</td> --}}

				        	{{--<td>{{ $d->material }}</td>--}}
							<td><span style="color:green"><pre>{{ $d->sku }}</pre></span></td>
				        	<td>{{ $d->brand }} </td>

				        	<td><span style="color:green">{{ $d->pcs_per_polybag }}</span></td>
				        	<td><span style="color:green">{{ $d->pcs_per_box }}</span></td>
				        	
				        	<td>{{ round($d->weight_of_polybag,3) }}</td>
				        	<td>{{ round($d->weight_of_pcs,3) }}</td>
				        	
				        	<td>{{ $d->status }}</td>

				        	<td>{{ substr($d->created_at,0 , 10) }}</td>
				        	<td>{{ substr($d->updated_at,0 , 16) }}</td>

				        	<td><span style="color:red"><pre>{{ $d->sku_2 }}</pre></span></td>
				        	<td><span style="color:red">{{ $d->ean_2 }}</span></td>

				        	<td><span style="color:red">{{ $d->pcs_per_polybag_2 }}</span></td>
				        	<td><span style="color:red">{{ $d->pcs_per_box_2 }}</span></td>
				        	<td><span style="color:red">{{ $d->barcode_type }}</span></td>
				        	
				        	<td>
				        	@if(Auth::check())
				        	  	<a href="{{ url('edit_box/'.$d->id) }}" class="btn btn-success btn-xs center-block">Edit 1 Quality</a>
				        	@endif
				        	</td>
				        	
				        	<td>
				        	@if(Auth::check())
				        	  	
                                {!! Form::open(['method'=>'POST', 'url'=>'/edit_box2' ]) !!}
                                    {!! Form::hidden('style', $d->style, ['class' => 'form-control']) !!}
                                    {!! Form::hidden('color', $d->color, ['class' => 'form-control']) !!}
                                    {!! Form::hidden('size', $d->size, ['class' => 'form-control']) !!}

                                    {!! Form::submit('Edit 2 Quality', ['class' => 'btn btn-danger btn-xs center-block ']) !!}
                                    @include('errors.list')
                                {!! Form::close() !!}
                            
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
