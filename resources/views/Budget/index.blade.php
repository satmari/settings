@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center">
			<div class="panel panel-default">
				<div class="panel-heading">Budget table</div>

				@if(Auth::check() && Auth::user()->name == "admin")
					<p><a href="{{ url('budget_import') }}" class="btn btn-info btn-xs ">Import/Update Budget from Excel file</a>
					</p>
					<a href="{{ url('add_budget') }}" class="btn btn-info btn-xs ">Add one new week</a>
					
					
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
				           {{-- <td>id</td> --}}
				           
				           <td>YMW</td>
				           <td>Y</td>
				           <td>M</td>
				           <td>W</td>
				           <td>Worked days [days]</td>
				           <td>New Modules</td>
				           <td>Modules Total</td>
				           <td>Operators</td>
				           <td>Available Minutes [min]</td>
				           <td>Absenteeism [%]</td>
				           <td>Turnover Gap [%]</td>
				           <td>Available Minutes (with Abs and Gap) [min]</td>
				           <td>Budget Eff [%]</td>
				           <td>Worked Minutes [min]</td>
				           <td>Pieces Produced [pcs]</td>
				           <td>Prod.C - New Modules [%]</td>
				           <td>Prod.C - Flash [%]</td>
				           <td>Prod.C - Fashion [%]</td>
				           <td>Prod.C - Basic Order [%]</td>
				           <td>Eff - New Modules [%]</td>
				           <td>Eff - Flash [%]</td>
				           <td>Eff - Fashion [%]</td>
				           <td>Eff - Basic Order [%]</td>
				           <td>First work day</td>
				           
				           <td></td>
				        </tr>
				    </thead>
				    <tbody class="searchable">
				    
				    @foreach ($data as $d)
				    	
				        <tr>
				        	{{-- <td>{{ $d->id }}</td> --}}
				        	
				            <td>{{ $d->ymw }} </td>
				            <td>{{ $d->year }} </td>
				            <td>{{ $d->month }} </td>
				            <td>{{ $d->week }} </td>
				            <td>{{ $d->worked_days }} </td>
				            <td>{{ number_format($d->new_modules,2) }} </td>
				            <td>{{ number_format($d->modules_total,2) }} </td>
				            <td>{{ $d->operators }} </td>
				            <td>{{ $d->available_minutes }} </td>
				        	<td>{{ number_format($d->absenteeism,2)*100 }} </td>
				        	<td>{{ number_format($d->turnover_gap,2)*100 }} </td>
				        	<td>{{ $d->available_minutes_abs_gap }} </td>
				        	<td>{{ number_format($d->budget_eff,4)*100 }} </td>
				        	<td>{{ number_format($d->worked_minutes,2) }} </td>
				        	<td>{{ number_format($d->pieces_produced,2) }} </td>
				        	<td>{{ number_format($d->prod_cap_new_modules,2)*100 }} </td>
				        	<td>{{ number_format($d->prod_cap_flash,2)*100 }} </td>
				        	<td>{{ number_format($d->prod_cap_fashion,2)*100 }} </td>
				        	<td>{{ number_format($d->prod_cap_basic,2)*100 }} </td>
				        	<td>{{ number_format($d->eff_new_modules,2)*100 }} </td>
				        	<td>{{ number_format($d->eff_flash,2)*100 }} </td>
				        	<td>{{ number_format($d->eff_fashion,2)*100 }} </td>
				        	<td>{{ number_format($d->eff_basic,2)*100 }} </td>
				        	<td>{{ $d->first_work_day }} </td>


				        	<td>
				        	@if(Auth::check())
				        	  	<a href="{{ url('edit_budget/'.$d->id) }}" class="btn btn-info btn-xs center-block">Edit</a>
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