@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 ">
            <div class="panel panel-info center-block">
                <div class="panel-heading">Box configuration table

                @if((Auth::check() && Auth::user()->name == "admin") OR ( Auth::check() && Auth::user()->name == "magacin"))
                    <a href="{{ url('add_box') }}" class="btn btn-info btn-xs ">Add new box configuration</a>
                    <a href="{{ url('box_table') }}" class="btn btn-default btn-xs ">Complete table</a>
                @endif
            </div>
                
                

                <div class="panel-body">

                {!! Form::open(['method'=>'POST', 'url'=>'/box_search_by_style']) !!}

                      
                        <div class="panel-body">
                        <p>Style: <span style="color:red;">*</span></p>
                            <select name="style" class="chosen">
                                <option value="" selected></option>
                            @foreach ($style as $line)
                                <option value="{{ $line->style }}">
                                    {{ $line->style }}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        
                        <br>
                        {!! Form::submit('Confirm', ['class' => 'btn  btn-success center-block']) !!}

                        @include('errors.list')

                {!! Form::close() !!}


                </div>

                
            </div>
        </div>
    </div>
</div>
@endsection
