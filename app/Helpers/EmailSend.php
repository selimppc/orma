<?php
/**
 * Created by PhpStorm.
 * User: selimets
 * Date: 11/5/15
 * Time: 10:25 AM
 */

namespace App\Helpers;

use App\SenderEmail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class EmailSend{

    /* @
     * @param $host ['string']
     * @param $port ['integer']
     * @param $from_email ['string']
     * @param $from_name ['string']
     * @param $username ['string'] :: sender email => username
     * @param $password ['string'] :: sender email => password
     * @param $to_email ['string']
     * @param $subject ['string']
     * @param $subject ['text']
     * @return bool
     */
    public static function reply_email( $from_email,$from_name, $to_email, $subject, $body){

        Config::set('mail.driver', 'smtp');
        Config::set('mail.host', 'smtp.gmail.com');
        Config::set('mail.port', 465);
        Config::set('mail.from', ['address' => $from_email, 'name' => $from_name]);
        Config::set('mail.encryption', 'ssl');
//        Config::set('mail.username', $username);
        Config::set('mail.username', 'devdhaka404@gmail.com');
//        Config::set('mail.password', $password);
        Config::set('mail.password', 'etsb1234');
        Config::set('mail.sendmail', '/usr/sbin/sendmail -bs');
        Config::set('mail.pretend', false);
        #Config::set('mail.encryption', $sender_email->relSmtp->secure);

        // Send email
        try{
            Mail::send('email_template.common', array('body'=>$body), function ($message) use($from_email, $to_email, $subject) {

                $message->from($from_email);
                $message->to($to_email);
                $message->subject($subject);
            });

            return true;
        }catch (\Exception $e){
            print_r($e->getMessage());exit('in catch block');
            return true;
        }
    }

    /**
     * @param $to_email could be a single email or array_list of emails
     * @param $subject
     * @param $body
     * @param null $from_email
     * @param null $from_name
     */
    public static function email_send($to_email, $subject, $body, $from_email = null, $from_name = null){
        if(!$from_email)
            $from_email = Config::get('mail.from')['address'];
        if(!$from_name)
            $from_name = Config::get('mail.from')['name'];

        Mail::send('email_template.common', array('body'=>$body),
            function($message) use($to_email, $subject, $from_email, $from_name){
                $message->from($from_email, $from_name);
                $message->to($to_email);
                $message->replyTo($from_email);
                $message->subject($subject);
            }
        );

    }

}