@if (Auth::check())

    {!! Form::open(array('url'=> '/logout', 'class' => 'navbar-form navbar-right', 'method' => 'GET')) !!}
    <div class="form-group">
        {!! Form::submit('Sign out', ['class' => 'btn btn-success']) !!}
    </div>
    {!! Form::close() !!}

@else

    {!! Form::open(array('url'=> '/login', 'class' => 'navbar-form navbar-right')) !!}
    <div class="form-group">
        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => "Email" ]) !!}
    </div>
    <div class="form-group">
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => "Password"]) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Sign in', ['class' => 'btn btn-success']) !!}
    </div>
    {!! Form::close() !!}

@endif