@extends('layouts.default')

@section('body')

<div class="row">
    <div class="col-md-2 sidebar">

        <div class="list-group">
            <a href="/status" class="list-group-item @if ($active == 'status') active @endif">
            <i class="fa fa-tasks"></i> Status
            </a>
        </div>

        <div class="list-group">
            <a href="/text" class="list-group-item @if ($active == 'text') active @endif">
            <i class="fa fa-file-text-o"></i> Text
            </a>

            <a href="/files" class="list-group-item @if ($active == 'files') active @endif">
            <i class="fa fa-file-o"></i> Files
            </a>
        </div>

        <div class="list-group">
            <a href="/settings" class="list-group-item @if ($active == 'settings') active @endif">
            <i class="fa fa-cogs"></i> Settings
            </a>
         </div>
    </div>
    <div class="col-md-10">

        @yield('content')

    </div>
</div>
@stop
