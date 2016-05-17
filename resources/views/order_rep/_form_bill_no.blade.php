@if($errors->any())
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
@if(Session::has('flash_message_error'))
    <div class="alert alert-danger">
        <p>{{ Session::get('flash_message_error') }}</p>
    </div>
@endif

<p> &nbsp; </p>


<div class="control-group">

        {!! Form::label('airway_bill_number', 'Airway Bill Number:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('airway_bill_number',Input::old('airway_bill_number'), array('class' => 'form-control','required')) !!}
        {!! Form::label('courier_company', 'Courier Company:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('courier_company',Input::old('courier_company'), array('class' => 'form-control','required')) !!}

        {!!Form::hidden('status','dispatched')  !!}
</div>

<p> &nbsp; </p>

<a href=""  class="btn btn-default" type="button"> Close </a>

{!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}

