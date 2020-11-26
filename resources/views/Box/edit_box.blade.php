@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-5 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Edit box configuration</b></div>
				
				
					{!! Form::open(['url' => 'update_box/'.$data->id]) !!}
					
					<div class="panel-body">
						<p>Style:<span style="color:red;">*</span></p>
	               		{!! Form::input('string', 'style', $data->style, ['id'=>'st','class' => 'form-control']) !!}
					</div>
					
					<div class="panel-body">
						<p>Color:<span style="color:red;">*</span></p>
	               		{!! Form::input('string', 'color', $data->color, ['id'=>'co','class' => 'form-control']) !!}
					</div>
					
					<div class="panel-body">
						<p>Size:<span style="color:red;">*</span></p>
	               		{!! Form::input('string', 'size', $data->size, ['id'=>'si','class' => 'form-control']) !!}
					</div>

					<div class="panel-body">
						<p>Brand:<span style="color:red;">*</span></p>
	               		{!! Form::select('brand', array(''=>'','Intimissimi'=>'Intimissimi','Tezenis'=>'Tezenis','Calzedonia'=>'Calzedonia'), $data->brand, array('class' => 'form-control')); !!} 
					</div>

					<div class="panel-body">
						<p>Pcs per polybag:</p>
	               		{!! Form::input('number', 'pcs_per_polybag', $data->pcs_per_polybag, ['class' => 'form-control']) !!}
					</div>

					<div class="panel-body">
						<p>Weight of polybag: <i><small>Za decimale uneti tacku!</small></i></p>
	               		{!! Form::input('float', 'weight_of_polybag', round($data->weight_of_polybag,3), ['class' => 'form-control']) !!}
					</div>

					<div class="panel-body">
						<p>Pcs per box:</p>
	               		{!! Form::input('number', 'pcs_per_box', $data->pcs_per_box, ['class' => 'form-control']) !!}
					</div>

					<div class="panel-body">
						<p>Status:</p>
	               		{!! Form::select('status', array('Checked'=>'Checked','Not checked'=>'Not checked'), $data->status, array('class' => 'form-control')); !!} 
					</div>

					<div class="panel-body">
						<p>Pcs per box 2nd:</p>
	               		{!! Form::input('number', 'pcs_per_box_2', $data->pcs_per_box_2, ['class' => 'form-control']) !!}
					</div>

					<div class="panel-body">
						{!! Form::submit('Confirm', ['class' => 'btn btn-success btn-lg center-block']) !!}
					</div>

					@include('errors.list')

					{!! Form::close() !!}

				
				<br>
				<div class="">
						<a href="{{url('/box')}}" class="btn btn-default btn-lg center-block">Back to main menu</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
