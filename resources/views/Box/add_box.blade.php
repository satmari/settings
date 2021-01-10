@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-5 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Add new box configuration</b></div>
				
				{!! Form::open(['url' => 'insert_box']) !!}
				
				<div class="panel-body">
				<p>Style:* </p>
					{!! Form::text('style', null, ['id'=>'st','class' => 'form-control']) !!}
				</div>

				<div class="panel-body">
				<p>Color:* </p>
					{!! Form::text('color', null, ['id'=>'co','class' => 'form-control']) !!}
				</div>

				<div class="panel-body">
				<p>Size:* </p>
					{!! Form::text('size', null, ['id'=>'si','class' => 'form-control']) !!}
				</div>

				<div class="panel-body">
				<p>Brand: </p>
					{{--{!! Form::text('brand', null, ['class' => 'form-control']) !!} --}}
					{!! Form::select('brand', array(''=>'','Intimissimi'=>'Intimissimi','Tezenis'=>'Tezenis','Calzedonia'=>'Calzedonia'), '', array('class' => 'form-control')); !!} 
				</div>

				<div class="panel-body">
				<p>Pcs per polybag:</p>
					{!! Form::input('number','pcs_per_polybag', null, ['class' => 'form-control']) !!}
				</div>

				<div class="panel-body">
				<p>Weight of polybag: <i><small>Za decimale uneti tacku!</small></i></p>
					{!! Form::input('float','weight_of_polybag', null, ['class' => 'form-control']) !!}
				</div>

				{{--
				<div class="panel-body">
				<p>Weight of 1 pcs:</p>
					{!! Form::input('float','weight_of_pcs', null, ['class' => 'form-control']) !!}
				</div>
				--}}

				<div class="panel-body">
				<p>Pcs per box:</p>
					{!! Form::input('number','pcs_per_box', null, ['class' => 'form-control']) !!}
				</div>

				<div class="panel-body">
				<p>Status:</p>
					{{--{!! Form::text('status', null, ['class' => 'form-control']) !!} --}}
					{!! Form::select('status', array('Checked'=>'Checked','Not checked'=>'Not checked'), '', array('class' => 'form-control')); !!} 
				</div>

				<div class="panel-body">
				<p><span style="color:red">Pcs per polybag (2Q):</span></p>
					{!! Form::input('number','pcs_per_polybag_2', null, ['class' => 'form-control']) !!}
				</div>
				
				<div class="panel-body">
				<p><span style="color:red">Pcs per box (2Q):</span></p>
					{!! Form::input('number','pcs_per_box_2', null, ['class' => 'form-control']) !!}
				</div>

				
				<div class="panel-body">
					{!! Form::submit('Confirm', ['class' => 'btn btn-success btn-lg center-block']) !!}
				</div>

				@include('errors.list')

				{!! Form::close() !!}
				
			</div>
		</div>
	</div>
</div>
@endsection