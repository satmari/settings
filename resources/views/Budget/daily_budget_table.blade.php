@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center">
			<div class="panel panel-default">
				<div class="panel-heading">Daily Budget table</div>


					<p><a href="{{ url('import_budget') }}" class="btn btn-info btn-xs ">Import from Excel file</a>
					
					


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
				           {{-- <td>id</td> --}}
				           
				           <!-- <td>key</td> -->
				           <td>plant_date</td>
				           <td>plant_year_month_week</td>
				           <td>plant</td>
				           <td>Y</td>
				           <td>M</td>
				           <td>W</td>
				           <td>week_day</td>
				           <td>date</td>

				           <td>working_day</td>
				           <td>total_lines</td>
				           <td>total_operators</td>

				           <td>absenteeism</td>
				           <td>turnover</td>

				           <td>available_min</td>
				           <td>average_eff</td>
				           <td>worked_min</td>
				           <td>average_smv_per_garment</td>
				           <td>pieces_produced</td>
				           <td>updated</td>
				           <td>created</td>
				           
				        </tr>
				    </thead>
				    <tbody class="searchable">
				    
				    @foreach ($data as $d)
				    	
				        <tr>
				        	{{-- <td>{{ $d->id }}</td> --}}
				        	
				            <td>{{ $d->plant_date }} </td>
				            <td>{{ $d->plant_year_month_week }} </td>
				            <td>{{ $d->plant }} </td>
				            <td>{{ $d->year }} </td>
				            <td>{{ $d->month }} </td>
				            <td>{{ $d->week }} </td>
				            <td>{{ $d->week_day }} </td>
				            <td>{{ $d->date }} </td>

				            <td>{{ $d->working_day }} </td>
				            <td>{{ number_format($d->total_lines,0) }} </td>
				            <td>{{ number_format($d->total_operators,0) }} </td>

				            <td>{{ number_format($d->absenteeism,2) }} </td>
				            <td>{{ number_format($d->turnover,3) }} </td>

				            <td>{{ $d->available_min }} </td>
				            <td>{{ number_format($d->average_eff,2) }} </td>
				            <td>{{ $d->worked_min }} </td>
				            <td>{{ $d->average_smv_per_garment }} </td>
				            <td>{{ $d->pieces_produced }} </td>
				            <td>{{ $d->updated_at }} </td>
				            <td>{{ $d->created_at }} </td>
						</tr>
				    
				    @endforeach
				    </tbody>

				</table>
			</div>
		</div>
	</div>
</div>

@endsection