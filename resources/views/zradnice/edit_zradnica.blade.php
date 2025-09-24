@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Edit Z radnica</b></div>

                @if(isset($data[0]))
                    
                    {!! Form::open(['url' => 'edit_zradnica_post']) !!}
                    
                    	{!! Form::hidden('id', $data[0]->id, ['class' => 'form-control']) !!}

                    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
    					
					    <div class="panel-body">
					        <label for="z_number">Z Number</label>
					        <input type="text" class="form-control" id="z_number" name="z_number"
					               value="{{ $data[0]->z_number }}" readonly>
					    </div>

					    <div class="panel-body">
					        <label for="z_name">Z Name</label>
					        <input type="text" class="form-control" id="z_name" name="z_name"
					               value="{{ $data[0]->z_name }}" readonly>
					    </div>

					    <div class="panel-body">
					        <label for="z_status">Current Z Status
					        	<p><i> It will update status from R</i></p></label>
					        <select class="form-control" id="z_status" name="z_status" readonly>
					            <option value="1" {{ $data[0]->z_status == 1 ? 'selected' : '' }}>Active</option>
					            <option value="0" {{ $data[0]->z_status == 0 ? 'selected' : '' }}>Inactive</option>
					        </select>
					    </div>

					    <div class="panel-body">
						    <p>Linked R number : </p>
	                        <select name="r_number_new" class="chosen narrow-chosen" data-placeholder="Select employee" data-allow_single_deselect="true">
	                            <option value=""></option>
	                            
	                            @foreach ($operators as $line)
	                                <option value="{{ $line->r_number }}-{{ $line->r_name }}"
	                                    @if(($data[0]->r_number . '-' . $data[0]->r_name) == ($line->r_number . '-' . $line->r_name)) 
	                                        selected 
	                                    @endif
	                                >
	                                    {{ $line->r_number }} - {{ $line->r_name }} - {{ $line->r_status == 1 ? 'Active' : 'Inactive' }}
	                                </option>
	                            @endforeach
	                        </select>
	                    </div>

                        <div class="panel-body">
							<p>Comment:</p>
		               		{!! Form::input('string', 'comment', $data[0]->comment, ['class' => 'form-control']) !!}
						</div>       

                        

						<div class="panel-body">
						    <label for="final_status"><b>Final Status - 
						        in case R operator is still active but not anymore QC</b>
						    </label>
						    <select class="form-control" id="final_status" name="final_status">
						        <option value="" {{ is_null($data[0]->final_status) ? 'selected' : '' }}>-- None --</option>
						        <option value="1" {{ $data[0]->final_status === 1 ? 'selected' : '' }}>Active</option>
						        <option value="0" {{ $data[0]->final_status === 0 ? 'selected' : '' }}>Inactive</option>
						    </select>
						</div>

					    <div class="panel-body">
						    <p>From date (MM/DD/YYYY):</p>
						    {!! Form::input(
						        'date',
						        'fromDate',
						        !empty($data[0]->fromDate) ? \Carbon\Carbon::parse($data[0]->fromDate)->format('Y-m-d') : null,
						        ['class' => 'form-control']
						    ) !!}
						</div>

						<div class="panel-body">
						    <p>To date (MM/DD/YYYY):</p>
						    {!! Form::input(
						        'date',
						        'toDate',
						        !empty($data[0]->toDate) ? \Carbon\Carbon::parse($data[0]->toDate)->format('Y-m-d') : null,
						        ['class' => 'form-control']
						    ) !!}
						</div>

						
						<br>


					    <button type="submit" class="btn btn-primary">Save Changes</button>
					    <a href="{{ url('zradnice') }}" class="btn btn-default">Cancel</a>

					@include('errors.list')
	                {!! Form::close() !!}


                @else
                    <div class="alert alert-danger">Record not found.</div>
                @endif
                <br>
				<!-- 
				<div class="">
						<a href="{{url('/')}}" class="btn btn-default btn-lg center-b lock">Back to main menu</a>
				</div> -->
			</div>
		</div>
	</div>
</div>
@endsection
