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
Route::group(array('prefix' => LaravelLocalization::setLocale()), function()
{
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
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

        /* User Login * & Authentication */
        Route::get('login1',function(){
            return View::make('login.index2');
        });

        Route::get('login',function(){
            return View::make('login.index');
        });
    });

    /*Confirm User When Click On Email */
    Route::get('user/confirm/{confirmation}', 'UserController@confirmUser');
    Route::post('authenticate', array('uses' => 'UserController@checkLogin'));
    Route::get('logout', array('uses' => 'UserController@doLogout'));

    /* Check UserName While Registration */
    Route::post('check-username', array('uses' => 'RegistrationController@checkUserName'));
    /* Save Service Provider Data */
    Route::post('save-sp-data', array('uses' => 'RegistrationController@saveSpData'));
    Route::post('save-customer-data', array('uses' => 'RegistrationController@saveCustomerData'));

    /* Search */
    Route::get('search/login=true', array('before' => 'auth|isCustomer','uses' => 'SearchController@index'));
    Route::get('search/results/login=true', array('before' => 'auth|isCustomer','uses' => 'SearchController@showDataAfterLogin'));
    Route::get('advance/search/login=true',array('before' => 'auth|isCustomer','uses' => 'SearchController@showDataAfterLogin'));
    /* Guest Search (If User IS NOT Logged In) */
    Route::get('search/login=guest',array('before' => 'isGuest','uses' => 'SearchController@guestSearchView'));
    Route::get('search/results/login=guest', array('before' => 'isGuest','uses' => 'SearchController@showDataToGuest'));
    Route::get('advance/search/login=guest',array('before' => 'isGuest','uses' => 'SearchController@showDataToGuest'));

    /* Messages Between Users */
    Route::get('messages',array('before' => 'auth','uses' => 'MessageController@index'));
    Route::get('messages/userlist',array('before' => 'auth','uses' => 'MessageController@showUserList'));
    Route::get('get/messages',array('before' => 'auth','uses' => 'MessageController@showMessages'));
    Route::post('messages/addnew',array('before' => 'auth','uses' => 'MessageController@insertNewMessage'));
    Route::post('messages/addnewFromProfile',array('before' => 'auth','uses' => 'MessageController@insertNewMessageViewProfile'));
    Route::get('messages/notification',array('before' => 'auth','uses' => 'MessageController@showNotifications'));

    /* As per New Message UI New Routes Don't use above 6 routes*/
    Route::get('messages-user-lists',array('before' => 'auth','uses' => 'MessageController@newMessageUserListing'));
    Route::get('messages/{username}',array('before' => 'auth','uses' => 'MessageController@newMessageDetailed'));
    Route::post('message-add-new',array('before' => 'auth','uses' => 'MessageController@addNewMessage'));

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
    Route::get('service-provider/delete-availability',array('before' => 'auth|isServiceProvider','uses' => 'ServiceProviderController@deleteAvailability'));

    /* Customer */
    Route::get('user/editprofile',array('before' => 'auth|isCustomer','uses' => 'UserController@profileEditView'));
    Route::post('user/savePersonalData',array('before' => 'auth|isCustomer','uses' => 'UserController@savePersonalData'));
    Route::post('user/savePassword',array('before' => 'auth|isCustomer','uses' => 'UserController@savePassword'));

    /* Forgot Password */
    Route::get('forgot-passowrd',array('before'=>'isGuest','uses'=>'RemindersController@getRemind'));
    Route::get('password/reset/{token}', 'RemindersController@getReset');
    Route::post('password/reset/{token}', 'RemindersController@postReset');
    Route: Route::controller('password', 'RemindersController');
    /* View Profile */
    Route::get('profile/{username}', array('before' => 'auth','uses' => 'CommonController@viewProfile'));
    Route::post('save/feedback', array('before' => 'auth|isCustomer','uses' => 'CommonController@saveFeedback'));
    Route::post('sp/risemeup', array('before' => 'auth|isServiceProvider','uses' => 'CommonController@riseMeUp'));
    Route::get('more/feedbacks', array('before' => 'auth','uses' => 'CommonController@getMoreFeedbacks'));
});

