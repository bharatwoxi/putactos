<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 1/12/14
 * Time: 3:33 PM
 */
class RegistrationController extends BaseController {


    /*
     *function Name: checkUserName
     *Desc: checkUserName for service provider & customer if it exists or not
     *Created By: Sagar Acharya
     *Created Date: 4 December 2014
     *return: true/false based on result
    */

    public function checkUserName(){
        $data = Input::all();

        if(Request::ajax())
        {
            $rules = [
                'username' => 'required|min:6|unique:system_users',
            ];

            $input = Input::only(
                'username'
            );

            $validator = Validator::make($input, $rules);
            if($validator->fails())
            {
                return Response::json([
                    'success'=>false,
                    'errors'=>$validator->errors()->toArray()
                ]);
            }
            return Response::json(['success'=>true]);
        }
    }

    /*
     *function Name: checkFirstName
     *Desc: checkFirstName for service provider
     *Created By: Sagar Acharya
     *Created Date: 23 Feb 2014
     *return: true/false based on result
    */

    public function checkFirstName(){
        if(Request::ajax())
        {
            $rules = [
                'firstName' => 'required|min:5|max:20',
            ];

            $input = Input::only(
                'firstName'
            );

            $validator = Validator::make($input, $rules);
            if($validator->fails())
            {
                return Response::json([
                    'success'=>false,
                    'errors'=>$validator->errors()->toArray()
                ]);
            }
            return Response::json(['success'=>true]);
        }
    }
    /*
     *function Name: checkLastName
     *Desc: checkFirstName for service provider
     *Created By: Sagar Acharya
     *Created Date: 23 Feb 2014
     *return: true/false based on result
    */

    public function checkLastName(){
        if(Request::ajax())
        {
            $rules = [
                'lastName' => 'required|min:5|max:20',
            ];

            $input = Input::only('lastName');

            $validator = Validator::make($input, $rules);
            if($validator->fails())
            {
                return Response::json([
                    'success'=>false,
                    'errors'=>$validator->errors()->toArray()
                ]);
            }
            return Response::json(['success'=>true]);
        }
    }
    /*
     *function Name: checkEmail
     *Desc: checkFirstName for service provider
     *Created By: Sagar Acharya
     *Created Date: 23 Feb 2014
     *return: true/false based on result
    */

    public function checkEmail(){
        if(Request::ajax())
        {
            $rules = [
                'email' => 'required|email|unique:system_users',
            ];

            $input = Input::only('email');

            $validator = Validator::make($input, $rules);
            if($validator->fails())
            {
                return Response::json([
                    'success'=>false,
                    'errors'=>$validator->errors()->toArray()
                ]);
            }
            return Response::json(['success'=>true]);
        }
    }
    /*
     *function Name: checkPassword
     *Desc: checkFirstName for service provider
     *Created By: Sagar Acharya
     *Created Date: 23 Feb 2014
     *return: true/false based on result
    */

    public function checkPassword(){
        if(Request::ajax())
        {
            $rules = [
                'password' => 'required|min:6',
            ];

            $input = Input::only('password');

            $validator = Validator::make($input, $rules);
            if($validator->fails())
            {
                return Response::json([
                    'success'=>false,
                    'errors'=>$validator->errors()->toArray()
                ]);
            }
            return Response::json(['success'=>true]);
        }
    }
    /*
     *function Name: checkPassword
     *Desc: checkFirstName for service provider
     *Created By: Sagar Acharya
     *Created Date: 23 Feb 2014
     *return: true/false based on result
    */

    public function checkConfirmPassword(){
        if(Request::ajax())
        {
            $rules = [
                'confirmPassword' => 'required|min:6|same:password',
            ];

            $input = Input::only('password','confirmPassword');

            $validator = Validator::make($input, $rules);
            if($validator->fails())
            {
                return Response::json([
                    'success'=>false,
                    'errors'=>$validator->errors()->toArray()
                ]);
            }
            return Response::json(['success'=>true]);
        }
    }
    /*
     *function Name: checkProfilePicture
     *Desc: checkProfilePicture
     *Created By: Sagar Acharya
     *Created Date: 24 Feb 2014
     *return: true/false based on result
    */

    public function checkProfilePicture(){
        if(Request::ajax())
        {
            $rules = [
                'profilePicture' => 'required|mimes:jpeg,jpg,png|max:2000'
            ];

            $input = Input::only('profilePicture');

            $validator = Validator::make($input, $rules);
            if($validator->fails())
            {
                return Response::json([
                    'success'=>false,
                    'errors'=>$validator->errors()->toArray()
                ]);
            }
            return Response::json(['success'=>true]);
        }
    }
    /*
     *function Name: saveSpData
     *Desc: checkUserName for service provider & customer if it exists or not
     *Created By: Sagar Acharya
     *Created Date: 4 December 2014
     *return: true/false based on result
    */

