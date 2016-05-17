<?php

namespace App\Http\Controllers;

use App\Helpers\EmailSend;
use App\OrderRep;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Session;
use Response;
use PHPExcel;
use PHPExcel_Cell_DataType;
use PHPExcel_IOFactory;
class OrderRepController extends Controller
{

    public function home_dashboard(){

        if(Auth::check()){

            $user = User::where('id',Auth::user()->id)->first();
            return view('home.dashboard',['user'=>$user]);
        }else{
            Session::flash('flash_message_error', 'No user is defined. Please login as csagent / sagent / admin');
            return view('user.login.login');
        }

    }

    public function my_order(){
        if(Auth::check()){
            $user = User::where('id',Auth::user()->id)->first();

            if($user->type == 'csagent'){

                $order_data = OrderRep::where('status','raised')->where('status','!=','close')
                                       ->where('rep_requested','refund')->orderBy('id','desc')->paginate(10);

            }if($user->type == 'sagent'){

                $order_data = OrderRep::where('status','!=','close')
                    ->whereIn('rep_requested',array('same','new'))->orderBy('id','desc')->paginate(10);

            }if($user->type == 'admin'){

                $order_data = OrderRep::orderBy('id','desc')->paginate(10);
            }
            return view('order_rep.my_order',['user'=>$user,'order_data'=>$order_data]);
        }else{

            return view('user.login.login');
        }
    }

    public function excel_export(){

    }

    public function order_list_all(){

        if(Auth::check()){
            $user = User::where('id',Auth::user()->id)->first();
            $order_data = OrderRep::orderBy('reference_number','desc')->paginate(10);

            //Excel Export
            $order_data_export = OrderRep::orderBy('reference_number','desc')->get();
            $objPHPExcel = new \PHPExcel();
            $objPHPExcel->getProperties()->setCreator("AH")
                ->setLastModifiedBy("AH")
                ->setTitle("Order List")
                ->setSubject("All order List")
                ->setDescription("Manipulated")
                ->setKeywords("Excel Export")
                ->setCategory("Order Data");

            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(18);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(22);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(24);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(26);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);

            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Market Place')
                ->setCellValue('B1', 'Reference Number')
                ->setCellValue('C1', 'Order Number')
                ->setCellValue('D1', 'Buyer Email ID')
                ->setCellValue('E1', 'Buyer Phone Number')
                ->setCellValue('F1', 'Order Amount')
                ->setCellValue('G1', 'Rep. Request')
                ->setCellValue('H1', 'New Product Name')
                ->setCellValue('I1', 'Refund Product Cost')
                ->setCellValue('J1', 'Airway Bill Number')
                ->setCellValue('K1', 'Status')
            ;
            $i = 2;
            foreach($order_data_export as $ode){
                // Data write to excel
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValueExplicit('A'.($i), $ode->market_place, PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('B'.($i), $ode->reference_number, PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('C'.($i), $ode->order_number, PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('D'.($i), $ode->buyer_email_id, PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('E'.($i), $ode->buyer_phone_number, PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('F'.($i), $ode->order_amount, PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('G'.($i), $ode->rep_requested, PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('H'.($i), $ode->new_product_name, PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('I'.($i), $ode->rep_refund_cost, PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('J'.($i), $ode->airway_bill_number, PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('K'.($i), $ode->status, PHPExcel_Cell_DataType::TYPE_STRING)
                ;
                $i++;
            }

            // Create Excel write
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            try {
                $file = public_path().DIRECTORY_SEPARATOR.'all-orders.xlsx';

                $fp = fopen($file, 'w');
                fclose($fp);
                chmod($file, 0777);

                $objWriter->save($file);
            }catch (Exception $ex){

            }
            //End of Excel write

            return view('order_rep.order_list',['user'=>$user,'order_data'=>$order_data]);
        }else{
            return view('user.login.login');
        }
    }

    public function store(Request $request)
    {

        $input = $request->all();
        $first_ref_number = 1000000001;
        $top_ref_number_exists =  DB::table('order_replacement')->exists();

        if($top_ref_number_exists){
            $top_ref_number =  DB::table('order_replacement')->max('reference_number');
            $cur_ref_number = $top_ref_number + 1;
        }else{
            $cur_ref_number = $first_ref_number;
        }

        /* Transaction Start Here */
        DB::beginTransaction();
        try {

            $input_data = [
                'reference_number'=>      $cur_ref_number,
                'date'=>                  date('Y-m-d h:i:s', time()),
                'status'=>                'raised',

                'market_place'=>          $input['market_place'],
                'rep_requested'=>         $input['rep_requested'],
                'order_number'=>          $input['order_number'],
                'desc'=>                  $input['desc'],
                'buyer_email_id'=>        $input['buyer_email_id'],
                'buyer_phone_number'=>    $input['buyer_phone_number'],
                'order_amount'=>          $input['order_amount'],
                'discussion_with_buyer'=> $input['discussion_with_buyer'],
                'rep_order_desc'=>        $input['rep_order_desc'],
                'new_product_name'=>      $input['new_product_name'],
                'rep_delivery_address'=>  $input['rep_delivery_address'],
                'rep_refund_cost'=>       $input['rep_refund_cost'],
//              'airway_bill_number'=> $input['airway_bill_number'],
            ];

            if($input['rep_requested'] == 'same' || $input['rep_requested'] == 'new')
                $subject = 'Order Replacement';
            else
                $subject = 'Order Refund';

            if($input['rep_requested'] == 'same' || $input['rep_requested'] == 'same') {
                $body = 'Your Replacement # '.$cur_ref_number.' is registered for '.$input['market_place'].' order # '.$input['order_number'].'. On dispatch we will inform you tracking details.';
            }else{
                $body = 'Your Refund of Rs. '.$input['rep_refund_cost'].' for '.$input['market_place'].' order # '.$input['order_number'].' been initiated & will reflect your ac within 8-10 working days.';
            }

            //EmailSend::email_send($input['buyer_email_id'], $subject, $body, $from_email = null, $from_name = null);
            $subject = "TEST SMS";
            $sms_buffer = $this->send_sms($input['buyer_phone_number'], $subject, $body);

            $model = new OrderRep();
            $model->fill($input_data)->save();

            DB::commit();
            Session::flash('flash_message', 'Successfully Created New Order! SMS sending status: '.$sms_buffer);
        }catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('flash_message_error', $e->getMessage());
        }
        return redirect()->back();
    }


    public function show($id){
        $pageTitle = 'Order Details';
        $data = OrderRep::findOrFail($id);

        return view('order_rep.view', ['data' => $data, 'pageTitle'=> $pageTitle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = OrderRep::findOrFail($id);
        $rep_requested = $data->rep_requested;
        return view('order_rep.update', ['data'=>$data,'rep_requested'=>$rep_requested]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $model = OrderRep::findOrFail($id);
        $input = $request->all();

        /* Transaction Start Here */
        DB::beginTransaction();
        try {

            $input_data = [
                'date'=> date('Y-m-d h:i:s', time()),
                'status'=> 'raised',
                'market_place'=>$input['market_place'],
                'rep_requested'=> $input['rep_requested'],
                'order_number'=> $input['order_number'],
                'desc'=> $input['desc'],
                'buyer_email_id'=> $input['buyer_email_id'],
                'buyer_phone_number'=> $input['buyer_phone_number'],
                'order_amount'=> $input['order_amount'],
                'discussion_with_buyer'=> $input['discussion_with_buyer'],
                'rep_order_desc'=> $input['rep_order_desc'],
                'new_product_name'=> $input['new_product_name'],
                'rep_delivery_address'=> $input['rep_delivery_address'],
                'rep_refund_cost'=> $input['rep_refund_cost'],
                'airway_bill_number'=> $input['airway_bill_number'],
            ];

            $model->fill($input_data)->save();

            DB::commit();
            Session::flash('flash_message', 'Successfully Updated!');
        }catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('flash_message_error', $e->getMessage());
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $model = OrderRep::findOrFail($id);
            if ($model->delete()) {
                Session::flash('flash_message', " Successfully Deleted.");
                return redirect()->back();
            }
        } catch(\Exception $ex) {
            Session::flash('flash_message_error', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function create_airway_bill_number($id){

        $model = OrderRep::findOrFail($id);
        return view('order_rep.airway_bill_number', ['model'=>$model]);

    }

    public function store_airway_bill_number(Request $request, $id){

        $model = OrderRep::findOrFail($id);
        $input = $request->all();
        $buyer_phone_number = $model->buyer_phone_number;
        try{
            $model->fill($input)->save();

            $subject = 'Order Dispatched';
            $body = 'Your Refund of Rs. '.$model['rep_refund_cost'].' for '.$model['market_place'].' order # '.$model['order_number'].' been initiated & will reflect your ac within 8-10 working days.From www.zaktag.com';

            EmailSend::email_send($model['buyer_email_id'], $subject, $body, $from_email = null, $from_name = null);

            $subject = "TEST SMS";
            $sms_buffer = $this->send_sms($buyer_phone_number, $subject, $body);

            Session::flash('flash_message', " Successfully Added. SMS sending status: ".$sms_buffer);
            return redirect()->back();

        }catch(\Exception $e){
            Session::flash('flash_message_error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function close_order(Request $request, $id){

        $model = OrderRep::findOrFail($id);
        //$input = Input::all();
        $input_data = $request->all();
        /* Transaction Start Here */
        DB::beginTransaction();
        try{
            $model->status = "close";
            $model->update($input_data);
            DB::commit();
            Session::flash('flash_message', 'Successfully Closed This Order!');
        }catch ( Exception $e ){
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('flash_message_error', $e->getMessage() );
        }
        return redirect()->back();
    }

    public function print_order($id){
        //return view('test.print');
    }

    public function send_sms($receipientno = '9704212707', $senderID = 'TEST SMS', $msgtxt = 'This is a test message.'){
        $ch = curl_init();
        $user = "zaktag.retail@gmail.com:Hyderabad1";
        #$receipientno = "9704212707";
        #$senderID = "TEST SMS";
        #$msgtxt = "this is test message , test";
        curl_setopt($ch,CURLOPT_URL,  "http://api.mVaayoo.com/mvaayooapi/MessageCompose");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=$receipientno&msgtxt=$msgtxt");
        $buffer = curl_exec($ch);
        if(empty ($buffer)){
            return "Buffer is empty";
        }else{
            return $buffer;
        }
        curl_close($ch);
    }
}
