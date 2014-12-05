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
                //return Redirect::back()->withInput()->withErrors($validator);
                //var_dump($validator);
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
        //dd($input);
        $rules = array(

            'firstName' => 'required|min:5|max:20',
            'lastName' => 'required|min:5|max:20',
            'username' => 'required|min:6|unique:system_users',
            'email' => 'required|email|unique:system_users',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:password',
            'profilePicture' => 'required|mimes:jpeg,jpg,png|max:2000'
        );
        $validation = Validator::make($input,$rules);
        if($validation->passes()){
            $systemUserInsertedId = DB::table('system_users')->insertGetId(
                array(
                    'username'  =>Input::get('username'),
                    'password'  =>Hash::make('password'),
                    'email'  =>Input::get('email'),
                    'is_active'  =>0,
                    'user_first_name'  =>Input::get('firstName'),
                    'user_last_name'  =>Input::get('lastName'),
                    'user_role_id'  =>2,
//                    'latitude'  =>Input::get('latitude'),
//                    'longitude'  =>Input::get('longitude'),
//                    'city'  =>Input::get('city'),
//                    'country'  =>Input::get('country'),
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
                chmod($_ENV['SP_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId)."/"."profile_image", 0777);
            }
            $extension = Input::file('profilePicture')->getClientOriginalExtension();
            $filename = sha1($systemUserInsertedId.time()).".{$extension}";
            //echo $spProfileUploadpath;echo "<br/>";
            //echo $filename;
            //exit;
            Input::file('profilePicture')->move($spProfileUploadpath, $filename);


            DB::table('system_users')
                ->where('id', $systemUserInsertedId)
                ->update(array('profile_image' => $filename));

            /* Insert Data In service provider table & update id in system_users table */

            $serviceProviderInsertedId = DB::table('service_providers')->insertGetId(
                array(
                    'riseme_up' =>0,
                    'profile_completeness'=>NULL,
                    'created_at'=>date('Y-m-d H:m:s'),
                    'updated_at'=> date('Y-m-d H:m:s')
                )
            );

            User::where('id', '=', $systemUserInsertedId)->update(array('service_provider_id' => $serviceProviderInsertedId,'updated_at'=> date('Y-m-d H:m:s')));


            /*Image Upload End */
            //$user = $systemUserInsertedId;
            /*if(app()->environment()!="local"){
                Mail::send('emails.welcome', $data, function($message) use ($input){
                    $message->to($input['localEmail'])->subject('Account Confirmation');
                });
            }*/
            Session::flash('message', 'Your account has been successfully created. Please check your email for the instructions on how to confirm your account.');
            //return View::make('signup-sp');
            return Redirect::to('signup-sp');


        }
        else{
            return Redirect::to('signup-sp')->withInput()->withErrors($validation);
        }

    }
}