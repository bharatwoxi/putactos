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
        return View::make('search.index');
    }


    /*
     *function Name: showDataAfterLogin
     *Desc: show search data initially if login
     *Created By: Sagar Acharya
     *Created Date: 4 December 2014
     *return: true/false based on result
    */
    public function showDataAfterLogin(){

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