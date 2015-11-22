@extends('layouts.dashboard')

@section('content')

<h2>Text</h2>

<table class="table">
<thead>
    <tr>
        <th>Text</th>
        <th>Html</th>
        <th>Date</th>
    </tr>
</thead>
<tbody>

    @foreach ($data as $textclip)
    <tr>
        <td> {{ $textclip->text_content }}</td>
        <td> {{ $textclip->html_content }}</td>
        <td> {{ $textclip->created_at }}</td>
    </tr>
    @endforeach

</tbody>
</table>

@stop
