<?php

class AdminController extends BaseController {

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

    /*
    *function Name: showLogin
    *Desc: View Admin Login
    *Created By: Sagar Acharya
    *Created Date: 31 January 2015
    *return: N/A
   */
	public function showLogin()
	{
		return View::make('admin.login_soft');
	}

    /*
    *function Name: showLogin
    *Desc: View Admin Login
    *Created By: Sagar Acharya
    *Created Date: 31 January 2015
    *return: true/false based on result
   */
    public function checkLogin()
    {
        $input = Input::all();
        $rules = array(
            'username' => 'required|min:5',
            'password' => 'required|min:6'
        );
        $validation = Validator::make($input,$rules);
        $data = array(
            'email' => $input['username'],
            'password' => $input['password']
        );
        if($validation->passes()){
            $id = DB::table('system_users')->where('email', $input['username'])->pluck('id');
            $user = User::find($id);
            if($id == NULL || $user == NULL){
                Session::flash('message', 'It looks like you entered the wrong username or password');
                return Redirect::to('admin-master')->withInput();;
            }elseif($user->is_active == 0){
                Session::flash('message', 'Please confirm your username address');
                return Redirect::to('admin-master');
            }elseif (Auth::attempt($data))
            {
                //App::make('UserController')->saveIpBrowserInformation();
                if(Auth::user()->user_role_id==3){
                    return Redirect::to('admin/home');
                }else{
                    Auth::logout();
                    return Redirect::to('/');
                }
            }else{
                /* Check Query Log With Time*/
                /*$queries = DB::getQueryLog();
                $last_query = end($queries);*/
                return Redirect::to('admin-master')
                    ->with('message', 'It looks like you entered the wrong email or password')
                    ->withInput();
            }
        }else{
            return Redirect::to('admin-master')->withInput()->withErrors($validation);
        }
    }
    /*
    *function Name: homeView
    *Desc: View Admin Home View
    *Created By: Sagar Acharya
    *Created Date: 3 Feb 2015
    *return: N/A
   */
    public function homeView()
    {
        return View::make('admin.index');
    }

    /*
    *function Name: searchExchangeMessage
    *Desc: View Search Exchange Message
    *Created By: Bharat Makwana
    *Created Date: 17 Mar 2015
    *return: N/A
   */
    public function searchExchangeMessage()
    {
        return View::make('admin.searchExchangeMessage');
    }

    /*
    *function Name: editMasterProfile
    *Desc: View Users Edit profile view
    *Created By: Bharat Makwana
    *Created Date: 17 Mar 2015
    *return: N/A
   */
    public function editMasterProfile()
    {
        return View::make('admin.editMasterProfile');
    }


    /*
    *function Name: getUserMessages
    *Desc: get user messages: Last 10 messages exchanged by users
    *Created By: Sagar Acharya
    *Created Date: 3 Feb 2015
    *return: N/A
   */
    public function getUserMessages()
    {
        $messages = Message::orderBy('sent_time','DESC')->take(10)->get();
        $users = null;
        $i = 0;
        foreach($messages as $message){
            $users[$i]['userdataFrom'] = User::find($message->from_user_id);
            $users[$i]['userdataTo'] = User::find($message->to_user_id);
            $users[$i]['messages'] = $message;
            $i++;
        }
        return View::make('admin.custom.user_messages')->with(array('users'=>$users));
    }

    /*
    *function Name: getUsersExchangeMessages
    *Desc: get user exchange messages by keyword
    *Created By: Bharat Makwana
    *Created Date: 17 Mar 2015
    *return: N/A
   */
    public function getUsersExchangeMessages()
    {
        $input = Input::all();
        $searchKey = $input['searchKey'];
        $messages = Message::where('message','LIKE', '%'.$searchKey.'%')->orderBy('sent_time','DESC')->get();
        $users = null;
        $i = 0;
        foreach($messages as $message){
            $users[$i]['userdataFrom'] = User::find($message->from_user_id);
            $users[$i]['userdataTo'] = User::find($message->to_user_id);
            $users[$i]['messages'] = $message;
            $i++;
        }
        return View::make('admin.custom.serach_user_messages')->with(array('users'=>$users));
    }

