<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 15/12/14
 * Time: 11:51 AM
 */
class SearchController extends BaseController {

    /*
    *function Name: distance
    *Desc: Distance calculation based on Lat & Long
    *Created By: Sagar Acharya
    *Created Date: 4 December 2014
    *return: distance
   */

    public function distance($lat1, $lon1, $lat2, $lon2, $unit) {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }

    /*
     *function Name: index
     *Desc: view search page
     *Created By: Sagar Acharya
     *Created Date: 4 December 2014
     *return: true/false based on result
    */

    public function index(){
        $knownLanguages = KnownLanguages::all();
        $ethnicity = Ethnicity::all();
        $eyeColor = EyeColor::all();
        $hairColor = HairColor::all();
        return View::make('search.index',array('knownLanguages' => $knownLanguages,'knownLanguages'=>$knownLanguages,'ethnicity'=>$ethnicity,'eyeColor'=>$eyeColor,'hairColor'=>$hairColor));
    }


    /*
     *function Name: showDataAfterLogin
     *Desc: show search data initially if login
     *Created By: Sagar Acharya
     *Created Date: 4 December 2014
     *return: true/false based on result
    */
    public function showDataAfterLogin(){
        /* If There is Normal Request */
        if(Input::get('isFilter')==0){
            $skip = Input::get('skip');
            $take = Input::get('take');

            if(Input::get('isScroll')==1){
                $latitude = Session::get('latitude');
                $longitude = Session::get('longitude');
            }else{
                $latitude = Input::get('latitude');
                $longitude = Input::get('longitude');
                if($latitude==0 && $longitude==0){
                    $latitude = Auth::user()->latitude;
                    $longitude = Auth::user()->longitude;
                }
                Session::put('latitude', $latitude);
                Session::put('longitude', $longitude);
            }

            $customerFromAge = Auth::user()->from_age;
            $customerToAge = Auth::user()->to_age;

            $customerData  = Customer::find(Auth::user()->customer_id);
            if($customerData->looking_for=='male'){

                $systemUsers = User::where('user_role_id','=','2')
                    ->where('gender','LIKE','male')
                    ->where('from_age','>=',$customerFromAge)
                    ->where('to_age','<=',$customerToAge)
                    ->where('is_active','=',1)
                    ->skip($skip)->take($take)->get();
            }elseif($customerData->looking_for=='female'){
                $systemUsers = User::where('user_role_id','=','2')
                    ->where('gender','LIKE','female')
                    ->where('from_age','>=',$customerFromAge)
                    ->where('to_age','<=',$customerToAge)
                    ->where('is_active','=',1)
                    ->skip($skip)->take($take)->get();
            }else{
                $systemUsers = User::where('user_role_id','=','2')
                    ->where('from_age','>=',$customerFromAge)
                    ->where('to_age','<=',$customerToAge)
                    ->where('is_active','=',1)
                    ->skip($skip)->take($take)->get();
            }

            $totalServiceProviderFound = NULL;
            $i=0;
            foreach($systemUsers as $systemUser){
                //$distance = round($this->distance($systemUser->latitude,$systemUser->longitude,$latitude,$longitude,'K'));
//            if($distance>=0 && $distance <=500){
                $totalServiceProviderFound[$i] = $systemUser->id;
                $i++;
                //}
            }

            /* Get Data Using Algorithm logic p,q,r */
            $serviceProviderData = NULL;
            if($totalServiceProviderFound!=NULL){
                $i=0;
                $serviceProviderData = NULL;
                foreach($totalServiceProviderFound as $systemUserSpId){
                    $serviceProviderData[$i]['system_user'] = User::find($systemUserSpId);
                    $serviceProviderData[$i]['service_provider'] = ServiceProvider::find($serviceProviderData[$i]['system_user']->service_provider_id);
                    $serviceProviderData[$i]['profile_plus_visit'] = $serviceProviderData[$i]['service_provider']->profile_completeness + $serviceProviderData[$i]['service_provider']->visit_frequency;
                    $serviceProviderData[$i]['rise_me_up'] = $serviceProviderData[$i]['service_provider']->riseme_up;
                    $i++;
                }
                $riseMeUpZero = array();
                $riseMeUpOne = array();
                $i =0;
                $j = 0;
                foreach($serviceProviderData as $serviceProvider){
                    if($serviceProvider['rise_me_up']==0){
                        array_push($riseMeUpZero,$serviceProvider);
                        //$riseMeUpZero[$i] = $serviceProvider;
                        $i++;
                    }
                    else{
                        array_push($riseMeUpOne,$serviceProvider);
                        //$riseMeUpOne[$j] = $serviceProvider;
                        $j++;
                    }
                }

                uasort($riseMeUpOne, array("SearchController","sortByProfilePlusVisit"));
                uasort($riseMeUpZero, array("SearchController","sortByProfilePlusVisit"));

                $serviceProviderData = array();
                if(!empty($riseMeUpOne) && !empty($riseMeUpZero)){
                    $serviceProviderData = array_merge($riseMeUpOne,$riseMeUpZero);
                }elseif(!empty($riseMeUpOne)){
                    $serviceProviderData = array_merge($riseMeUpOne);
                }elseif(!empty($riseMeUpZero)){
                    $serviceProviderData = array_merge($riseMeUpZero);
                }

            }
            /* Maintain Global Data
                http://laravel.io/forum/07-23-2014-global-data-object
            */
            //Data::set('serviceProviderSearchResult', $serviceProviderData);
            //  dd($serviceProviderData);
            //echo "<pre>";print_r($serviceProviderData);echo "</pre>";
            //if($serviceProviderData!=NULL){
            //return Response::json(['success'=>true,'serviceProviderData'=>json_encode($serviceProviderData)]);
            return View::make('search.searchResults')->with('serviceProviderData', $serviceProviderData);
            /*}else{
                return Response::json(['success'=>false]);
            }*/
        }else{ /* If there is ajax request filter */
            //dd(Input::all());
            $input = Input::all();
            if($input['languages']==0){
                $languageId = array(1,2);
            }else{
                $languageId = array($input['languages']);
            }
            $currentDate=date('d-m-Y');
            $dayName = strtolower(date("D",strtotime($currentDate)));
            $currentTime = date('H:m:s');

            if(isset($input['availability']) && isset($input['pubicHair'])){
                if($input['gender']=='both'){
                    $queryResult = DB::table('service_providers')
                        ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                        ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                        ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                        ->where('service_providers.hair_color','LIKE',$input['hairColor'])
                        ->where('service_providers.eye_color','LIKE',$input['eyeColor'])
                        ->where('service_providers.ethnicity','LIKE',$input['ethnicity'])
                        ->where('service_providers.pubic_hair','LIKE',$input['pubicHair'])
                        ->where('service_providers.hips','=',$input['hips'])
                        ->where('service_providers.bust','=',$input['bust'])
                        ->where('service_providers.cup_size','=',$input['cup'])
                        ->where('service_providers.hips','=',$input['hips'])
                        ->whereIn('service_provider_languages.known_languages_id',$languageId)
                        ->where('service_provider_availabilities.day','LIKE',$dayName)
                        ->where('service_provider_availabilities.from_time','<=',$currentTime)
                        ->where('service_provider_availabilities.to_time','>=',$currentTime)
                        ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_provider_availabilities.id AS availabilytId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency'] )
                        ->get();
                }else{
                    $queryResult = DB::table('service_providers')
                        ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                        ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                        ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                        ->where('system_users.gender','LIKE',$input['gender'])
                        ->where('service_providers.hair_color','LIKE',$input['hairColor'])
                        ->where('service_providers.eye_color','LIKE',$input['eyeColor'])
                        ->where('service_providers.ethnicity','LIKE',$input['ethnicity'])
                        ->where('service_providers.pubic_hair','LIKE',$input['pubicHair'])
                        ->where('service_providers.hips','=',$input['hips'])
                        ->where('service_providers.bust','=',$input['bust'])
                        ->where('service_providers.cup_size','=',$input['cup'])
                        ->where('service_providers.hips','=',$input['hips'])
                        ->whereIn('service_provider_languages.known_languages_id',$languageId)
                        ->where('service_provider_availabilities.day','LIKE',$dayName)
                        ->where('service_provider_availabilities.from_time','<=',$currentTime)
                        ->where('service_provider_availabilities.to_time','>=',$currentTime)
                        ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_provider_availabilities.id AS availabilytId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency'] )
                        ->get();
                }
            }elseif(isset($input['availability'])){
                if($input['gender']=='both'){
                    $queryResult = DB::table('service_providers')
                        ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                        ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                        ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                        ->where('service_providers.hair_color','LIKE',$input['hairColor'])
                        ->where('service_providers.eye_color','LIKE',$input['eyeColor'])
                        ->where('service_providers.ethnicity','LIKE',$input['ethnicity'])
                        ->where('service_providers.hips','=',$input['hips'])
                        ->where('service_providers.bust','=',$input['bust'])
                        ->where('service_providers.cup_size','=',$input['cup'])
                        ->where('service_providers.hips','=',$input['hips'])
                        ->whereIn('service_provider_languages.known_languages_id',$languageId)
                        ->where('service_provider_availabilities.day','LIKE',$dayName)
                        ->where('service_provider_availabilities.from_time','<=',$currentTime)
                        ->where('service_provider_availabilities.to_time','>=',$currentTime)
                        ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_provider_availabilities.id AS availabilytId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency'] )
                        ->get();
                }else{
                    $queryResult = DB::table('service_providers')
                        ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                        ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                        ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                        ->where('system_users.gender','LIKE',$input['gender'])
                        ->where('service_providers.hair_color','LIKE',$input['hairColor'])
                        ->where('service_providers.eye_color','LIKE',$input['eyeColor'])
                        ->where('service_providers.ethnicity','LIKE',$input['ethnicity'])
                        ->where('service_providers.hips','=',$input['hips'])
                        ->where('service_providers.bust','=',$input['bust'])
                        ->where('service_providers.cup_size','=',$input['cup'])
                        ->where('service_providers.hips','=',$input['hips'])
                        ->whereIn('service_provider_languages.known_languages_id',$languageId)
                        ->where('service_provider_availabilities.day','LIKE',$dayName)
                        ->where('service_provider_availabilities.from_time','<=',$currentTime)
                        ->where('service_provider_availabilities.to_time','>=',$currentTime)
                        ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_provider_availabilities.id AS availabilytId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency'] )
                        ->get();
                }
            }elseif(isset($input['pubicHair'])){
                if($input['gender']=='both'){
                    $queryResult = DB::table('service_providers')
                        ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                        ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                        ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                        ->where('service_providers.hair_color','LIKE',$input['hairColor'])
                        ->where('service_providers.eye_color','LIKE',$input['eyeColor'])
                        ->where('service_providers.ethnicity','LIKE',$input['ethnicity'])
                        ->where('service_providers.pubic_hair','LIKE',$input['pubicHair'])
                        ->where('service_providers.hips','=',$input['hips'])
                        ->where('service_providers.bust','=',$input['bust'])
                        ->where('service_providers.cup_size','=',$input['cup'])
                        ->where('service_providers.hips','=',$input['hips'])
                        ->whereIn('service_provider_languages.known_languages_id',$languageId)
                        ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency'] )
                        ->get();
                }else{
                    $queryResult = DB::table('service_providers')
                        ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                        ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                        ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                        ->where('system_users.gender','LIKE',$input['gender'])
                        ->where('service_providers.hair_color','LIKE',$input['hairColor'])
                        ->where('service_providers.eye_color','LIKE',$input['eyeColor'])
                        ->where('service_providers.ethnicity','LIKE',$input['ethnicity'])
                        ->where('service_providers.pubic_hair','LIKE',$input['pubicHair'])
                        ->where('service_providers.hips','=',$input['hips'])
                        ->where('service_providers.bust','=',$input['bust'])
                        ->where('service_providers.cup_size','=',$input['cup'])
                        ->where('service_providers.hips','=',$input['hips'])
                        ->whereIn('service_provider_languages.known_languages_id',$languageId)
                        ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency'] )
                        ->get();
                }
            }
            dd($queryResult);
        }
    }

    /*
     *function Name: sortByProfilePlusVisit
     *Desc: sort multidimentional array using addition of profile completeness & visit frequency
     *Created By: Sagar Acharya
     *Created Date: 16 December 2014
     * Reference:  http://www.paulund.co.uk/sort-multi-dimensional-array-value
                   http://php.net/manual/en/function.uasort.php
     *return: true/false based on result
    */
    public function sortByProfilePlusVisit($a,$b){

        if ($a['profile_plus_visit'] == $b['profile_plus_visit']) {
            return 0;
        }
        return ($a['profile_plus_visit'] > $b['profile_plus_visit']) ? -1 : 1;
    }

    public function sortByRiseUp($a,$b){
//        if ($a['rise_me_up'] == $b['rise_me_up']) {
//            return 0;
//        }
        return ($a['rise_me_up'] > $b['rise_me_up']) ? -1 : 1;
    }
}