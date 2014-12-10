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
        return View::make('dataTesting.gplaces', array('userRole' => $userRole,'knownLanguages'=>$knownLanguages));
    }

    public function getFormData(){
        $systemUserInsertedId = DB::table('system_users')->insertGetId(
            array(
                'username'  =>Input::get('username'),
                'password'  =>Hash::make('password'),
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
                'created_at'=>date('Y-m-d H:m:s'),
                'updated_at'=> date('Y-m-d H:m:s')
            )
        );
        if(Input::get('userRole')==1){ //customer
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
            $serviceProviderInsertedId = DB::table('service_providers')->insertGetId(
                array(
                    'riseme_up' =>0,
                    'visit_frequency'=>Input::get('visitFrequency'),
                    'turns_me_on'=>Input::get('turnsMeOn'),
                    'pubic_hair'=>Input::get('pubicHair'),
                    'bust'=>Input::get('bust'),
                    'cup_size'=>Input::get('cupSize'),
                    'waist'=>Input::get('waist'),
                    'hips'=>Input::get('hips'),
                    'ethnicity'=>Input::get('ethnicity'),
                    'weight'=>Input::get('weight'),
                    'height'=>Input::get('height'),
                    'eye_color'=>Input::get('eyeColor'),
                    'hair_color'=>Input::get('hairColor'),
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
            $x = implode(",",$availability);
            DB::table('service_provider_availabilities')->insert(
                array(
                    'service_provider_id'=>$serviceProviderInsertedId,
                    'day'=>1,
                    'from_time'=>Input::get('fromTime'),
                    'to_time'=>Input::get('toTime'),
                    'created_at'=>date('Y-m-d H:m:s'),
                    'updated_at'=> date('Y-m-d H:m:s')
                )
            );
        }
    }
}
