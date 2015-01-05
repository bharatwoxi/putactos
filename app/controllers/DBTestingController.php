<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 1/12/14
 * Time: 3:33 PM
 */
class DBTestingController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function index()
    {
        $userRole = UserRole::all();
        $knownLanguages = KnownLanguages::all();
        $ethnicity = Ethnicity::all();
        $eyeColor = EyeColor::all();
        $hairColor = HairColor::all();
        return View::make('dataTesting.gplaces', array('userRole' => $userRole,'knownLanguages'=>$knownLanguages,'ethnicity'=>$ethnicity,'eyeColor'=>$eyeColor,'hairColor'=>$hairColor));
    }

    public function getFormData(){
        $systemUserInsertedId = DB::table('system_users')->insertGetId(
            array(
                'username'  =>Input::get('username'),
                'password'  =>Hash::make(Input::get('password')),
                'email'  =>Input::get('email'),
                'birth_date'  =>Input::get('birthdate'),
                'gender'  =>Input::get('gender'),
                'is_active'  =>1,
                'user_first_name'  =>Input::get('firstName'),
                'user_last_name'  =>Input::get('lastName'),
                'profile_image'  =>'default.jpg',
                'user_role_id'  =>Input::get('userRole'),
                'from_age'  =>Input::get('fromAge'),
                'to_age'  =>Input::get('toAge'),
                'latitude'  =>Input::get('latitude'),
                'longitude'  =>Input::get('longitude'),
                'city'  =>Input::get('city'),
                'country'  =>Input::get('country'),
                'remember_token'=> Input::get('_token'),
                'created_at'=>date('Y-m-d H:m:s'),
                'updated_at'=> date('Y-m-d H:m:s')
            )
        );
        if(Input::get('userRole')==1){ //customer

            /* File Upload Code */
            $customerProfileUploadpath = $_ENV['CUSTOMER_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId)."/"."profile_image";

            /* Create Upload Directory If Not Exists */
            if(!file_exists($customerProfileUploadpath)){
                File::makeDirectory($customerProfileUploadpath, $mode = 0777,true,true);
                chmod($_ENV['CUSTOMER_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId), 0777);
                chmod($_ENV['CUSTOMER_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId)."/"."profile_image", 0777);
            }
            $extension = Input::file('profileImage')->getClientOriginalExtension();
            $filename = sha1($systemUserInsertedId.time()).".{$extension}";
            Input::file('profileImage')->move($customerProfileUploadpath, $filename);


            DB::table('system_users')
                ->where('id', $systemUserInsertedId)
                ->update(array('profile_image' => $filename));

            $customerInsertedId = DB::table('customers')->insertGetId(
                array(
                    'looking_for'=>Input::get('lookingFor'),
                    'created_at'=>date('Y-m-d H:m:s'),
                    'updated_at'=> date('Y-m-d H:m:s')
                )
            );
            User::where('id', '=', $systemUserInsertedId)->update(array('customer_id' => $customerInsertedId,'updated_at'=> date('Y-m-d H:m:s')));
        }
        if(Input::get('userRole')==2){ //service provider
            /* File Upload Code */
            $spProfileUploadpath = $_ENV['SP_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId)."/"."profile_image";

            /* Create Upload Directory If Not Exists */
            if(!file_exists($spProfileUploadpath)){
                File::makeDirectory($spProfileUploadpath, $mode = 0777,true,true);
                chmod($_ENV['SP_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId), 0777);
                chmod($_ENV['SP_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId)."/"."profile_image", 0777);
            }
            $extension = Input::file('profileImage')->getClientOriginalExtension();
            $filename = sha1($systemUserInsertedId.time()).".{$extension}";
            Input::file('profileImage')->move($spProfileUploadpath, $filename);


            DB::table('system_users')
                ->where('id', $systemUserInsertedId)
                ->update(array('profile_image' => $filename));

            /* Insert Null if empty */

            if(Input::get('visitFrequency')==''){
                $visitFrequency = NULL;
            }else{
                $visitFrequency = Input::get('visitFrequency');
            }

            if(Input::get('turnsMeOn')==''){
                $turnsMeOn = NULL;
            }else{
                $turnsMeOn = Input::get('turnsMeOn');
            }

            if(Input::get('pubicHair')==''){
                $pubicHair = NULL;
            }else{
                $pubicHair = Input::get('pubicHair');
            }

            if(Input::get('bust')==''){
                $bust = NULL;
            }else{
                $bust = Input::get('bust');
            }

            if(Input::get('cupSize')==''){
                $cupSize = NULL;
            }else{
                $cupSize = Input::get('cupSize');
            }

            if(Input::get('waist')==''){
                $waist = NULL;
            }else{
                $waist = Input::get('waist');
            }

            if(Input::get('hips')==''){
                $hips = NULL;
            }else{
                $hips = Input::get('hips');
            }

            if(Input::get('weight')==''){
                $weight = NULL;
            }else{
                $weight = Input::get('weight');
            }

            if(Input::get('height')==''){
                $height = NULL;
            }else{
                $height = Input::get('height');
            }

            if(Input::get('eyeColor')==''){
                $eyeColor = NULL;
            }else{
                $eyeColor = Input::get('eyeColor');
            }

            if(Input::get('hairColor')==''){
                $hairColor = NULL;
            }else{
                $hairColor = Input::get('hairColor');
            }

            if(Input::get('ethnicity')==''){
                $ethnicity = NULL;
            }else{
                $ethnicity = Input::get('ethnicity');
            }

            $serviceProviderInsertedId = DB::table('service_providers')->insertGetId(
                array(
                    'riseme_up' =>0,
                    'visit_frequency'=>$visitFrequency,
                    'turns_me_on'=>$turnsMeOn,
                    'pubic_hair'=>$pubicHair,
                    'bust'=>$bust,
                    'cup_size'=>$cupSize,
                    'waist'=>$waist,
                    'hips'=>$hips,
                    'ethnicity'=>$ethnicity,
                    'weight'=>$weight,
                    'height'=>$height,
                    'eye_color'=>$eyeColor,
                    'hair_color'=>$hairColor,
                    'created_at'=>date('Y-m-d H:m:s'),
                    'updated_at'=> date('Y-m-d H:m:s')
                )
            );

            User::where('id', '=', $systemUserInsertedId)->update(array('service_provider_id' => $serviceProviderInsertedId,'updated_at'=> date('Y-m-d H:m:s')));


            /* Insert Languages */
            $language = Input::get('knownLanguages');
            for($i=0;$i<count($language);$i++){
                DB::table('service_provider_languages')->insert(
                    array(
                        'known_languages_id'=>$language[$i],
                        'service_provider_id'=>$serviceProviderInsertedId,
                        'created_at'=>date('Y-m-d H:m:s'),
                        'updated_at'=> date('Y-m-d H:m:s')
                    )
                );
            }


            $availability = Input::get('availability');
            if(!empty($availability) || $availability!=NULL){
                foreach($availability as $available){
                    DB::table('service_provider_availabilities')->insert(
                        array(
                            'service_provider_id'=>$serviceProviderInsertedId,
                            'week_day'=>$available,
                            'from_time'=>Input::get('fromTime'),
                            'to_time'=>Input::get('toTime'),
                            'created_at'=>date('Y-m-d H:m:s'),
                            'updated_at'=> date('Y-m-d H:m:s')
                        )
                    );
                }
            }
        }
        return Redirect::to('dummy');
    }
}
