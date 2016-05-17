<div class="modal-dialog">
    <div class="modal-content" style="width:800px">
        <div class="modal-header">
            <a href="{{ URL::previous() }}" class="btn btn-xs btn-default pull-right" type="button"> x </a>
            <h4 class="modal-title">Update Order</h4>
        </div>
        <div class="modal-body">

            {!! Form::model($data, ['method' => 'PATCH', 'route'=> ['orders.update', $data->id]]) !!}
            {!! Form::hidden('rep_requested',$rep_requested) !!}
            {!! Form::hidden('rep_order_desc',$data->rep_order_desc) !!}
            {!! Form::hidden('new_product_name',$data->new_product_name) !!}
            {!! Form::hidden('rep_delivery_address',$data->rep_delivery_address) !!}
            @include('order_rep._form')

            {!! Form::close() !!}

        </div>
    </div>
</div>