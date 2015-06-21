@extends('layouts.master')

@section('title','What UP!')
@section('content')
    <div class="container">
    <br><br>
        <div class="row">
            <form action="recognize" method="post" class="form-horizontal" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="text" name="url" class="form-control" placeholder="IMAGE URL">
                </div>
                <div class="form-group">
                    <input type="file" name="img" class="form-control">
                </div>
                <div class="form-group" align="center">
                    <input type="submit" value="Recognize" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
@stop