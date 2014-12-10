<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 9/12/14
 * Time: 11:13 AM
 */
class UserController extends BaseController {

    /*
     *function Name: checkUserName
     *Desc: checkUserName for service provider & customer if it exists or not
     *Created By: Sagar Acharya
     *Created Date: 4 December 2014
     *return: true/false based on result
    */

    public function checkLogin(){

        $input = Input::all();
        /* Check reCaptcha */
        $secret = "6LfCB_8SAAAAAIE7nuQD5Du0mJqWH6qDkhTh99wB";
        $reCaptcha = new ReCaptcha($secret);
        // reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
        $lang = "en";

        // The response from reCAPTCHA
                $resp = null;
        // The error code from reCAPTCHA, if any
                $error = null;
        if ($input["g-recaptcha-response"]) {
        //var_dump($resp);exit;
            $resp = $reCaptcha->verifyResponse(
                $_SERVER["REMOTE_ADDR"],
                $input["g-recaptcha-response"]
            );
        }
        if ($resp != null && $resp->success) {
            //echo "You got it!";
        }else{
            Session::flash('message', 'Please re-enter your reCAPTCHA.');
            //return View::make('signup-sp');
            return Redirect::to('login');
        }



        //dd($input);
        $rules = array(
            'email' => 'required|email',
            'password' => 'required|min:6'
        );
        $validation = Validator::make($input,$rules);
        $data = array(
                'email' => $input['email'],
                'password' => $input['password']
            );
        if($validation->passes()){
            if (Auth::attempt($data))
            {
                echo 123;
            }else{
                /* Check Query Log With Time*/
                $queries = DB::getQueryLog();
                $last_query = end($queries);
                echo 100;
                //dd($last_query);
                /*return Redirect::to('login')
                    ->with('message', 'Your username/password combination was incorrect')
                    ->withInput();*/
            }
        }else{
            return Redirect::to('login')->withInput()->withErrors($validation);
        }
    }

    public function doLogout(){
        Auth::logout(); // log the user out of our application
        return Redirect::to('login'); // redirect the user to the login screen
    }

    public function test(){
        echo Auth::check();
    }
}