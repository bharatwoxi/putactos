<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (!Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

Route::filter('logged_in', function()
{
    if (Auth::check()) return Redirect::to('/');
});

/* Check User Role */
//Check is Customer Accessing Page Or Not
Route::filter('isCustomer', function()
{
    $user = Auth::user()->id;
    $roleId = User::find($user);
    if($roleId->user_role_id!=1){
        Session::flash('unauth-msg','Oops.. You are not authorized to access this page');
        return Redirect::to('/');
    }
});

//Check is Service provider Accessing Page Or Not
Route::filter('isServiceProvider', function()
{
    $user = Auth::user()->id;
    $roleId = User::find($user);
    if($roleId->user_role_id!=2){
        Session::flash('unauth-msg','Oops.. You are not authorized to access this page');
        return Redirect::to('/');
    }
});

/* Check if user is Guest i.e. User is not logged in */
Route::filter('isGuest', function()
{
    if (!Auth::guest())
    {
        Session::flash('unauth-msg','Oops.. You are not authorized to access this page');
        return Redirect::to('/');
    }
});