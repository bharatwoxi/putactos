<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 1/12/14
 * Time: 3:33 PM
 */
class ServiceProviderController extends BaseController {

    /*
     *function Name: checkUserName
     *Desc: checkUserName for service provider & customer if it exists or not
     *Created By: Sagar Acharya
     *Created Date: 4 December 2014
     *return: true/false based on result
    */

    public function updateProfileCompleteness(){

        $userData = User::all();
        $i=0;
        $serviceProviderProfileData = NULL;
        foreach($userData as $user){
            if($user->user_role_id==2){
                $serviceProviderProfileData[$i]['id'] = $user->id;
                $serviceProviderProfileData[$i]['contact_no'] = $user->contact_no;
                $serviceProviderProfileData[$i]['birth_date'] = $user->birth_date;
                $serviceProviderProfileData[$i]['gender'] = $user->gender;
                $serviceProviderProfileData[$i]['service_provider_id'] = $user->service_provider_id;
                $serviceProviderProfileData[$i]['from_age'] = $user->from_age;
                $serviceProviderProfileData[$i]['to_age'] = $user->to_age;
                $serviceProviderProfileData[$i]['latitude'] = $user->latitude;
                $serviceProviderProfileData[$i]['longitude'] = $user->longitude;
                $i++;
            }
        }
        $count = count($serviceProviderProfileData);
        for($i=0;$i<$count;$i++){
            $serviceProvider = ServiceProvider::find($serviceProviderProfileData[$i]['service_provider_id']);
            $serviceProviderProfileData[$i]['service_provider_id'];
            $serviceProviderProfileData[$i]['turns_me_on'] = $serviceProvider->turns_me_on;
            $serviceProviderProfileData[$i]['expertise'] = $serviceProvider->expertise;
            $serviceProviderProfileData[$i]['pubic_hair'] = $serviceProvider->pubic_hair;
            $serviceProviderProfileData[$i]['bust'] = $serviceProvider->bust;
            $serviceProviderProfileData[$i]['cup_size'] = $serviceProvider->cup_size;
            $serviceProviderProfileData[$i]['waist'] = $serviceProvider->waist;
            $serviceProviderProfileData[$i]['hips'] = $serviceProvider->hips;
            $serviceProviderProfileData[$i]['ethnicity'] = $serviceProvider->ethnicity;
            $serviceProviderProfileData[$i]['weight'] = $serviceProvider->weight;
            $serviceProviderProfileData[$i]['height'] = $serviceProvider->height;
            $serviceProviderProfileData[$i]['eye_color'] = $serviceProvider->eye_color;
            $serviceProviderProfileData[$i]['hair_color'] = $serviceProvider->hair_color;
        }

        $spFinalCount = count($serviceProviderProfileData);


        for($i=0;$i<$spFinalCount;$i++){
            $serviceProviderProfileData[$i]['totalNonEmptyFields'] = 0;
            $serviceProviderProfileData[$i]['totalFields'] = NULL;
            $serviceProviderProfileData[$i]['totalFields'] = count($serviceProviderProfileData[$i])-4;

            if($serviceProviderProfileData[$i]['contact_no']!=NULL || $serviceProviderProfileData[$i]['contact_no']!=''){
                $serviceProviderProfileData[$i]['totalNonEmptyFields'] = $serviceProviderProfileData[$i]['totalNonEmptyFields'] + 1;
            }

            if($serviceProviderProfileData[$i]['birth_date']!=NULL || $serviceProviderProfileData[$i]['birth_date']!=''){
                $serviceProviderProfileData[$i]['totalNonEmptyFields'] = $serviceProviderProfileData[$i]['totalNonEmptyFields'] + 1;
            }

            if($serviceProviderProfileData[$i]['gender']!=NULL || $serviceProviderProfileData[$i]['gender']!=''){
                $serviceProviderProfileData[$i]['totalNonEmptyFields'] = $serviceProviderProfileData[$i]['totalNonEmptyFields'] + 1;
            }

            if($serviceProviderProfileData[$i]['from_age']!=NULL || $serviceProviderProfileData[$i]['from_age']!=''){
                $serviceProviderProfileData[$i]['totalNonEmptyFields'] = $serviceProviderProfileData[$i]['totalNonEmptyFields'] + 1;
            }

            if($serviceProviderProfileData[$i]['to_age']!=NULL || $serviceProviderProfileData[$i]['to_age']!=''){
                $serviceProviderProfileData[$i]['totalNonEmptyFields'] = $serviceProviderProfileData[$i]['totalNonEmptyFields'] + 1;
            }

            if($serviceProviderProfileData[$i]['latitude']!=NULL || $serviceProviderProfileData[$i]['latitude']!=''){
                $serviceProviderProfileData[$i]['totalNonEmptyFields'] = $serviceProviderProfileData[$i]['totalNonEmptyFields'] + 1;
            }

            if($serviceProviderProfileData[$i]['longitude']!=NULL || $serviceProviderProfileData[$i]['longitude']!=''){
                $serviceProviderProfileData[$i]['totalNonEmptyFields'] = $serviceProviderProfileData[$i]['totalNonEmptyFields'] + 1;
            }

            if($serviceProviderProfileData[$i]['turns_me_on']!=NULL || $serviceProviderProfileData[$i]['turns_me_on']!=''){
                $serviceProviderProfileData[$i]['totalNonEmptyFields'] = $serviceProviderProfileData[$i]['totalNonEmptyFields'] + 1;
            }

            if($serviceProviderProfileData[$i]['expertise']!=NULL || $serviceProviderProfileData[$i]['expertise']!=''){
                $serviceProviderProfileData[$i]['totalNonEmptyFields'] = $serviceProviderProfileData[$i]['totalNonEmptyFields'] + 1;
            }

            if($serviceProviderProfileData[$i]['pubic_hair']!=NULL || $serviceProviderProfileData[$i]['pubic_hair']!=''){
                $serviceProviderProfileData[$i]['totalNonEmptyFields'] = $serviceProviderProfileData[$i]['totalNonEmptyFields'] + 1;
            }

            if($serviceProviderProfileData[$i]['bust']!=NULL || $serviceProviderProfileData[$i]['bust']!=''){
                $serviceProviderProfileData[$i]['totalNonEmptyFields'] = $serviceProviderProfileData[$i]['totalNonEmptyFields'] + 1;
            }

            if($serviceProviderProfileData[$i]['cup_size']!=NULL || $serviceProviderProfileData[$i]['cup_size']!=''){
                $serviceProviderProfileData[$i]['totalNonEmptyFields'] = $serviceProviderProfileData[$i]['totalNonEmptyFields'] + 1;
            }

            if($serviceProviderProfileData[$i]['waist']!=NULL || $serviceProviderProfileData[$i]['waist']!=''){
                $serviceProviderProfileData[$i]['totalNonEmptyFields'] = $serviceProviderProfileData[$i]['totalNonEmptyFields'] + 1;
            }

            if($serviceProviderProfileData[$i]['hips']!=NULL || $serviceProviderProfileData[$i]['hips']!=''){
                $serviceProviderProfileData[$i]['totalNonEmptyFields'] = $serviceProviderProfileData[$i]['totalNonEmptyFields'] + 1;
            }

            if($serviceProviderProfileData[$i]['ethnicity']!=NULL || $serviceProviderProfileData[$i]['ethnicity']!=''){
                $serviceProviderProfileData[$i]['totalNonEmptyFields'] = $serviceProviderProfileData[$i]['totalNonEmptyFields'] + 1;
            }

            if($serviceProviderProfileData[$i]['weight']!=NULL || $serviceProviderProfileData[$i]['weight']!=''){
                $serviceProviderProfileData[$i]['totalNonEmptyFields'] = $serviceProviderProfileData[$i]['totalNonEmptyFields'] + 1;
            }

            if($serviceProviderProfileData[$i]['height']!=NULL || $serviceProviderProfileData[$i]['height']!=''){
                $serviceProviderProfileData[$i]['totalNonEmptyFields'] = $serviceProviderProfileData[$i]['totalNonEmptyFields'] + 1;
            }

            if($serviceProviderProfileData[$i]['eye_color']!=NULL || $serviceProviderProfileData[$i]['eye_color']!=''){
                $serviceProviderProfileData[$i]['totalNonEmptyFields'] = $serviceProviderProfileData[$i]['totalNonEmptyFields'] + 1;
            }

            if($serviceProviderProfileData[$i]['hair_color']!=NULL || $serviceProviderProfileData[$i]['hair_color']!=''){
                $serviceProviderProfileData[$i]['totalNonEmptyFields'] = $serviceProviderProfileData[$i]['totalNonEmptyFields'] + 1;
            }


            $serviceProviderProfileData[$i]['percentage'] = round(($serviceProviderProfileData[$i]['totalNonEmptyFields']/$serviceProviderProfileData[$i]['totalFields'])*100,2);

        }
        //dd($serviceProviderProfileData);

        /* Update Profile Completeness */
        foreach($serviceProviderProfileData as $serviceProviderData){
          $systemUser = User::find($serviceProviderData['id']);
            $serviceProvider = ServiceProvider::find($systemUser->service_provider_id);
            $serviceProvider->profile_completeness = $serviceProviderData['percentage'];
            $serviceProvider->save();
        }
        dd(ServiceProvider::all());
    }
}