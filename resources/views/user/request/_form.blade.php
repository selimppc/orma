@extends('layout.master')
@section('sidebar')
    @parent
    @include('layout.sidebar')
@stop

@section('content')

    <div class="col-lg-6"  style="margin-left: 15%">
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
        <section class="panel">
            <header class="panel-heading">
                MemberShip Request
            </header>
            <div class="panel-body">
                {{--<form role="form">--}}
                {!! Form::open(['route' => 'user.send-request']) !!}
                {!! Form::hidden('status','invited') !!}
                    <div class="form-group">
                        {!! Form::label('email', 'Email Address:', ['class' => 'control-label']) !!}
                        <small class="required">(Required)</small>
                        {!! Form::email('email', null, ['id'=>'email', 'class' => 'form-control', 'required'=>'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('type', 'User Type:', ['class' => 'control-label']) !!}
                        <small class="required">(Required)</small>
                        {!! Form::Select('type',array(''=>'Select User Type','admin'=>'Admin','csagent'=>'Customer Agent','sagent'=>'Store Agent'),Input::old('type'),['class'=>'form-control ','required']) !!}
                    </div>
                    <button type="submit" class="pull-right btn btn-info btn-xs">Send</button>
                {!! Form::close() !!}

            </div>
        </section>
    </div>
@stop