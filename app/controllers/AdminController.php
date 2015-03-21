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
            $userRoleName = UserRole::select('role')->where('id', '=', $userResult['user_role_id'])->get();
            $users[$i]['user_role'] = $userRoleName[0]['role'];
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
}