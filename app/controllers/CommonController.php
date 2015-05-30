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
            $photoData = AdditionalPhotos::where('system_user_id','=',$user->id)->get();
            if($photoData->count()>0){
                $file['status'] = 'success';
                $i = 0;
                if($user->user_role_id==1){ //Customer
                    $ImageUploadpath = URL::to('/')."/".$_ENV['CUSTOMER_FILE_VIEW_PATH']."/".sha1($user->id)."/"."extra_images";
                }
                if($user->user_role_id==2){ //Service Provider
                    $ImageUploadpath = URL::to('/')."/".$_ENV['SP_FILE_VIEW_PATH']."/".sha1($user->id)."/"."extra_images";
                }
                $file['path'] = $ImageUploadpath;
                foreach($photoData as $photo){
                    $file['files'][$i]['name'] = $photo->original_name;
                    $i++;
                }
            }else{
                $file['status'] = 'fail';
            }
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

                /* Feddback Logic Start */
                $authenticatedUser = Auth::user();
                $feedbackFlag = 0;
                $feedbackMessage = null;
                if($authenticatedUser->user_role_id==1){ //Only for customer
                    $feedbackFlag = 1;
                    $feedback = Feedback::where('service_provider_id','=',$user->id)->where('customer_id','=',$authenticatedUser->id)->get();
                    if($feedback->count()>0){
                        $feedbackFlag = 0; //If already Feedback then change flag to 0
                        $feedbackMessage = 'You have already submitted feedback';
                    }else{
                        /* Check feedback for same day for logged in user */
                        $feedbackForSameDay = Feedback::where('customer_id','=',$authenticatedUser->id)->where('created_at','>=',date('Y-m-d 00:00:00'))->where('created_at','<=',date('Y-m-d 23:59:59'))->get();
                        if($feedbackForSameDay->count()>0){
                            $feedbackFlag = 0; //If already Feedback to another SP on same day
                            $feedbackMessage = 'You can not submit more than one feedback in one day';
                        }else{
                            /* Check for more than 3 msgs */
                            $checkMessagesFromSP = Message::where('from_user_id','=',$user->id)->where('to_user_id','=',$authenticatedUser->id)->get();
                            $checkMessagesFromCustomer = Message::where('from_user_id','=',$authenticatedUser->id)->where('to_user_id','=',$user->id)->get();
                            if($checkMessagesFromSP->count()>3 && $checkMessagesFromCustomer->count()>0){
                                $feedbackFlag = 1;
                            }else{
                                $feedbackFlag = 0;  // From SP there should be more than 3 MSG & From Cust at least 1
                                $feedbackMessage = 'To submit feedback there should be atleast three message send by current service provider to you';
                            }
                        }
                    }

                }
                /* Feddback Logic End */
                return View::make('profile.viewServiceProvider')->with(array('userData'=>$userData,'spIsSameAsLoggedInUser'=>$spIsSameAsLoggedInUser,'feedbackFlag'=>$feedbackFlag,'feedbackMessage'=>$feedbackMessage,'userExtrafile'=>$file));
            }elseif($user->user_role_id==1){ //Customer
                $userData['systemUser'] = $user;
                $userData['customer'] = Customer::find($user->customer_id);
                return View::make('profile.viewCustomer')->with(array('userData'=>$userData,'userExtrafile'=>$file));
            }
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
    *function Name: insertMultipleImages
    *Desc: Add multiple Images for Users
    *Created By: Sagar Acharya
    *Created Date: 14 March 2015
    *return: N/A
   */
    public function insertMultipleImages(){
        $systemUserInsertedId = Auth::User()->id;
        //echo "<script>alert(".Input::file('file').")</script>";
        //return;
        if(Auth::User()->user_role_id==1){ //Customer{
            $ImageUploadpath = $_ENV['CUSTOMER_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId)."/"."extra_images";
        }

        if(Auth::User()->user_role_id==2){ //Service Provider
            $ImageUploadpath = $_ENV['SP_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId)."/"."extra_images";
        }
        /* Create Upload Directory If Not Exists */
        if(Auth::User()->user_role_id==1){ //Customer

            if(!file_exists($ImageUploadpath)){
                File::makeDirectory($ImageUploadpath, $mode = 0777,true,true);
                //chmod($_ENV['CUSTOMER_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId), 0777);
                @chmod($_ENV['CUSTOMER_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId)."/"."extra_images/", 0777);
            }
        }
        if(Auth::User()->user_role_id==2){ //Service Provider

            if(!file_exists($ImageUploadpath)){
                File::makeDirectory($ImageUploadpath, $mode = 0777,true,true);
                //chmod($_ENV['SP_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId), 0777);
                @chmod($_ENV['SP_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId)."/"."extra_images/", 0777);
            }
        }
        $extension = Input::file('file')->getClientOriginalExtension();
        $filename = Input::file('file')->getClientOriginalName();//sha1($systemUserInsertedId.time()).".{$extension}";
        Input::file('file')->move($ImageUploadpath, $filename);
        if(Auth::User()->user_role_id==1){ //Customer
            @chmod($_ENV['CUSTOMER_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId)."/"."extra_images/", 0777);
        }
        if(Auth::User()->user_role_id==2){ //Service Provider
            @chmod($_ENV['SP_FILE_UPLOAD_PATH']."/".sha1($systemUserInsertedId)."/"."extra_images/", 0777);
        }
        DB::table('customer_additional_photos')->insert(
            array(
                'system_user_id'  =>$systemUserInsertedId,
                'image_name' => $filename,
                'original_name'  =>Input::file('file')->getClientOriginalName(),
                'file_size'  =>123,//Input::file('file')->getSize(),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            )
        );
        echo Input::file('file')->getClientOriginalName();
    }
    public function deleteMultipleImages(){
        $userId = Auth::User()->id;
        if(Auth::User()->user_role_id==1){ //Customer
            $ImageUploadpath = $_ENV['CUSTOMER_FILE_UPLOAD_PATH']."/".sha1($userId)."/"."extra_images/";
        }
        if(Auth::User()->user_role_id==2){ //Service Provider
            $ImageUploadpath = $_ENV['SP_FILE_UPLOAD_PATH']."/".sha1($userId)."/"."extra_images/";
        }
        $photoData = AdditionalPhotos::where('original_name','LIKE',Input::get('file_name'))->where('system_user_id','=',$userId)->first();
        $photo = AdditionalPhotos::find($photoData->id);
        $photo->delete();
        unlink($ImageUploadpath.Input::get('file_name'));
        print_r(Input::get('file_name'));
    }
    public function showMultipleImages(){
        $userId = Auth::User()->id;
        $photoData = AdditionalPhotos::where('system_user_id','=',$userId)->get();
        if($photoData->count()>0){
            $file['status'] = 'success';
            $i = 0;
            if(Auth::User()->user_role_id==1){ //Customer
                $ImageUploadpath = URL::to('/')."/".$_ENV['CUSTOMER_FILE_VIEW_PATH']."/".sha1($userId)."/"."extra_images";
            }
            if(Auth::User()->user_role_id==2){ //Service Provider
                $ImageUploadpath = URL::to('/')."/".$_ENV['SP_FILE_VIEW_PATH']."/".sha1($userId)."/"."extra_images";
            }
            foreach($photoData as $photo){
                $file['files'][$i]['name'] = $photo->original_name;
                $file['files'][$i]['size'] = $photo->file_size;
                $file['files'][$i]['path'] = $ImageUploadpath;
                $i++;
            }
        }else{
            $file['status'] = 'fail';
        }
        echo json_encode($file);
    }
}
