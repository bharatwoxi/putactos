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
    return View::make('dataTesting.gplaces');
});
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
