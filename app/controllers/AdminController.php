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
                return Redirect::to('admin')->withInput();;
            }elseif($user->is_active == 0){
                Session::flash('message', 'Please confirm your username address');
                return Redirect::to('admin');
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
                return Redirect::to('admin')
                    ->with('message', 'It looks like you entered the wrong email or password')
                    ->withInput();
            }
        }else{
            return Redirect::to('admin')->withInput()->withErrors($validation);
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
            $users[$i]['userdata'] = User::find($message->from_user_id);
            $users[$i]['messages'] = $message;
            $i++;
        }
        return View::make('admin.custom.user_messages')->with(array('users'=>$users));
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
        $array = array();
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
}