/* Localization Translated Routes*/
Route::group(
    array(
        'prefix' => LaravelLocalization::setLocale(),
        'before' => 'LaravelLocalizationRedirectFilter' // LaravelLocalization filter
    ),
    function()
    {
        /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
        /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
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
        Route::post('authenticate', array('uses' => 'UserController@checkLogin'));
        Route::get('logout', array('uses' => 'UserController@doLogout'));

        /* Check UserName While Registration */
        Route::post('check-username', array('uses' => 'RegistrationController@checkUserName'));
        Route::post('check-firstname', array('uses' => 'RegistrationController@checkFirstName'));
        Route::post('check-lastname', array('uses' => 'RegistrationController@checkLastName'));
        Route::post('check-email', array('uses' => 'RegistrationController@checkEmail'));
        Route::post('check-password', array('uses' => 'RegistrationController@checkPassword'));
        Route::post('check-cpassword', array('uses' => 'RegistrationController@checkConfirmPassword'));
        Route::post('check-profile-picture', array('uses' => 'RegistrationController@checkProfilePicture'));
        /* Save Service Provider Data */
        Route::post('save-sp-data', array('uses' => 'RegistrationController@saveSpData'));
        Route::post('save-customer-data', array('uses' => 'RegistrationController@saveCustomerData'));

        /* Search */
        Route::get('search/login=true', array('before' => 'auth|isCustomer','uses' => 'SearchController@index'));
        Route::get('search/results/login=true', array('before' => 'auth|isCustomer','uses' => 'SearchController@showDataAfterLogin'));
        Route::get('advance/search/login=true',array('before' => 'auth|isCustomer','uses' => 'SearchController@showDataAfterLogin'));
        /* Guest Search (If User IS NOT Logged In) */
        Route::get('search/login=guest',array('before' => 'isGuest','uses' => 'SearchController@guestSearchView'));
        Route::get('search/results/login=guest', array('before' => 'isGuest','uses' => 'SearchController@showDataToGuest'));
        Route::get('advance/search/login=guest',array('before' => 'isGuest','uses' => 'SearchController@showDataToGuest'));

        /* Messages Between Users */
        Route::get('messages',array('before' => 'auth','uses' => 'MessageController@index'));
        Route::get('messages/userlist',array('before' => 'auth','uses' => 'MessageController@showUserList'));
        Route::get('get/messages',array('before' => 'auth','uses' => 'MessageController@showMessages'));
        Route::post('messages/addnew',array('before' => 'auth','uses' => 'MessageController@insertNewMessage'));
        Route::post('messages/addnewFromProfile',array('before' => 'auth','uses' => 'MessageController@insertNewMessageViewProfile'));
        /* As per New Message UI New Routes Don't use above 6 routes*/
        Route::get('messages-user-lists',array('before' => 'auth','uses' => 'MessageController@newMessageUserListing'));
        Route::get('messages/{username}',array('before' => 'auth','uses' => 'MessageController@newMessageDetailed'));
        Route::post('message-add-new',array('before' => 'auth','uses' => 'MessageController@addNewMessage'));
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
        Route::get('service-provider/delete-availability',array('before' => 'auth|isServiceProvider','uses' => 'ServiceProviderController@deleteAvailability'));

        /* Customer */
        Route::get('user/editprofile',array('before' => 'auth|isCustomer','uses' => 'UserController@profileEditView'));
        Route::post('user/savePersonalData',array('before' => 'auth|isCustomer','uses' => 'UserController@savePersonalData'));
        Route::post('user/savePassword',array('before' => 'auth|isCustomer','uses' => 'UserController@savePassword'));
        Route::post('user/save-preference',array('before' => 'auth|isCustomer','uses' => 'UserController@savePreferences'));

        /* Forgot Password */
        Route::get('forgot-passowrd',array('before'=>'isGuest','uses'=>'RemindersController@getRemind'));
        Route::get('password/reset/{token}', 'RemindersController@getReset');
        Route::post('password/reset/{token}', 'RemindersController@postReset');
        Route: Route::controller('password', 'RemindersController');
        /* View Profile */
        Route::get('profile/{username}', array('before' => 'auth','uses' => 'CommonController@viewProfile'));
        Route::post('save/feedback', array('before' => 'auth|isCustomer','uses' => 'CommonController@saveFeedback'));
        Route::post('sp/risemeup', array('before' => 'auth|isServiceProvider','uses' => 'CommonController@riseMeUp'));
        Route::get('more/feedbacks', array('before' => 'auth','uses' => 'CommonController@getMoreFeedbacks'));
    });

/* Admin Routes */
Route::get('admin-master',array('before'=>'isGuestOrAdmin','uses'=>'AdminController@showLogin'));
Route::post('admin/check-login',array('before'=>'isGuest','uses'=>'AdminController@checkLogin'));
Route::get('admin/admin-logout', array('uses' => 'AdminController@doLogout'));

Route::get('admin/home',array('before'=>'auth|isAdmin','uses'=>'AdminController@homeView'));
Route::get('admin/searchMessage',array('before'=>'auth|isAdmin','uses'=>'AdminController@searchExchangeMessage'));
Route::get('admin/editMasterProfile',array('before'=>'auth|isAdmin','uses'=>'AdminController@editMasterProfile'));

Route::get('admin/user-messages',array('before'=>'auth|isAdmin','uses'=>'AdminController@getUserMessages'));
Route::get('admin/search-user-message',array('before'=>'auth|isAdmin','uses'=>'AdminController@getUsersExchangeMessages'));
Route::get('admin/search-user-profile',array('before'=>'auth|isAdmin','uses'=>'AdminController@getUsersProfile'));
Route::get('admin/block-unblock-user',array('before'=>'auth|isAdmin','uses'=>'AdminController@blockUnblockUser'));

Route::get('admin/site-visitors/daily',array('before'=>'auth|isAdmin','uses'=>'AdminController@userLoginCountDaily'));
Route::get('admin/site-visitors/hourly',array('before'=>'auth|isAdmin','uses'=>'AdminController@userLoginCountHourly'));
Route::get('admin/user-stats-last10',array('before'=>'auth|isAdmin','uses'=>'AdminController@lastTenNewUsers'));
Route::get('admin/user-stats-last10_loggedin',array('before'=>'auth|isAdmin','uses'=>'AdminController@lastTenLoggedinUsers'));
Route::get('admin/user-count-detail',array('before'=>'auth|isAdmin','uses'=>'AdminController@userCount'));
