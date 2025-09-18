@extends('app')

@section('content')
<div class="container container-table">
    <div class="row vertical-center-row">
        <div class="text-center col-md-6 col-md-offset-3">
            <br>
            <div class="panel panel-default">
                <div class="panel-head ing" style="background-color: yellow"><b>Edit locker</b>
                        
                    
                </div>

                @if (isset($msg))
                    <small><i>&nbsp &nbsp &nbsp Msg: <span style="color:green"><b>{{ $msg }}</b></span></i></small>
                @endif
                @if (isset($msge))
                    <small><i>&nbsp &nbsp &nbsp Msg: <span style="color:red"><b>{{ $msge }}</b></span></i></small>
                    <audio autoplay="true" style="display:none;">
                        <source src="{{ asset('/css/2.wav') }}" type="audio/wav">
                    </audio>
                @endif
                @if (isset($msgs))
                    <audio autoplay="true" style="display:none;">
                        <source src="{{ asset('/css/1.wav') }}" type="audio/wav">
                    </audio>
                @endif
                @if (isset($msgbin))
                    <audio autoplay="true" style="display:none;">
                        <source src="{{ asset('/css/3.wav') }}" type="audio/wav">
                    </audio>
                @endif
        
                {!! Form::open(['url' => 'locker_edit_post']) !!}
                    
                    {!! Form::hidden('id', $id, ['class' => 'form-control']) !!}
                    <br>
                    <!-- <p>R number &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp -->
                    <br>
                    <!-- {!! Form::text('r_number', null, ['class' => 'form-control','autofocus' => 'autofocus']) !!}</td> -->

                    <p>Employee : </p>
                        <select name="r_number" class="chosen narrow-chosen" data-placeholder="Select employee" data-allow_single_deselect="true">
                            <option value=""></option>
                            
                            @foreach ($operators as $line)
                                <option value="{{ $line->r_number }}-{{ $line->employee }}"
                                    @if(($data->r_number . '-' . $data->employee) == ($line->r_number . '-' . $line->employee)) 
                                        selected 
                                    @endif
                                >
                                    {{ $line->r_number }} - {{ $line->employee }}
                                </option>
                            @endforeach
                        </select>
                                                

                    </p>
                        
                    
                    </table>

                    <div class="panel-body">
                        {!! Form::submit('Change emoloyee', ['class' => 'btn btn-success btn center-block']) !!}
                    </div>

                    
                @include('errors.list')
                {!! Form::close() !!}
                <hr>

                <div class="panel-body">
                    <a href="{{ url('remove_employee/'.$id) }}" class="btn btn-danger btn center-bl ock">Remove employee</a>
                </div>

                <div class="panel-body">
                    <div class="">
                        <a href="{{url('/lockers')}}" class="btn btn-default center-block">Back</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection