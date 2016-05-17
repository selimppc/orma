<?php

namespace App\Http\Controllers;

use App\Filter;
use App\SenderEmail;
use App\User;
use DB;
use Session;
use Auth;
use App\Helpers\Xmlapi;
use App\Imap;
use App\Smtp;
use Illuminate\Support\Facades\Input;
use Queue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UserResetPassword;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::has('email')) {
            return redirect()->route('home-dashboard');
        }
        else{
            return view('user.login.login');
        }
    }




    public function layout_language_switch_bar()
    {
        return view('pages.layouts.language_switch_bar');
    }
//UI-elements..
    public function elements_general()
    {
        return view('pages.ui_elements.general');
    }

    public function elements_buttons()
    {
        return view('pages.ui_elements.button');
    }

    public function elements_widget()
    {
        return view('pages.ui_elements.widget');
    }



    public function data_tables_editable()
    {
        return view('pages.data_tables.editable');
    }

    public function data_tables_responsive()
    {
        return view('pages.data_tables.responsive');
    }

    //mail..
    public function mail()
    {
        return view('pages.mail._mail');
    }

    //charts....
    public function chart_js()
    {
        return view('pages.charts.chartjs');
    }
    public function chart_flot()
    {
        return view('pages.charts.flot_chart');
    }
    public function chart_morris()
    {
        return view('pages.charts.morris');
    }
    public function chart_x()
    {
        return view('pages.charts.x_chart');
    }

    //shop....
    public function shop_list_view()
    {
        return view('pages.shop.list_view');
    }
    public function shop_details_view()
    {
        return view('pages.shop.details_view');
    }

    //google-map...
    public function google_map()
    {
        return view('pages.google_map._google_map');
    }

    //extra....
    public function extra_404_error()
    {
        return view('pages.extra.404_error');
    }
    public function extra_500_error()
    {
        return view('pages.extra.500_error');
    }
    public function extra_blank_page()
    {
        return view('pages.extra.blank_page');
    }
    public function extra_invoice()
    {
        return view('pages.extra.invoice');
    }
    public function extra_lock_screen()
    {
        return view('pages.extra.lock_screen');
    }
    public function extra_profile()
    {
        return view('pages.extra.profile');
    }
    public function extra_search_result()
    {
        return view('pages.extra.search_result');
    }

    //login....
    /*public function login()
    {
        return view('pages.login._login');
    }*/

    //multilevel-menu....
    public function menu_item_1()
    {
        return view('pages.menu.item_1');
    }
    public function menu_item_2()
    {
        return view('pages.menu.item_2');
    }


    /*
     *
     * Form Validation
     */
    public function form_validation(){
        return view('form_validation.form_valid');
    }

    public function new_advanced_form(){
        return view('form_validation.advanced_form');
    }

    public function modal_form(){
        return view('test.modal');
    }


    /*
     *
     * Mail Queue : Delay
     *
     */
    public function send_email_with_delay()
    {
        $input = [
            'name' => 'Mario Basic',
            'email' => 'nhsajib316@gmail.com',
            'comment' =>  'Testing queues',
            'subject' =>  'Email subject'
        ];


        try {
            Mail::queue('home.email', array(''), function ($message) {
                $message->from('bdcode404@gmail.com', 'Nadim');
                $message->to('bdcode404@gmail.com');
                $message->subject('Test New');
            });
        }
        catch(\Exception $e){
            return "Not send";
        }

        return "successfully send";
    }


    /*
     * Generate email account in cpanel
     *
     *
     */



    public function home_reminder_mail()
    {
        $email = 'admin@admin.com';
        $user_exists = DB::table('user')->where('email', '=', $email)->exists();

        if($user_exists){
            $user = DB::table('user')->where('email', '=', $email)->first();

            $model = new UserResetPassword();
            $model->user_id = $user->id;
            $model->reset_password_token = str_random(30);
            $token = $model->reset_password_token;
            $model->reset_password_expire = date("Y-m-d h:i:s", (strtotime(date('Y-m-d h:i:s', time())) + (60 * 30)));
            $model->reset_password_time = date('Y-m-d h:i:s', time());
            $model->status = 2;


            if($model->save()) {
                try{
                    Mail::send('user.forgot_password.email_notification', array('link' =>$token),
                        function($message) use ($user)
                        {
                            $message->from('test@edutechsolutionsbd.com', 'AFFIFACT');
                            $message->to($user->email);
                            $message->cc('tanintjt@gmail.com', 'Tanin');
                            $message->subject('Forgot Password Reset Mail');
                        });
                    Session::flash('flash_message', 'Sent email with reset password. Please check your email!');
                }catch (\Exception $e){
                    Session::flash('flash_message_error', 'Email does not Send!');
                }

            }else{
                Session::flash('flash_message_error', 'Does not Save!');
            }
            #return view('user.forgot_password.flash_message');
        }else{
            Session::flash('flash_message_error', 'The Specified Email address Is not Listed On Your Account. Please Try Again.');
            exit("Account nai tomar");
        }
        return redirect('user/dashboard');


    }




    public function check_keyword_exists(){
        #$list =array('postmaster', 'no-reply', 'cheese', 'milk');
        $filter_list= DB::table('filter')->select('name')->get();
        foreach($filter_list as $filter){
            $list []= [
                'name' => $filter->name,
            ];
        }
        $text ='no-reply@gmail.com';

        $match = 0;
        foreach ($list[0] as $word) {
            // This pattern takes care of word boundaries, and is case insensitive
            $pattern = "/\b$word\b/i";
            $match += preg_match($pattern, $text);
        }
        print_r($match);
        exit;
    }



    public function settings()
    {
        $pageTitle = " System Settings";
        return view('settings.setup', [
            'pageTitle'=>$pageTitle
        ]);
    }







}
