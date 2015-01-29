<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('/',function(){
    return View::make('home.index');
});
Route::get('dummy', array('uses' => 'DBTestingController@index'));
Route::get('places',function(){
    // View::make('dataTesting.gplaces');
        return Response::view('errors.missing', array(), 404);
});
Route::get('test',array('before'=>'auth','uses'=>'UserController@test'));

/* Apply Filters To Group */
/* If user is not logged in then apply this filter */
Route::group(array('before' => 'logged_in'), function() {
    /* User Registration */
    Route::get('signup/service-provider',function(){
        return View::make('registration.service_provider');
    });
    Route::get('signup/customer',function(){
        return View::make('registration.customer');
    });

    /* User Login *& Authentication */
    Route::get('login1',function(){
        return View::make('login.index2');
    });

    Route::get('login',function(){
        return View::make('login.index');
    });
});

/*Confirm User When Click On Email */
Route::get('user/confirm/{confirmation}', 'UserController@confirmUser');
Route::post('authenticate', array('before' => 'csrf','uses' => 'UserController@checkLogin'));
Route::get('logout', array('uses' => 'UserController@doLogout'));

/* Check UserName While Registration */
Route::post('check-username', array('uses' => 'RegistrationController@checkUserName'));
/* Save Service Provider Data */
Route::post('save-sp-data', array('before' => 'csrf','uses' => 'RegistrationController@saveSpData'));
Route::post('save-customer-data', array('before' => 'csrf','uses' => 'RegistrationController@saveCustomerData'));

/* Search */
Route::get('search/login=true', array('before' => 'auth|isCustomer','uses' => 'SearchController@index'));
Route::get('search/results/login=true', array('before' => 'auth|isCustomer','uses' => 'SearchController@showDataAfterLogin'));
Route::get('advance/search/login=true',array('before' => 'auth|isCustomer','uses' => 'SearchController@showDataAfterLogin'));
/* Guest Search (If User IS NOT Logged In) */
Route::post('search/login=guest',array('before' => 'isGuest','uses' => 'SearchController@guestSearchView'));
Route::get('search/results/login=guest', array('before' => 'isGuest','uses' => 'SearchController@showDataToGuest'));
Route::get('advance/search/login=guest',array('before' => 'isGuest','uses' => 'SearchController@showDataToGuest'));

/* Messages Between Users */
Route::get('messages',array('before' => 'auth','uses' => 'MessageController@index'));
Route::get('messages/userlist',array('before' => 'auth','uses' => 'MessageController@showUserList'));
Route::get('get/messages',array('before' => 'auth','uses' => 'MessageController@showMessages'));
Route::post('messages/addnew',array('before' => 'auth','uses' => 'MessageController@insertNewMessage'));

/* Detect Environment */
//echo App::environment();
Route::post('testing-data/insert', array('uses' => 'DBTestingController@getFormData'));



/* Cron Routes */
Route::get('update/age', array('uses' => 'CronController@updateUserAge'));
/* Profile Completeness (In future it should be run as cron or Update value on each profile update) */
Route::get('profile-complete', array('uses' => 'ServiceProviderController@updateProfileCompleteness'));

/* Profile Edit */
/* Service Provider */
Route::get('service-provider/editprofile',array('before' => 'auth|isServiceProvider','uses' => 'ServiceProviderController@profileEditView'));
Route::post('service-provider/saveProfileData',array('before' => 'auth|isServiceProvider','uses' => 'ServiceProviderController@saveProfileData'));
Route::post('service-provider/savePersonalData',array('before' => 'auth|isServiceProvider','uses' => 'ServiceProviderController@savePersonalData'));
Route::post('service-provider/savePassword',array('before' => 'auth|isServiceProvider','uses' => 'ServiceProviderController@savePassword'));

/* Customer */
Route::get('user/editprofile',array('before' => 'auth|isCustomer','uses' => 'UserController@profileEditView'));
Route::post('user/savePersonalData',array('before' => 'auth|isCustomer','uses' => 'UserController@savePersonalData'));
Route::post('user/savePassword',array('before' => 'auth|isCustomer','uses' => 'UserController@savePassword'));

/* Forgot Password */
Route::get('forgot-passowrd',array('before'=>'isGuest','uses'=>'RemindersController@getRemind'));
Route::get('password/reset/{token}', 'RemindersController@getReset');
Route::post('password/reset/{token}', 'RemindersController@postReset');
Route: Route::controller('password', 'RemindersController');
