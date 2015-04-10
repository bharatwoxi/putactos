<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 7/2/15
 * Time: 5:00 PM
 */
class CommonController extends BaseController {

    /*
    *function Name: viewProfile
    *Desc: View Profile Customer & SP
    *Created By: Sagar Acharya
    *Created Date: 7 Feb 2015
    *return: N/A
   */
    public function viewProfile($username)
    {
        $userCount = User::where('username','like',$username)->count();
        if($userCount==1){
            Session::put('feedbackForUsername', $username);
            $user = User::where('username','like',$username)->first();
            if($user->user_role_id==2){ //Service Provider
                $userData['averageHeartRating'] = 0;
                Session::put('feedbackSkip', 4);
                $userData['feedbackData'] = NULL;
                $totelFeedback = 0;
                $feedbackCount = Feedback::where('service_provider_id','=',$user->id)->orderBy('created_at','DESC')->take(Session::get('feedbackSkip'))->count();

                if($feedbackCount>0){
                    $userData['feedbackData'] = Feedback::where('service_provider_id','=',$user->id)->orderBy('created_at','DESC')->take(Session::get('feedbackSkip'))->get();
                    foreach($userData['feedbackData'] as $feedback){
                        if($feedback!=null || !empty($feedback)){
                            $totelFeedback++;
                            $userData['averageHeartRating'] = $userData['averageHeartRating'] + $feedback['rating'];
                        }
                    }
                }
                if($totelFeedback!=0){
                    $userData['averageHeartRating'] = ceil($userData['averageHeartRating']/$totelFeedback);
                }
                $userData['userData'] = $user;
                $userData['serviceProviderData'] = ServiceProvider::find($user->service_provider_id);
                $loggedInServiceProvider = Auth::user();
                /* Check If loggedIn user & View Profile User are same */

                if($loggedInServiceProvider->username == $userData['userData']->username){
                    $spIsSameAsLoggedInUser = 1;
                }else{
                    $spIsSameAsLoggedInUser = 0;
                }
                return View::make('profile.viewServiceProvider')->with(array('userData'=>$userData,'spIsSameAsLoggedInUser'=>$spIsSameAsLoggedInUser));
            }elseif($user->user_role_id==1){ //Customer
                $userData['systemUser'] = $user;
                $userData['customer'] = Customer::find($user->customer_id);
                return View::make('profile.viewCustomer')->with(array('userData'=>$userData));
            }
            //return View::make('profile.serviceProviderEdit')->with(array('ethnicitys'=> $ethnicity,'hairColors'=>$hairColor,'genders'=>$gender,'eyeColors'=>$eyeColor,'userData'=>$userData));


        }else{
            return Redirect::to('/');
        }

    }
    /*
    *function Name: saveFeedback
    *Desc: Save User Feedback
    *Created By: Sagar Acharya
    *Created Date: 7 Feb 2015
    *return: N/A
   */
    public function saveFeedback()
    {
        $input = Input::all();
        $username = Session::get('feedbackForUsername');
        $input=array_map('trim',$input);
        $rules = array(
            'feedback_text' => 'required|min:10|max:150',
            'heart_rating' => 'required|numeric|min:0.5|max:5',
        );
        $serviceProviderId = DB::table('system_users')->where('username','like',$username)->where('user_role_id','=',2)->pluck('id');
        $validation = Validator::make($input,$rules);
        if($validation->passes()){

            DB::table('customer_feedbacks')->insert(
                array(
                    'service_provider_id'  =>$serviceProviderId,
                    'customer_id' => Auth::user()->id,
                    'feedback'  =>$input['feedback_text'],
                    'rating'  =>$input['heart_rating'],
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=> date('Y-m-d H:i:s')
                )
            );
            Session::flash('message', 'Your feedback submitted successfully');
            return Redirect::to("profile/".$username);
        }else{
            return Redirect::to("profile/".$username)->withInput()->withErrors($validation);
        }
        //return View::make('profile.serviceProviderEdit')->with(array('ethnicitys'=> $ethnicity,'hairColors'=>$hairColor,'genders'=>$gender,'eyeColors'=>$eyeColor,'userData'=>$userData));
        return View::make('profile.viewServiceProvider');
    }
    /*
    *function Name: riseMeUp
    *Desc: Sp RiseMe Up
    *Created By: Sagar Acharya
    *Created Date: 8 Feb 2015
    *return: N/A
   */
    public function riseMeUp()
    {
        $username = Session::get('feedbackForUsername');
        $user = Auth::user();
        $serviceProvider = ServiceProvider::find($user->service_provider_id);
        $serviceProvider->riseme_up = 1;
        $serviceProvider->updated_at = date('Y-m-d H:i:s');
        if($serviceProvider->save()){
            Session::flash('message', 'RiseMe Up successfully');
            return Redirect::to("profile/".$username);
        }else{
            Session::flash('message', 'Something went wrong');
            return Redirect::to("profile/".$username);
        }
    }
    /*
    *function Name: getMoreFeedbacks
    *Desc: Get More Feedback
    *Created By: Sagar Acharya
    *Created Date: 8 Feb 2015
    *return: N/A
   */
    public function getMoreFeedbacks()
    {
        $skip = Session::get('feedbackSkip');
        $username = Session::get('feedbackForUsername');
        $user = User::where('username','like',$username)->first();
        $feedbacks = Feedback::where('service_provider_id','=',$user->id)->orderBy('created_at','DESC')->skip($skip)->take(4)->get();
        $skip = $skip + 4;
        Session::put('feedbackSkip',$skip);
        return View::make('profile.moreFeedbacks')->with(array('feedbacks'=>$feedbacks));
    }

    /*
    *function Name: mutipleImageUpload
    *Desc: Multiple Image Upload
    *Created By: Sagar Acharya
    *Created Date: 10 April 2015
    *return: N/A
   */
    public function mutipleImageUpload()
    {
        $user = Auth::user();
        if($user->user_role_id==1){ //Customer
            $uploadpath = $_ENV['CUSTOMER_FILE_UPLOAD_PATH']."/".sha1($user->id)."/"."extra_images";

            /* Create Upload Directory If Not Exists */
            if(!file_exists($uploadpath)){
                File::makeDirectory($uploadpath, $mode = 0777,true,true);
                chmod($_ENV['CUSTOMER_FILE_UPLOAD_PATH']."/".sha1($user->id), 0777);
                chmod($uploadpath, 0777);
            }
            $file = Input::file('file');
            $fileName = $file->getClientOriginalName();
            return $file->move($uploadpath, $fileName);
        }
    }

    public function getImages(){
        $user = Auth::user();
        if($user->user_role_id==1){ //Customer
            $result  = array();
            $storeFolder = $_ENV['CUSTOMER_FILE_UPLOAD_PATH']."/".sha1($user->id)."/"."extra_images";
            $imageUrl = '/public/uploads/userdata/customer/'.sha1($user->id).'/'.'extra_images';
            $files = scandir($storeFolder);                 //1
            if ( false!==$files ) {
                foreach ( $files as $file ) {
                    if ( '.'!=$file && '..'!=$file) {       //2
                        $obj['name'] = $file;
                        $obj['size'] = filesize($storeFolder.'/'.$file);
                        $obj['uploadsfolder'] = $imageUrl;
                        $result[] = $obj;
                    }
                }
            }

            header('Content-type: text/json');              //3
            header('Content-type: application/json');
            echo json_encode($result);
        }
    }
}