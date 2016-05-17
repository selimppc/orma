<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <a href="{{ URL::previous() }}" class="btn btn-xs btn-default pull-right" type="button"> x </a>
            <h4 class="modal-title">Add Airway Bill Number</h4>
        </div>
        <div class="modal-body">

            {!! Form::model($model, ['method' => 'PATCH', 'route'=> ['store.airway-bill-number', $model->id]]) !!}
            @include('order_rep._form_bill_no')
            {!! Form::close() !!}

        </div>
    </div>
</div>