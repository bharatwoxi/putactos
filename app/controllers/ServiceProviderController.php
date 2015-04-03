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

        $user = Auth::user();
        $serviceProviderProfileData['id'] = $user->id;
        $serviceProviderProfileData['contact_no'] = $user->contact_no;
        $serviceProviderProfileData['birth_date'] = $user->birth_date;
        $serviceProviderProfileData['gender'] = $user->gender;
        $serviceProviderProfileData['service_provider_id'] = $user->service_provider_id;
        $serviceProviderProfileData['from_age'] = $user->from_age;
        $serviceProviderProfileData['to_age'] = $user->to_age;
        $serviceProviderProfileData['latitude'] = $user->latitude;
        $serviceProviderProfileData['longitude'] = $user->longitude;


        $serviceProvider = ServiceProvider::find($serviceProviderProfileData['service_provider_id']);
        $serviceProviderProfileData['turns_me_on'] = $serviceProvider->turns_me_on;
        $serviceProviderProfileData['expertise'] = $serviceProvider->expertise;
        $serviceProviderProfileData['pubic_hair'] = $serviceProvider->pubic_hair;
        $serviceProviderProfileData['bust'] = $serviceProvider->bust    ;
        $serviceProviderProfileData['cup_size'] = $serviceProvider->cup_size;
        $serviceProviderProfileData['waist'] = $serviceProvider->waist;
        $serviceProviderProfileData['hips'] = $serviceProvider->hips;
        $serviceProviderProfileData['ethnicity'] = $serviceProvider->ethnicity;
        $serviceProviderProfileData['weight'] = $serviceProvider->weight;
        $serviceProviderProfileData['height'] = $serviceProvider->height;
        $serviceProviderProfileData['eye_color'] = $serviceProvider->eye_color;
        $serviceProviderProfileData['hair_color'] = $serviceProvider->hair_color;

        $serviceProviderProfileData['totalNonEmptyFields'] = 0;
        //$serviceProviderProfileData['totalFields'] = count($serviceProviderProfileData)-4;
        $serviceProviderProfileData['totalFields'] = NULL;
        if($user->gender==1){ //male
            $serviceProviderProfileData['totalFields'] = 16;
        }
        if($user->gender==2){ //male
            $serviceProviderProfileData['totalFields'] = 19;
        }


        if($serviceProviderProfileData['contact_no']!=NULL || $serviceProviderProfileData['contact_no']!=''){
            $serviceProviderProfileData['totalNonEmptyFields'] = $serviceProviderProfileData['totalNonEmptyFields'] + 1;
        }

        if($serviceProviderProfileData['birth_date']!=NULL || $serviceProviderProfileData['birth_date']!=''){
            $serviceProviderProfileData['totalNonEmptyFields'] = $serviceProviderProfileData['totalNonEmptyFields'] + 1;
        }

        if($serviceProviderProfileData['gender']!=NULL || $serviceProviderProfileData['gender']!=''){
            $serviceProviderProfileData['totalNonEmptyFields'] = $serviceProviderProfileData['totalNonEmptyFields'] + 1;
        }

        if($serviceProviderProfileData['from_age']!=NULL || $serviceProviderProfileData['from_age']!=''){
            $serviceProviderProfileData['totalNonEmptyFields'] = $serviceProviderProfileData['totalNonEmptyFields'] + 1;
        }

        if($serviceProviderProfileData['to_age']!=NULL || $serviceProviderProfileData['to_age']!=''){
            $serviceProviderProfileData['totalNonEmptyFields'] = $serviceProviderProfileData['totalNonEmptyFields'] + 1;
        }

        if($serviceProviderProfileData['latitude']!=NULL || $serviceProviderProfileData['latitude']!=''){
            $serviceProviderProfileData['totalNonEmptyFields'] = $serviceProviderProfileData['totalNonEmptyFields'] + 1;
        }

        if($serviceProviderProfileData['longitude']!=NULL || $serviceProviderProfileData['longitude']!=''){
            $serviceProviderProfileData['totalNonEmptyFields'] = $serviceProviderProfileData['totalNonEmptyFields'] + 1;
        }

        if($serviceProviderProfileData['turns_me_on']!=NULL || $serviceProviderProfileData['turns_me_on']!=''){
            $serviceProviderProfileData['totalNonEmptyFields'] = $serviceProviderProfileData['totalNonEmptyFields'] + 1;
        }

        if($serviceProviderProfileData['expertise']!=NULL || $serviceProviderProfileData['expertise']!=''){
            $serviceProviderProfileData['totalNonEmptyFields'] = $serviceProviderProfileData['totalNonEmptyFields'] + 1;
        }

        if($serviceProviderProfileData['pubic_hair']!=NULL || $serviceProviderProfileData['pubic_hair']!=''){
            $serviceProviderProfileData['totalNonEmptyFields'] = $serviceProviderProfileData['totalNonEmptyFields'] + 1;
        }
        if($user->gender==1){ //male
            if($serviceProviderProfileData['penis_size']!=NULL || $serviceProviderProfileData['penis_size']!=''){
                $serviceProviderProfileData['totalNonEmptyFields'] = $serviceProviderProfileData['totalNonEmptyFields'] + 1;
            }
        }
        if($user->gender==2){ //female
            if($serviceProviderProfileData['bust']!=NULL || $serviceProviderProfileData['bust']!=''){
                $serviceProviderProfileData['totalNonEmptyFields'] = $serviceProviderProfileData['totalNonEmptyFields'] + 1;
            }

            if($serviceProviderProfileData['cup_size']!=NULL || $serviceProviderProfileData['cup_size']!=''){
                $serviceProviderProfileData['totalNonEmptyFields'] = $serviceProviderProfileData['totalNonEmptyFields'] + 1;
            }

            if($serviceProviderProfileData['waist']!=NULL || $serviceProviderProfileData['waist']!=''){
                $serviceProviderProfileData['totalNonEmptyFields'] = $serviceProviderProfileData['totalNonEmptyFields'] + 1;
            }

            if($serviceProviderProfileData['hips']!=NULL || $serviceProviderProfileData['hips']!=''){
                $serviceProviderProfileData['totalNonEmptyFields'] = $serviceProviderProfileData['totalNonEmptyFields'] + 1;
            }
        }


        if($serviceProviderProfileData['ethnicity']!=NULL || $serviceProviderProfileData['ethnicity']!=''){
            $serviceProviderProfileData['totalNonEmptyFields'] = $serviceProviderProfileData['totalNonEmptyFields'] + 1;
        }

        if($serviceProviderProfileData['weight']!=NULL || $serviceProviderProfileData['weight']!=''){
            $serviceProviderProfileData['totalNonEmptyFields'] = $serviceProviderProfileData['totalNonEmptyFields'] + 1;
        }

        if($serviceProviderProfileData['height']!=NULL || $serviceProviderProfileData['height']!=''){
            $serviceProviderProfileData['totalNonEmptyFields'] = $serviceProviderProfileData['totalNonEmptyFields'] + 1;
        }

        if($serviceProviderProfileData['eye_color']!=NULL || $serviceProviderProfileData['eye_color']!=''){
            $serviceProviderProfileData['totalNonEmptyFields'] = $serviceProviderProfileData['totalNonEmptyFields'] + 1;
        }

        if($serviceProviderProfileData['hair_color']!=NULL || $serviceProviderProfileData['hair_color']!=''){
            $serviceProviderProfileData['totalNonEmptyFields'] = $serviceProviderProfileData['totalNonEmptyFields'] + 1;
        }


        $serviceProviderProfileData['percentage'] = round(($serviceProviderProfileData['totalNonEmptyFields']/$serviceProviderProfileData['totalFields'])*100,2);


        /* Update Profile Completeness */
        $systemUser = User::find($serviceProviderProfileData['id']);
        $serviceProvider = ServiceProvider::find($systemUser->service_provider_id);
        $serviceProvider->profile_completeness = $serviceProviderProfileData['percentage'];
        $serviceProvider->save();
    }

    /*
     *function Name: profileEditView
     *Desc: Edit Profile View
     *Created By: Sagar Acharya
     *Created Date: 23 January 2014
     *return: N/A
    */
    public function profileEditView(){
        $userData['systemUser'] = Auth::user();
        $userData['serviceProvider'] = ServiceProvider::find(Auth::user()->service_provider_id);
        $ethnicity = Ethnicity::all();
        $gender = Gender::all();
        $hairColor = HairColor::all();
        $eyeColor = EyeColor::all();
        $cupSize = CupSize::all();
        $avaliability = DB::table('service_provider_availabilities')->where('service_provider_id', $userData['serviceProvider'] ->id)->get();
        return View::make('profile.serviceProviderEdit')->with(array('ethnicitys'=> $ethnicity,'hairColors'=>$hairColor,'genders'=>$gender,'eyeColors'=>$eyeColor,'userData'=>$userData,'cupSizes'=>$cupSize,'avaliabilities'=>$avaliability));
    }

    /*
     *function Name: saveProfileData
     *Desc: Edit Profile View
     *Created By: Sagar Acharya
     *Created Date: 26 January 2014
     *return: N/A
    */
    public function saveProfileData(){
        $input = Input::all();
        unset($input['avail_day']);
        unset($input['avail_from']);
        unset($input['avail_to']);
        unset($input['avail']);

        $input=array_map('trim',$input);
        $rules = array(
            'height' => 'integer',
            'weight' => 'integer',
            'bust' => 'integer',
            'waist' => 'integer',
            'hips' => 'integer',
            'penis_size' => 'integer',
            'cup_size' => 'integer|min:0|max:10',
            'ethnicity' => 'required|integer',
            'gender' => 'integer',
            'pubicHair' => 'integer',
            'hairColor' => 'integer',
            'eyeColor' => 'integer',
            'turnsMeOn' => 'max:100',
            'latitude' => 'required',
            'longitude' => 'required',
            'birthDate' => 'required',
            'ageRange' => 'required',
        );
        $validation = Validator::make($input,$rules);
        if($validation->passes()){
            $ageRange = explode(",",$input['ageRange']);
            $serviceProvider = ServiceProvider::find(Auth::user()->service_provider_id);
            $user = Auth::user();
            if($user->gender==1){   //for male
                if(!empty($input['penis_size'])){
                    $serviceProvider->penis_size = trim($input['penis_size']);
                }
            }
            if($user->gender==2){   //for female
                if(!empty($input['bust'])){
                    $serviceProvider->bust = trim($input['bust']);
                }
                if(!empty($input['cup_size'])){
                    $serviceProvider->cup_size = trim($input['cup_size']);
                }
                if(!empty($input['waist'])){
                    $serviceProvider->waist = trim($input['waist']);
                }
                if(!empty($input['hips'])){
                    $serviceProvider->hips = trim($input['hips']);
                }
            }

            if(!empty($input['height'])){
                $serviceProvider->height = trim($input['height']);
            }
            if(!empty($input['weight'])){
                $serviceProvider->weight = trim($input['weight']);
            }
            if($input['ethnicity']!=0){
                $serviceProvider->ethnicity = trim($input['ethnicity']);
            }
            if(!empty($input['pubicHair'])){
                $serviceProvider->pubic_hair = trim($input['pubicHair']);
            }
            if($input['hairColor']!=0){
                $serviceProvider->hair_color = trim($input['hairColor']);
            }
            if($input['eyeColor']!=0){
                $serviceProvider->eye_color = trim($input['eyeColor']);
            }
            if(!empty($input['gender'])){
                $user->gender = trim($input['gender']);
                $user->updated_at = date('Y-m-d H:m:s');
            }
            $user->latitude = $input['latitude'];
            $user->longitude = $input['longitude'];
            $user->city = $input['city'];
            $user->country = $input['country'];
            $user->birth_date = $input['birthDate'];
            $user->from_age = $ageRange[0];
            $user->to_age = $ageRange[1];
            $serviceProvider->turns_me_on = trim($input['turnsMeOn']);
            $serviceProvider->updated_at = date('Y-m-d H:m:s');
            /* Service Provider Availabilities Start*/
            $day = Input::get('avail_day');
            $from = Input::get('avail_from');
            $to = Input::get('avail_to');
            $availabilityArrayStatic = null;
            if(isset($day) || $day!=null){

                if(isset($day['static']) && isset($from['static']) && isset($to['static'])){
                    $count = count($day['static']);
                    for($i=0;$i<$count;$i++){
                        $availabilityArrayStatic[$i]['day'] = $day['static'][$i];
                        $availabilityArrayStatic[$i]['from'] = $from['static'][$i];
                        $availabilityArrayStatic[$i]['to'] = $to['static'][$i];
                    }
                }
            }
            $availabilityArrayDb = null;
            $avail = Input::get('avail');

            if(isset($avail) || $avail!=null){
                $count = count($avail['db']['day']);
                for($i=0;$i<$count;$i++){
                    $availabilityArrayDb[$i]['day'] = $avail['db']['day'][$i];
                    $availabilityArrayDb[$i]['from'] = $avail['db']['from'][$i];
                    $availabilityArrayDb[$i]['to'] = $avail['db']['to'][$i];
                    $availabilityArrayDb[$i]['id'] = $avail['db']['id'][$i];
                }
            }
            /* -----------END--------------- */

            if($availabilityArrayStatic!=null){
                $i = 0;
                foreach($availabilityArrayStatic as $availabilityArray){
                    $data[$i] =  array('service_provider_id'=>Auth::user()->service_provider_id,'week_day'=>$availabilityArray['day'],'from_time'=>$availabilityArray['from'].':00:00','to_time'=>$availabilityArray['to'].':00:00','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'));
                    $i++;
                }
                Availability::insert($data);
            }
            if($availabilityArrayDb!=null){
                foreach($availabilityArrayDb as $availabilityArray){
                    DB::table('service_provider_availabilities')
                        ->where('id', $availabilityArray['id'])
                        ->update(array('week_day'=>$availabilityArray['day'],'from_time'=>$availabilityArray['from'].':00:00','to_time'=>$availabilityArray['to'].':00:00','updated_at'=>date('Y-m-d H:i:s')));
                }

            }
            if($user->save() && $serviceProvider->save()){
                $this->updateProfileCompleteness();
                return Redirect::to('service-provider/editprofile')->with('message','Updated Successfully');
            }else{
                return Redirect::to('service-provider/editprofile')->withErrors('Something went wrong');
            }
        }else{
            return Redirect::to('service-provider/editprofile')->withInput()->withErrors($validation);
        }
    }
    /*
     *function Name: savePersonalData
     *Desc: Edit Profile View
     *Created By: Sagar Acharya
     *Created Date: 27 January 2014
     *return: N/A
    */
    public function savePersonalData(){
        $input = Input::all();
        $rules = array(
            'firstName' => 'required|min:5|max:20',
            'lastName' => 'required|min:5|max:20',
            'profilePicture' => 'mimes:jpeg,jpg,png|max:2000'
        );
        $validation = Validator::make($input,$rules);
        if($validation->passes()){
            $user = Auth::user();
            $user->user_first_name = trim(strtolower($input['firstName']));
            $user->user_last_name = trim(strtolower($input['lastName']));
            $user->updated_at = date('Y-m-d H:m:s');
            if($user->save()){
                if($input['profilePicture']!=null || !empty($input['profilePicture'])){
                    /* File Upload Code */
                    $spProfileUploadpath = $_ENV['SP_FILE_UPLOAD_PATH']."/".sha1($user->id)."/"."profile_image";

                    /* Create Upload Directory If Not Exists */
                    if(!file_exists($spProfileUploadpath)){
                        File::makeDirectory($spProfileUploadpath, $mode = 0777,true,true);
                        chmod($_ENV['SP_FILE_UPLOAD_PATH']."/".sha1($user->id), 0777);
                        chmod($_ENV['SP_FILE_UPLOAD_PATH']."/".sha1($user->id)."/"."profile_image", 0777);
                    }
                    $extension = Input::file('profilePicture')->getClientOriginalExtension();
                    $filename = sha1($user->id.time()).".{$extension}";
                    Input::file('profilePicture')->move($spProfileUploadpath, $filename);


                    DB::table('system_users')
                        ->where('id', $user->id)
                        ->update(array('profile_image' => $filename));
                }
                return Redirect::to('service-provider/editprofile')->with('message','Updated Successfully');
            }else{
                return Redirect::to('service-provider/editprofile')->withErrors('Something went wrong');
            }
        }else{
            return Redirect::to('service-provider/editprofile')->withInput()->withErrors($validation);
        }
    }

    /*
     *function Name: savePassword
     *Desc: Edit Profile View
     *Created By: Sagar Acharya
     *Created Date: 27 January 2014
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
                return Redirect::to('service-provider/editprofile')->with('message','Current password not matched, please try again');
            }else{
                $user->password = $input['newPassword'];
                $user->updated_at = date('Y-m-d H:m:s');
                if($user->save()){
                    return Redirect::to('service-provider/editprofile')->with('message','Password Updated Successfully');
                }else{
                    return Redirect::to('service-provider/editprofile')->with('message','Password Not Updated Something Went Wrong');
                }
            }
        }else{
            return Redirect::to('service-provider/editprofile')->withInput()->withErrors($validation);
        }
    }




}