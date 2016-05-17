<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::any('user-login', [
    'as' => 'user-login',
    'uses' => 'UserController@user_login'
]);
Route::any("login", [
    "as"   => "login",
    "uses" => "UserController@login"
]);

Route::any('user/forgot-password', [
    'as' => 'user.forgot-password',
    'uses' => 'AdminController@forgot_password'
]);

Route::any('user/password_reminder_mail',
    ['as'=>'user.password_reminder_mail',
        'uses'=>'AdminController@user_password_reminder_mail']);

Route::any('user/password_reset_confirm/{reset_password_token}',
    ['as'=>'user/password_reset_confirm',
        'uses'=>'AdminController@user_password_reset_confirm']);

Route::any('user/save-new-password',
    ['as'=>'user/save-new-password',
        'uses'=>'AdminController@save_new_password']);

Route::any('home_reminder_mail', [
    'as' => 'home_reminder_mail',
    'uses' => 'HomeController@home_reminder_mail'
]);


Route::any('user-activation/{remember_token}',
    ['as'=>'user.user-activation',
        'uses'=>'UserController@user_activation']);


Route::any('generate_password/{remember_token}',
    ['as'=>'generate_password',
        'uses'=>'AdminController@generate_password']);

Route::any('user/save_password',
    ['as'=>'user/save_password',
        'uses'=>'AdminController@save_password']);



//user activation for signup...

Route::any('user-confirmation/{remember_token}',
    ['as'=>'user.user-confirmation',
        'uses'=>'UserController@user_confirm']);

Route::any('user-signup/store/{user_id}', [
    'as' => 'user-signup.store',
    'uses' => 'UserController@store'
]);

Route::group(['middleware' => 'auth'], function()
{
/*
 * -------------------  Start CRUD area ------------------------
 */
@include('routes_sh.php');
@include('routes_nh.php');
@include('routes_tj.php');

Route::get('/', [
    'as' => 'home', 'uses' => 'HomeController@index'
]);

    Route::any('home-dashboard', [
    'as' => 'home-dashboard',
    'uses' => 'OrderRepController@home_dashboard'
]);

 //OrderRepController....
Route::any('order/store', [
    'as' => 'order.store',
    'uses' => 'OrderRepController@store'
]);

Route::any('orders/show/{id}', [
    'as' => 'orders.show',
    'uses' => 'OrderRepController@show'
]);

Route::any('orders/edit/{id}', [
    'as' => 'orders.edit',
    'uses' => 'OrderRepController@edit'
]);

Route::any('orders/update/{id}', [
    'as' => 'orders.update',
    'uses' => 'OrderRepController@update'
]);

Route::any('orders/destroy/{id}', [
    'as' => 'orders.destroy',
    'uses' => 'OrderRepController@destroy'
]);

Route::any('create/airway-bill-number/{id}', [
    'as' => 'create.airway-bill-number',
    'uses' => 'OrderRepController@create_airway_bill_number'
]);

Route::any('store/airway-bill-number/{id}', [
    'as' => 'store.airway-bill-number',
    'uses' => 'OrderRepController@store_airway_bill_number'
]);

Route::any('order/close/{id}', [
    'as' => 'order.close',
    'uses' => 'OrderRepController@close_order'
]);

    Route::any('my-order-list', [
        'as' => 'my-order-list',
        'uses' => 'OrderRepController@my_order'
    ]);


Route::any('order-list', [
'as' => 'order-list',
'uses' => 'OrderRepController@order_list'
]);

Route::any('order-list-all', [
    'as' => 'order-list-all',
    'uses' => 'OrderRepController@order_list_all'
]);



Route::any("print-order-data/{id}", [
    "as"   => "print-order-data",
    "uses" => "OrderRepController@print_order"
]);


});