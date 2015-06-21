@extends('layouts.master')

@section('title')
Admin Home Page
@stop

@section('content')
<div class="container">
    @include('partials.adminMenu')
    <h3>All The Tagged Users in the Namespace - CELEBS</h3>
    <ul class="list-group">
        @foreach($celebs as $celeb)
            <li class="list-group-item">{{ $celeb }}</li>
        @endforeach
    </ul>
</div>
@stop