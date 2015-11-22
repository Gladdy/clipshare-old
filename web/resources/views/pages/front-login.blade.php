@extends('layouts.default')

@section('body')

    <div class="row">

        <div class = "col-md-6 col-md-offset-4">
            <h2> Please log in</h2>
        </div>

        {!! Form::open(array('url'=> '/login', 'class' => 'form-horizontal')) !!}

        <div class="form-group">
            {!! Form::label('email', 'E-Mail Address', ['class' => 'col-md-4 control-label']) !!}
            <div class = "col-md-6">
                {!! Form::text('email', null, ['class' => 'form-control', 'value' => "{{ old('email') }}" ]) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Password', ['class' => 'col-md-4 control-label']) !!}
            <div class = "col-md-6">
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
        </div>

        @if (count($errors) > 0)
            <div class="alert alert-danger col-md-6 col-md-offset-4">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                {!! Form::submit('Sign in', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
        {!! Form::close() !!}

    </div>
@stop