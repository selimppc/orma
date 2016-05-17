{{--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>--}}
{{--<script src="../jQuery.print.js"></script>--}}

<div class="modal-dialog">
    <div class="modal-content" style="width:800px" >
        <div class="modal-header">
            <a href="{{ URL::previous() }}" class="btn btn-xs btn-default pull-right" type="button"> x </a>
            <h4 class="modal-title">{{ $pageTitle }}</h4>
        </div>

        <div class="modal-body" >
            <a href="javascript:printDiv('printable') " class="pull-right btn btn-xs paste-blue-button-bg print_frame"> Print this </a>
            <div style="padding: 30px;">
                <table id="" class="table table-bordered table-hover table-striped">
                    <tr>
                        <th class="col-lg-4">Market Place</th>
                        <td>{{ $data->market_place }}</td>
                    </tr>

                    <tr>
                        <th class="col-lg-4">Reference Number</th>
                        <td>{{ $data->reference_number }}</td>
                    </tr>

                    <tr>
                        <th class="col-lg-4">Order Number</th>
                        <td>{{ $data->order_number }}</td>
                    </tr>
                    <tr>
                        <th class="col-lg-4">Buyer Email ID</th>
                        <td>{{ $data->buyer_email_id }}</td>
                    </tr>
                    <tr>
                        <th class="col-lg-4">Buyer Phone Number</th>
                        <td>{{ $data->buyer_phone_number }}</td>
                    </tr>
                    <tr>
                        <th class="col-lg-4">Order Amount</th>
                        <td>{{ $data->order_amount }}</td>
                    </tr>
                    <tr>
                        <th class="col-lg-4">Discussion with Buyer</th>
                        <td>{{ $data->discussion_with_buyer }}</td>
                    </tr>
                    <tr>
                        <th class="col-lg-4">Replacement Requested</th>
                        <td>{{ $data->rep_requested }}</td>
                    </tr>
                    <tr>
                        <th class="col-lg-4">Replacement order Description</th>
                        <td>{{ $data->rep_order_desc }}</td>
                    </tr>
                    @if(isset($data->new_product_name))
                        <tr>
                            <th class="col-lg-4">New Product Name</th>
                            <td>{{ $data->new_product_name }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th class="col-lg-4">Replacement Delivery Address</th>
                        <td>{{ $data->rep_delivery_address }}</td>
                    </tr>
                    <tr>
                        <th class="col-lg-4">Product Refund Cost</th>
                        <td>{{ $data->rep_refund_cost }}</td>
                    </tr>
                    <tr>
                        <th class="col-lg-4">Airway Bill Number</th>
                        <td>{{ $data->airway_bill_number }}</td>
                    </tr>
                    <tr>
                        <th class="col-lg-4">Status</th>
                        <td>{{ $data->status }}</td>
                    </tr>
                    <tr>
                        <th class="col-lg-4">Date</th>
                        <td>{{ $data->date }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <a href="{{ URL::previous()}}" class="btn btn-default" type="button"> Close </a>

        </div>

        <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>

    </div>
</div>


<script>
//    printDivCSS = new String ('<link href="myprintstyle.css" rel="stylesheet" type="text/css">')
    function printDiv(divId) {
        window.frames["print_frame"].document.body.innerHTML= document.getElementById(divId).innerHTML;
        window.frames["print_frame"].window.focus();
        window.frames["print_frame"].window.print();
    }
</script>

<div id="printable" style="display: none">
    <p> &nbsp; </p>
    <div style="margin-left: 80%" style="font-size: 20px">
        Order # <?php echo $data->order_number?>
    </div>
    <p> &nbsp; </p>

    <div></div>
    <header class="panel-heading" style="font-size: 22px">
        <strong>Ship To :</strong>
        @if(isset($data->rep_delivery_address))
            <p>Address :{{$data->rep_delivery_address}}</p>
        @endif
        <p>Phone :{{isset($data->buyer_phone_number)?$data->buyer_phone_number:''}}</p>
    </header>

    <p> &nbsp; </p>
    <div >
        <table cellspacing="50">

                <thead style="border-bottom:1pt solid black">
                   <tr style="font-size: 18px">
                       <th> Product Name</th>
                       <th> Qty</th>
                       <th> Sub Total</th>
                   </tr>

                </thead>
            <tbody>
            <tr>
                <td>{{isset($data->new_product_name)?$data->new_product_name:''}}</td>
                <td>{{count($data)}}</td>
                <td>{{isset($data->rep_refund_cost)?$data->rep_refund_cost:''}}</td>
            </tr>
            </tbody>
        </table>
        {{--<hr>--}}
    </div>
    <p> &nbsp; </p>

    <div>
        <header class="panel-heading " style="text-align: right;font-size: 22px">
            <strong>Return To :</strong>
        </header>
            <p style="text-align: right">
                Zaktag Retail,13-6-438/70,Rd.no.2, Satyanarayana Nagar,
            </p>
        <p style="text-align: right">
            Mehdipatnam Mehdipatnam,
        </p>
        <p style="text-align: right">
            HYderabad , AP - 500028
        </p>
        <p style="text-align: right">
            Phone : 9704212707
        </p>
    </div>
</div>



