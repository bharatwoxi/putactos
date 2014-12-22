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
        //dd(Input::all());
//        $latitude = Input::get('latitude');
//        $longitude = Input::get('longitude');

        $latitude = '40.483936';
        $longitude = '-3.567951999999991';
        $customerFromAge = Auth::user()->from_age;
        $customerToAge = Auth::user()->to_age;
//        echo '<br/>FromAge:'.$customerFromAge;
//        echo '<br/>ToAge:'.$customerToAge;
        $customerData  = Customer::find(Auth::user()->customer_id);
        $systemUsers = User::where('user_role_id','=','2')->get();
        $totalServiceProviderFound = NULL;
        $i=0;
        foreach($systemUsers as $systemUser){
            $distance = round($this->distance($systemUser->latitude,$systemUser->longitude,$latitude,$longitude,'K'));
            if($distance>=0 && $distance <=15){
                $dayDiff=floor((abs(strtotime(date("Y-m-d")) - strtotime($systemUser->birth_date))/(60*60*24)));
                $years = ($dayDiff / 365) ; // days / 365 days
                $years = floor($years); // Remove all decimals
//                echo "<br/>";
//                echo 'Years:'.$years;
//                echo 'Id:'.$systemUser->id;
                if($years>=$customerFromAge && $years<=$customerToAge){
                    if($customerData->looking_for=='male'){
                        if($systemUser->gender=='male'){
                            $totalServiceProviderFound[$i] = $systemUser->id;
                            $i++;
                        }
                    }elseif($customerData->looking_for=='female'){
                        if($systemUser->gender=='female'){
                            $totalServiceProviderFound[$i] = $systemUser->id;
                            $i++;
                        }
                    }else{
                        $totalServiceProviderFound[$i] = $systemUser->id;
                        $i++;
                    }
                }
            }
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