    /*
    *function Name: getUsersProfile
    *Desc: get user profile
    *Created By: Bharat Makwana
    *Created Date: 17 Mar 2015
    *return: N/A
   */
    public function getUsersProfile()
    {
        $input = Input::all();
        $searchKey = $input['searchKey'];
        $userResults = User::whereRaw((DB::raw("`user_role_id` <> 3 AND (`username` LIKE '%$searchKey%' OR `email` LIKE '%$searchKey%')")))->get();
        $users = array();
        $stats = array();
        $i = 0;
        foreach($userResults as $userResult){
            $users[$i]['profile_image'] = $userResult['profile_image'];
            $users[$i]['user_id'] = $userResult['id'];
            $users[$i]['username'] = $userResult['username'];
            $users[$i]['email'] = $userResult['email'];
            $users[$i]['user_first_name'] = $userResult['user_first_name'];
            $users[$i]['user_last_name'] = $userResult['user_last_name'];
            $users[$i]['is_active'] = $userResult['is_active'];
            $users[$i]['user_role_id'] = $userResult['user_role_id'];
            $userRoleName = UserRole::select('role', 'id')->where('id', '=', $userResult['user_role_id'])->get();
            $users[$i]['user_role'] = $userRoleName[0]['role'];
            $users[$i]['user_role_id'] = $userRoleName[0]['id'];
            $i++;
        }
        $stats['totalResult'] = $i;
        return View::make('admin.custom.user_profile_list')->with(array('users'=>$users, 'stats'=>$stats));
    }

    /*
    *function Name: blockUnblockUser
    *Desc: Block Unblock User
    *Created By: Bharat Makwana
    *Created Date: 19 Mar 2015
    *return: N/A
    */
    public function blockUnblockUser()
    {
        $input = Input::all();
        $searchKey = $input['searchKey'];
        $userInfo = explode('_',$input['userId']);
        User::where('id', '=', $userInfo[0])->update(array('is_active' => $userInfo[1]));
        $userResults = User::whereRaw((DB::raw("`user_role_id` <> 3 AND (`username` LIKE '%$searchKey%' OR `email` LIKE '%$searchKey%')")))->get();
        $users = array();
        $stats = array();
        $i = 0;
        foreach($userResults as $userResult){
            $users[$i]['profile_image'] = $userResult['profile_image'];
            $users[$i]['user_id'] = $userResult['id'];
            $users[$i]['username'] = $userResult['username'];
            $users[$i]['email'] = $userResult['email'];
            $users[$i]['user_first_name'] = $userResult['user_first_name'];
            $users[$i]['user_last_name'] = $userResult['user_last_name'];
            $users[$i]['is_active'] = $userResult['is_active'];
            $users[$i]['user_role_id'] = $userResult['user_role_id'];
            $userRoleName = UserRole::select('role')->where('id', '=', $userResult['user_role_id'])->get();
            $users[$i]['user_role'] = $userRoleName[0]['role'];
            $i++;
        }
        $stats['totalResult'] = $i;
        return View::make('admin.custom.user_profile_list')->with(array('users'=>$users, 'stats'=>$stats));
    }

