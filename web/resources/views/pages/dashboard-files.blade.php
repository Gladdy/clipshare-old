@extends('layouts.dashboard')

@section('content')

    {!! Form::open(array('url' => '/content', 'files' => true, 'class' => 'form-horizontal')) !!}

    {!! Form::label('filename', 'Filename') !!}
    {!! Form::text('filename') !!}

    {!! Form::label('file', 'Select file') !!}
    {!! Form::file('file') !!}

    {!! Form::submit('Submit!') !!}
    {!! Form::close() !!}
@stop
