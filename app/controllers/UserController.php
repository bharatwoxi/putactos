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
                    if(Auth::user()->user_role_id==1){
                        return Redirect::to('search/login=true');
                    }else{
                        return Redirect::to('service-provider/editprofile');
                    }
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

    /*
     *function Name: profileEditView
     *Desc: Edit Profile View
     *Created By: Sagar Acharya
     *Created Date: 29 January 2014
     *return: N/A
    */
    public function profileEditView(){
        $userData['systemUser'] = Auth::user();
        $userData['gender'] = Customer::find(Auth::user()->id);
        return View::make('profile.customerEdit')->with(array('userData'=>$userData));
    }

    /*
     *function Name: savePersonalData
     *Desc: Edit Profile View
     *Created By: Sagar Acharya
     *Created Date: 29 January 2014
     *return: N/A
    */
    public function savePersonalData(){
        $input = Input::all();
        $rules = array(
            'firstName' => 'required|min:5|max:20',
            'lastName' => 'required|min:5|max:20',
            'profilePicture' => 'mimes:jpeg,jpg,png|max:2000'
        );
        /* Custom Validation Rule For Image Size */
        Validator::extend('image_size', function($attribute, $value, $parameters)
        {
            $param1 = $parameters[0];//array_get($this->data, $parameters[0]);
            $param2 = $parameters[1];//array_get($this->data, $parameters[1]);
            $file = Input::file($attribute);
            $fileWidth = $width = Image::make($file)->width();
            $fileHeight = Image::make($file)->height();
            if($fileWidth>=$param1 && $fileHeight>=$param2){
                return true;
            }else{
                return false;
            }
        });
        $messages = array(
            'image_size' => 'Minimum image dimension required:330x220',
        );
        /* Rule End here */
        $validation = Validator::make($input,$rules);
        if($validation->passes()){
            $imageRule = array(
                'profilePicture' => 'image_size:330,220',
            );
            $imageValidation = Validator::make($input,$imageRule,$messages);
            if(!$imageValidation->passes()){
                return Redirect::to('user/editprofile')->withInput()->withErrors($imageValidation);
            }
            $user = Auth::user();
            $user->user_first_name = trim(strtolower($input['firstName']));
            $user->user_last_name = trim(strtolower($input['lastName']));
            $user->updated_at = date('Y-m-d H:m:s');
            if($user->save()){
                if($input['profilePicture']!=null || !empty($input['profilePicture'])){
                    /* File Upload Code */
                    $spProfileUploadpath = $_ENV['CUSTOMER_FILE_UPLOAD_PATH']."/".sha1($user->id)."/"."profile_image";

                    /* Create Upload Directory If Not Exists */
                    if(!file_exists($spProfileUploadpath)){
                        File::makeDirectory($spProfileUploadpath, $mode = 0777,true,true);
                        chmod($_ENV['CUSTOMER_FILE_UPLOAD_PATH']."/".sha1($user->id), 0777);
                        chmod($_ENV['CUSTOMER_FILE_UPLOAD_PATH']."/".sha1($user->id)."/"."profile_image", 0777);
                    }
                    $extension = Input::file('profilePicture')->getClientOriginalExtension();
                    $filename = sha1($user->id.time()).".{$extension}";
                    Input::file('profilePicture')->move($spProfileUploadpath, $filename);

                    //chmod($_ENV['CUSTOMER_FILE_UPLOAD_PATH']."/".sha1($user->id)."/"."profile_image/", 0777);
                    /* Cropped Image Code */
                    $image330by220 = $user->id.time()."_330x220".".{$extension}";
                    $image250by180 = $user->id.time()."_250x180".".{$extension}";
                    $img = Image::make($spProfileUploadpath.'/'.$filename)->resize(330, 220);
                    $img->save($spProfileUploadpath.'/'.$image330by220);
                    $img = Image::make($spProfileUploadpath.'/'.$filename)->resize(250, 180);
                    $img->save($spProfileUploadpath.'/'.$image250by180);
                    $image62by54 = $user->id.time()."_62x54".".{$extension}";
                    $img = Image::make($spProfileUploadpath.'/'.$filename)->resize(62, 54);
                    $img->save($spProfileUploadpath.'/'.$image62by54);
                    DB::table('system_users')
                        ->where('id', $user->id)
                        ->update(array('profile_image' => $filename,'image_330by220'=>$image330by220,'image_250by180'=>$image250by180,'image_62by54'=>$image62by54));
                }
                return Redirect::to('user/editprofile')->with('message','Updated Successfully');
            }else{
                return Redirect::to('user/editprofile')->withErrors('Something went wrong');
            }
        }else{
            return Redirect::to('user/editprofile')->withInput()->withErrors($validation);
        }
    }

    /*
     *function Name: savePassword
     *Desc: Edit Profile View
     *Created By: Sagar Acharya
     *Created Date: 29 January 2014
     *return: N/A
    */
    public function savePassword(){
        $input = Input::all();
        $user = User::find(Auth::user()->id);
        $rules = array(
            'currentPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword',
        );
        $validation = Validator::make($input,$rules);
        if($validation->passes()){
            if(!Hash::check($input['currentPassword'] , $user->getAuthPassword())){
                return Redirect::to('user/editprofile')->with('message','Current password not matched, please try again');
            }else{
                $user->password = $input['newPassword'];
                $user->updated_at = date('Y-m-d H:m:s');
                if($user->save()){
                    return Redirect::to('user/editprofile')->with('message','Password Updated Successfully');
                }else{
                    return Redirect::to('user/editprofile')->with('message','Password Not Updated Something Went Wrong');
                }
            }
        }else{
            return Redirect::to('user/editprofile')->withInput()->withErrors($validation);
        }
    }
    /*
     *function Name: savePreferences
     *Desc: Save User Preferences
     *Created By: Sagar Acharya
     *Created Date: 27 Feb 2015
     *return: N/A
    */
    public function savePreferences(){
        $input = Input::all();
        $rules = array(
            'looking_for' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'ageRange' => 'required',
        );
        $validation = Validator::make($input,$rules);
        if($validation->passes()){
            $user = User::find(Auth::user()->id);
            $usePersonalData = Customer::find($user->customer_id);
            $ageRange = explode(",",$input['ageRange']);
            $user->latitude = $input['latitude'];
            $user->longitude = $input['longitude'];
            $user->city = $input['city'];
            $user->country = $input['country'];
            $user->from_age = $ageRange[0];
            $user->to_age = $ageRange[1];
            $user->updated_at = date('Y-m-d H:m:s');
            $usePersonalData->looking_for = $input['looking_for'];
            $usePersonalData->updated_at = date('Y-m-d H:m:s');
            if($user->save() && $usePersonalData->save()){
                return Redirect::to('user/editprofile')->with('message','Updated Successfully');
            }else{
                return Redirect::to('user/editprofile')->with('message','Data Not Updated Something Went Wrong');
            }
        }else{
            return Redirect::to('user/editprofile')->withErrors($validation);
        }
    }
}