    public function saveSpData(){
        $input = Input::all();
        $rules = array(

            'firstName' => 'required|min:5|max:20',
            'lastName' => 'required|min:5|max:20',
            'username' => 'required|min:6|unique:system_users',
            'email' => 'required|email|unique:system_users',
            'birthDate' => 'required',
            'gender' => 'required|integer',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:password',
            'profilePicture' => 'required|mimes:jpeg,jpg,png|max:2000'
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
                return Redirect::to('signup/service-provider')->withInput()->withErrors($imageValidation);
            }
            $date1 = Input::get('birthDate');
            $date2 = date('Y-m-d');

            $diff = abs(strtotime($date2) - strtotime($date1));

            $years = floor($diff / (365*60*60*24));
            $systemUserInsertedId = DB::table('system_users')->insertGetId(
                array(
                    'username'  =>Input::get('username'),
                    'password'  =>Hash::make(Input::get('password')),
                    'email'  =>Input::get('email'),
                    'is_active'  =>0,
                    'user_first_name'  =>Input::get('firstName'),
                    'user_last_name'  =>Input::get('lastName'),
                    'birth_date'  =>Input::get('birthDate'),
                    'current_age'=>$years,
                    'gender'  =>Input::get('gender'),
                    'user_role_id'  =>2,
                    'latitude'  =>Input::get('latitude'),
                    'longitude'  =>Input::get('longitude'),
                    'city'  =>Input::get('city'),
                    'country'  =>Input::get('country'),
                    'remember_token'  =>Input::get('_token'),
                    'created_at'=>date('Y-m-d H:m:s'),
                    'updated_at'=> date('Y-m-d H:m:s')
                )
            );

            /* File Upload Code */
                $spProfileUploadpath = $_ENV['SP_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId)."/"."profile_image";

            /* Create Upload Directory If Not Exists */
            if(!file_exists($spProfileUploadpath)){
                File::makeDirectory($spProfileUploadpath, $mode = 0777,true,true);
                chmod($_ENV['SP_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId), 0777);
                chmod($_ENV['SP_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId)."/"."profile_image/", 0777);
            }
            $extension = Input::file('profilePicture')->getClientOriginalExtension();
            $filename = sha1($systemUserInsertedId.time()).".{$extension}";
            Input::file('profilePicture')->move($spProfileUploadpath, $filename);

            chmod($_ENV['SP_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId)."/"."profile_image/", 0777);
            /* Cropped Image Code */
            $image330by220 = $systemUserInsertedId.time()."_330x220".".{$extension}";
            $image250by180 = $systemUserInsertedId.time()."_250x180".".{$extension}";
            $image62by54 = $systemUserInsertedId.time()."_62x54".".{$extension}";
            $img = Image::make($spProfileUploadpath.'/'.$filename)->resize(330, 220);
            $img->save($spProfileUploadpath.'/'.$image330by220);
            $img = Image::make($spProfileUploadpath.'/'.$filename)->resize(250, 180);
            $img->save($spProfileUploadpath.'/'.$image250by180);
            $img = Image::make($spProfileUploadpath.'/'.$filename)->resize(62, 54);
            $img->save($spProfileUploadpath.'/'.$image62by54);
            chmod($_ENV['SP_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId)."/"."profile_image/", 0777);

            DB::table('system_users')
                ->where('id', $systemUserInsertedId)
                ->update(array('profile_image' => $filename,'image_330by220'=>$image330by220,'image_250by180'=>$image250by180,'image_62by54'=>$image62by54));


            /* Insert Data In service provider table & update id in system_users table */

            $serviceProviderInsertedId = DB::table('service_providers')->insertGetId(
                array(
                    'riseme_up' =>0,
                    'visit_frequency' =>0,
                    'profile_completeness'=>NULL,
                    'created_at'=>date('Y-m-d H:m:s'),
                    'updated_at'=> date('Y-m-d H:m:s')
                )
            );

            User::where('id', '=', $systemUserInsertedId)->update(array('service_provider_id' => $serviceProviderInsertedId,'updated_at'=> date('Y-m-d H:m:s')));


            /*Image Upload End */


            /* Send Mail Functionality */

            //if(app()->environment()!="local"){
                Mail::send('email.activation', $input, function($message) use ($input){
                    $message->to($input['email'])->subject('Account Confirmation');
                });
            //}
            Session::flash('message', 'Your account has been successfully created. Please check your email for the instructions on how to confirm your account.');
            return Redirect::to('login');
        }
        else{
            return Redirect::to('signup/service-provider')->withInput()->withErrors($validation);
        }

    }

    /*
    *function Name: saveCustomerData
    *Desc: save customer data if validated
    *Created By: Sagar Acharya
    *Created Date: 8 December 2014
    *return: true/false based on result
   */

    public function saveCustomerData(){
        $input = Input::all();

        $ageValueIfEmpty = '16,60';
        if(Input::get('ageRange')==''){
            $age = explode(',',$ageValueIfEmpty);
        }else{
            $age = explode(',',Input::get('ageRange'));
        }
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
        $rules = array(

            'firstName' => 'required|min:5|max:20',
            'lastName' => 'required|min:5|max:20',
            'username' => 'required|min:6|unique:system_users',
            'email' => 'required|email|unique:system_users',
            'birthDate' => 'required',
            'gender' => 'required|integer',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:password',
            'profilePicture' => 'required|mimes:jpeg,jpg,png|max:2000',
        );
        $validation = Validator::make($input,$rules);
        if($validation->passes()){
            $imageRule = array(
                'profilePicture' => 'image_size:330,220',
            );
            $imageValidation = Validator::make($input,$imageRule,$messages);
            if(!$imageValidation->passes()){
                return Redirect::to('signup/customer')->withInput()->withErrors($imageValidation);
            }
            $date1 = Input::get('birthDate');
            $date2 = date('Y-m-d');

            $diff = abs(strtotime($date2) - strtotime($date1));

            $years = floor($diff / (365*60*60*24));
            //$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            //$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            $systemUserInsertedId = DB::table('system_users')->insertGetId(
                array(
                    'username'  =>Input::get('username'),
                    'password'  =>Hash::make(Input::get('password')),
                    'email'  =>Input::get('email'),
                    'is_active'  =>0,
                    'user_first_name'  =>Input::get('firstName'),
                    'user_last_name'  =>Input::get('lastName'),
                    'birth_date'  =>Input::get('birthDate'),
                    'current_age'=>$years,
                    'gender'  =>Input::get('gender'),
                    'user_role_id'  =>1,
                    'from_age' =>$age[0],
                    'to_age' =>$age[1],
                    'latitude'  =>Input::get('latitude'),
                    'longitude'  =>Input::get('longitude'),
                    'city'  =>Input::get('city'),
                    'country'  =>Input::get('country'),
                    'remember_token'  =>Input::get('_token'),
                    'created_at'=>date('Y-m-d H:m:s'),
                    'updated_at'=> date('Y-m-d H:m:s')
                )
            );

            /* File Upload Code */
            $customerProfileUploadpath = $_ENV['CUSTOMER_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId)."/"."profile_image";

            /* Create Upload Directory If Not Exists */
            if(!file_exists($customerProfileUploadpath)){
                File::makeDirectory($customerProfileUploadpath, $mode = 0777,true,true);
                chmod($_ENV['CUSTOMER_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId), 0777);
                chmod($_ENV['CUSTOMER_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId)."/"."profile_image/", 0777);
            }
            $extension = Input::file('profilePicture')->getClientOriginalExtension();
            $filename = sha1($systemUserInsertedId.time()).".{$extension}";
            Input::file('profilePicture')->move($customerProfileUploadpath, $filename);
            chmod($_ENV['CUSTOMER_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId)."/"."profile_image/", 0777);
            /* Cropped Image Code */
            $image330by220 = $systemUserInsertedId.time()."_330x220".".{$extension}";
            $image250by180 = $systemUserInsertedId.time()."_250x180".".{$extension}";
            $img = Image::make($customerProfileUploadpath.'/'.$filename)->resize(330, 220);
            $img->save($customerProfileUploadpath.'/'.$image330by220);
            $img = Image::make($customerProfileUploadpath.'/'.$filename)->resize(250, 180);
            $img->save($customerProfileUploadpath.'/'.$image250by180);
            $image62by54 = $systemUserInsertedId.time()."_62x54".".{$extension}";
            $img = Image::make($customerProfileUploadpath.'/'.$filename)->resize(62, 54);
            $img->save($customerProfileUploadpath.'/'.$image62by54);
            chmod($_ENV['CUSTOMER_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId)."/"."profile_image/", 0777);
            DB::table('system_users')
                ->where('id', $systemUserInsertedId)
                ->update(array('profile_image' => $filename,'image_330by220'=>$image330by220,'image_250by180'=>$image250by180,'image_62by54'=>$image62by54));

            /* Insert Data In service provider table & update id in system_users table */

            $customerInsertedId = DB::table('customers')->insertGetId(
                array(
                    'looking_for' =>Input::get('lookingFor'),
                    'created_at'=>date('Y-m-d H:m:s'),
                    'updated_at'=> date('Y-m-d H:m:s')
                )
            );

            User::where('id', '=', $systemUserInsertedId)->update(array('customer_id' => $customerInsertedId,'updated_at'=> date('Y-m-d H:m:s')));


            /*Image Upload End */

            //if(app()->environment()!="local"){
                Mail::send('email.activation', $input, function($message) use ($input){
                    $message->to($input['email'])->subject('Account Confirmation');
                });
            //}
            Session::flash('message', 'Your account has been successfully created. Please check your email for the instructions on how to confirm your account.');
            return Redirect::to('login');
        }
        else{
            return Redirect::to('signup/customer')->withInput()->withErrors($validation);
        }
    }
}