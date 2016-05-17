<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 9/20/15
 * Time: 5:43 PM
 */

// imap routes --------------------------------------
Route::any('imap/index', [
    'as' => 'imap.index',
    'uses' => 'ImapController@index'
]);
Route::any('imap/create', [
    'as' => 'imap.create',
    'uses' => 'ImapController@create'
]);
Route::any('imap/store', [
    'as' => 'imap.store',
    'uses' => 'ImapController@store'
]);
Route::any('imap/show-data/{id}', [
    'as' => 'imap.show.data',
    'uses' => 'ImapController@show'
]);
Route::any('imap/edit/{id}', [
    'as' => 'imap.edit',
    'uses' => 'ImapController@edit'
]);
Route::any('imap/update/{id}', [
    'as' => 'imap.update',
    'uses' => 'ImapController@update'
]);
Route::any('imap/destroy/{id}', [
    'as' => 'imap.destroy',
    'uses' => 'ImapController@destroy'
]);


// message routes --------------------------------------
Route::any('message/index/{campaign_id}', [
    'as' => 'message.index',
    'uses' => 'MessageController@index'
]);
Route::any('message/create', [
    'as' => 'message.create',
    'uses' => 'MessageController@create'
]);
Route::any('message/store', [
    'as' => 'message.store',
    'uses' => 'MessageController@store'
]);
Route::any('message/show-data/{id}', [
    'as' => 'message.show.data',
    'uses' => 'MessageController@show'
]);
Route::any('message/edit/{id}', [
    'as' => 'message.edit',
    'uses' => 'MessageController@edit'
]);
Route::any('message/update/{id}', [
    'as' => 'message.update',
    'uses' => 'MessageController@update'
]);
Route::any('message/destroy/{id}', [
    'as' => 'message.destroy',
    'uses' => 'MessageController@destroy'
]);


// Sub message routes --------------------------------------
Route::any('sub-message/index/{message_id}/{campaign_id}', [
    'as' => 'sub-message.index',
    'uses' => 'SubMessageController@index'
]);
Route::any('sub-message/create', [
    'as' => 'sub-message.create',
    'uses' => 'SubMessageController@create'
]);
Route::any('sub-message/store', [
    'as' => 'sub-message.store',
    'uses' => 'SubMessageController@store'
]);
Route::any('sub-message/show-data/{id}', [
    'as' => 'sub-message.show.data',
    'uses' => 'SubMessageController@show'
]);

Route::any('sub-message/image-show/{id}', [
    'as' => 'sub-message.image.show',
    'uses' => 'SubMessageController@image_show'
]);

Route::any('sub-message/edit/{id}', [
    'as' => 'sub-message.edit',
    'uses' => 'SubMessageController@edit'
]);
Route::any('sub-message/update/{id}', [
    'as' => 'sub-message.update',
    'uses' => 'SubMessageController@update'
]);
Route::any('sub-message/destroy/{id}', [
    'as' => 'sub-message.destroy',
    'uses' => 'SubMessageController@destroy'
]);
Route::any('sub-message/destroy-file/{id}', [
    'as' => 'sub-message.destroy.file',
    'uses' => 'SubMessageController@destroy_file'
]);

// Send email with delay time --------------------------------------
Route::any('send-email/with-delay', [
    'as' => 'send.email.with.delay',
    'uses' => 'HomeController@send_email_with_delay'
]);

// Generate email in cpanel --------------------------------------
Route::any('generate-email', [
    'as' => 'generate.email',
    'uses' => 'SenderEmailController@generate_email'
]);

// Delete email account using cpanel --------------------------------------
Route::any('delete-email-cpanel/{email}/{id}/{campaign_id}', [
    'as' => 'delete.email.cpanel',
    'uses' => 'SenderEmailController@delete_email_cpanel'
]);

// bulk email using upload csv file --------------------------------------
Route::any('bulk-email', [
    'as' => 'bulk.email',
    'uses' => 'SenderEmailController@bulk_email'
]);