    /*
    *function Name: userLoginCountDaily
    *Desc: Daily Login Count
    *Created By: Sagar Acharya
    *Created Date: 3 Feb 2015
    *return: N/A
   */
    public function userLoginCountDaily()
    {
        $dateString = date('Y-m-d'); // for example
        $dates[0] = date('Y-m-d', strtotime("$dateString"));
        $dates[1] = date('Y-m-d', strtotime("$dateString -1 days"));
        $dates[2] = date('Y-m-d', strtotime("$dateString -2 days"));
        $dates[3] = date('Y-m-d', strtotime("$dateString -3 days"));
        $dates[4] = date('Y-m-d', strtotime("$dateString -4 days"));
        $dates[5] = date('Y-m-d', strtotime("$dateString -5 days"));
        $dates[6] = date('Y-m-d', strtotime("$dateString -6 days"));
        $dates[7] = date('Y-m-d', strtotime("$dateString -7 days"));
        $dates[8] = date('Y-m-d', strtotime("$dateString -8 days"));
        $dates[9] = date('Y-m-d', strtotime("$dateString -9 days"));
        $dates[10] = date('Y-m-d', strtotime("$dateString -10 days"));
        $dates[11] = date('Y-m-d', strtotime("$dateString -11 days"));
        $dates[12] = date('Y-m-d', strtotime("$dateString -12 days"));
        $dates[13] = date('Y-m-d', strtotime("$dateString -13 days"));
        $dates[14] = date('Y-m-d', strtotime("$dateString -14 days"));
        foreach($dates as $date){
            $dailyUserLoginCount[$date] = SystemIpLog::where('login_time','>',$date.' 00:00:00')
                            ->where('login_time','<',$date.' 23:59:59')->count('id');
        }
        $array = array();
        $dailyUserLoginCount = array_reverse($dailyUserLoginCount);
        foreach($dailyUserLoginCount as $key=>$value){
            $key = date('d M',strtotime($key));
            $data = array($key, $value);
            array_push($array,$data);
        }
        echo json_encode($array);
    }
    /*
    *function Name: userLoginCountHourly
    *Desc: Hourly Login Count
    *Created By: Sagar Acharya
    *Created Date: 4 Feb 2015
    *return: N/A
   */
    public function userLoginCountHourly()
    {
        $timeArray = array();
        $hourlyUserLoginCount = array();
        $array = array();
        $timeString = date('H:00:00');
        for($i=0,$currentTime=date('H:00:00');$currentTime>='01:00:00';$i++,$currentTime = date('H:00:00',strtotime("$newTime -1 hour"))){
            $newTime = date('H:00:00',strtotime("$currentTime"));
            $timeArray[$i] = $newTime;
        }
        foreach($timeArray as $time){
            $minusOneHour = date('H:00:00',strtotime("$time -1 hour"));
            if($minusOneHour>='01:00:00'){
                $hourlyUserLoginCount[$time] = SystemIpLog::where('login_time','<',date('Y-m-d '.$time))
                    ->where('login_time','>',date('Y-m-d '.$minusOneHour))->count('id');
            }
        }

        $hourlyUserLoginCount = array_reverse($hourlyUserLoginCount);
        foreach($hourlyUserLoginCount as $key=>$value){
            $hourkey = date('H',strtotime($key));
            $amPm = date('A',strtotime($key));
            $key = ($hourkey-1).$amPm.'-'.($hourkey).$amPm;
            $data = array($key, $value);
            array_push($array,$data);
        }
        echo json_encode($array);
    }
    /*
    *function Name: lastTenNewUsers
    *Desc: get user messages: Last 10 new users
    *Created By: Sagar Acharya
    *Created Date: 7 Feb 2015
    *return: N/A
   */
    public function lastTenNewUsers()
    {
        $users = User::where('user_role_id','!=','3')->orderBy('created_at','DESC')->take(10)->get();
        return View::make('admin.custom.last_ten_newusers')->with(array('users'=>$users));
    }

    /*
    *function Name: lastTenLoggedinUsers
    *Desc: get user messages: Last 10 logged in users
    *Created By: Bharat Makwana
    *Created Date:  16 Mar 2015
    *return: N/A
    */
    public function lastTenLoggedinUsers()
    {
        $lastLogUserDetail = SystemIpLog::select('system_user_id')->distinct()->orderBy('id','DESC')->take(10)->get();
        $userLogArray = array();
        foreach ($lastLogUserDetail as $logDetail){
            //echo $logDetail['system_user_id'];
            array_push($userLogArray, $logDetail['system_user_id']);
        }
        //exit;
        //$users = Users::where('id','in',$lastLogUserDetail);
        $login_time = array();
        $max_login_time = array();
        foreach ($userLogArray as $userLogId) {
            $max_login_time = SystemIpLog::where('system_user_id','=', $userLogId)->get([DB::raw('MAX(login_time) as login_time')]);
            foreach ($max_login_time as $maxloginTime) {
                array_push($login_time, $maxloginTime->login_time);
            }
        }
        $users = User::where('user_role_id','!=','3')->whereIn('id', $userLogArray)->get();
        return View::make('admin.custom.last_ten_loggedinusers')->with(array('users'=>$users, 'login_time'=>$login_time));
    }


    /*
    *function Name: newUserStatsDetail
    *Desc: get user messages: Last 10 new users
    *Created By: Sagar Acharya
    *Created Date: 7 Feb 2015
    *return: N/A
   */
    public function userCount()
    {
        $input = Input::all();
        if($input['default'] ==0){
            $users['total'] = User::all()->count();
            $users['new'] = User::where('created_at','=',date('Y-m-d 00:00:00'))->where('created_at','=',date('Y-m-d H:i:s'))->count();
        }
        $userCount = array(
            'totalUsers' => $users['total'],
            'newUsers' => $users['new']
        );
        echo json_encode($userCount);
    }

    /*
    *function Name: doLogout
    *Desc: logout from system
    *Created By: Bharat Makwana
    *Created Date: 21 Mar 2015
    *return: N/A
    */

