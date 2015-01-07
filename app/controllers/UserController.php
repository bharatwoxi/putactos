<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 9/12/14
 * Time: 11:13 AM
 */
/* For Browser & OS Detection */
use Browser\Browser;
use Browser\Os;
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
        $secret = $_ENV['reCaptchaSecretKey'];
        $reCaptcha = new ReCaptcha($secret);

        // The response from reCAPTCHA
                $resp = null;
        // The error code from reCAPTCHA, if any
                $error = null;
        if ($input["g-recaptcha-response"]) {
            $resp = $reCaptcha->verifyResponse(
                $_SERVER["REMOTE_ADDR"],
                $input["g-recaptcha-response"]
            );
        }
        if ($resp != null && $resp->success) {
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
                $id = DB::table('system_users')->where('email', $input['email'])->pluck('id');
                $user = User::find($id);
                if($id == NULL || $user == NULL){
                    Session::flash('message', 'It looks like you entered the wrong email or password');
                    return Redirect::to('login')->withInput();;
                }elseif($user->is_active == 0){
                    Session::flash('message', 'Please confirm your email address');
                    return Redirect::to('login');
                }elseif (Auth::attempt($data))
                {
                    $this->saveIpBrowserInformation();
                    return Redirect::to('search/login=true');
                }else{
                    /* Check Query Log With Time*/
                    /*$queries = DB::getQueryLog();
                    $last_query = end($queries);*/
                    return Redirect::to('login')
                        ->with('message', 'It looks like you entered the wrong email or password')
                        ->withInput();
                }
            }else{
                return Redirect::to('login')->withInput()->withErrors($validation);
            }
        }else{
            Session::flash('message', 'Please re-enter your reCAPTCHA.');
            return Redirect::to('login');
        }
    }

    /*
    *function Name: saveIpBrowserInformation
    *Desc: Save Browser and Information and Increment Login count
    *Created By: Sagar Acharya
    *Created Date: 7 JAN 2014
    *return: NA
   */

    public function saveIpBrowserInformation(){
        $browser = new Browser;
        $os = new Os;
        $browserInformation = 'name:'.$browser->getName().' version:'.$browser->getVersion();
        $osInformation = 'name:'.$os->getName().' version:'.$os->getVersion();
        $ipAddress = getenv('HTTP_CLIENT_IP')?:
                     getenv('HTTP_X_FORWARDED_FOR')?:
                     getenv('HTTP_X_FORWARDED')?:
                     getenv('HTTP_FORWARDED_FOR')?:
                     getenv('HTTP_FORWARDED')?:
                     getenv('REMOTE_ADDR');

        DB::table('system_user_ip_logs')->insert(
            array(
                'system_user_id'  =>Auth::user()->id,
                'ip_address'  =>$ipAddress,
                'browser'  =>$browserInformation,
                'os'  =>$osInformation,
                'login_time'  =>date('Y-m-d H:m:s'),
                'created_at'=>date('Y-m-d H:m:s'),
                'updated_at'=> date('Y-m-d H:m:s')
            )
        );
        if(Auth::user()->service_provider_id!=NULL || !empty(Auth::user()->service_provider_id)){
            $serviceProvider = ServiceProvider::find(Auth::user()->service_provider_id);
            $visitCount = $serviceProvider->visit_frequency;
            $visitCount = $visitCount + 1;
            ServiceProvider::where('id', '=',$serviceProvider['id'])->update(array('visit_frequency' => $visitCount,'updated_at'=> date('Y-m-d H:m:s')));
        }
    }

        public function doLogout(){
        Auth::logout(); // log the user out of our application
        return Redirect::to('/'); // redirect the user to the login screen
    }

    public function test(){
        echo Auth::check();
    }


    /*
    *function Name: confirmUser
    *Desc: Confirm User Identity
    *Created By: Sagar Acharya
    *Created Date: 7 JAN 2014
    *return: redirect to login page
   */
    public function confirmUser($confirmation){

        DB::table('system_users')->where('remember_token', $confirmation)->update(array('is_active' => 1));
        Session::flash('message', 'Thank you for confirming your account, you can now login');
        return Redirect::to('login');
    }
}