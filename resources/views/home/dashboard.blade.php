@extends('layout.master')
@section('sidebar')
@parent
@include('layout.sidebar')
@stop

@section('content')


    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            <p>{{ Session::get('flash_message') }}</p>
        </div>
    @endif
    @if(Session::has('flash_message_error'))
        <div class="alert alert-danger">
            <p>{{ Session::get('flash_message_error') }}</p>
        </div>
    @endif



@stop