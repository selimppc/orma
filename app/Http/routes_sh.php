<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 9/20/15
 * Time: 5:43 PM
 */

/*
 * -------------------  Start SMTP area ------------------------
 */

Route::any('smtp/index', [
    'as' => 'smtp.index',
    'uses' => 'SmtpController@index'
]);


Route::any('smtp/create', [
    'as' => 'smtp.create',
    'uses' => 'SmtpController@create'
]);


Route::any('smtp/store', [
    'as' => 'smtp.store',
    'uses' => 'SmtpController@store'
]);


Route::any('smtp/show-data/{id}', [
    'as' => 'smtp.show.data',
    'uses' => 'SmtpController@show'
]);

Route::any('smtp/edit/{id}', [
    'as' => 'smtp.edit',
    'uses' => 'SmtpController@edit'
]);

Route::any('smtp/update/{id}', [
    'as' => 'smtp.update',
    'uses' => 'SmtpController@update'
]);

Route::any('smtp/destroy/{id}', [
    'as' => 'smtp.destroy',
    'uses' => 'SmtpController@destroy'
]);

/*
*  ------------------- END SMTP area -----------------------
 */




/*
* -------------------  Start Token area ------------------------
 */

Route::any('token/index', [
    'as' => 'token.index',
    'uses' => 'TokenController@index'
]);


Route::any('token/create', [
    'as' => 'token.create',
    'uses' => 'TokenController@create'
]);


Route::any('token/store', [
    'as' => 'token.store',
    'uses' => 'TokenController@store'
]);


Route::any('token/show-data/{id}', [
    'as' => 'token.show.data',
    'uses' => 'TokenController@show'
]);

Route::any('token/edit/{id}', [
    'as' => 'token.edit',
    'uses' => 'TokenController@edit'
]);

Route::any('token/update/{id}', [
    'as' => 'token.update',
    'uses' => 'TokenController@update'
]);

Route::any('token/destroy/{id}', [
    'as' => 'token.destroy',
    'uses' => 'TokenController@destroy'
]);

/*
*  ------------------- END Token area -----------------------
 */




/*
* -------------------  Start Filter area ------------------------
 */

Route::any('filter/index', [
    'as' => 'filter.index',
    'uses' => 'FilterController@index'
]);


Route::any('filter/store', [
    'as' => 'filter.store',
    'uses' => 'FilterController@store'
]);


Route::any('filter/show-data/{id}', [
    'as' => 'filter.show.data',
    'uses' => 'FilterController@show'
]);

Route::any('filter/edit/{id}', [
    'as' => 'filter.edit',
    'uses' => 'FilterController@edit'
]);

Route::any('filter/update/{id}', [
    'as' => 'filter.update',
    'uses' => 'FilterController@update'
]);

Route::any('filter/destroy/{id}', [
    'as' => 'filter.destroy',
    'uses' => 'FilterController@destroy'
]);

/*
*  ------------------- END Filter area -----------------------
 */


/*
* -------------------  Start Sender_Email area ------------------------
 */



Route::any('sender-email/index/{id}', [
    'as' => 'sender-email.index',
    'uses' => 'SenderEmailController@index'
]);
Route::any('sender-email/store', [
    'as' => 'sender-email.store',
    'uses' => 'SenderEmailController@store'
]);
Route::any('sender-email/show-data/{id}', [
    'as' => 'sender-email.show.data',
    'uses' => 'SenderEmailController@show'
]);
Route::any('sender-email/edit/{id}', [
    'as' => 'sender-email.edit',
    'uses' => 'SenderEmailController@edit'
]);
Route::any('sender-email/update/{id}', [
    'as' => 'sender-email.update',
    'uses' => 'SenderEmailController@update'
]);
Route::any('sender-email/destroy/{id}', [
    'as' => 'sender-email.destroy',
    'uses' => 'SenderEmailController@destroy'
]);


/*
*  ------------------- END Sender_Email area -----------------------
 */




/*
* -------------------  Start Sender_User area ------------------------
 */


Route::any('sender-email/create-user', [
    'as' => 'sender-email.create-user',
    'uses' => 'SenderEmailController@create_user'
]);

/*
*  ------------------- END Sender_User area -----------------------
 */


/*
* -------------------  Start Poping_Email area ------------------------
 */

Route::any('popping-email/index', [
    'as' => 'popping_email.index',
    'uses' => 'PoppingEmailController@index'
]);
Route::any('popping-email/store', [
    'as' => 'popping_email.store',
    'uses' => 'PoppingEmailController@store'
]);
Route::any('popping-email/show-data/{id}', [
    'as' => 'popping_email.show.data',
    'uses' => 'PoppingEmailController@show'
]);
Route::any('popping-email/edit/{id}', [
    'as' => 'popping_email.edit',
    'uses' => 'PoppingEmailController@edit'
]);
Route::any('popping-email/update/{id}', [
    'as' => 'popping_email.update',
    'uses' => 'PoppingEmailController@update'
]);
Route::any('popping-email/destroy/{id}', [
    'as' => 'popping_email.destroy',
    'uses' => 'PoppingEmailController@destroy'
]);

/*
*  ------------------- END Poping_Email area -----------------------
 */


/*
* -------------------  Auto Mail Send Area ------------------------
 */

Route::any('mail/auto-mail', [
    'as' => 'mail.automail',
    'uses' => 'QueueMailController@send_email_queue'
]);

/*
* -------------------  User Profile Area Start------------------------
 */

Route::any("user/profile-info", [
    "as"   => "user.profile-info",
    "uses" => "UserController@profile"
]);


Route::any('user-signup/update/{id}', [
    'as' => 'user-signup.update',
    'uses' => 'UserController@updateProfile'
]);

Route::any('user-signup/reset_password/{id}',
    ['as'=>'user-signup.reset_password',
        'uses'=>'UserController@password_change_view']);

Route::any('user-signup/update_password/{id}', [
    'as' => 'user-signup.update_password',
    'uses' => 'UserController@update_passwd'
]);

/*
* -------------------  User Profile Area End ------------------------
 */


/*
* -------------------  User List Area Start------------------------
 */

Route::any('user/inactive/{id}', [
    'as' => 'user.inactive',
    'uses' => 'UserController@status_inactive'
]);

Route::any('user/active/{id}', [
    'as' => 'user.active',
    'uses' => 'UserController@status_active'
]);


Route::any('user/status_active_mail/{remember_token}',
    ['as'=>'user/status_active_mail',
        'uses'=>'UserController@active_user_login']);

/*
* -------------------  User List Area End------------------------
 */

/*
* -------------------  Clean System Start------------------------
 */

Route::any('system-clean/system-wise', [
    'as' => 'system-clean.system-wise',
    'uses' => 'CleanSystemController@system_wise_clean'
]);

Route::any('system-clean/system-wise-delete', [
    'as' => 'system-clean.system-wise-delete',
    'uses' => 'CleanSystemController@system_wise_delete'
]);

Route::any('system-clean/sender-mail-delete', [
    'as' => 'system-clean.sender-mail-delete',
    'uses' => 'CleanSystemController@system_wise_sender_mail_delete'
]);

/*
* -------------------  Clean System End------------------------
 */

/*
* -------------------  Read Sender Emsil-----------------------
 */


Route::any('sender-emial/sender-email-checking', [
    'as' => 'sender-emial.sender-email-checking',
    'uses' => 'SenderEmailController@sender_email_checking'
]);

