<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 11/19/15
 * Time: 9:59 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use Illuminate\Http\Request;

class OrderRep extends Model
{

    protected $table = 'order_replacement';

    protected $fillable = [

        'reference_number','date','market_place','rep_requested','status','order_number','desc',
        'buyer_email_id','buyer_phone_number','order_amount','discussion_with_buyer','rep_order_desc',
        'new_product_name','rep_delivery_address','rep_refund_cost','airway_bill_number', 'courier_company'

    ];
}