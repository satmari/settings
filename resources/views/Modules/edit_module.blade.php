@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-5 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Edit line</b></div>
				
				
				@if(Auth::check() && Auth::user()->name == "admin")
				
					{!! Form::open(['url' => 'update_module/'.$data->id]) !!}
					<input type="hidden" id="_token" value="<?php echo csrf_token(); ?>">

					<div class="panel-body">
						<p>Line:</p>
	               		{!! Form::input('module', 'module', $data->module, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
					</div>

					<div class="panel-body">
						<p>Team / Shift:</p>
	               		{!! Form::select('team', array('A'=>'A','B'=>'B'), $data->team, array('class' => 'form-control')); !!} 
					</div>

					<div class="panel-body">
						<p>Sort order:</p>
						{!! Form::input('number','sort_order', $data->sort_order, ['class' => 'form-control']) !!}
	                </div>

					<div class="panel-body">
						<p>Row:</p>
	               		{!! Form::input('row', 'row', $data->row, ['class' => 'form-control']) !!}
					</div>

					<div class="panel-body">
						<p>Column group:</p>
	               		{!! Form::input('column_group', 'column_group', $data->column_group, ['class' => 'form-control']) !!}
					</div>

					<div class="panel-body">
						<p>Sector:</p>
	               		{!! Form::input('sector', 'sector', $data->sector, ['class' => 'form-control']) !!}
					</div>

					<div class="panel-body">
						<p>Workstudy: <i>{{$data->workstudy}}</i></p>
						<select name="workstudy" class="chosen narrow-chosen form-control">
					    	
					    	<option value="no" {{ $data->workstudy == 'no' ? 'selected' : '' }}>No</option>
					    	<option value="Replacement" {{ $data->workstudy == 'Replacement' ? 'selected' : '' }}>Replacement</option>

					    	@foreach ($operators as $line)
					        	<option value="{{ $line->rnumber }} {{ $line->name }}" 
								    {{ $data->workstudy == $line->name ? 'selected' : '' }}>
								    {{ $line->rnumber }} {{ $line->name }}
								</option>
					    	@endforeach
						</select>
					</div>

					<div class="panel-body">
						<p>Line leader: <i>{{$data->line_leader}}</i></p>
						<select name="line_leader" class="chosen narrow-chosen form-control">
					    	
					    	<option value="no" {{ $data->line_leader == 'no' ? 'selected' : '' }}>No</option>
					    	<option value="Replacement" {{ $data->line_leader == 'Replacement' ? 'selected' : '' }}>Replacement</option>

					    	@foreach ($operators as $line)
					        	<option value="{{ $line->rnumber }} {{ $line->name }}" 
								    {{ $data->line_leader == $line->name ? 'selected' : '' }}>
								    {{ $line->rnumber }} {{ $line->name }}
								</option>
					    	@endforeach
						</select>
					</div>

					<div class="panel-body">
						<p>Supervisor: <i>{{$data->supervisor}}</i></p>
						<select name="supervisor" class="chosen narrow-chosen form-control">
					    	
					    	<option value="no" {{ $data->supervisor == 'no' ? 'selected' : '' }}>No</option>
					    	<option value="Replacement" {{ $data->supervisor == 'Replacement' ? 'selected' : '' }}>Replacement</option>
					    	
					    	@foreach ($operators as $line)
					        	<option value="{{ $line->rnumber }} {{ $line->name }}" 
								    {{ $data->supervisor == $line->name ? 'selected' : '' }}>
								    {{ $line->rnumber }} {{ $line->name }}
								</option>
					    	@endforeach
						</select>
					</div>

					<div class="panel-body">
						{!! Form::submit('Confirm', ['class' => 'btn btn-success btn-lg center-block']) !!}
					</div>

					@include('errors.list')

					{!! Form::close() !!}

				@endif


				@if(Auth::check() && Auth::user()->name == 'workstudy')

					{!! Form::open(['url' => 'update_module/'.$data->id]) !!}
					<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

					{!! Form::hidden('module', $data->module, ['class' => 'form-control']) !!}
					
					<div class="panel-body">
						<p>Team / Shift:</p>
	               		{!! Form::select('team', array('A'=>'A','B'=>'B'), $data->team, array('class' => 'form-control')); !!} 
					</div>

					<div class="panel-body">
						<p>Sort order:</p>
						{!! Form::input('number','sort_order', $data->sort_order, ['class' => 'form-control']) !!}
	                </div>

					<div class="panel-body">
						<p>Row:</p>
	               		{!! Form::input('row', 'row', $data->row, ['class' => 'form-control']) !!}
					</div>

					<div class="panel-body">
						<p>Column group:</p>
	               		{!! Form::input('column_group', 'column_group', $data->column_group, ['class' => 'form-control']) !!}
					</div>

					<div class="panel-body">
						<p>Sector:</p>
	               		{!! Form::input('sector', 'sector', $data->sector, ['class' => 'form-control']) !!}
					</div>

					<div class="panel-body">
						<p>Workstudy: <i>{{$data->workstudy}}</i></p>
						<select name="workstudy" class="chosen narrow-chosen form-control">
					    	
					    	<option value="no" {{ $data->workstudy == 'no' ? 'selected' : '' }}>No</option>
					    	@foreach ($operators as $line)
					        	<option value="{{ $line->rnumber }} {{ $line->name }}" 
								    {{ $data->workstudy == $line->name ? 'selected' : '' }}>
								    {{ $line->rnumber }} - {{ $line->name }} - {{ $data->workstudy }}
								</option>
					    	@endforeach
						</select>
					</div>

					<div class="panel-body">
						<p>Line leader: <i>{{$data->line_leader}}</i></p>
						<select name="line_leader" class="chosen narrow-chosen form-control">
					    	
					    	<option value="no" {{ $data->line_leader == 'no' ? 'selected' : '' }}>No</option>
					    	@foreach ($operators as $line)
					        	<option value="{{ $line->rnumber }} {{ $line->name }}" 
								    {{ $data->line_leader == $line->name ? 'selected' : '' }}>
								    {{ $line->rnumber }} - {{ $line->name }} - {{ $data->line_leader }}
								</option>
					    	@endforeach
						</select>
					</div>

					<div class="panel-body">
						<p>Supervisor: <i>{{$data->supervisor}}</i></p>
						<select name="supervisor" class="chosen narrow-chosen form-control">
					    	
					    	<option value="no" {{ $data->supervisor == 'no' ? 'selected' : '' }}>No</option>
					    	@foreach ($operators as $line)
					        	<option value="{{ $line->rnumber }} {{ $line->name }}" 
								    {{ $data->supervisor == $line->name ? 'selected' : '' }}>
								    {{ $line->rnumber }} - {{ $line->name }} - {{ $data->supervisor }}
								</option>
					    	@endforeach
						</select>
					</div>

					<div class="panel-body">
						{!! Form::submit('Confirm', ['class' => 'btn btn-success btn-lg center-block']) !!}
					</div>

					@include('errors.list')

					{!! Form::close() !!}
				
				@endif

				


				<br>
				<div class="">
						<a href="{{url('/module')}}" class="btn btn-default btn-lg center-block">Back to main menu</a>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
.narrow-chosen + .chosen-container {
    width: 300px !important;
}
.narrow-chosen + .chosen-container .chosen-drop {
    width: 300px !important;
}
.narrow-chosen + .chosen-container .chosen-search input {
    width: 300px !important;
}
</style>
@endsection
