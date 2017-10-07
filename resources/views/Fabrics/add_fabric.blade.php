@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-5 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Add fabric</b></div>
				
				{!! Form::open(['url' => 'insert_fabric']) !!}
				<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

				<div class="panel-body">
				<p>Fabric: </p>
					{!! Form::text('fabric', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
				</div>
				
				<div class="panel-body">
				<p>Supplier: </p>
					{{-- {!! Form::text('supplier', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!} --}}
					{{-- {!! Form::select('supplier', ['' => ''] + $supplier, null,['class' => 'form-control']) !!} --}}
					
					 <select name="supplier" class="form-control">
		                	<option value=""></option>
		                    @foreach ($suppliers as $line)
		                    <option value="{{ $line->supplier }}">{{ $line->supplier }}</option>
		                    @endforeach
	                </select>
				</div>
				<div class="panel-body">
				<p>Description: </p>
					{!! Form::text('material_description', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
				</div>
				<div class="panel-body">
				<p>Mat1: </p>
					{{-- {!! Form::text('mat1', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!} --}}
					<select name="mat1" class="form-control">
		                	<option value=""></option>
		                    @foreach ($materials as $line)
		                    <option value="{{ $line->abbreviation }}">{{ $line->abbreviation }}</option>
		                    @endforeach
	                </select>
				</div>
				<div class="panel-body">
				<p>Mat1 [%]: </p>
					{!! Form::input('decimal','mat1_p', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
				</div>
				<div class="panel-body">
				<p>Mat2: </p>
					{{-- {!! Form::text('mat2', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!} --}}
					<select name="mat2" class="form-control">
		                	<option value=""></option>
		                    @foreach ($materials as $line)
		                    <option value="{{ $line->abbreviation }}">{{ $line->abbreviation }}</option>
		                    @endforeach
	                </select>
				</div>
				<div class="panel-body">
				<p>Mat2 [%]: </p>
					{!! Form::input('decimal','mat2_p', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
				</div>
				<div class="panel-body">
				<p>Mat3: </p>
					{{-- {!! Form::text('mat1', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!} --}}
					<select name="mat3" class="form-control">
		                	<option value=""></option>
		                    @foreach ($materials as $line)
		                    <option value="{{ $line->abbreviation }}">{{ $line->abbreviation }}</option>
		                    @endforeach
	                </select>
				</div>
				<div class="panel-body">
				<p>Mat3 [%]: </p>
					{!! Form::input('decimal','mat3_p', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
				</div>
				<div class="panel-body">
				<p>Mat4: </p>
					{{-- {!! Form::text('mat1', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!} --}}
					<select name="mat4" class="form-control">
		                	<option value=""></option>
		                    @foreach ($materials as $line)
		                    <option value="{{ $line->abbreviation }}">{{ $line->abbreviation }}</option>
		                    @endforeach
	                </select>
				</div>
				<div class="panel-body">
				<p>Mat4 [%]: </p>
					{!! Form::input('decimal','mat4_p', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
				</div>
				<div class="panel-body">
				<p>Total width: </p>
					{!! Form::input('decimal','tot_width', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Usable width: </p>
					{!! Form::input('decimal','usable_width', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Shrinkage Dry O [%]: </p>
					{!! Form::input('decimal','shrinkage_dry_o', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Shrinkage Dry W [%]: </p>
					{!! Form::input('decimal','shrinkage_dry_w', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Shrinkage Dry Tol: </p>
					{!! Form::text('shrinkage_dry_tol', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Shrinkage steam O [%]: </p>
					{!! Form::input('decimal','shrinkage_steam_o', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Shrinkage steam W [%]: </p>
					{!! Form::input('decimal','shrinkage_steam_w', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Shrinkage steam Tol: </p>
					{!! Form::text('shrinkage_steam_tol', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Relaxation: </p>
					{{-- {!! Form::text('relaxation', null, ['class' => 'form-control']) !!} --}}
					{!! Form::select('relaxation', array(''=>'','YES'=>'YES','NO'=>'NO'), '', array('class' => 'form-control')); !!} 
				</div>
				<div class="panel-body">
				<p>To be checked on QC [%]: </p>
					{!! Form::input('decimal','to_be_checked_on_qc_p', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Date of update QC: </p>
					{!! Form::input('date','date_of_update_qc_p', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Supplier truck: </p>
					{!! Form::text('supplier_truck', null, ['class' => 'form-control']) !!}
				</div>
				<div class="panel-body">
				<p>Labels to genetate: </p>
					{!! Form::text('labels_to_genetate', null, ['class' => 'form-control']) !!}
				</div>




				<div class="panel-body">
					{!! Form::submit('Confirm', ['class' => 'btn btn-success btn-lg center-block']) !!}
				</div>

				@include('errors.list')

				{!! Form::close() !!}


				<br>
				<div class="">
						<a href="{{url('/')}}" class="btn btn-default btn-lg center-block">Back to main menu</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection