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


/* Detect Environment */
//echo App::environment();
Route::post('testing-data/insert', array('uses' => 'DBTestingController@getFormData'));



/* Cron Routes */
Route::get('update/age', array('uses' => 'CronController@updateUserAge'));
/* Profile Completeness (In future it should be run as cron or Update value on each profile update) */
Route::get('profile-complete', array('uses' => 'ServiceProviderController@updateProfileCompleteness'));
