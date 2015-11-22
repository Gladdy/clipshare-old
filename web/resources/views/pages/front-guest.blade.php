@extends('layouts.default')

@section('body')
<div class="row">

    {!! Form::open(array('url'=> '/register', 'class' => 'form-horizontal')) !!}
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

    <div class="form-group">
        {!! Form::label('password_confirmation', 'Confirm password', ['class' => 'col-md-4 control-label']) !!}
        <div class = "col-md-6">
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
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
            {!! Form::submit('Register', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}

</div>

<div class="row">
  <div class="col-md-4">
    <h2>What</h2>
    <p> sharing stuff because fun.sharing stuff because fun.sharing stuff because fun.sharing stuff because fun.sharing stuff because fun.sharing stuff because fun.sharing stuff because fun.sharing stuff because fun. </p>
    <p><a class="btn btn-default" href="/info/what" role="button">View more &raquo;</a></p>
  </div>
  <div class="col-md-4">
    <h2>How</h2>
    <p>In contrast to previous projects, this one is truly spanning loads of different domains. An API and web interface in PHP using Laravel, the connections are handled using JavaScript and Node.JS with some additional compiled C++. The client is currently written in C++ using Qt. </p>
    <p><a class="btn btn-default" href="/info/how" role="button">View more &raquo;</a></p>
  </div>
  <div class="col-md-4">
    <h2>Todo</h2>
    <p>There is still a lot to be done!</p>
    <p><a class="btn btn-default" href="/info/todo" role="button">View more &raquo;</a></p>
  </div>
</div>
@stop
