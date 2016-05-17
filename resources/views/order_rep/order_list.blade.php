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

                <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        @if($user->type == 'admin')
                            <a class="btn-sm btn-info pull-right" data-toggle="modal" href="#addData">
                                <strong>Create Order</strong>
                            </a>
                        @endif
                            <a class="btn-sm btn-info pull-left" href="/all-orders.xlsx">
                                <strong>Export Orders</strong>
                            </a>
                        <p> &nbsp; </p>
                    </header>

                    <div class="panel-body">

                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="data-table-example">
                                <thead>
                                <tr>
                                    <th> Market Place </th>
                                    <th> Reference Number</th>
                                    <th> Order Number</th>
                                    <th> Buyer Email ID</th>
                                    <th> Buyer Phone No. </th>
                                    <th> Order Amount </th>
                                    <th> Rep. Requested</th>
                                    <th> New Product Name</th>
                                    <th> Product Refund Cost</th>
                                    <th> Airway Bill Number</th>
                                    <th> Status </th>
                                    <th>  </th>
                                    {{--<th>Change Status</th>--}}
                                </tr>
                                </thead>
                                <tbody>

                                @if(isset($order_data))
                                    @foreach($order_data as $values)
                                        <tr>

                                            <td>{{ucfirst($values->market_place)}}</td>
                                            <td>{{$values->reference_number}}</td>
                                            <td>{{$values->order_number}}</td>
                                            <td>{{$values->buyer_email_id}}</td>
                                            <td>{{$values->buyer_phone_number}}</td>
                                            <td>{{$values->order_amount}}</td>
                                            <td>{{ucfirst($values->rep_requested)}}</td>
                                            <td>{{$values->new_product_name}}</td>
                                            <td>{{$values->rep_refund_cost}}</td>
                                            <td>{{$values->airway_bill_number}}</td>
                                            <td>{{$values->status}}
                                            </td>
                                            <td>
                                                <a href="{{ route('orders.show', $values->id) }}" class="btn btn-info btn-xs" data-toggle="modal" data-target="#etsbModal" title="Order View"><i class="icon-eye-open"></i></a>

                                            @if($user->type == 'admin')
                                                    <a href="{{ route('orders.edit', $values->id) }}" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#etsbModal" title="Edit Order"><i class="icon-edit"></i></a>
                                                    {{--<a href="{{ route('print-order-data', $values->id) }}" id='ord-print' class="btn btn-success btn-xs" title="Print This Order"><i class="icon-print"></i></a>--}}

                                                @if($values->status != 'close')
                                                        <a href="{{ route('order.close', $values->id) }}" class="btn btn-default btn-group-lg btn-xs" onclick="return confirm('Are you sure to close this order?')" title="close this order"><i class="icon-minus-sign"></i></a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>

                            <span class="pull-right">{!! str_replace('/?', '?', $order_data->render()) !!} </span>
                        </div>
                    </div>
                </section>
            </div>
        </div>


        <!-- addData -->
        <div class="modal fade" id="addData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="width:800px">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Create Order</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['route' => 'order.store']) !!}
                        @include('order_rep._form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
        <!-- Modal  -->
        <div class="modal fade" id="etsbModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
        </div>
        <!-- modal -->

        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">

        </div>
        <div class="modal fade" id="bill-number" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">

        </div>

        @if($errors->any())
            <script type="text/javascript">
                $(function(){
                    $("#addData").modal('show');
                });
            </script>
        @endif

@stop