    public function doLogout(){
        Auth::logout(); // log the user out of our application
        return Redirect::to('admin-master'); // redirect the user to the login screen
    }

    /*
     *function Name: profileEditView
     *Desc: Edit Profile View
     *Created By: Bharat Makwana
     *Created Date: 20 April 2015
     *return: N/A
    */
    public function spEditProfile($id){
        $userData['systemUser'] = User::find($id);
        $userData['serviceProvider'] = ServiceProvider::find($userData['systemUser']->service_provider_id);
        $ethnicity = Ethnicity::all();
        $gender = Gender::all();
        $hairColor = HairColor::all();
        $eyeColor = EyeColor::all();
        $cupSize = CupSize::all();
        $avaliability = DB::table('service_provider_availabilities')->where('service_provider_id', $userData['serviceProvider']->id)->get();
        return View::make('profile.adminServiceProviderEdit')->with(array('ethnicitys'=> $ethnicity,'hairColors'=>$hairColor,'genders'=>$gender,'eyeColors'=>$eyeColor,'userData'=>$userData,'cupSizes'=>$cupSize,'avaliabilities'=>$avaliability));
    }

    /*
    *function Name: saveSPPersonalData
    *Desc: Edit Profile View by admin
    *Created By: Bharat Makwana
    *Created Date: 22 April 2015
    *return: N/A
   */
    public function saveSPPersonalData($id){
        $input = Input::all();
        $rules = array(
            'firstName' => 'required|min:5|max:20',
            'lastName' => 'required|min:5|max:20',
            'profilePicture' => 'mimes:jpeg,jpg,png|max:2000'
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
        $user = User::where('service_provider_id', '=', $id)->first();
        $redirectUrl = 'admin/spEditProfile/'.$user['id'];
        if($validation->passes()){
            $imageRule = array(
                'profilePicture' => 'image_size:330,220',
            );
            $imageValidation = Validator::make($input,$imageRule,$messages);
            if(!$imageValidation->passes()){
                return Redirect::to($redirectUrl)->withInput()->withErrors($imageValidation);
            }
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

                    /* Cropped Image Code */
                    $image330by220 = $user->id.time()."_330x220".".{$extension}";
                    $image250by180 = $user->id.time()."_250x180".".{$extension}";
                    $img = Image::make($spProfileUploadpath.'/'.$filename)->resize(330, 220);
                    $img->save($spProfileUploadpath.'/'.$image330by220);
                    $img = Image::make($spProfileUploadpath.'/'.$filename)->resize(250, 180);
                    $img->save($spProfileUploadpath.'/'.$image250by180);
                    $image62by54 = $user->id.time()."_62x54".".{$extension}";
                    $img = Image::make($spProfileUploadpath.'/'.$filename)->resize(62, 54);
                    $img->save($spProfileUploadpath.'/'.$image62by54);
                    DB::table('system_users')
                        ->where('id', $user->id)
                        ->update(array('profile_image' => $filename,'image_330by220'=>$image330by220,'image_250by180'=>$image250by180,'image_62by54'=>$image62by54));
                }
                return Redirect::to($redirectUrl)->with('message','Updated Successfully');
            }else{
                return Redirect::to($redirectUrl)->withErrors('Something went wrong');
            }
        }else{
            return Redirect::to($redirectUrl)->withInput()->withErrors($validation);
        }
    }


    /*
     *function Name: saveSPPassword
     *Desc: Edit Profile View
     *Created By: Bharat Makwana
     *Created Date: 22 April 2015
     *return: N/A
    */
    public function saveSPPassword($id){
        $input = Input::all();
        $user = User::where('service_provider_id', '=', $id)->first();
        $rules = array(
            //'currentPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword',
        );
        $validation = Validator::make($input,$rules);
        $redirectUrl = 'admin/spEditProfile/'.$user['id'];
        if($validation->passes()){
            //if(!Hash::check($input['currentPassword'] , $user->getAuthPassword())){
           //     return Redirect::to('service-provider/editprofile')->with('message','Current password not matched, please try again');
           // }else{
                $user->password = $input['newPassword'];
                $user->updated_at = date('Y-m-d H:m:s');
                if($user->save()){
                    return Redirect::to($redirectUrl)->with('message','Password Updated Successfully');
                }else{
                    return Redirect::to($redirectUrl)->with('message','Password Not Updated Something Went Wrong');
                }
           // }
        }else{
            return Redirect::to($redirectUrl)->withInput()->withErrors($validation);
        }
    }
    /*
    *function Name: saveSPProfileData
    *Desc: Edit Profile View
    *Created By: Bharat Makwana
    *Created Date: 22 April 2015
    *return: N/A
   */
    public function saveSPProfileData($id){
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
        $user = User::where('service_provider_id', '=', $id)->first();
        $redirectUrl = 'admin/spEditProfile/'.$user['id'];
        if($validation->passes()){
            $ageRange = explode(",",$input['ageRange']);
            $serviceProvider = ServiceProvider::find($user->service_provider_id);
            //$user = Auth::user();
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
                    $data[$i] =  array('service_provider_id'=>$id,'week_day'=>$availabilityArray['day'],'from_time'=>$availabilityArray['from'].':00:00','to_time'=>$availabilityArray['to'].':00:00','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'));
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
                $this->updateProfileCompletenessAdmin($id);
                return Redirect::to($redirectUrl)->with('message','Updated Successfully');
            }else{
                return Redirect::to($redirectUrl)->withErrors('Something went wrong');
            }
        }else{
            return Redirect::to($redirectUrl)->withInput()->withErrors($validation);
        }
    }

    /*
     *function Name: custProfileEditView
     *Desc: Edit Profile View
     *Created By: Bharat Makwana
     *Created Date: 22 April 2015
     *return: N/A
    */
    public function custEditProfile($id){
        $userData['systemUser'] = User::find($id);
        $userData['gender'] = Customer::find($userData['systemUser']->customer_id);
        return View::make('profile.adminCustomerEdit')->with(array('userData'=>$userData));
    }

    /*
     *function Name: saveCustPersonalData
     *Desc: Edit Profile View
     *Created By: Sagar Acharya
     *Created Date: 29 January 2014
     *return: N/A
    */
    public function saveCustPersonalData($id){
        $input = Input::all();
        $rules = array(
            'firstName' => 'required|min:5|max:20',
            'lastName' => 'required|min:5|max:20',
            'profilePicture' => 'mimes:jpeg,jpg,png|max:2000'
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
        $user = User::where('customer_id', '=', $id)->first();
        $redirectUrl = 'admin/custEditProfile/'.$user['id'];
        if($validation->passes()){
            $imageRule = array(
                'profilePicture' => 'image_size:330,220',
            );
            $imageValidation = Validator::make($input,$imageRule,$messages);
            if(!$imageValidation->passes()){
                return Redirect::to($redirectUrl)->withInput()->withErrors($imageValidation);
            }
            //$user = Auth::user();

            $user->user_first_name = trim(strtolower($input['firstName']));
            $user->user_last_name = trim(strtolower($input['lastName']));
            $user->updated_at = date('Y-m-d H:m:s');
            if($user->save()){
                if($input['profilePicture']!=null || !empty($input['profilePicture'])){
                    /* File Upload Code */
                    $spProfileUploadpath = $_ENV['CUSTOMER_FILE_UPLOAD_PATH']."/".sha1($user->id)."/"."profile_image";

                    /* Create Upload Directory If Not Exists */
                    if(!file_exists($spProfileUploadpath)){
                        File::makeDirectory($spProfileUploadpath, $mode = 0777,true,true);
                        chmod($_ENV['CUSTOMER_FILE_UPLOAD_PATH']."/".sha1($user->id), 0777);
                        chmod($_ENV['CUSTOMER_FILE_UPLOAD_PATH']."/".sha1($user->id)."/"."profile_image", 0777);
                    }
                    $extension = Input::file('profilePicture')->getClientOriginalExtension();
                    $filename = sha1($user->id.time()).".{$extension}";
                    Input::file('profilePicture')->move($spProfileUploadpath, $filename);

                    //chmod($_ENV['CUSTOMER_FILE_UPLOAD_PATH']."/".sha1($user->id)."/"."profile_image/", 0777);
                    /* Cropped Image Code */
                    $image330by220 = $user->id.time()."_330x220".".{$extension}";
                    $image250by180 = $user->id.time()."_250x180".".{$extension}";
                    $img = Image::make($spProfileUploadpath.'/'.$filename)->resize(330, 220);
                    $img->save($spProfileUploadpath.'/'.$image330by220);
                    $img = Image::make($spProfileUploadpath.'/'.$filename)->resize(250, 180);
                    $img->save($spProfileUploadpath.'/'.$image250by180);
                    $image62by54 = $user->id.time()."_62x54".".{$extension}";
                    $img = Image::make($spProfileUploadpath.'/'.$filename)->resize(62, 54);
                    $img->save($spProfileUploadpath.'/'.$image62by54);
                    DB::table('system_users')
                        ->where('id', $user->id)
                        ->update(array('profile_image' => $filename,'image_330by220'=>$image330by220,'image_250by180'=>$image250by180,'image_62by54'=>$image62by54));
                }
                return Redirect::to($redirectUrl)->with('message','Updated Successfully');
            }else{
                return Redirect::to($redirectUrl)->withErrors('Something went wrong');
            }
        }else{
            return Redirect::to($redirectUrl)->withInput()->withErrors($validation);
        }
    }

    /*
     *function Name: savePassword
     *Desc: Edit Profile View
     *Created By: Sagar Acharya
     *Created Date: 29 January 2014
     *return: N/A
    */
    public function saveCustPassword($id){
        $input = Input::all();
        $user = User::where('customer_id', '=', $id)->first();
        $rules = array(
            //'currentPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword',
        );
        $validation = Validator::make($input,$rules);
        $redirectUrl = 'admin/custEditProfile/'.$user['id'];
        //echo "<pre>"; print_r($redirectUrl); exit;

        if($validation->passes()){
//            if(!Hash::check($input['currentPassword'] , $user->getAuthPassword())){
//                echo 1; exit;
//                return Redirect::to($redirectUrl)->with('message','Current password not matched, please try again');
//            }else{
                $user->password = $input['newPassword'];
                $user->updated_at = date('Y-m-d H:m:s');
                //echo "<pre>"; print_r($user); exit;
                if($user->save()){
                    //echo "<pre>"; print_r($user); exit;
                    return Redirect::to($redirectUrl)->with('message','Password Updated Successfully');
                }else{
                    return Redirect::to($redirectUrl)->with('message','Password Not Updated Something Went Wrong');
                }
           // }
        }else{
            return Redirect::to($redirectUrl)->withInput()->withErrors($validation);
        }
    }

    /*
    *function Name: savePreferences
    *Desc: Save User Preferences
    *Created By: Sagar Acharya
    *Created Date: 27 Feb 2015
    *return: N/A
   */
    public function saveCustPreferences($id){
        $input = Input::all();
        $rules = array(
            'looking_for' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'ageRange' => 'required',
            'birthDate' => 'required',
        );
        $validation = Validator::make($input,$rules);
        $user = User::where('customer_id', '=', $id)->first();
        $redirectUrl = 'admin/custEditProfile/'.$user['id'];
        if($validation->passes()){
            $usePersonalData = Customer::find($user->customer_id);
            $ageRange = explode(",",$input['ageRange']);
            $user->latitude = $input['latitude'];
            $user->longitude = $input['longitude'];
            $user->city = $input['city'];
            $user->country = $input['country'];
            $user->birth_date = $input['birthDate'];
            $user->from_age = $ageRange[0];
            $user->to_age = $ageRange[1];
            $user->updated_at = date('Y-m-d H:m:s');
            $usePersonalData->looking_for = $input['looking_for'];
            $usePersonalData->updated_at = date('Y-m-d H:m:s');
            if($user->save() && $usePersonalData->save()){
                return Redirect::to($redirectUrl)->with('message','Updated Successfully');
            }else{
                return Redirect::to($redirectUrl)->with('message','Data Not Updated Something Went Wrong');
            }
        }else{
            return Redirect::to($redirectUrl)->withErrors($validation);
        }
    }

    /*
*function Name: updateProfileCompletenessAdmin
*Desc: checkUserName for service provider & customer if it exists or not
*Created By: Bharat Makwana
*Created Date: 16 May 2015
*return: true/false based on result
*/

    public function updateProfileCompletenessAdmin($spId){
        $serviceProviderProfileData = array();
        $user = User::where('service_provider_id', '=', $spId)->first();
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
        $serviceProviderProfileData['penis_size'] = $serviceProvider->penis_size;

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
     *function Name: deleteAvailability
     *Desc: Edit Profile View
     *Created By: Sagar Acharya
     *Created Date: 6 April 2015
     *return: N/A
    */
    public function deleteAvailability(){
        $availability = Availability::find(Input::get('id'));
        if(!(empty($availability))){
            $availability->delete();
        }
    }
}
