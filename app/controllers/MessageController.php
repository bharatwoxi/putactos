<?php

class MessageController extends BaseController {

    /*
    *function Name: showMessages
    *Desc: Show message listing to user
    *Created By: Sagar Acharya
    *Created Date: 8 December 2014
    *return: true/false based on result
   */
    public function showUserList()
    {
        /*
         * User Listing
         *select * from `user_messages` where `from_user_id` = '1' group by `from_user_id` order by `sent_time` desc
         *Get Latest Message
         * select * from `user_messages` where `sent_time` = (SELECT max(`sent_time`) FROM `user_messages` WHERE (`from_user_id`= 1 AND `to_user_id` = 2) OR (`from_user_id`= 2 AND `to_user_id` = 1))
         * Message:
         * select * from `user_messages` WHERE `from_user_id` IN (1,2) AND `to_user_id` IN (1,2) ORDER BY `sent_time` DESC
        */
        $input = Input::all();
        if($input['isScroll']==0){
            $skip = 0;
            $take = 8;
        }else{
            $skip = Session::get('userListingSkip');
            $take = 8;
        }
        $loggedInUserId = Auth::user()->id;
        $userRoleId = Auth::user()->user_role_id;
        if($userRoleId==1){ //Customer
            $getMessageData = Message::where('from_user_id','=',$loggedInUserId)->select('to_user_id')->orderBy('sent_time','desc')->groupBy('to_user_id')->skip($skip)->take($take)->get();
        }
        if($userRoleId==2){ //Service Provider
            $getMessageData = Message::where('to_user_id','=',$loggedInUserId)->select('from_user_id')->orderBy('sent_time','desc')->groupBy('from_user_id')->skip($skip)->take($take)->get();
        }

        $skip = $skip + $take;
        Session::put('userListingSkip', $skip);
//
//        foreach($getMessageData as $user){
//            var_dump($user->to_user_id);echo "<br/>";
//        }
           //exit;
        $userListingForMessages = NULL;
        if(!$getMessageData->isEmpty()){
            $i = 0;
            foreach($getMessageData as $user){
                if($userRoleId==1){ //Customer
                    $useData = User::find($user->to_user_id);
                    //$getMaxTimeStamp = Message::whereIn('from_user_id', array($loggedInUserId,$user->to_user_id))->orwhereIn('to_user_id', array($loggedInUserId,$user->to_user_id))->max('sent_time');
                    $getMaxTimeStamp = Message::where('from_user_id', $loggedInUserId)->where('to_user_id', $user->to_user_id)->orWhere('from_user_id', $user->to_user_id)->where('to_user_id', $loggedInUserId)->max('sent_time');

                    /* Get New Message Count */
                    $getNewMessageCountLeft = Message::where('from_user_id', $loggedInUserId)->where('to_user_id', $user->to_user_id)->where('is_new',1)->count();
                    $getNewMessageCountRight = Message::Where('from_user_id', $user->to_user_id)->where('to_user_id', $loggedInUserId)->where('is_new',1)->count();
                }
                if($userRoleId==2){ //Service Provider
                    $useData = User::find($user->from_user_id);
                    //$getMaxTimeStamp = Message::whereIn('from_user_id', array($loggedInUserId,$user->to_user_id))->orwhereIn('to_user_id', array($loggedInUserId,$user->to_user_id))->max('sent_time');
                    $getMaxTimeStamp = Message::where('from_user_id', $loggedInUserId)->where('to_user_id', $user->from_user_id)->orWhere('from_user_id', $user->from_user_id)->where('to_user_id', $loggedInUserId)->max('sent_time');

                    /* Get New Message Count */
                    $getNewMessageCountLeft = Message::where('from_user_id', $loggedInUserId)->where('to_user_id', $user->from_user_id)->where('is_new',1)->count();
                    $getNewMessageCountRight = Message::Where('from_user_id', $user->from_user_id)->where('to_user_id', $loggedInUserId)->where('is_new',1)->count();
                }
                $getNewMessageCount = $getNewMessageCountLeft + $getNewMessageCountRight;
                $getLatestMessage = Message::where('sent_time','=',$getMaxTimeStamp)->select('message')->orderBy('sent_time','desc')->groupBy('to_user_id')->get();
                foreach($getLatestMessage as $getMessage){
                    $message = $getMessage->message;
                }
                $getDayFromDate = date('D', strtotime($getMaxTimeStamp));
                $userListingForMessages[$i]['serviceProviderId'] = $useData->id;
                $userListingForMessages[$i]['name'] = ucfirst($useData->user_first_name).' '.ucfirst($useData->user_last_name);

                if($useData->user_role_id==1){
                    $userListingForMessages[$i]['profilePicture'] = 'public/uploads/userdata/customer'."/".sha1($useData->id)."/"."profile_image/".$useData->profile_image;
                }
                if($useData->user_role_id==2){
                    $userListingForMessages[$i]['profilePicture'] = 'public/uploads/userdata/service_provider'."/".sha1($useData->id)."/"."profile_image/".$useData->profile_image;
                }
                $userListingForMessages[$i]['message'] = mb_strimwidth($message,0,15,"...");
                $userListingForMessages[$i]['day'] = $getDayFromDate;
                $userListingForMessages[$i]['totalNewMessages'] = $getNewMessageCount;
                $i++;
            }

//            echo "<pre>";print_r($userListingForMessages);echo "</pre>";
//            exit;
        }
        return View::make('messages.users')->with('userListingForMessages',$userListingForMessages);
    }
    /*
    *function Name: index
    *Desc: Show message Page
    *Created By: Sagar Acharya
    *Created Date: 12 December 2014
    *return: N/A
   */
    public function index()
    {
        return View::make('messages.index');
    }
    /*
    *function Name: showMessages
    *Desc: Show message Between SP & Customer
    *Created By: Sagar Acharya
    *Created Date: 12 December 2014
    *return: Messages UI
   */
    public function showMessages(){
        $loggedInUserId = Auth::user()->id;
        if(Input::get('isScroll')==0){
            $input = Input::all();
            Session::put('messegeFromId', $input['from_id']);
            Session::put('messegeToId', $input['to_id']);
            $skip = 0;
            $take = 8;
        }else{
            $input['from_id'] = Session::get('messegeFromId');
            $input['to_id'] = Session::get('messegeToId');
            $skip = Session::get('messegeSkip');
            $take = 8;
        }
        if($input['to_id'] != $loggedInUserId ){
            $showMessageForUser = User::find($input['to_id']);
            $sendMessageUserId = $input['to_id'];
            $userFullName = ucwords($showMessageForUser->user_first_name.' '.$showMessageForUser->user_last_name);
        }
        if($input['from_id'] != $loggedInUserId){
            $showMessageForUser = User::find($input['from_id']);
            $sendMessageUserId = $input['from_id'];
            $userFullName = ucwords($showMessageForUser->user_first_name.' '.$showMessageForUser->user_last_name);
        }
        $messageData = Message::whereIn('from_user_id', array($input['from_id'],$input['to_id']))->whereIn('to_user_id', array($input['from_id'],$input['to_id']))->orderBy('sent_time','dsc')->skip($skip)->take($take)->get();
        $skip = $skip + $take;
        Session::put('messegeSkip', $skip);
        $userMessage = NULL;
        $i = 0;

        foreach($messageData as $message){
            $user = User::find($message['from_user_id']);
            $userMessage[$i]['messageId'] = $message['id'];
            $getMessageRecord = Message::find($message['id']);
            if($getMessageRecord->is_new==1){
                $getMessageRecord->is_new = 0;
                $getMessageRecord->updated_at = date('Y-m-d H:m:s');
                $getMessageRecord->save();
            }
//            if($loggedInUserId == $message['from_user_id']){
//                echo 1;echo "<br/>";
//                $userMessage[$i]['name'] = 'You';
//            }elseif($loggedInUserId == $message['to_user_id']){
//                echo 2;echo "<br/>";
//                $userMessage[$i]['name'] = 'You';
//            }else{
//                echo 3;echo "<br/>";
//                $userMessage[$i]['name'] = ucwords($user->user_first_name.' '.$user->user_last_name);
//            }
            $userMessage[$i]['name'] = ucwords($user->user_first_name.' '.$user->user_last_name);
            if($user->user_role_id==1){
                $userMessage[$i]['image'] = 'public/uploads/userdata/customer'."/".sha1($user->id)."/"."profile_image/".$user->profile_image;
            }
            if($user->user_role_id==2){
                $userMessage[$i]['image'] = 'public/uploads/userdata/service_provider'."/".sha1($user->id)."/"."profile_image/".$user->profile_image;
            }
            $userMessage[$i]['message'] = $message['message'];
            $userMessage[$i]['sent_time'] = $message['sent_time'];
            $i++;
        }
        return View::make('messages.detailedMessages')->with(array('userMessage'=>$userMessage,'userFullName'=>$userFullName,'isScroll'=>Input::get('isScroll'),'sendMessageUserId'=>$sendMessageUserId,'showMessageForUser'=>$showMessageForUser));
    }
    /*
    *function Name: insertNewMessage
    *Desc: Add new message
    *Created By: Sagar Acharya
    *Created Date: 14 December 2014
    *return: true/false based on message insertion
   */
    public function insertNewMessage(){
        $input = Input::all();
        $insertedMessageId = DB::table('user_messages')->insertGetId(
            array(
                'from_user_id'=>Auth::user()->id,
                'to_user_id'=>$input['to_id'],
                'message'=>$input['message'],
                'is_new'=>1,
                'sent_time'=>date('Y-m-d H:m:s'),
                'created_at'=>date('Y-m-d H:m:s'),
                'updated_at'=> date('Y-m-d H:m:s')
            )
        );
        $message = Message::find($insertedMessageId);
        $fromUser = User::find(Auth::user()->id);
        if($fromUser->user_role_id==1){
            $user['image'] = 'public/uploads/userdata/customer'."/".sha1($fromUser->id)."/"."profile_image/".$fromUser->profile_image;
        }
        if($fromUser->user_role_id==2){
            $user['image'] = 'public/uploads/userdata/service_provider'."/".sha1($fromUser->id)."/"."profile_image/".$fromUser->profile_image;
        }
        $user['name'] = $userMessage['name'] = ucwords($fromUser->user_first_name.' '.$fromUser->user_last_name);;
        return View::make('messages.showAddedMessage')->with(array('message'=>$message,'user'=>$user));
    }
    /*
    *function Name: insertNewMessageViewProfile
    *Desc: Add new message
    *Created By: Sagar Acharya
    *Created Date: 14 December 2014
    *return: true/false based on message insertion
   */
    public function insertNewMessageViewProfile(){
        $input = Input::all();
        $insertedMessageId = DB::table('user_messages')->insertGetId(
            array(
                'from_user_id'=>Auth::user()->id,
                'to_user_id'=>$input['to_id'],
                'message'=>$input['message'],
                'is_new'=>1,
                'sent_time'=>date('Y-m-d H:m:s'),
                'created_at'=>date('Y-m-d H:m:s'),
                'updated_at'=> date('Y-m-d H:m:s')
            )
        );
    }
    /*
    *function Name: showNotifications
    *Desc: Show Toastr Notificationto user
    *Created By: Sagar Acharya
    *Created Date: 3 March 2015
    *return: N/A
   */
    public function showNotifications()
    {
        $getNewMessages = Message::where('to_user_id', Auth::user()->id)->where('is_new',1)->where('toastr_notification',1)->get();
        if($getNewMessages->isEmpty()){
            return Response::json([
                'success'=>false
            ]);
        }else{
            $i = 0;
            $newMessage = array();
            foreach($getNewMessages as $message){
                $user = User::find($message->from_user_id);
                $newMessage[$i]['fromUserName'] = ucwords($user->user_first_name." ".$user->user_last_name);
                $i++;
                $getMessageFromId = Message::find($message->id);
                $getMessageFromId->toastr_notification = 0;
                $getMessageFromId->save();
            }
            return Response::json([
                'success'=>true,
                'message'=>$newMessage
            ]);
        }
    }
}
