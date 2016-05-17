<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 9/21/15
 * Time: 10:05 AM
 */
//Campaign...





    Route::any('campaign/index', [
        'as' => 'campaign.index',
        'uses' => 'CampaignController@index'
    ]);


    Route::any('campaign/store', [
        'as' => 'campaign.store',
        'uses' => 'CampaignController@store'
    ]);
    Route::any('campaign/show-data/{id}', [
        'as' => 'campaign.show.data',
        'uses' => 'CampaignController@show'
    ]);
    Route::any('campaign/edit/{id}', [
        'as' => 'campaign.edit',
        'uses' => 'CampaignController@edit'
    ]);
    Route::any('campaign/update/{id}', [
        'as' => 'campaign.update',
        'uses' => 'CampaignController@update'
    ]);
    Route::any('campaign/destroy/{id}', [
        'as' => 'campaign.destroy',
        'uses' => 'CampaignController@destroy'
    ]);

    //message-followup...
    Route::any('message-followup/index/{campaign_id}', [
        'as' => 'message-followup.index',
        'uses' => 'MessageFollowupController@index'
    ]);
    Route::any('message-followup/store', [
        'as' => 'message-followup.store',
        'uses' => 'MessageFollowupController@store'
    ]);
    Route::any('message-followup/show-data/{id}', [
        'as' => 'message-followup.show.data',
        'uses' => 'MessageFollowupController@show'
    ]);
    Route::any('message-followup/image-show/{id}', [
        'as' => 'message-followup.image.show',
        'uses' => 'MessageFollowupController@image_show'
    ]);
    Route::any('message-followup/edit/{id}', [
        'as' => 'message-followup.edit',
        'uses' => 'MessageFollowupController@edit'
    ]);
    Route::any('message-followup/update/{id}', [
        'as' => 'message-followup.update',
        'uses' => 'MessageFollowupController@update'
    ]);
    Route::any('message-followup/destroy/{id}', [
        'as' => 'message-followup.destroy',
        'uses' => 'MessageFollowupController@destroy'
    ]);
    Route::any('message-followup/destroy-file/{id}', [
        'as' => 'message-followup.destroy-file',
        'uses' => 'MessageFollowupController@destroy_file'
    ]);

    //sub-message-followup....
    Route::any('sub-message-followup/index/{campaign_id}/{message_followup_id}', [
        'as' => 'sub-message-followup.index',
        'uses' => 'SubMessageFollowupController@index'
    ]);
    Route::any('sub-message-followup/store', [
        'as' => 'sub-message-followup.store',
        'uses' => 'SubMessageFollowupController@store'
    ]);
    Route::any('sub-message-followup/show-data/{id}', [
        'as' => 'sub-message-followup.show.data',
        'uses' => 'SubMessageFollowupController@show'
    ]);
    Route::any('sub-message-followup/image-show/{id}', [
        'as' => 'sub-message-followup.image.show',
        'uses' => 'SubMessageFollowupController@image_show'
    ]);
    Route::any('sub-message-followup/edit/{id}', [
        'as' => 'sub-message-followup.edit',
        'uses' => 'SubMessageFollowupController@edit'
    ]);
    Route::any('sub-message-followup/update/{id}', [
        'as' => 'sub-message-followup.update',
        'uses' => 'SubMessageFollowupController@update'
    ]);
    Route::any('sub-message-followup/destroy/{id}', [
        'as' => 'sub-message-followup.destroy',
        'uses' => 'SubMessageFollowupController@destroy'
    ]);
    Route::any('sub-message-followup/destroy-file/{id}', [
        'as' => 'sub-message-followup.destroy.file',
        'uses' => 'SubMessageFollowupController@destroy_file'
    ]);

    /** User Controller **/
    Route::any('user/request', [
        'as' => 'user.request',
        'uses' => 'UserController@request'
    ]);

    Route::any('user/send-request', [
        'as' => 'user.send-request',
        'uses' => 'UserController@user_request_mail'
    ]);

    /*Route::any('user-confirmation/{remember_token}',
        ['as'=>'user.user-confirmation',
            'uses'=>'UserController@user_confirm']);

    Route::any('user-signup/store/{user_id}', [
        'as' => 'user-signup.store',
        'uses' => 'UserController@store'
    ]);



    Route::any('user-activation/{remember_token}',
        ['as'=>'user.user-activation',
            'uses'=>'UserController@user_activation']);*/

    Route::any('user/logout', [
        'as' => 'user.logout',
        'uses' => 'UserController@logout'
    ]);

// User List...
Route::any('user/user-list', [
    'as' => 'user.user-list',
    'uses' => 'AdminController@user_list'
]);

Route::any('user/create/{id}', [
    'as' => 'user.create',
    'uses' => 'AdminController@create'
]);

Route::any('user/store/{id}', [
    'as' => 'user.store',
    'uses' => 'AdminController@store'
]);


Route::any('user/show-data/{id}', [
    'as' => 'user.show.data',
    'uses' => 'AdminController@show'
]);

Route::any('user/edit/{id}', [
    'as' => 'user.edit',
    'uses' => 'AdminController@edit'
]);

Route::any('user/update/{id}', [
    'as' => 'user.update',
    'uses' => 'AdminController@update'
]);

Route::any('user/destroy/{id}', [
    'as' => 'user.destroy',
    'uses' => 'AdminController@destroy'
]);


Route::any('create/new-user',
    ['as'=>'create.new-user',
        'uses'=>'AdminController@create_new_user']);

//Clean System......

Route::any('clean-system',
    ['as'=>'clean-system',
        'uses'=>'CleanSystemController@clean_system_per_campaign']);

Route::any('clean-system/per-campaign/delete',
    ['as'=>'clean-system.per-campaign.delete',
        'uses'=>'CleanSystemController@delete_customer_mail_per_camp']);

Route::any('clean-system/delete/mail-server',
    ['as'=>'clean-system.delete.mail-server',
        'uses'=>'CleanSystemController@delete_mail_server_per_camp']);

//Central Settings...

Route::any('central-settings',
    ['as'=>'central-settings',
        'uses'=>'CentralSettingsController@central_settings']);

Route::any('central-settings/edit/{id}', [
    'as' => 'central-settings.edit',
    'uses' => 'CentralSettingsController@edit'
]);
Route::any('central-settings/update/{id}', [
    'as' => 'central-settings.update',
    'uses' => 'CentralSettingsController@update'
]);

Route::any('central-settings/show/{id}', [
    'as' => 'central-settings.show',
    'uses' => 'CentralSettingsController@show'
]);
