@extends('layouts.master')

@section('title', 'Save Tag');

@section('content')
    <div class="container">
        @include('partials.adminMenu')
        <br>
        <br>
        <form class="form-horizontal"  method="post">
            <div class="form-group">
                <input type="text" name="urls" class="form-control" namespace="Enter URLs">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"
            </div>
            <div class="form-group" align="center">
                <input type="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
@stop