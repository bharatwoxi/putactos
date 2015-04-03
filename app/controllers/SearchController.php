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
        //dd(Input::all());
        $bustMaster = Input::get('bust');
        $cupMaster = Input::get('cup');
        $hipsMaster = Input::get('hips');
        $penisMaster = Input::get('penis');
        $waistMaster = Input::get('waist');
        $bust = explode(",",$bustMaster);
        $cup = explode(",",$cupMaster);
        $hips = explode(",",$hipsMaster);
        $penis = explode(",",$penisMaster);
        $waist = explode(",",$waistMaster);
        /* If There is Normal Request */
        if(Input::get('isFilter')==0){
            $customerData  = Customer::find(Auth::user()->customer_id);
            $customerFromAge = Auth::user()->from_age;
            $customerToAge = Auth::user()->to_age;

            if(Input::get('isScroll')==1){
                $latitude = Session::get('latitude');
                $longitude = Session::get('longitude');
                $skip = Session::get('skip');
                $take = 3;
            }else{
                $latitude = Input::get('latitude');
                $longitude = Input::get('longitude');
                $skip = 0;
                $take = 3;
                if($latitude==0 && $longitude==0){
                    $latitude = Auth::user()->latitude;
                    $longitude = Auth::user()->longitude;
                }
                Session::put('latitude', $latitude);
                Session::put('longitude', $longitude);

                /* Get Total Query Count Result */
                if($customerData->looking_for=='male'){

                    $queryCount = User::where('user_role_id','=','2')
                        ->where('gender','=',1)
                        ->where('current_age','>=',$customerFromAge)
                        ->where('current_age','<=',$customerToAge)
                        ->where('is_active','=',1)
                        ->count();
                }elseif($customerData->looking_for=='female'){
                    $queryCount = User::where('user_role_id','=','2')
                        ->where('gender','=',2)
                        ->where('current_age','>=',$customerFromAge)
                        ->where('current_age','<=',$customerToAge)
                        ->where('is_active','=',1)
                        ->count();
                }else{
                    $queryCount = User::where('user_role_id','=','2')
                        ->where('current_age','>=',$customerFromAge)
                        ->where('current_age','<=',$customerToAge)
                        ->where('is_active','=',1)
                        ->count();
                }
                Session::put('queryCount', $queryCount);
            }

            $queryCount = Session::get('queryCount');
            $queryRecord = 0;
            do{
                $queryRecord++;
                $take = $take + 1;
                if($customerData->looking_for=='male'){
                    $systemUsers = User::where('user_role_id','=','2')
                        ->where('gender','=',1)
                        ->where('current_age','>=',$customerFromAge)
                        ->where('current_age','<=',$customerToAge)
                        ->where('is_active','=',1)
                        ->skip($skip)->take($take)->get();
                }elseif($customerData->looking_for=='female'){
                    $systemUsers = User::where('user_role_id','=','2')
                        ->where('gender','=',2)
                        ->where('current_age','>=',$customerFromAge)
                        ->where('current_age','<=',$customerToAge)
                        ->where('is_active','=',1)
                        ->skip($skip)->take($take)->get();
                }else{
                    $systemUsers = User::where('user_role_id','=','2')
                        ->where('current_age','>=',$customerFromAge)
                        ->where('current_age','<=',$customerToAge)
                        ->where('is_active','=',1)
                        ->skip($skip)->take($take)->get();
                }
                $totalServiceProviderFound = NULL;
                $i=0;
                if(!empty($systemUsers) || $systemUsers!=NULL){
                    foreach($systemUsers as $systemUser){
                        $distance = round($this->distance($systemUser->latitude,$systemUser->longitude,$latitude,$longitude,'K'));
                        if($distance>=0 && $distance <=5){
                            $totalServiceProviderFound[$i] = $systemUser->id;
                            $i++;
                        }
                    }
                }else{
                    break;
                }
            }while(count($totalServiceProviderFound)<4 && $queryRecord<=$queryCount);
            $skip = $skip + $take;
            Session::put('skip', $skip);


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
                        $i++;
                    }
                    else{
                        array_push($riseMeUpOne,$serviceProvider);
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
            $skip = $skip + $take;

            return View::make('search.searchResults')->with(array('serviceProviderData'=> $serviceProviderData,'skip'=>$skip,'take'=>$take));

        }else{ /* If there is ajax request filter */
            if(Input::get('isScroll')==1){
                $input = Session::get('input');
                $bustMaster = Session::get('bustMaster');
                $cupMaster = Session::get('cupMaster');
                $hipsMaster = Session::get('hipsMaster');
                $penisMaster = Session::get('penisMaster');
                $waistMaster = Session::get('waistMaster');
            }else{
                $input = Input::all();
                $bustMaster = Input::get('bust');
                $cupMaster = Input::get('cup');
                $hipsMaster = Input::get('hips');
                $penisMaster = Input::get('penis');
                $waistMaster = Input::get('waist');
                Session::put('bustMaster', $bustMaster);
                Session::put('cupMaster', $cupMaster);
                Session::put('hipsMaster', $hipsMaster);
                Session::put('penisMaster', $penisMaster);
                Session::put('waistMaster', $waistMaster);
                if(!isset($input['pubicHair'])){
                    $input['pubicHair'] = NULL;
                }
                if(!isset($input['availability'])){
                    $input['availability'] = NULL;
                }

            }
            $bust = explode(",",$bustMaster);
            $cup = explode(",",$cupMaster);
            $hips = explode(",",$hipsMaster);
            $penis = explode(",",$penisMaster);
            $waist = explode(",",$waistMaster);
            $distanceRange = explode('-',$input['distanceRange']);

            $latitude = Session::get('latitude');
            $longitude = Session::get('longitude');
            /* To get atleast 4 records for lazy loading */
            $skip = $input['skip'];
            $take = $input['take'];
            /* 0 For Both Languages */
            if($input['languages']==0){
                $languageId = array(1,2);
            }else{
                $languageId = array($input['languages']);
            }

            $currentDate=date('d-m-Y');
            $dayName = strtolower(date("D",strtotime($currentDate)));
            if($dayName=='mon'){
                $day = 1;
            }elseif($dayName=='tue'){
                $day = 2;
            }elseif($dayName=='wed'){
                $day = 3;
            }elseif($dayName=='thu'){
                $day = 4;
            }elseif($dayName=='fri'){
                $day = 5;
            }elseif($dayName=='sat'){
                $day = 6;
            }elseif($dayName=='sun'){
                $day = 7;
            }
            $currentTime = date('H:m:s');
            if($input['isScroll']==0){
                /* Get Query Count For Total Records*/
                if($input['availability']!=NULL && $input['pubicHair']!=NULL){
                    if($input['gender']==1){
                        $queryCount = DB::table('service_providers')
                            ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                            ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                            ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                            ->where('service_providers.hair_color','=',$input['hairColor'])
                            ->where('service_providers.eye_color','=',$input['eyeColor'])
                            ->where('service_providers.ethnicity','=',$input['ethnicity'])
                            ->where('service_providers.pubic_hair','=',$input['pubicHair'])
                            ->where('service_providers.hips','>=',$hips[0])
                            ->where('service_providers.hips','<=',$hips[1])
                            ->where('service_providers.bust','>=',$bust[0])
                            ->where('service_providers.bust','<=',$bust[1])
                            ->where('service_providers.cup_size','>=',$cup[0])
                            ->where('service_providers.cup_size','<=',$cup[1])
                            ->where('service_providers.waist','>=',$waist[0])
                            ->where('service_providers.waist','<=',$waist[1])
                            ->where('service_providers.penis_size','>=',$penis[0])
                            ->where('service_providers.penis_size','<=',$penis[1])
                            ->whereIn('service_provider_languages.known_languages_id',$languageId)
                            ->where('service_provider_availabilities.week_day','=',$day)
                            ->where('service_provider_availabilities.from_time','<=',$currentTime)
                            ->where('service_provider_availabilities.to_time','>=',$currentTime)
                            ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_provider_availabilities.id AS availabilytId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency','system_users.latitude','system_users.longitude'] )
                            ->count();
                    }else{
                        $queryCount = DB::table('service_providers')
                            ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                            ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                            ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                            ->where('system_users.gender','=',$input['gender'])
                            ->where('service_providers.hair_color','=',$input['hairColor'])
                            ->where('service_providers.eye_color','=',$input['eyeColor'])
                            ->where('service_providers.ethnicity','=',$input['ethnicity'])
                            ->where('service_providers.pubic_hair','=',$input['pubicHair'])
                            ->where('service_providers.hips','>=',$hips[0])
                            ->where('service_providers.hips','<=',$hips[1])
                            ->where('service_providers.bust','>=',$bust[0])
                            ->where('service_providers.bust','<=',$bust[1])
                            ->where('service_providers.cup_size','>=',$cup[0])
                            ->where('service_providers.cup_size','<=',$cup[1])
                            ->where('service_providers.waist','>=',$waist[0])
                            ->where('service_providers.waist','<=',$waist[1])
                            ->whereIn('service_provider_languages.known_languages_id',$languageId)
                            ->where('service_provider_availabilities.week_day','=',$day)
                            ->where('service_provider_availabilities.from_time','<=',$currentTime)
                            ->where('service_provider_availabilities.to_time','>=',$currentTime)
                            ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_provider_availabilities.id AS availabilytId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency','system_users.latitude','system_users.longitude'] )
                            ->count();
                    }
                }elseif($input['availability']!=NULL){
                    if($input['gender']==1){
                        $queryCount = DB::table('service_providers')
                            ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                            ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                            ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                            ->where('service_providers.hair_color','=',$input['hairColor'])
                            ->where('service_providers.eye_color','=',$input['eyeColor'])
                            ->where('service_providers.ethnicity','=',$input['ethnicity'])
                            ->where('service_providers.hips','>=',$hips[0])
                            ->where('service_providers.hips','<=',$hips[1])
                            ->where('service_providers.bust','>=',$bust[0])
                            ->where('service_providers.bust','<=',$bust[1])
                            ->where('service_providers.cup_size','>=',$cup[0])
                            ->where('service_providers.cup_size','<=',$cup[1])
                            ->where('service_providers.waist','>=',$waist[0])
                            ->where('service_providers.waist','<=',$waist[1])
                            ->where('service_providers.penis_size','>=',$penis[0])
                            ->where('service_providers.penis_size','<=',$penis[1])
                            ->whereIn('service_provider_languages.known_languages_id',$languageId)
                            ->where('service_provider_availabilities.week_day','=',$day)
                            ->where('service_provider_availabilities.from_time','<=',$currentTime)
                            ->where('service_provider_availabilities.to_time','>=',$currentTime)
                            ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_provider_availabilities.id AS availabilytId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency','system_users.latitude','system_users.longitude'] )
                            ->count();
                    }else{
                        $queryCount = DB::table('service_providers')
                            ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                            ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                            ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                            ->where('system_users.gender','=',$input['gender'])
                            ->where('service_providers.hair_color','=',$input['hairColor'])
                            ->where('service_providers.eye_color','=',$input['eyeColor'])
                            ->where('service_providers.ethnicity','=',$input['ethnicity'])
                            ->where('service_providers.hips','>=',$hips[0])
                            ->where('service_providers.hips','<=',$hips[1])
                            ->where('service_providers.bust','>=',$bust[0])
                            ->where('service_providers.bust','<=',$bust[1])
                            ->where('service_providers.cup_size','>=',$cup[0])
                            ->where('service_providers.cup_size','<=',$cup[1])
                            ->where('service_providers.waist','>=',$waist[0])
                            ->where('service_providers.waist','<=',$waist[1])
                            ->whereIn('service_provider_languages.known_languages_id',$languageId)
                            ->where('service_provider_availabilities.week_day','=',$day)
                            ->where('service_provider_availabilities.from_time','<=',$currentTime)
                            ->where('service_provider_availabilities.to_time','>=',$currentTime)
                            ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_provider_availabilities.id AS availabilytId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency','system_users.latitude','system_users.longitude'] )
                            ->count();
                    }
                }elseif($input['pubicHair']!=NULL){
                    if($input['gender']==1){
                        $queryCount = DB::table('service_providers')
                            ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                            ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                            ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                            ->where('service_providers.hair_color','=',$input['hairColor'])
                            ->where('service_providers.eye_color','=',$input['eyeColor'])
                            ->where('service_providers.ethnicity','=',$input['ethnicity'])
                            ->where('service_providers.pubic_hair','=',$input['pubicHair'])
                            ->where('service_providers.hips','>=',$hips[0])
                            ->where('service_providers.hips','<=',$hips[1])
                            ->where('service_providers.bust','>=',$bust[0])
                            ->where('service_providers.bust','<=',$bust[1])
                            ->where('service_providers.cup_size','>=',$cup[0])
                            ->where('service_providers.cup_size','<=',$cup[1])
                            ->where('service_providers.waist','>=',$waist[0])
                            ->where('service_providers.waist','<=',$waist[1])
                            ->where('service_providers.penis_size','>=',$penis[0])
                            ->where('service_providers.penis_size','<=',$penis[1])
                            ->whereIn('service_provider_languages.known_languages_id',$languageId)
                            ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency','system_users.latitude','system_users.longitude'] )
                            ->count();
                    }else{
                        $queryCount = DB::table('service_providers')
                            ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                            ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                            ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                            ->where('system_users.gender','=',$input['gender'])
                            ->where('service_providers.hair_color','=',$input['hairColor'])
                            ->where('service_providers.eye_color','=',$input['eyeColor'])
                            ->where('service_providers.ethnicity','=',$input['ethnicity'])
                            ->where('service_providers.pubic_hair','=',$input['pubicHair'])
                            ->where('service_providers.hips','>=',$hips[0])
                            ->where('service_providers.hips','<=',$hips[1])
                            ->where('service_providers.bust','>=',$bust[0])
                            ->where('service_providers.bust','<=',$bust[1])
                            ->where('service_providers.cup_size','>=',$cup[0])
                            ->where('service_providers.cup_size','<=',$cup[1])
                            ->where('service_providers.waist','>=',$waist[0])
                            ->where('service_providers.waist','<=',$waist[1])
                            ->whereIn('service_provider_languages.known_languages_id',$languageId)
                            ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency','system_users.latitude','system_users.longitude'] )
                            ->count();
                    }
                }
                $input['queryCount'] = $queryCount;
            }
            $queryCount = $input['queryCount'];
            $queryRecord = 0;
            do{
                $queryRecord++;
                $take = $take + 1;
                if($input['availability']!=NULL && $input['pubicHair']!=NULL){
                    if($input['gender']==1){
                        $queryResult = DB::table('service_providers')
                            ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                            ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                            ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                            ->where('service_providers.hair_color','=',$input['hairColor'])
                            ->where('service_providers.eye_color','=',$input['eyeColor'])
                            ->where('service_providers.ethnicity','=',$input['ethnicity'])
                            ->where('service_providers.pubic_hair','=',$input['pubicHair'])
                            ->where('service_providers.hips','>=',$hips[0])
                            ->where('service_providers.hips','<=',$hips[1])
                            ->where('service_providers.bust','>=',$bust[0])
                            ->where('service_providers.bust','<=',$bust[1])
                            ->where('service_providers.cup_size','>=',$cup[0])
                            ->where('service_providers.cup_size','<=',$cup[1])
                            ->where('service_providers.waist','>=',$waist[0])
                            ->where('service_providers.waist','<=',$waist[1])
                            ->where('service_providers.penis_size','>=',$penis[0])
                            ->where('service_providers.penis_size','<=',$penis[1])
                            ->whereIn('service_provider_languages.known_languages_id',$languageId)
                            ->where('service_provider_availabilities.week_day','=',$day)
                            ->where('service_provider_availabilities.from_time','<=',$currentTime)
                            ->where('service_provider_availabilities.to_time','>=',$currentTime)
                            ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_provider_availabilities.id AS availabilytId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency','system_users.latitude','system_users.longitude'] )
                            ->skip($skip)->take($take)->get();
                    }else{
                        $queryResult = DB::table('service_providers')
                            ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                            ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                            ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                            ->where('system_users.gender','=',$input['gender'])
                            ->where('service_providers.hair_color','=',$input['hairColor'])
                            ->where('service_providers.eye_color','=',$input['eyeColor'])
                            ->where('service_providers.ethnicity','=',$input['ethnicity'])
                            ->where('service_providers.pubic_hair','=',$input['pubicHair'])
                            ->where('service_providers.hips','>=',$hips[0])
                            ->where('service_providers.hips','<=',$hips[1])
                            ->where('service_providers.bust','>=',$bust[0])
                            ->where('service_providers.bust','<=',$bust[1])
                            ->where('service_providers.cup_size','>=',$cup[0])
                            ->where('service_providers.cup_size','<=',$cup[1])
                            ->where('service_providers.waist','>=',$waist[0])
                            ->where('service_providers.waist','<=',$waist[1])
                            ->whereIn('service_provider_languages.known_languages_id',$languageId)
                            ->where('service_provider_availabilities.week_day','=',$day)
                            ->where('service_provider_availabilities.from_time','<=',$currentTime)
                            ->where('service_provider_availabilities.to_time','>=',$currentTime)
                            ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_provider_availabilities.id AS availabilytId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency','system_users.latitude','system_users.longitude'] )
                            ->skip($skip)->take($take)->get();
                    }
                }elseif($input['availability']!=NULL){
                    if($input['gender']==1){
                        $queryResult = DB::table('service_providers')
                            ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                            ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                            ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                            ->where('service_providers.hair_color','=',$input['hairColor'])
                            ->where('service_providers.eye_color','=',$input['eyeColor'])
                            ->where('service_providers.ethnicity','=',$input['ethnicity'])
                            ->where('service_providers.hips','>=',$hips[0])
                            ->where('service_providers.hips','<=',$hips[1])
                            ->where('service_providers.bust','>=',$bust[0])
                            ->where('service_providers.bust','<=',$bust[1])
                            ->where('service_providers.cup_size','>=',$cup[0])
                            ->where('service_providers.cup_size','<=',$cup[1])
                            ->where('service_providers.waist','>=',$waist[0])
                            ->where('service_providers.waist','<=',$waist[1])
                            ->where('service_providers.penis_size','>=',$penis[0])
                            ->where('service_providers.penis_size','<=',$penis[1])
                            ->whereIn('service_provider_languages.known_languages_id',$languageId)
                            ->where('service_provider_availabilities.week_day','=',$day)
                            ->where('service_provider_availabilities.from_time','<=',$currentTime)
                            ->where('service_provider_availabilities.to_time','>=',$currentTime)
                            ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_provider_availabilities.id AS availabilytId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency','system_users.latitude','system_users.longitude'] )
                            ->skip($skip)->take($take)->get();
                    }else{
                        $queryResult = DB::table('service_providers')
                            ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                            ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                            ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                            ->where('system_users.gender','=',$input['gender'])
                            ->where('service_providers.hair_color','=',$input['hairColor'])
                            ->where('service_providers.eye_color','=',$input['eyeColor'])
                            ->where('service_providers.ethnicity','=',$input['ethnicity'])
                            ->where('service_providers.hips','>=',$hips[0])
                            ->where('service_providers.hips','<=',$hips[1])
                            ->where('service_providers.bust','>=',$bust[0])
                            ->where('service_providers.bust','<=',$bust[1])
                            ->where('service_providers.cup_size','>=',$cup[0])
                            ->where('service_providers.cup_size','<=',$cup[1])
                            ->where('service_providers.waist','>=',$waist[0])
                            ->where('service_providers.waist','<=',$waist[1])
                            ->whereIn('service_provider_languages.known_languages_id',$languageId)
                            ->where('service_provider_availabilities.week_day','=',$day)
                            ->where('service_provider_availabilities.from_time','<=',$currentTime)
                            ->where('service_provider_availabilities.to_time','>=',$currentTime)
                            ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_provider_availabilities.id AS availabilytId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency','system_users.latitude','system_users.longitude'] )
                            ->skip($skip)->take($take)->get();
                    }
                }elseif($input['pubicHair']!=NULL){
                    if($input['gender']==1){
                        $queryResult = DB::table('service_providers')
                            ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                            ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                            ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                            ->where('service_providers.hair_color','=',$input['hairColor'])
                            ->where('service_providers.eye_color','=',$input['eyeColor'])
                            ->where('service_providers.ethnicity','=',$input['ethnicity'])
                            ->where('service_providers.pubic_hair','=',$input['pubicHair'])
                            ->where('service_providers.hips','>=',$hips[0])
                            ->where('service_providers.hips','<=',$hips[1])
                            ->where('service_providers.bust','>=',$bust[0])
                            ->where('service_providers.bust','<=',$bust[1])
                            ->where('service_providers.cup_size','>=',$cup[0])
                            ->where('service_providers.cup_size','<=',$cup[1])
                            ->where('service_providers.waist','>=',$waist[0])
                            ->where('service_providers.waist','<=',$waist[1])
                            ->where('service_providers.penis_size','>=',$penis[0])
                            ->where('service_providers.penis_size','<=',$penis[1])
                            ->whereIn('service_provider_languages.known_languages_id',$languageId)
                            ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency','system_users.latitude','system_users.longitude'] )
                            ->skip($skip)->take($take)->get();
                    }else{
                        $queryResult = DB::table('service_providers')
                            ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                            ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                            ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                            ->where('system_users.gender','=',$input['gender'])
                            ->where('service_providers.hair_color','=',$input['hairColor'])
                            ->where('service_providers.eye_color','=',$input['eyeColor'])
                            ->where('service_providers.ethnicity','=',$input['ethnicity'])
                            ->where('service_providers.pubic_hair','=',$input['pubicHair'])
                            ->where('service_providers.hips','>=',$hips[0])
                            ->where('service_providers.hips','<=',$hips[1])
                            ->where('service_providers.bust','>=',$bust[0])
                            ->where('service_providers.bust','<=',$bust[1])
                            ->where('service_providers.cup_size','>=',$cup[0])
                            ->where('service_providers.cup_size','<=',$cup[1])
                            ->where('service_providers.waist','>=',$waist[0])
                            ->where('service_providers.waist','<=',$waist[1])
                            ->whereIn('service_provider_languages.known_languages_id',$languageId)
                            ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency','system_users.latitude','system_users.longitude'] )
                            ->skip($skip)->take($take)->get();
                    }
                }

                /* Apply Distance Range Filter */
                $i = 0;
                $totalServiceProviderFound = NULL;
                if(!empty($queryResult) || $queryResult!=NULL){
                    foreach($queryResult as $serviceProvider){
                        $distance = round($this->distance($serviceProvider->latitude,$serviceProvider->longitude,$latitude,$longitude,'K'));
                        if($distance>=$distanceRange[0] && $distance <=$distanceRange[1]){
                            $totalServiceProviderFound[$i]['serviceProviderId'] = $serviceProvider->spId;
                            $totalServiceProviderFound[$i]['systemUserId'] = $serviceProvider->systemUserId;
                            $totalServiceProviderFound[$i]['riseUp'] = $serviceProvider->riseme_up;
                            $totalServiceProviderFound[$i]['profileComplete'] = $serviceProvider->profile_completeness;
                            $totalServiceProviderFound[$i]['visitFrequency'] = $serviceProvider->visit_frequency;
                            $i++;
                        }
                    }
                }else{
                    break;
                }
            }while(count($totalServiceProviderFound)<4 && $queryRecord<=$queryCount);
            $skip = $skip + $take;
            $input['skip'] = "$skip";
            Session::put('input', $input);


            $serviceProviderData = NULL;
            if($totalServiceProviderFound!=NULL){
                $i=0;
                $serviceProviderData = NULL;
                foreach($totalServiceProviderFound as $serviceProvider){
                    $serviceProviderData[$i]['system_user'] = User::find($serviceProvider['systemUserId']);
                    $serviceProviderData[$i]['service_provider'] = ServiceProvider::find($serviceProvider['serviceProviderId']);
                    $serviceProviderData[$i]['profile_plus_visit'] = $serviceProvider['profileComplete'] + $serviceProvider['visitFrequency'];
                    $serviceProviderData[$i]['rise_me_up'] = $serviceProvider['riseUp'];
                    $i++;
                }
                $riseMeUpZero = array();
                $riseMeUpOne = array();
                $i =0;
                $j = 0;
                foreach($serviceProviderData as $serviceProvider){
                    if($serviceProvider['rise_me_up']==0){
                        array_push($riseMeUpZero,$serviceProvider);
                        $i++;
                    }
                    else{
                        array_push($riseMeUpOne,$serviceProvider);
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
            return View::make('search.searchResults')->with(array('serviceProviderData'=> $serviceProviderData,'skip'=>$skip,'take'=>$take));
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
        return ($a['rise_me_up'] > $b['rise_me_up']) ? -1 : 1;
    }

    /*
     *function Name: guestSearch
     *Desc: view guest search page
     *Created By: Sagar Acharya
     *Created Date: 22 January 2014
     *return: N/A
    */

    public function guestSearchView(){
        $input = Input::all();
        Session::put('guestMinimumAge', $input['minimumAge']);
        Session::put('guestMaximumAge', $input['maximumAge']);
        Session::put('guestLookingFor', $input['looking_for']);
        $knownLanguages = KnownLanguages::all();
        $ethnicity = Ethnicity::all();
        $eyeColor = EyeColor::all();
        $hairColor = HairColor::all();
        return View::make('search.guestSearchIndex',array('knownLanguages' => $knownLanguages,'knownLanguages'=>$knownLanguages,'ethnicity'=>$ethnicity,'eyeColor'=>$eyeColor,'hairColor'=>$hairColor));
    }

    /*
     *function Name: showDataToGuest
     *Desc: show search data initially if guest
     *Created By: Sagar Acharya
     *Created Date: 22 January 2014
     *return: true/false based on result
    */
    public function showDataToGuest(){
        /* If There is Normal Request */
        //dd(Input::all());

        if(Input::get('isFilter')==0){
            $customerFromAge = Session::get('guestMinimumAge');
            $customerToAge = Session::get('guestMaximumAge');

            if(Input::get('isScroll')==1){
                $latitude = Session::get('latitude');
                $longitude = Session::get('longitude');
                $skip = Session::get('skip');
                $take = 3;
            }else{
                $latitude = Input::get('latitude');
                $longitude = Input::get('longitude');
                $skip = 0;
                $take = 3;
                if($latitude==0 && $longitude==0){
                    $latitude = '18.5204303';
                    $longitude = '73.85674369999992';
                }
                Session::put('latitude', $latitude);
                Session::put('longitude', $longitude);

                /* Get Total Query Count Result */
                if(Session::get('guestLookingFor')=='male'){

                    $queryCount = User::where('user_role_id','=','2')
                        ->where('gender','=',1)
                        ->where('current_age','>=',$customerFromAge)
                        ->where('current_age','<=',$customerToAge)
                        ->where('is_active','=',1)
                        ->count();
                }elseif(Session::get('guestLookingFor')=='female'){
                    $queryCount = User::where('user_role_id','=','2')
                        ->where('gender','=',2)
                        ->where('current_age','>=',$customerFromAge)
                        ->where('current_age','<=',$customerToAge)
                        ->where('is_active','=',1)
                        ->count();
                }else{
                    $queryCount = User::where('user_role_id','=','2')
                        ->where('current_age','>=',$customerFromAge)
                        ->where('current_age','<=',$customerToAge)
                        ->where('is_active','=',1)
                        ->count();
                }
                Session::put('queryCount', $queryCount);
            }

            $queryCount = Session::get('queryCount');
            $queryRecord = 0;
            do{
                $queryRecord++;
                $take = $take + 1;
                if(Session::get('guestLookingFor')=='male'){
                    $systemUsers = User::where('user_role_id','=','2')
                        ->where('gender','=',1)
                        ->where('current_age','>=',$customerFromAge)
                        ->where('current_age','<=',$customerToAge)
                        ->where('is_active','=',1)
                        ->skip($skip)->take($take)->get();
                }elseif(Session::get('guestLookingFor')=='female'){
                    $systemUsers = User::where('user_role_id','=','2')
                        ->where('gender','=',2)
                        ->where('current_age','>=',$customerFromAge)
                        ->where('current_age','<=',$customerToAge)
                        ->where('is_active','=',1)
                        ->skip($skip)->take($take)->get();
                }else{
                    $systemUsers = User::where('user_role_id','=','2')
                        ->where('current_age','>=',$customerFromAge)
                        ->where('current_age','<=',$customerToAge)
                        ->where('is_active','=',1)
                        ->skip($skip)->take($take)->get();
                }
                $totalServiceProviderFound = NULL;
                $i=0;
                if(!empty($systemUsers) || $systemUsers!=NULL){
                    foreach($systemUsers as $systemUser){
                        $distance = round($this->distance($systemUser->latitude,$systemUser->longitude,$latitude,$longitude,'K'));
                        if($distance>=0 && $distance <=5){
                            $totalServiceProviderFound[$i] = $systemUser->id;
                            $i++;
                        }
                    }
                }else{
                    break;
                }
            }while(count($totalServiceProviderFound)<4 && $queryRecord<=$queryCount);
            $skip = $skip + $take;
            Session::put('skip', $skip);


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
                        $i++;
                    }
                    else{
                        array_push($riseMeUpOne,$serviceProvider);
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
            $skip = $skip + $take;

            return View::make('search.searchResults')->with(array('serviceProviderData'=> $serviceProviderData,'skip'=>$skip,'take'=>$take));

        }else{ /* If there is ajax request filter */
            if(Input::get('isScroll')==1){
                $bustMaster = Session::get('bustMaster');
                $cupMaster = Session::get('cupMaster');
                $hipsMaster = Session::get('hipsMaster');
                $penisMaster = Session::get('penisMaster');
                $waistMaster = Session::get('waistMaster');
                $input = Session::get('input');
            }else{
                $bustMaster = Input::get('bust');
                $cupMaster = Input::get('cup');
                $hipsMaster = Input::get('hips');
                $penisMaster = Input::get('penis');
                $waistMaster = Input::get('waist');
                Session::put('bustMaster', $bustMaster);
                Session::put('cupMaster', $cupMaster);
                Session::put('hipsMaster', $hipsMaster);
                Session::put('penisMaster', $penisMaster);
                Session::put('waistMaster', $waistMaster);
                $input = Input::all();
                if(!isset($input['pubicHair'])){
                    $input['pubicHair'] = NULL;
                }
                if(!isset($input['availability'])){
                    $input['availability'] = NULL;
                }

            }
            $bust = explode(",",$bustMaster);
            $cup = explode(",",$cupMaster);
            $hips = explode(",",$hipsMaster);
            $penis = explode(",",$penisMaster);
            $waist = explode(",",$waistMaster);
            $distanceRange = explode('-',$input['distanceRange']);

            $latitude = Session::get('latitude');
            $longitude = Session::get('longitude');
            /* To get atleast 4 records for lazy loading */
            $skip = $input['skip'];
            $take = $input['take'];
            /* 0 For Both Languages */
            if($input['languages']==0){
                $languageId = array(1,2);
            }else{
                $languageId = array($input['languages']);
            }

            $currentDate=date('d-m-Y');
            $dayName = strtolower(date("D",strtotime($currentDate)));
            if($dayName=='mon'){
                $day = 1;
            }elseif($dayName=='tue'){
                $day = 2;
            }elseif($dayName=='wed'){
                $day = 3;
            }elseif($dayName=='thu'){
                $day = 4;
            }elseif($dayName=='fri'){
                $day = 5;
            }elseif($dayName=='sat'){
                $day = 6;
            }elseif($dayName=='sun'){
                $day = 7;
            }
            $currentTime = date('H:m:s');
            if($input['isScroll']==0){
                /* Get Query Count For Total Records*/
                if($input['availability']!=NULL && $input['pubicHair']!=NULL){
                    if($input['gender']==1){
                        $queryCount = DB::table('service_providers')
                            ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                            ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                            ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                            ->where('service_providers.hair_color','=',$input['hairColor'])
                            ->where('service_providers.eye_color','=',$input['eyeColor'])
                            ->where('service_providers.ethnicity','=',$input['ethnicity'])
                            ->where('service_providers.pubic_hair','=',$input['pubicHair'])
                            ->where('service_providers.hips','>=',$hips[0])
                            ->where('service_providers.hips','<=',$hips[1])
                            ->where('service_providers.bust','>=',$bust[0])
                            ->where('service_providers.bust','<=',$bust[1])
                            ->where('service_providers.cup_size','>=',$cup[0])
                            ->where('service_providers.cup_size','<=',$cup[1])
                            ->where('service_providers.waist','>=',$waist[0])
                            ->where('service_providers.waist','<=',$waist[1])
                            ->where('service_providers.penis_size','>=',$penis[0])
                            ->where('service_providers.penis_size','<=',$penis[1])
                            ->whereIn('service_provider_languages.known_languages_id',$languageId)
                            ->where('service_provider_availabilities.week_day','=',$day)
                            ->where('service_provider_availabilities.from_time','<=',$currentTime)
                            ->where('service_provider_availabilities.to_time','>=',$currentTime)
                            ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_provider_availabilities.id AS availabilytId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency','system_users.latitude','system_users.longitude'] )
                            ->count();
                    }else{
                        $queryCount = DB::table('service_providers')
                            ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                            ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                            ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                            ->where('system_users.gender','=',$input['gender'])
                            ->where('service_providers.hair_color','=',$input['hairColor'])
                            ->where('service_providers.eye_color','=',$input['eyeColor'])
                            ->where('service_providers.ethnicity','=',$input['ethnicity'])
                            ->where('service_providers.pubic_hair','=',$input['pubicHair'])
                            ->where('service_providers.hips','>=',$hips[0])
                            ->where('service_providers.hips','<=',$hips[1])
                            ->where('service_providers.bust','>=',$bust[0])
                            ->where('service_providers.bust','<=',$bust[1])
                            ->where('service_providers.cup_size','>=',$cup[0])
                            ->where('service_providers.cup_size','<=',$cup[1])
                            ->where('service_providers.waist','>=',$waist[0])
                            ->where('service_providers.waist','<=',$waist[1])
                            ->whereIn('service_provider_languages.known_languages_id',$languageId)
                            ->where('service_provider_availabilities.week_day','=',$day)
                            ->where('service_provider_availabilities.from_time','<=',$currentTime)
                            ->where('service_provider_availabilities.to_time','>=',$currentTime)
                            ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_provider_availabilities.id AS availabilytId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency','system_users.latitude','system_users.longitude'] )
                            ->count();
                    }
                }elseif($input['availability']!=NULL){
                    if($input['gender']==1){
                        $queryCount = DB::table('service_providers')
                            ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                            ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                            ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                            ->where('service_providers.hair_color','=',$input['hairColor'])
                            ->where('service_providers.eye_color','=',$input['eyeColor'])
                            ->where('service_providers.ethnicity','=',$input['ethnicity'])
                            ->where('service_providers.hips','>=',$hips[0])
                            ->where('service_providers.hips','<=',$hips[1])
                            ->where('service_providers.bust','>=',$bust[0])
                            ->where('service_providers.bust','<=',$bust[1])
                            ->where('service_providers.cup_size','>=',$cup[0])
                            ->where('service_providers.cup_size','<=',$cup[1])
                            ->where('service_providers.waist','>=',$waist[0])
                            ->where('service_providers.waist','<=',$waist[1])
                            ->where('service_providers.penis_size','>=',$penis[0])
                            ->where('service_providers.penis_size','<=',$penis[1])
                            ->whereIn('service_provider_languages.known_languages_id',$languageId)
                            ->where('service_provider_availabilities.week_day','=',$day)
                            ->where('service_provider_availabilities.from_time','<=',$currentTime)
                            ->where('service_provider_availabilities.to_time','>=',$currentTime)
                            ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_provider_availabilities.id AS availabilytId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency','system_users.latitude','system_users.longitude'] )
                            ->count();
                    }else{
                        $queryCount = DB::table('service_providers')
                            ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                            ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                            ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                            ->where('system_users.gender','=',$input['gender'])
                            ->where('service_providers.hair_color','=',$input['hairColor'])
                            ->where('service_providers.eye_color','=',$input['eyeColor'])
                            ->where('service_providers.ethnicity','=',$input['ethnicity'])
                            ->where('service_providers.hips','>=',$hips[0])
                            ->where('service_providers.hips','<=',$hips[1])
                            ->where('service_providers.bust','>=',$bust[0])
                            ->where('service_providers.bust','<=',$bust[1])
                            ->where('service_providers.cup_size','>=',$cup[0])
                            ->where('service_providers.cup_size','<=',$cup[1])
                            ->where('service_providers.waist','>=',$waist[0])
                            ->where('service_providers.waist','<=',$waist[1])
                            ->whereIn('service_provider_languages.known_languages_id',$languageId)
                            ->where('service_provider_availabilities.week_day','=',$day)
                            ->where('service_provider_availabilities.from_time','<=',$currentTime)
                            ->where('service_provider_availabilities.to_time','>=',$currentTime)
                            ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_provider_availabilities.id AS availabilytId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency','system_users.latitude','system_users.longitude'] )
                            ->count();
                    }
                }elseif($input['pubicHair']!=NULL){
                    if($input['gender']==1){
                        $queryCount = DB::table('service_providers')
                            ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                            ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                            ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                            ->where('service_providers.hair_color','=',$input['hairColor'])
                            ->where('service_providers.eye_color','=',$input['eyeColor'])
                            ->where('service_providers.ethnicity','=',$input['ethnicity'])
                            ->where('service_providers.pubic_hair','=',$input['pubicHair'])
                            ->where('service_providers.hips','>=',$hips[0])
                            ->where('service_providers.hips','<=',$hips[1])
                            ->where('service_providers.bust','>=',$bust[0])
                            ->where('service_providers.bust','<=',$bust[1])
                            ->where('service_providers.cup_size','>=',$cup[0])
                            ->where('service_providers.cup_size','<=',$cup[1])
                            ->where('service_providers.waist','>=',$waist[0])
                            ->where('service_providers.waist','<=',$waist[1])
                            ->where('service_providers.penis_size','>=',$penis[0])
                            ->where('service_providers.penis_size','<=',$penis[1])
                            ->whereIn('service_provider_languages.known_languages_id',$languageId)
                            ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency','system_users.latitude','system_users.longitude'] )
                            ->count();
                    }else{
                        $queryCount = DB::table('service_providers')
                            ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                            ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                            ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                            ->where('system_users.gender','=',$input['gender'])
                            ->where('service_providers.hair_color','=',$input['hairColor'])
                            ->where('service_providers.eye_color','=',$input['eyeColor'])
                            ->where('service_providers.ethnicity','=',$input['ethnicity'])
                            ->where('service_providers.pubic_hair','=',$input['pubicHair'])
                            ->where('service_providers.hips','>=',$hips[0])
                            ->where('service_providers.hips','<=',$hips[1])
                            ->where('service_providers.bust','>=',$bust[0])
                            ->where('service_providers.bust','<=',$bust[1])
                            ->where('service_providers.cup_size','>=',$cup[0])
                            ->where('service_providers.cup_size','<=',$cup[1])
                            ->where('service_providers.waist','>=',$waist[0])
                            ->where('service_providers.waist','<=',$waist[1])
                            ->whereIn('service_provider_languages.known_languages_id',$languageId)
                            ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency','system_users.latitude','system_users.longitude'] )
                            ->count();
                    }
                }
                $input['queryCount'] = $queryCount;
            }
            $queryCount = $input['queryCount'];
            $queryRecord = 0;
            do{
                $queryRecord++;
                $take = $take + 1;
                if($input['availability']!=NULL && $input['pubicHair']!=NULL){
                    if($input['gender']==1){
                        $queryResult = DB::table('service_providers')
                            ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                            ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                            ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                            ->where('service_providers.hair_color','=',$input['hairColor'])
                            ->where('service_providers.eye_color','=',$input['eyeColor'])
                            ->where('service_providers.ethnicity','=',$input['ethnicity'])
                            ->where('service_providers.pubic_hair','=',$input['pubicHair'])
                            ->where('service_providers.hips','>=',$hips[0])
                            ->where('service_providers.hips','<=',$hips[1])
                            ->where('service_providers.bust','>=',$bust[0])
                            ->where('service_providers.bust','<=',$bust[1])
                            ->where('service_providers.cup_size','>=',$cup[0])
                            ->where('service_providers.cup_size','<=',$cup[1])
                            ->where('service_providers.waist','>=',$waist[0])
                            ->where('service_providers.waist','<=',$waist[1])
                            ->where('service_providers.penis_size','>=',$penis[0])
                            ->where('service_providers.penis_size','<=',$penis[1])
                            ->whereIn('service_provider_languages.known_languages_id',$languageId)
                            ->where('service_provider_availabilities.week_day','=',$day)
                            ->where('service_provider_availabilities.from_time','<=',$currentTime)
                            ->where('service_provider_availabilities.to_time','>=',$currentTime)
                            ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_provider_availabilities.id AS availabilytId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency','system_users.latitude','system_users.longitude'] )
                            ->skip($skip)->take($take)->get();
                    }else{
                        $queryResult = DB::table('service_providers')
                            ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                            ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                            ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                            ->where('system_users.gender','=',$input['gender'])
                            ->where('service_providers.hair_color','=',$input['hairColor'])
                            ->where('service_providers.eye_color','=',$input['eyeColor'])
                            ->where('service_providers.ethnicity','=',$input['ethnicity'])
                            ->where('service_providers.pubic_hair','=',$input['pubicHair'])
                            ->where('service_providers.hips','>=',$hips[0])
                            ->where('service_providers.hips','<=',$hips[1])
                            ->where('service_providers.bust','>=',$bust[0])
                            ->where('service_providers.bust','<=',$bust[1])
                            ->where('service_providers.cup_size','>=',$cup[0])
                            ->where('service_providers.cup_size','<=',$cup[1])
                            ->where('service_providers.waist','>=',$waist[0])
                            ->where('service_providers.waist','<=',$waist[1])
                            ->whereIn('service_provider_languages.known_languages_id',$languageId)
                            ->where('service_provider_availabilities.week_day','=',$day)
                            ->where('service_provider_availabilities.from_time','<=',$currentTime)
                            ->where('service_provider_availabilities.to_time','>=',$currentTime)
                            ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_provider_availabilities.id AS availabilytId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency','system_users.latitude','system_users.longitude'] )
                            ->skip($skip)->take($take)->get();
                    }
                }elseif($input['availability']!=NULL){
                    if($input['gender']==1){
                        $queryResult = DB::table('service_providers')
                            ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                            ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                            ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                            ->where('service_providers.hair_color','=',$input['hairColor'])
                            ->where('service_providers.eye_color','=',$input['eyeColor'])
                            ->where('service_providers.ethnicity','=',$input['ethnicity'])
                            ->where('service_providers.hips','>=',$hips[0])
                            ->where('service_providers.hips','<=',$hips[1])
                            ->where('service_providers.bust','>=',$bust[0])
                            ->where('service_providers.bust','<=',$bust[1])
                            ->where('service_providers.cup_size','>=',$cup[0])
                            ->where('service_providers.cup_size','<=',$cup[1])
                            ->where('service_providers.waist','>=',$waist[0])
                            ->where('service_providers.waist','<=',$waist[1])
                            ->where('service_providers.penis_size','>=',$penis[0])
                            ->where('service_providers.penis_size','<=',$penis[1])
                            ->whereIn('service_provider_languages.known_languages_id',$languageId)
                            ->where('service_provider_availabilities.week_day','=',$day)
                            ->where('service_provider_availabilities.from_time','<=',$currentTime)
                            ->where('service_provider_availabilities.to_time','>=',$currentTime)
                            ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_provider_availabilities.id AS availabilytId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency','system_users.latitude','system_users.longitude'] )
                            ->skip($skip)->take($take)->get();
                    }else{
                        $queryResult = DB::table('service_providers')
                            ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                            ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                            ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                            ->where('system_users.gender','=',$input['gender'])
                            ->where('service_providers.hair_color','=',$input['hairColor'])
                            ->where('service_providers.eye_color','=',$input['eyeColor'])
                            ->where('service_providers.ethnicity','=',$input['ethnicity'])
                            ->where('service_providers.hips','>=',$hips[0])
                            ->where('service_providers.hips','<=',$hips[1])
                            ->where('service_providers.bust','>=',$bust[0])
                            ->where('service_providers.bust','<=',$bust[1])
                            ->where('service_providers.cup_size','>=',$cup[0])
                            ->where('service_providers.cup_size','<=',$cup[1])
                            ->where('service_providers.waist','>=',$waist[0])
                            ->where('service_providers.waist','<=',$waist[1])
                            ->whereIn('service_provider_languages.known_languages_id',$languageId)
                            ->where('service_provider_availabilities.week_day','=',$day)
                            ->where('service_provider_availabilities.from_time','<=',$currentTime)
                            ->where('service_provider_availabilities.to_time','>=',$currentTime)
                            ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_provider_availabilities.id AS availabilytId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency','system_users.latitude','system_users.longitude'] )
                            ->skip($skip)->take($take)->get();
                    }
                }elseif($input['pubicHair']!=NULL){
                    if($input['gender']==1){
                        $queryResult = DB::table('service_providers')
                            ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                            ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                            ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                            ->where('service_providers.hair_color','=',$input['hairColor'])
                            ->where('service_providers.eye_color','=',$input['eyeColor'])
                            ->where('service_providers.ethnicity','=',$input['ethnicity'])
                            ->where('service_providers.pubic_hair','=',$input['pubicHair'])
                            ->where('service_providers.hips','>=',$hips[0])
                            ->where('service_providers.hips','<=',$hips[1])
                            ->where('service_providers.bust','>=',$bust[0])
                            ->where('service_providers.bust','<=',$bust[1])
                            ->where('service_providers.cup_size','>=',$cup[0])
                            ->where('service_providers.cup_size','<=',$cup[1])
                            ->where('service_providers.waist','>=',$waist[0])
                            ->where('service_providers.waist','<=',$waist[1])
                            ->where('service_providers.penis_size','>=',$penis[0])
                            ->where('service_providers.penis_size','<=',$penis[1])
                            ->whereIn('service_provider_languages.known_languages_id',$languageId)
                            ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency','system_users.latitude','system_users.longitude'] )
                            ->skip($skip)->take($take)->get();
                    }else{
                        $queryResult = DB::table('service_providers')
                            ->join('system_users', 'service_providers.id', '=', 'system_users.service_provider_id')
                            ->join('service_provider_languages', 'service_providers.id', '=', 'service_provider_languages.service_provider_id')
                            ->join('service_provider_availabilities', 'service_providers.id', '=', 'service_provider_availabilities.service_provider_id')
                            ->where('system_users.gender','=',$input['gender'])
                            ->where('service_providers.hair_color','=',$input['hairColor'])
                            ->where('service_providers.eye_color','=',$input['eyeColor'])
                            ->where('service_providers.ethnicity','=',$input['ethnicity'])
                            ->where('service_providers.pubic_hair','=',$input['pubicHair'])
                            ->where('service_providers.hips','>=',$hips[0])
                            ->where('service_providers.hips','<=',$hips[1])
                            ->where('service_providers.bust','>=',$bust[0])
                            ->where('service_providers.bust','<=',$bust[1])
                            ->where('service_providers.cup_size','>=',$cup[0])
                            ->where('service_providers.cup_size','<=',$cup[1])
                            ->where('service_providers.waist','>=',$waist[0])
                            ->where('service_providers.waist','<=',$waist[1])
                            ->whereIn('service_provider_languages.known_languages_id',$languageId)
                            ->select([DB::RAW('DISTINCT(service_providers.id) AS spId'),'system_users.id AS systemUserId','service_providers.riseme_up','service_providers.profile_completeness','service_providers.visit_frequency','system_users.latitude','system_users.longitude'] )
                            ->skip($skip)->take($take)->get();
                    }
                }

                /* Apply Distance Range Filter */
                $i = 0;
                $totalServiceProviderFound = NULL;
                if(!empty($queryResult) || $queryResult!=NULL){
                    foreach($queryResult as $serviceProvider){
                        $distance = round($this->distance($serviceProvider->latitude,$serviceProvider->longitude,$latitude,$longitude,'K'));
                        if($distance>=$distanceRange[0] && $distance <=$distanceRange[1]){
                            $totalServiceProviderFound[$i]['serviceProviderId'] = $serviceProvider->spId;
                            $totalServiceProviderFound[$i]['systemUserId'] = $serviceProvider->systemUserId;
                            $totalServiceProviderFound[$i]['riseUp'] = $serviceProvider->riseme_up;
                            $totalServiceProviderFound[$i]['profileComplete'] = $serviceProvider->profile_completeness;
                            $totalServiceProviderFound[$i]['visitFrequency'] = $serviceProvider->visit_frequency;
                            $i++;
                        }
                    }
                }else{
                    break;
                }
            }while(count($totalServiceProviderFound)<4 && $queryRecord<=$queryCount);
            $skip = $skip + $take;
            $input['skip'] = "$skip";
            Session::put('input', $input);


            $serviceProviderData = NULL;
            if($totalServiceProviderFound!=NULL){
                $i=0;
                $serviceProviderData = NULL;
                foreach($totalServiceProviderFound as $serviceProvider){
                    $serviceProviderData[$i]['system_user'] = User::find($serviceProvider['systemUserId']);
                    $serviceProviderData[$i]['service_provider'] = ServiceProvider::find($serviceProvider['serviceProviderId']);
                    $serviceProviderData[$i]['profile_plus_visit'] = $serviceProvider['profileComplete'] + $serviceProvider['visitFrequency'];
                    $serviceProviderData[$i]['rise_me_up'] = $serviceProvider['riseUp'];
                    $i++;
                }
                $riseMeUpZero = array();
                $riseMeUpOne = array();
                $i =0;
                $j = 0;
                foreach($serviceProviderData as $serviceProvider){
                    if($serviceProvider['rise_me_up']==0){
                        array_push($riseMeUpZero,$serviceProvider);
                        $i++;
                    }
                    else{
                        array_push($riseMeUpOne,$serviceProvider);
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
            return View::make('search.searchResults')->with(array('serviceProviderData'=> $serviceProviderData,'skip'=>$skip,'take'=>$take));
        }
    }
}