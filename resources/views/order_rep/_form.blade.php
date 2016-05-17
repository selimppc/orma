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

<div class="control-group">
    <div class="col-lg-6">
        {!! Form::label('market_place', 'Market Place:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::Select('market_place',array(''=>'Market Place','ebay'=>'eBay','amazon'=>'Amazon','zaktag'=>'Zaktag','flipcart'=>'Flipcart','snapdeal'=>'Snapdeal','paytm'=>'Paytm'),Input::old('market_place'),['class'=>'form-control','required']) !!}

    </div>
    <div class="col-lg-6">
        {!! Form::label('order_number', 'Order Number:') !!}
        <small class="required">(Required)</small>
        {!! Form::text('order_number',Input::old('order_number'), array('class' => 'form-control','placeholder'=>'Enter Order Number','required')) !!}
    </div>
</div>
<p> &nbsp; </p>
@if(isset($data))
    <div class='control-group'>
        <div class="col-lg-12">
            {!! Form::label('reference_number', 'Reference Number:', ['class' => 'control-label']) !!}
            {!! Form::text('reference_number', $data->reference_number,[ 'readonly','class'=>'form-control']) !!}
        </div>
    </div>
@endif

<p> &nbsp; </p>
<div class='control-group'>
    <div class="col-lg-12">
        {!! Form::label('desc', 'Description:', ['class' => 'control-label']) !!}
        {!! Form::textarea('desc', Input::old('desc'),['id'=>'desc','size' => '30x5', 'class'=>'form-control','onkeyup'=>'moveOnNext();']) !!}
   </div>
</div>

<div class="control-group">
    <div class="col-lg-6">
        {!! Form::label('buyer_email_id', 'Buyer Email ID:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('buyer_email_id',Input::old('buyer_email_id'), array('class' => 'form-control','required')) !!}
    </div>
    <div class="col-lg-6">
        {!! Form::label('buyer_phone_number', 'Buyer Phone Number:') !!}
        <small class="required">(Required)</small>
        {!! Form::text('buyer_phone_number',Input::old('buyer_phone_number'), array('class' => 'form-control','placeholder'=>'Buyer Phone Number','required')) !!}
    </div>
</div>

<div class="control-group">
    <div class="col-lg-6">
        {!! Form::label('order_amount', 'Order Amount:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('order_amount',Input::old('order_amount'), array('class' => 'form-control','required')) !!}
    </div>
    <div class="col-lg-6">
        {!! Form::label('rep_requested', 'Replacement Requested:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
          @if(isset($data->rep_requested))
                {!! Form::text('rep_requested', $data->rep_requested, ['id'=>'order_data->rep_requested', 'readonly', 'class' => 'form-control', 'required'=>'required']) !!}
            @else
                {!! Form::Select('rep_requested',array('refund'=>'Refund','new'=>'New','same'=>'Same'),Input::old('rep_requested'),['class'=>'form-control ','id'=>'requested','required']) !!}
           @endif
    </div>
</div>
<p> &nbsp; </p>
<div class="control-group">

    @if(isset($data))
        @if($data->rep_requested == 'same'|| $data->rep_requested == 'new')
            <div class="col-lg-12">
                {!! Form::label('rep_order_desc', 'Replacement Order Description:', ['class' => 'control-label']) !!}
                {!! Form::textarea('rep_order_desc', $data->rep_order_desc,['id'=>'rep_ord_desc','size' => '30x5', 'class'=>'form-control','onclick'=>'moveOnNext();']) !!}
            </div>

            @if($data->rep_requested == 'new')
                <div class="col-lg-12">
                    {!! Form::label('new_product_name', 'New Product Name:', ['class' => 'control-label']) !!}
                    {!! Form::text('new_product_name', $data->new_product_name,[ 'class'=>'form-control']) !!}
                </div>
            @endif
            <div class="col-lg-12" style="display:block" id="rep_delivery_address">
                {!! Form::label('rep_delivery_address', 'Replacement Delivery Address:', ['class' => 'control-label']) !!}
                {!! Form::text('rep_delivery_address', Input::old('rep_delivery_address'),[ 'class'=>'form-control']) !!}
            </div>
        @endif
    @else
        <div class='control-group'>
            <div class="col-lg-12" style="display:none" id="rep_order_desc">
                {!! Form::label('rep_order_desc', 'Replacement Order Description:', ['class' => 'control-label']) !!}
                {!! Form::textarea('rep_order_desc', Input::old('rep_order_desc'),['id'=>'rep_ord_desc','size' => '30x5', 'class'=>'form-control','onclick'=>'moveOnNext();']) !!}
            </div>
            <div class="col-lg-12" style="display:none" id="new_product_name">
                {!! Form::label('new_product_name', 'New Product Name:', ['class' => 'control-label']) !!}
                {!! Form::text('new_product_name', Input::old('new_product_name'),[ 'class'=>'form-control']) !!}
            </div>
            <div class="col-lg-12" style="display:none" id="rep_delivery_address">
                {!! Form::label('rep_delivery_address', 'Replacement Delivery Address:', ['class' => 'control-label']) !!}
                {!! Form::text('rep_delivery_address', Input::old('rep_delivery_address'),[ 'class'=>'form-control']) !!}
            </div>
        </div>
    @endif

</div>
<div class='control-group'>
    <div class="col-lg-12">
        {!! Form::label('rep_refund_cost', 'Replacement Refund Cost:', ['class' => 'control-label']) !!}
        {!! Form::text('rep_refund_cost', Input::old('rep_refund_cost'),[ 'class'=>'form-control','required']) !!}
    </div>
</div>
<div class='control-group'>
    <div class="col-lg-12">
        {!! Form::label('discussion_with_buyer', 'Discussion With Buyer:', ['class' => 'control-label']) !!}
        {!! Form::textarea('discussion_with_buyer', Input::old('discussion_with_buyer'),['size' => '30x5', 'class'=>'form-control']) !!}
    </div>
</div>

@if(isset($data))
    <div class='control-group'>
        <div class="col-lg-12">
            {!! Form::label('airway_bill_number', 'Airway Bill Number:', ['class' => 'control-label']) !!}
            {!! Form::text('airway_bill_number', $data->airway_bill_number,[ 'class'=>'form-control']) !!}
        </div>
    </div>
@endif

<p> &nbsp; </p>

<a href=""  class="btn btn-default" type="button"> Close </a>

{!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}

<script>
    $('select[id=requested]').change(function () {
        if ($(this).val()=="same") {
            $('#rep_order_desc').show();
            $('#new_product_name').hide();
            $('#rep_delivery_address').show();

        }
        if($(this).val()=="refund"){
            $('#rep_order_desc').hide();
            $('#new_product_name').hide();
            $('#rep_delivery_address').hide();
        }
        if($(this).val()=="new"){
            $('#rep_order_desc').show();
            $('#new_product_name').show();
            $('#rep_delivery_address').show();
        }
    });

    function moveOnNext(){

        var text = document.getElementById('desc').value;
        document.getElementById('rep_ord_desc').value = text;
    }


</script>