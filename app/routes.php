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

Route::get('/', array('uses' => 'DBTestingController@index'));
Route::get('places',function(){
    // View::make('dataTesting.gplaces');
        return Response::view('errors.missing', array(), 404);
});

/* User Registration */
Route::get('signup-sp',function(){
    return View::make('registration.service_provider');
});
Route::get('signup-customer',function(){
    return View::make('registration.customer');
});


/* Check UserName While Registration */
Route::post('check-username', array('uses' => 'RegistrationController@checkUserName'));
/* Save Service Provider Data */
Route::post('save-sp-data', array('uses' => 'RegistrationController@saveSpData'));
Route::post('save-customer-data', array('uses' => 'RegistrationController@saveCustomerData'));


//    /* Create New Users */
////    $user = new User;
////    $user->username = 'bharat';
////    $user->password = Hash::make('bharat');
////    $user->save();
//    $x = '';
//    //$x = User::where('username','=','fsdfs')->firstOrFail();
//    //$x = User::find(1);
//    $users = NULL;
//    $users = User::where('username', '=', 'sagar')->get();
//    if(!$users->isEmpty()){
//        //echo "<pre>";print_r($users->username);echo "</pre>";exit;
//        foreach($users as $user){
//            //echo $user->username;
//        }
//        //return $users;
//    }else{
//        //echo 1;exit;
//    }
//
//    //return $x;

    /* Detect Environment */
    //echo App::environment();
Route::post('testing-data/insert', array('uses' => 'DBTestingController@getFormData'));
