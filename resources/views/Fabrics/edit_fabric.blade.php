@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-5 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Edit fabric</b></div>
				
				
				@if(Auth::check() && Auth::user()->name == "admin")
				
					{!! Form::open(['url' => 'update_fabric/'.$data->id]) !!}
					<input type="hidden" id="_token" value="<?php echo csrf_token(); ?>">

					<div class="panel-body">
						<p>Fabric:</p>
	               		{!! Form::input('fabric', 'fabric', $data->fabric, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
					</div>
					
					<div class="panel-body">
					<p>Supplier: </p>
						 {{-- {!! Form::input('supplier','supplier', $data->supplier, ['class' => 'form-control']) !!} --}}
						 <select name="supplier" class="form-control">
			                	<option value=""></option>
			                    @foreach ($suppliers as $line)
			                    <option value="{{ $line->supplier }}" 
			                    	@if ($line->supplier == $data->supplier)
				                    selected
				                    @endif
				                    >{{ $line->supplier }}</option>
			       
			                    @endforeach
		                </select>
					</div>

	                <div class="panel-body">
						<p>Material description:</p>
						{!! Form::input('material_description','material_description', $data->material_description, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Fabric type</p>
						{!! Form::input('fabric_type', 'fabric_type', $data->fabric_type, ['class' => 'form-control']) !!}
	                </div>

	                <div class="panel-body">
						<p>Mat1:</p>
						{{-- {!! Form::input('mat1','mat1', $data->mat1, ['class' => 'form-control']) !!} --}}
						<select name="mat1" class="form-control">
			                	<option value=""></option>
			                    @foreach ($materials as $line)
			                    <option value="{{ $line->abbreviation }}" 
			                    	@if ($line->abbreviation == $data->mat1)
				                    selected
				                    @endif
				                    >{{ $line->abbreviation }}</option>
			       
			                    @endforeach
		                </select>
	                </div>
	                <div class="panel-body">
						<p>Mat1 [%]: </p>
						{!! Form::input('decimal','mat1_p', number_format($data->mat1_p,2)*100, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Mat2:</p>
						{{-- {!! Form::input('mat2','mat2', $data->mat2, ['class' => 'form-control']) !!} --}}
						<select name="mat2" class="form-control">
			                	<option value=""></option>
			                    @foreach ($materials as $line)
			                    <option value="{{ $line->abbreviation }}" 
			                    	@if ($line->abbreviation == $data->mat2)
				                    selected
				                    @endif
				                    >{{ $line->abbreviation }}</option>
			       
			                    @endforeach
		                </select>
	                </div>
	                <div class="panel-body">
						<p>Mat2 [%]: </p>
						{!! Form::input('decimal','mat2_p', number_format($data->mat2_p,2)*100, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Mat3:</p>
						{{-- {!! Form::input('mat3','mat3', $data->mat3, ['class' => 'form-control']) !!} --}}
						<select name="mat3" class="form-control">
			                	<option value=""></option>
			                    @foreach ($materials as $line)
			                    <option value="{{ $line->abbreviation }}" 
			                    	@if ($line->abbreviation == $data->mat3)
				                    selected
				                    @endif
				                    >{{ $line->abbreviation }}</option>
			       
			                    @endforeach
		                </select>
	                </div>
	                <div class="panel-body">
						<p>Mat3 [%]: </p>
						{!! Form::input('decimal','mat3_p', number_format($data->mat3_p,2)*100, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Mat4:</p>
						{{-- {!! Form::input('mat4','mat4', $data->mat4, ['class' => 'form-control']) !!} --}}
						<select name="mat4" class="form-control">
			                	<option value=""></option>
			                    @foreach ($materials as $line)
			                    <option value="{{ $line->abbreviation }}" 
			                    	@if ($line->abbreviation == $data->mat4)
				                    selected
				                    @endif
				                    >{{ $line->abbreviation }}</option>
			       
			                    @endforeach
		                </select>
	                </div>
	                <div class="panel-body">
						<p>Mat4 [%]: </p>
						{!! Form::input('decimal','mat4_p', number_format($data->mat4_p,2)*100, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Tot width:</p>
						{!! Form::input('decimal','tot_width', number_format($data->tot_width,2), ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Usable width:</p>
						{!! Form::input('decimal','usable_width', number_format($data->usable_width,2), ['class' => 'form-control']) !!}
	                </div>
	                 <div class="panel-body">
						<p>Average length:</p>
						{!! Form::input('decimal','avg_length', number_format($data->avg_length,1), ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Shrinkage Dry O [%]: </p>
						{!! Form::input('decimal','shrinkage_dry_o', number_format($data->shrinkage_dry_o,2)*100, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Shrinkage Dry W [%]: </p>
						{!! Form::input('decimal','shrinkage_dry_w', number_format($data->shrinkage_dry_w,2)*100, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Shrinkage Dry Tol: </p>
						{!! Form::input('shrinkage_dry_tol','shrinkage_dry_tol', $data->shrinkage_dry_tol, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Shrinkage steam O [%]: </p>
						{!! Form::input('decimal','shrinkage_steam_o', number_format($data->shrinkage_steam_o,2)*100, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Shrinkage steam W [%]: </p>
						{!! Form::input('decimal','shrinkage_steam_w', number_format($data->shrinkage_steam_w,2)*100, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Shrinkage steam Tol: </p>
						{!! Form::input('shrinkage_steam_tol','shrinkage_steam_tol', $data->shrinkage_steam_tol, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Relaxation: </p>
						{{-- {!! Form::input('relaxation','relaxation', $data->relaxation, ['class' => 'form-control']) !!} --}}
						{!! Form::select('relaxation', array(''=>'','YES'=>'YES','NO'=>'NO'), $data->relaxation, array('class' => 'form-control')); !!} 
	                </div>
	                <div class="panel-body">
						<p>MQ Weight: </p>
						{!! Form::input('number','mq_weight', $data->mq_weight, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>To be checked on QC [%]: </p>
						{!! Form::input('decimal','to_be_checked_on_qc_p', number_format($data->to_be_checked_on_qc_p,2)*100, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Date of update QC: </p>
						{!! Form::input('date','date_of_update_qc_p', $data->date_of_update_qc_p, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Supplier truck: </p>
						{!! Form::input('supplier_truck','supplier_truck', $data->supplier_truck, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Labels to genetate: </p>
						{!! Form::input('labels_to_genetate','labels_to_genetate', $data->labels_to_genetate, ['class' => 'form-control']) !!}
	                </div>

	                <div class="panel-body">
						<p>Sample: </p>
						{!! Form::input('sample','sample', $data->sample, ['class' => 'form-control']) !!}
	                </div>

	                <div class="panel-body">
					<p>Spreader parameters: </p>
						{!! Form::input('sp_parameter', 'sp_parameter', $data->sp_parameter, ['class' => 'form-control']) !!}
					</div>

					<div class="panel-body">
					<p>Information for SP and CUT: </p>
						{!! Form::input('info_for_sp_and_cut', 'info_for_sp_and_cut', $data->info_for_sp_and_cut ,['class' => 'form-control']) !!}
					</div>

	                
	                <div class="panel-body">
						{!! Form::submit('Confirm', ['class' => 'btn btn-success btn-lg center-block']) !!}
					</div>


					@include('errors.list')

					{!! Form::close() !!}

				@endif


				@if(Auth::check() && Auth::user()->name == 'workstudy')

					{!! Form::open(['url' => 'update_fabric/'.$data->id]) !!}
					<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

					{!! Form::hidden('fabric', $data->fabric, ['class' => 'form-control']) !!}

					
					<div class="panel-body">
						<p>Supplier:</p>
						{!! Form::input('supplier','supplier', $data->supplier, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Material description:</p>
						{!! Form::input('material_description','material_description', $data->material_description, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Mat1:</p>
						{!! Form::input('mat1','mat1', $data->mat1, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Mat1 [%]: </p>
						{!! Form::input('decimal','mat1_p', number_format($data->mat1_p,2)*100, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Mat2:</p>
						{!! Form::input('mat2','mat2', $data->mat2, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Mat2 [%]: </p>
						{!! Form::input('decimal','mat2_p', number_format($data->mat2_p,2)*100, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Mat3:</p>
						{!! Form::input('mat3','mat3', $data->mat3, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Mat3 [%]: </p>
						{!! Form::input('decimal','mat3_p', number_format($data->mat3_p,2)*100, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Mat4:</p>
						{!! Form::input('mat4','mat4', $data->mat4, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Mat4 [%]: </p>
						{!! Form::input('decimal','mat4_p', number_format($data->mat4_p,2)*100, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Tot width:</p>
						{!! Form::input('decimal','tot_width', number_format($data->tot_width,2), ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Usable width:</p>
						{!! Form::input('decimal','usable_width', number_format($data->usable_width,2), ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Shrinkage Dry O [%]: </p>
						{!! Form::input('decimal','shrinkage_dry_o', number_format($data->shrinkage_dry_o,2)*100, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Shrinkage Dry W [%]: </p>
						{!! Form::input('decimal','shrinkage_dry_w', number_format($data->shrinkage_dry_w,2)*100, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Shrinkage Dry Tol: </p>
						{!! Form::input('shrinkage_dry_tol','shrinkage_dry_tol', $data->shrinkage_dry_tol, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Shrinkage steam O [%]: </p>
						{!! Form::input('decimal','shrinkage_steam_o', number_format($data->shrinkage_steam_o,2)*100, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Shrinkage steam W [%]: </p>
						{!! Form::input('decimal','shrinkage_steam_w', number_format($data->shrinkage_steam_w,2)*100, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Shrinkage steam Tol: </p>
						{!! Form::input('shrinkage_steam_tol','shrinkage_steam_tol', $data->shrinkage_steam_tol, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Relaxation: </p>
						{{-- {!! Form::input('relaxation','relaxation', $data->relaxation, ['class' => 'form-control']) !!} --}}
						{!! Form::select('relaxation', array(''=>'','YES'=>'YES','NO'=>'NO'), $data->relaxation, array('class' => 'form-control')); !!} 
	                </div>
	                <div class="panel-body">
						<p>To be checked on QC [%]: </p>
						{!! Form::input('decimal','to_be_checked_on_qc_p', number_format($data->to_be_checked_on_qc_p,2)*100, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Date of update QC: </p>
						{!! Form::input('date','date_of_update_qc_p', $data->date_of_update_qc_p, ['class' => 'form-control']) !!}
	                </div>
	                <div class="panel-body">
						<p>Supplier truck: </p>
						{!! Form::input('supplier_truck','supplier_truck', $data->supplier_truck, ['class' => 'form-control']) !!}
	                </div>

	                <div class="panel-body">
						<p>Labels to genetate: </p>
						{!! Form::input('labels_to_genetate','labels_to_genetate', $data->labels_to_genetate, ['class' => 'form-control']) !!}
	                </div>

	                <div class="panel-body">
						<p>Sample: </p>
						{!! Form::input('sample','sample', $data->sample, ['class' => 'form-control']) !!}
	                </div>

	                 <div class="panel-body">
					<p>Spreader parameters: </p>
						{!! Form::input('sp_parameter', 'sp_parameter', $data->sp_parameter, ['class' => 'form-control']) !!}
					</div>

					<div class="panel-body">
					<p>Information for SP and CUT: </p>
						{!! Form::input('info_for_sp_and_cut', 'info_for_sp_and_cut', $data->info_for_sp_and_cut ,['class' => 'form-control']) !!}
					</div>



	                <div class="panel-body">
						{!! Form::submit('Confirm', ['class' => 'btn btn-success btn-lg center-block']) !!}
					</div>
				

					@include('errors.list')

					{!! Form::close() !!}
				
				@endif

				


				<br>
				<div class="">
						<a href="{{url('/')}}" class="btn btn-default btn-lg center-block">Back to main menu</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
