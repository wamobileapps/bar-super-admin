<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Log;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use App\Models\AuthenticationModel;
use App\Models\BlockuserModel;
use App\Models\InviteUser;
use App\Models\UserEventModel;
use App\Models\UserFriendModel;
use App\Models\UserDrinkFavourite;
use App\Models\UserRequestModel;
use App\Models\UserChekinModel;
use App\Models\BareventModel;
use App\Models\BarModel;
use App\Models\NotificationModel;
use App\Models\RequestDrink;
use App\Models\BarEventSaveModel;
use App\Doors;
use App\UserDoors;
use App\Models\PaymentModel;
use App\Models\UserEventAddModel;
use Illuminate\Support\Facades\Validator;
use Session;
const LOGIN ="Login successfully";
const UserComplete ="User profile has been complete Successfully";
const USER_PROFILE_IMAGE ="User profile image has been uploaded successfully";
const USER_PROFILE_UPDATE ="User profile has been updated successfully";
const USER_PROFILE_GET ="User profile has been get Successfully";
const USERALL_PROFILE_GET ="All user profile has been get Successfully";
const WENTWRONG="Something went wrong";
const INVALIDEMAILPASSWORD="Invalid email or password";
const Vailid_time = '+20 minutes';
const Forget_password = "Forgot password link send your registered email address";
const INVAILID_ID="Invalid Id";
const LINKEXPIRED="Link Expired";
const SESSION_TIMEOUT = "Session Expired ";
const CHANGE_PASSWORD="Password changed successfully.";
const NOT_REGISTER="Email does not exist.";
const USER_ID_ERROR="User id is required.";
const BLOCK_USER="User block successfully";
const UNBLOCK_USER="User unblock successfully";
const FRIEND_ADDED="Friend added successfully";
const UNFRIEND="Unfriend  successfully";
const DRINK_ADDED="Drink added to favorites.";
const DRINK_REMOVED="Drink removed from favorites.";
const FRIEND_LISTED="Friend list get successfully";
const NOT_DATA_FOUND=" No Data Found. ";
const UNSAVED_EVENT=" Event removed successfully.";
const EVENT_SAVED="Event Saved Successfully";
const USER_EVENT_LIST="User events get successfully";
const USER_DRUNK_UPDATED ="User drunk level has been updtaed successfully.";

const FRIEND_ACCEPT ="Friend request Accepted successfully";
const FRIEND_REQ_ALREADY ="Request already sent to user !";
const FRIEND_REQ_SENT ="Friend request has been sent successfully.";
const FRIEND_REJECTED ="Friend request rejected successfully";
const SAVE_EVENT ="Get user saved event successfully";
const NOUSER_FOUND="No user found!";
const DELETE_SAVED_EVENT ="Saved event data deleted successfully";


// require_once('../vendor/stripe/stripe-php/init.php');


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if(!$request->user_id)
        {
            $responcearray = array('status' => 400, "success" => false, "message" =>USER_ID_ERROR, "result" => new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {


                $user = AuthenticationModel::select('*')
                                ->where('user_id', '=', $request->user_id)
                                ->get()->first();
                
                if (isset( $request->current_user_id) && $request->current_user_id) {

                    $user->isFriend = Controller::getUserFriend($request->user_id,$request->current_user_id);
                    
                }

                $date = date_create($user->dob);
                $user->dob = date_format($date,"m/d/Y");
                
                $count = $user->count();
                if($count > 0)
                {
                    $responcearray = array('status' => 200, "success" => true, "message" =>USER_PROFILE_GET, "result" =>$user);
                    return response()->json($responcearray, 200);
                }
                else
                {
                    $responcearray = array('status' => 400, "success" => false, "message" =>INVAILID_ID, "result" => new \stdClass());
                    return response()->json($responcearray, 400);
                }
        }
    }
public function inviteToGame(Request $request)

{
    // return $request->all();
    

    DB::table('t_user_invite')->insert(
    ['email' => 'john@example.com', 'votes' => 0]
);
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $post = $request->all();
          
        $rules = array(
                    "user_id" => "required", 
                    "age" => "required",
                    "dob" => "required",
                    "name" => "required",
                    "gender" => "required",
                    "favourite_drink" => "required",
                    // "interests" => "required",
                    // "mood_at_bar" => "required",
                    "relationship_status" => "required",
                    "orientation" => "required",
                    "profile_completed" => "required"
                );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {
            $post['full_name'] = $post['name'];
            unset($post['name']);
            $users = AuthenticationModel::where('user_id', $post['user_id'])->update($post);

            if($users)
            {
               
                // $responcearray = array('status' => 200, "success" => true, "message" =>USER_PROFILE_UPDATE, "result" =>$users);
                $user = AuthenticationModel::select('*')
                                ->where('user_id', '=', $post['user_id'])
                                ->get()->first();


                $count = $user->count();
                if($count > 0)
                {
                    $UserChekin = UserChekinModel::where('user_id', '=', $user['user_id'])
                                              ->get()->first();
                    if (!empty($UserChekin)) 
                    {

                        $getBar = BarModel::where('bar_id',$UserChekin['bar_id'])->get()->first();

                        if(!empty($getBar)){

                            $UserChekin['bar_name'] = Controller::getBarDetails($UserChekin['bar_id'])->name;
                            $UserChekin['time'] = date("h:i:s A", strtotime($UserChekin['created_at']));
                            unset($UserChekin['created_at']);
                            unset($UserChekin['updated_at']);
                            unset($UserChekin['id']);
                            $user['checkinDetail'] =$UserChekin;   

                        }else{
                            $user['checkinDetail'] =null;

                        }

                    }
                    else
                    {
                        $user['checkinDetail'] =null;                    
                    }

                    $responcearray = array('status' => 200, "success" => true, "message" =>USERALL_PROFILE_GET, "result" =>$user);
                    return response()->json($responcearray, 200);
                }
                else
                {
                    $responcearray = array('status' => 400, "success" => false, "message" =>INVAILID_ID, "result" => new \stdClass());
                    return response()->json($responcearray, 400);
                }
            }
            else
            {
               $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" => new \stdClass());
                return response()->json($responcearray, 400); 
            }
        }
    }
    
    public function updatedMood(Request $request)
    {
        $post = $request->all();
          
        $rules = array(
                    "user_id" => "required", 
                    "mood_at_bar" => "required",
                );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {
            $data = [ 'mood_at_bar' => $request->mood_at_bar ];
            $users = AuthenticationModel::where('user_id', $post['user_id'])->update($data);

            if($users)
            {
               
                // $responcearray = array('status' => 200, "success" => true, "message" =>USER_PROFILE_UPDATE, "result" =>$users);
                $user = AuthenticationModel::select('*')
                                ->where('user_id', '=', $post['user_id'])
                                ->get()->first();
                $count = $user->count();
                if($count > 0)
                {
                    $responcearray = array('status' => 200, "success" => true, "message" =>USERALL_PROFILE_GET, "result" =>$user);
                    return response()->json($responcearray, 200);
                }
                else
                {
                    $responcearray = array('status' => 400, "success" => false, "message" =>INVAILID_ID, "result" => new \stdClass());
                    return response()->json($responcearray, 400);
                }
            }
            else
            {
               $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" => new \stdClass());
                return response()->json($responcearray, 400); 
            }
        }
    }
    /**
     * Store a newly created resource in blockUser.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function blockUser(Request $request)
    {
        $post = $request->all();
          
        $rules = array(
                    "user_id" => "required", 
                    "block_user_id" => "required",
                    "block_reason" => "required",
                    "barID" => "barID"
                );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
     
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {
            $param = array(
                "user_id" => $post['user_id'],
                "block_user_id" => $post['block_user_id'],
                "block_reason" => $post['block_reason']
            ); 

            $get = BlockuserModel::select('*')
                                ->where('user_id', '=', $post['user_id'])
                                ->where('block_user_id', '=', $post['block_user_id'])
                                ->get();
            $count = $get->count();

            if($count > 0)
            {
                $blockUser = BlockuserModel::where('user_id', '=', $post['user_id'])
                                      ->where('block_user_id', '=', $post['block_user_id'])
                                      ->delete();
                $result['is_blocked']=false;
                $responcearray = array('status' => 200, "success" => true, "message" =>UNBLOCK_USER, "result" =>$result);
            }
            else
            {
                $blockUser = BlockuserModel::create($param);
                $blockUser['is_blocked']=true;
                
                $get = UserFriendModel::select('*')
                                ->where('user_id', '=', $post['user_id'])
                                ->where('friend_user_id', '=', $post['block_user_id'])
                                ->delete();
                 $get = UserFriendModel::select('*')
                                ->where('friend_user_id', '=', $post['user_id'])
                                ->where('user_id', '=', $post['block_user_id'])
                                ->delete();
                
                

                $responcearray = array('status' => 200, "success" => true, "message" =>BLOCK_USER, "result" =>$blockUser);
            }

            if($blockUser)
            {
                
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
                return response()->json($responcearray, 400);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($id)
    {
        if(empty($id))
        {
            $responcearray = array('status' => 400, "success" => false, "message" =>USER_ID_ERROR, "result" => new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {   
                $result  =  array();

                $user = AuthenticationModel::select('*')
                                ->get();


                foreach ($user as $key => $value) {
                    // return $value['user_id'];
                    $UserChekin = UserChekinModel::select('*')->where('user_id', $value['user_id'])->first();
                    if (!empty($UserChekin)) {
                        $value['bar_id'] = $UserChekin['bar_id'];
                        $value['is_blocked']= Controller::getBlockUser($id,$value['user_id']);
                        if($value['is_blocked'] == true){
                             unset($value[$key]);

                        }
                        $value['is_friend']= Controller::getUserFriend($id,$value['user_id']);
                        $result[]    = $value;
                    }
                }                
               
                if(!empty($user->first()))
                {
                    $responcearray = array('status' => 200, "success" => true, "message" =>USERALL_PROFILE_GET, "result" =>$result);
                    return response()->json($responcearray, 200);
                }
                else
                {
                    $responcearray = array('status' => 400, "success" => false, "message" =>INVAILID_ID, "result" => new \stdClass());
                    return response()->json($responcearray, 400);
                }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadProfilePhoto(Request $request)
    {
        $users =  new \stdClass();
        $post = $request->all();
          
        $rules = array(
            "user_id" => "required", 
            "profileImage" => "required" ,
            "useDefaultImage" => "required|boolean" 
        );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
     
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>$users);
            return response()->json($responcearray, 400);
        }
        else
        {
            
           
            $photoURL = '';

            $post['profileImage'] = '';
            $filename = time()."profileImage.jpg";
            $path = $request->file('profileImage')->move(public_path("/imageUpload"), $filename);
            $photoURL = url('/imageUpload/'.$filename);
            $post['profileImage'] = (!empty($photoURL)?$photoURL:'');
            if($request->useDefaultImage == 1){
                $post['profileImage'] = url('/imageUpload/defultImage.jpg');
            }
            unset($post['useDefaultImage']);
            $users = AuthenticationModel::where('user_id', $post['user_id'])->update($post);

            if($request->useDefaultImage != 1){
                $data = [
                    'image' => $post['profileImage'],
                    'user_id' => $post['user_id']
                ];
                $photowall = DB::table('t_user_images')->insert($data);
            }

            if($users)
            {
                $user = AuthenticationModel::select('*')
                                ->where('user_id', '=', $post['user_id'])
                                ->get()->first();

                $UserChekin = UserChekinModel::where('user_id', '=', $user['user_id'])
                                              ->get()->first();
                if (!empty($UserChekin)) 
                {

                    $getBar = BarModel::where('bar_id',$UserChekin['bar_id'])->get()->first();

                    if(!empty($getBar)){

                        $UserChekin['bar_name'] = Controller::getBarDetails($UserChekin['bar_id'])->name;
                        $UserChekin['time'] = date("h:i:s A", strtotime($UserChekin['created_at']));
                        unset($UserChekin['created_at']);
                        unset($UserChekin['updated_at']);
                        unset($UserChekin['id']);
                        $user['checkinDetail'] =$UserChekin;   

                    }else{
                        $user['checkinDetail'] =null;

                    }

                }
                else
                {
                    $user['checkinDetail'] =null;                    
                }

                $responcearray = array('status' => 200, "success" => true, "message" =>USER_PROFILE_IMAGE, "result" =>$user);
                return response()->json($responcearray, 200);
            }
            else
            {
               $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" => new \stdClass());
                return response()->json($responcearray, 400); 
            }
            
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $users =  new \stdClass();
        $post = $request->all();
          
        $rules = array(
            "user_id" => "required", 
            "dob" => "required", 
            "gender" => "required", 
            "relationship_status" => "required", 
            "favourite_drink" => "required", 
            "interests" => "required", 
            "about" => "required", 
            "status" => "required", 
        );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
     
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>$users);
            return response()->json($responcearray, 400);
        }
        else
        {
            $photoURL = '';

            if(isset($post['profileImage']) && !empty($post['profileImage']) )
            {
                $post['profileImage'] = 
                $filename = time()."profileImage.jpg";
                $path = $request->file('profileImage')->move(public_path("/imageUpload"), $filename);
                $photoURL = url('/imageUpload/'.$filename);
                $post['profileImage'] = (!empty($photoURL)?$photoURL:'');
            }
             


            $users = AuthenticationModel::where('user_id', $post['user_id'])->update($post);

            if($users)
            {
                $responcearray = array('status' => 200, "success" => true, "message" =>UserComplete, "result" =>$users);
                return response()->json($responcearray, 200);
            }
            else
            {
               $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" => new \stdClass());
                return response()->json($responcearray, 400); 
            }   
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getBlockedUserList($user_id = '')
    {
        if(empty($user_id))
        {
            $responcearray = array('status' => 400, "success" => false, "message" =>USER_ID_ERROR, "result" => array());
            return response()->json($responcearray, 400);
        }
        else
        {   
            $result = array();
            $user = AuthenticationModel::select('t_user.user_id','t_user.full_name as name','t_user.profileImage')
                                ->from('t_user')
                                ->join('t_user_block', 't_user.user_id', '=', 't_user_block.block_user_id')
                                ->where('t_user_block.user_id', '=', $user_id)
                                ->get();

            foreach ($user as $key => $value) {
            $value['is_blocked']= Controller::getBlockUser($user_id,$value['user_id']);
            $value['is_friend']= Controller::getUserFriend($user_id,$value['user_id']);
            $result[]    = $value;
            }                       

            
            if(!empty($user->first()))
            {
                $responcearray = array('status' => 200, "success" => true, "message" =>USER_PROFILE_GET, "result" =>$result);
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 400, "success" => false, "message" =>NOT_DATA_FOUND, "result" => array());
                return response()->json($responcearray, 400);
            }
        }
    }

    public function getInviteuser(Request $request)
    {

        $post = $request->all();
          
        $rules = array(
                    "sender_id" => "required", 
                    "receiver_id" => "required",
                    "bar_id" => "required",
                    "invitation_type" => "required",
                    "game_id" => "required",
                    "event_id" => "required",
                    "chat_message" => "required"
                );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {
            $post['invitation_type'] = ucfirst($post['invitation_type']);

            $bar = InviteUser::create($post);

            if($bar)
            {
                $responcearray = array('status' => 200, "success" => true, "message" =>BAR_ADD, "result" =>$bar);
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
            return response()->json($responcearray, 400);
            }


        }  
    }

    public function getInviteAccept(Request $request)
    {

        $post = $request->all();
          
        $rules = array(
                    "id" => "required", 
                    "receiver_id" => "required",
                    "status" => "required"
                );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {
            $bar = InviteUser::where('id', $post['id'])->update($post);
            
            if($bar)
            {
                $responcearray = array('status' => 200, "success" => true, "message" =>"Invite ", "result" =>$bar);
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
            return response()->json($responcearray, 400);
            }
        }  
    }

    public function destroy($id)
    {
        
    }

    public function addBarRatingUser()
    {
        $post = $request->all();

        $data = array();
          
        $rules = array(
            "user_id" => 'required',
            "rating" => 'required'
        );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" => new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {
            $bars = AuthenticationModel::where('user_id', $post['user_id'])->update($post);

            $responcearray = array('status' => 200, "success" => true, "message" =>BAR_GET_UPDATE, "result" => new \stdClass());
                return response()->json($responcearray, 200);
        }
    }


    public function addFriend(Request $request)
    {
        $post = $request->all();

        $data = array();
          
        $rules = array(
            "user_id" => 'required',
            "friend_user_id" => 'required'
        );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" => new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {
            DB::beginTransaction();
            try {

             if ($post['user_id'] == $post['friend_user_id']) {
               $result['is_friend']=false;
               return  $responcearray = array('status' => 200, "success" => true, "message" =>WENTWRONG, "result" =>$result);
            } 
            
            $param = array(
                "user_id" => $post['user_id'],
                "friend_user_id" => $post['friend_user_id']
            ); 

            $param['request_status'] = '0';

            $get = UserFriendModel::select('*')
                                ->where('user_id', '=', $post['user_id'])
                                ->where('friend_user_id', '=', $post['friend_user_id'])
                                ->get();
            $count = $get->count();

            if ($count == 0) {

                $get = UserFriendModel::select('*')
                                ->where('user_id', '=', $post['friend_user_id'])
                                ->where('friend_user_id', '=', $post['user_id'])
                                ->get();

                $count = $get->count();
                if ($count > 0) {

                    $post['user_id'] = $get[0]->user_id;
                    $post['friend_user_id'] = $get[0]->friend_user_id;
                           
                }       
            }

            if($count > 0)
            {
                $friendUser = UserFriendModel::where('user_id', '=', $post['user_id'])
                                      ->where('friend_user_id', '=', $post['friend_user_id'])
                                      ->delete();
                // $getRequest = UserRequestModel::select('*')
                //                       ->where('user_id', '=', $post['user_id'])
                //                       ->where('request_user_id', '=', $post['friend_user_id'])
                //                       ->first();
                // $notification = NotificationModel::where('frined_request_id', '=', $getRequest->request_id)->delete();

                $getRequest = UserRequestModel::select('*')
                                      ->where('user_id', '=', $post['user_id'])
                                      ->where('request_user_id', '=', $post['friend_user_id'])
                                      ->delete();
                      
                $result['is_friend']=false;
                $result['is_friend_request_sent']= Controller::getUserFriendRequest($post['user_id'],$post['friend_user_id']);
                $responcearray = array('status' => 200, "success" => true, "message" =>UNFRIEND, "result" =>$result);
            }
            else
            {


                $getRequest = UserRequestModel::select('*')
                                ->where('user_id', '=', $post['user_id'])
                                ->where('request_user_id', '=', $post['friend_user_id'])
                                ->get();
                
                if (empty($getRequest->first())) {

                    $getRequest = UserRequestModel::select('*')
                                ->where('user_id', '=', $post['friend_user_id'])
                                ->where('request_user_id', '=', $post['user_id'])
                                ->get();

                    $count = $getRequest->count();
                    if ($count > 0) {

                        $result['is_friend']=false;
                        $result['is_friend_request_sent']= Controller::getUserFriendRequest($post['user_id'],$post['friend_user_id']);
                        $responcearray = array('status' => 200, "success" => true, "message" =>"Request already sent to you !", "result" => $result);
                        return response()->json($responcearray, 200);
                    }

                    
                }

                if(!empty($getRequest->first()))
                {

                    $result['is_friend']=false;
                    $result['is_friend_request_sent']= Controller::getUserFriendRequest($post['user_id'],$post['friend_user_id']);
                    $responcearray = array('status' => 200, "success" => true, "message" =>FRIEND_REQ_ALREADY, "result" => $result);
                    return response()->json($responcearray, 200);
                }
                else
                {

                    $UserDetails = Controller::getUserDetails($post['user_id']);

                    $NotificationData['save_request']                   =  1;   

                    $NotificationData['title']                          = "Friend Request ";          
                    $NotificationData['body']                           = "".$UserDetails['full_name']." has sent you a friend request.";   

                    $NotificationData['description']                    =  $NotificationData['body'];   

                    $NotificationData['device_token']                   =  Controller::getUserDetails($post['friend_user_id'])->device_token; 
 
                    $NotificationData['user_id']                        =  $post['user_id'];   
                    $NotificationData['request_type']                   =  6;   //Friend Request
                    $NotificationData['request_user_id']                =  $post['friend_user_id'];   
                    $NotificationData['notfication_sendto_user_id']     =  $post['friend_user_id'];   
                    $NotificationData['request_status']                 =  0;   
                    $NotificationData['bar_id']                         =  null;   
                    $NotificationData['order_id']                       =  null;  
                    $NotificationData['event_id']                       =  null;   
                    $NotificationData['notification_type']              =  'friend_request';   
                            
                    
                    $NotificationData['data']                           =  array(
                                                                            "senders_name" => $UserDetails['full_name'],
                                                                            "senders_id" => $UserDetails['user_id'],
                                                                            "senders_image" => $UserDetails['profileImage'],
                                                                            "is_accepted" =>false,
                                                                   );               

                    $friendUser = Controller::sendUserRequest($NotificationData);

                    $result['is_friend']=false;
                    $result['is_friend_request_sent']= Controller::getUserFriendRequest($post['user_id'],$post['friend_user_id']);
                    $responcearray = array('status' => 200, "success" => true, "message" =>FRIEND_REQ_SENT, "result" => $result);
                }    

                // $friendUser = UserFriendModel::create($param);
                // $friendUser['is_friend']=true;
            }

            DB::commit();

            if($friendUser)
            {                
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
                return response()->json($responcearray, 400);
            }

            } catch (\Exception $e) {
                DB::rollback();
                $request->session()->flash('error', $e->getMessage());
                return back()->withInput();
            }
        }
    }

     public function removeFriend(Request $request)
     {

        $post = $request->all();

        $data = array();
          
        $rules = array(
            "user_id" => 'required',
            "friend_user_id" => 'required'
        );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" => new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {
            

             if ($post['user_id'] == $post['friend_user_id']) {
                 $result['is_friend']=false;
               return  $responcearray = array('status' => 200, "success" => true, "message" =>WENTWRONG, "result" =>$result);
            } 
            
            $param = array(
                "user_id" => $post['user_id'],
                "friend_user_id" => $post['friend_user_id']
            ); 

            // $param['request_status'] = '0';

            $get = UserFriendModel::select('*')
                                ->where('user_id', '=', $post['user_id'])
                                ->where('friend_user_id', '=', $post['friend_user_id'])
                                ->get();
            $count = $get->count();

            if ($count == 0) {
               $result['is_friend']=false;
               $responcearray = array('status' => 200, "success" => true, "message" =>"Friend already Removed", "result" =>$result);
            
                return response()->json($responcearray, 400);
            }

            if($count > 0)
            {
                $friendUser = UserFriendModel::where('user_id', '=', $post['user_id'])
                                      ->where('friend_user_id', '=', $post['friend_user_id'])
                                      ->delete();

               $getRequest = UserRequestModel::select('*')
                                      ->where('user_id', '=', $post['user_id'])
                                      ->where('request_user_id', '=', $post['friend_user_id'])
                                      ->first();
                if($getRequest)
                {
                $notification = NotificationModel::where('frined_request_id', '=', $getRequest->request_id)->delete();  
              

                  $getRequest = UserRequestModel::select('*')
                                      ->where('user_id', '=', $post['user_id'])
                                      ->where('request_user_id', '=', $post['friend_user_id'])
                                      ->delete();
                }
                      
                $result['is_friend']=false;
                $responcearray = array('status' => 200, "success" => true, "message" =>UNFRIEND, "result" =>$result);
            
                if($friendUser)
            {                
                return response()->json($responcearray, 200);
            }
              else
            {
                $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
                return response()->json($responcearray, 400);
            }
            }
            
        }

     }

    public function getFrinedsList($user_id)
    {
        if(empty($user_id))
        {
            $responcearray = array('status' => 400, "success" => false, "message" =>USER_ID_ERROR, "result" => array());
            return response()->json($responcearray, 400);
        }
        else
        {   
            $result = array();
            $user = AuthenticationModel::select('t_user.user_id','t_user_friends.user_id as f_user_id','t_user_friends.friend_user_id','t_user.full_name as name', 't_user.age as age', 't_user.profileImage')
                                ->from('t_user')
                                ->join('t_user_friends', 't_user.user_id', '=', 't_user_friends.friend_user_id')
                                ->where('t_user_friends.user_id', '=', $user_id)
                                ->orWhere('t_user_friends.friend_user_id', '=', $user_id)
                                ->get();
            
            foreach ($user as $key => $value) {
                $is_blocked = Controller::getBlockUser($user_id,$value['user_id']);
                $is_friend = Controller::getUserFriend($user_id,$value['user_id']);

                if ($is_friend == false) {
                    $userData = AuthenticationModel::select('t_user.user_id','t_user.full_name as name','t_user.profileImage', 't_user.age as age')
                                        ->where('user_id', '=', $value['f_user_id'])
                                        ->first();
                    $userData['is_blocked']= Controller::getBlockUser($user_id,$value['user_id']);
                    if($value['is_blocked'] == true){
                             unset($value[$key]);

                    }
                    $userData['is_friend']= true;
                } else {
                    $userData = AuthenticationModel::select('t_user.user_id','t_user.full_name as name','t_user.profileImage', 't_user.age as age',)
                                            ->where('user_id', '=', $value['user_id'])
                                            ->first();
                    $userData['is_blocked']= Controller::getBlockUser($user_id,$value['user_id']);
                    if($value['is_blocked'] == true){
                             unset($value[$key]);

                    }
                    $userData['is_friend']= $is_friend;

                }
                $result[]    = $userData;
            }  

            if(!empty($user->first()))
            {
                $responcearray = array('status' => 200, "success" => true, "message" =>FRIEND_LISTED, "result" =>$result);
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 400, "success" => false, "message" =>NOT_DATA_FOUND, "result" => array());
                return response()->json($responcearray, 400);
            }
        }
    }

    public function saveUserEvent(Request $request)
    {
        
$post = $request->all();
          
        $rules = array(
                    "user_id" => "required", 
                    "event_id" => "required",
                    "bar_id" => "required",
                );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
     
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {
            $param = array(
                "user_id" => $post['user_id'],
                "event_id" => $post['event_id'],
                "bar_id" => $post['bar_id']
            ); 

            $get = BarEventSaveModel::select('*')
                                ->where('user_id', '=', $post['user_id'])
                                ->where('event_id', '=', $post['event_id'])
                                ->where('bar_id', '=', $post['bar_id'])
                                ->get();
            $count = $get->count();

            if($count > 0)
            {
                $event = BarEventSaveModel::where('user_id', '=', $post['user_id'])
                                      ->where('event_id', '=', $post['event_id'])
                                      ->where('bar_id', '=', $post['bar_id'])
                                      ->delete();
                    $responcearray = array('status' => 200, "success" => true, "message" =>DELETE_SAVED_EVENT, "result" =>$event);
                return response()->json($responcearray, 200);
            }
            else
            {
                $event = BarEventSaveModel::create($param);
                $event['is_saved']=true;
            }

            if($event)
            {
                $responcearray = array('status' => 200, "success" => true, "message" =>SAVE_EVENT, "result" =>$event);
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
                return response()->json($responcearray, 400);
            }


        }



















        // $post = $request->all();
                  
        // $rules = array(
        //     "user_id" => 'required',
        //     "bar_id" => 'required',
        //     "event_id" => 'required'
        // );

        // $validator = Validator::make($post, $rules);

        // if($validator->fails())
        // {
        //     $errorString = implode(",",$validator->messages()->all());
        //     $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" => new \stdClass());
        //     return response()->json($responcearray, 400);
        // }
        // else
        // {
        //     $param = array(
        //         "user_id" => $post['user_id'],
        //         "bar_id" => $post['bar_id'],
        //         "event_id" => $post['event_id']
        //     ); 

            

        //     $get = UserEventModel::select('*')
        //                         ->where('user_id', '=', $post['user_id'])
        //                         ->where('event_id', '=', $post['event_id'])
        //                         ->where('bar_id', '=', $post['bar_id'])
        //                         ->get();
        //     $count = $get->count();

        //     if($count > 0)
        //     {
        //         $UserEvents = UserEventModel::where('user_id', '=', $post['user_id'])
        //                               ->where('event_id', '=', $post['event_id'])
        //                               ->where('bar_id', '=', $post['bar_id'])
        //                               ->delete();
        //         $result['is_event_saved']=false;
        //         $responcearray = array('status' => 200, "success" => true, "message" =>UNSAVED_EVENT, "result" =>$result);
        //     }
        //     else
        //     {
        //         $UserEvents = UserEventModel::create($param);
        //         $checked = BarModel::select('t_user.user_id','t_user.full_name as fullName','t_user.status','t_user.favourite_drink')
        //                                 ->from('t_checked_in_user')
        //                                 ->join('t_user', 't_checked_in_user.user_id', '=', 't_user.user_id')
        //                                 ->where('t_checked_in_user.bar_id', '=', $post['bar_id'])
        //                                 ->get();

        //         // $bar['checkedIn'] = $checked;
        //         $UserEvents['people_in'] = $checked->count();
        //         $UserEvents['possible_in'] = $checked->count();
        //         $UserEvents['is_event_saved']=true;
        //         $responcearray = array('status' => 200, "success" => true, "message" =>EVENT_SAVED, "result" =>$UserEvents);
        //     }

        //     if($UserEvents)
        //     {                
        //         return response()->json($responcearray, 200);
        //     }
        //     else
        //     {
        //         $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
        //         return response()->json($responcearray, 400);
        //     }
        // }
    }

    public function getUserEvents($user_id ='')
    {
        if(empty($user_id))
        {
            $responcearray = array('status' => 400, "success" => false, "message" =>USER_ID_ERROR, "result" => array());
            return response()->json($responcearray, 400);
        }
        else
        {   

            $events=array();
            $saved_event = BarEventSaveModel::where('user_id', '=', $user_id)
                            ->get();
            if( $saved_event)   
            {          
            foreach($saved_event as $event)
              {
        
            $bar = BarModel::where('bar_id', $event->bar_id)->first(); 
            if($bar)
            {
            $bar_event = BareventModel::where('event_id', $event->event_id)->first();  
            
            $event['bar_name']=$bar->name; 
            
            $event['event_name']=$bar_event->name;  
            $event['event_image']=$bar_event->image;  
            $event['event_description']=$bar_event->description;
            $event['event_start_date']=$bar_event->start_date;
            $event['event_end_date']=$bar_event->end_date;
            $event['event_start_time']=$bar_event->start_time;
            $event['event_end_time']=$bar_event->end_time;
            $event['is_saved']=true;
            
            array_push($events,$event);
            }

            }
        }
        else
            {
                $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>array());
                return response()->json($responcearray, 404);
            }   
            
        
            // $result = array();
            // $user = UserEventModel::select('*')                               
            //                     ->join('t_bar_event', 't_bar_event.event_id', '=', 't_add_user_event.event_id')
            //                     ->where('t_add_user_event.user_id', '=', $user_id)
            //                     ->where('t_bar_event.start_date', '>=', Carbon::now()->format('Y-m-d'))
            //                     ->get();
            
            // foreach ($user as $key => $value) {
            //     $value['is_event_saved']= Controller::getUserEvent($value['user_id']);
            //     $value['bar_name']= Controller::getBarDetails($value['bar_id'])->name;
            //     $value['people_in'] = UserEventModel::where('event_id', $value['event_id'])->get()->count();
            //     $value['possible_in'] = UserEventAddModel::where('event_id', $value['event_id'])->get()->count();

            //     $value['start_time'] = date('h:i A', strtotime($value['start_time']));
            //     $value['end_time'] = date('h:i A', strtotime($value['end_time']));

            //     if ($value['start_date'] == Carbon::now()->format('Y-m-d')) {
            //         $value['day'] = "Today";
            //     } elseif ($value['start_date'] == Carbon::tomorrow()->format('Y-m-d')) {
            //         $value['day'] = "Tomorrow";
            //     }else{
            //         $value['day'] = Carbon::createFromFormat("Y-m-d", $value['start_date'])->format('m/d/Y');
            //     }
            //     $result[]    = $value;
            }  
            if($events)
            {
               
                $responcearray = array('status' => 200, "success" => true, "message" =>SAVE_EVENT, "result" =>$events);
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>array());
                return response()->json($responcearray, 404);
            }   

            // if(!empty($user->first()))
            // {
            //     $responcearray = array('status' => 200, "success" => true, "message" =>USER_EVENT_LIST, "result" =>$result);
            //     return response()->json($responcearray, 200);
            // }
            // else
            // {
            //     $responcearray = array('status' => 400, "success" => false, "message" =>NOT_DATA_FOUND, "result" => array());
            //     return response()->json($responcearray, 400);
            // }
        
    }
    public function getFavoriteDrink($id)
    {
        if(empty($id))
        {
            
            $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>array());
            return response()->json($responcearray, 404);
        }
        else
        {
            $UserDrink = UserDrinkFavourite::select('*')->join('t_bar_menu', 't_user_drink_favourite.menu_id', '=', 't_bar_menu.menu_id')->where('user_id', '=', $id)->get();
            if($UserDrink){
                $responcearray = array('status' => 200, "success" => true, "message" =>"get favorite drinks successfully", "result" =>$UserDrink);
                return response()->json($responcearray, 200);                
            }else{
                $responcearray = array('status' => 400, "success" => false, "message" =>"No drink in favourite", "result" => new \stdClass());
                return response()->json($responcearray, 400);
            }

        }
    }

    public function addFavoriteUser(Request $request)
    {
        $post = $request->all();

        $data = array();
          
        $rules = array(
            "user_id" => 'required',
            "favourite_user_id" => 'required',
        );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" => new \stdClass());
            return response()->json($responcearray, 400);
        }
        $favUser = DB::table('t_user_favourite_user')->where(['user_id' => $request->user_id, 'favourite_user_id' => $request->favourite_user_id])->get();
        if($favUser->count() > 0)
            {
                $UserDrinkFav = DB::table('t_user_favourite_user')->where(['user_id' => $request->user_id, 'favourite_user_id' => $request->favourite_user_id])->delete();
                $favUser = DB::table('t_user_favourite_user')->where('user_id', $request->user_id)->get();
                $responcearray = array('status' => 200, "success" => true, "message" =>'User removed from favorites', "result" =>$favUser);
                return response()->json($responcearray, 200);
            }
            else
            {
                $data = [
                    'user_id' => $request->user_id,
                    'favourite_user_id' => $request->favourite_user_id,
                ];
                $UserDrinkFav = DB::table('t_user_favourite_user')->insert($data);
                $favUser = DB::table('t_user_favourite_user')->where('user_id', $request->user_id)->get();
                $responcearray = array('status' => 200, "success" => true, "message" =>"User added to favorites", "result" =>$favUser);
                return response()->json($responcearray, 200);
            }
    }

    public function getFavoriteUser($id)
    {
        if(empty($id))
        {
            
            $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>array());
            return response()->json($responcearray, 404);
        }
        $favUser = DB::table('t_user_favourite_user')->where('user_id', $id)->get();
        $responcearray = array('status' => 200, "success" => true, "message" =>"User added to favorites", "result" =>$favUser);
                return response()->json($responcearray, 200);
    }

    public function addUserPhotowall(Request $request)
    {
        $post = $request->all();

        $data = array();
          
        $rules = array(
            "user_id" => 'required',
            "image" => 'required|mimes:jpeg,jpg,png,gif'
        );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" => new \stdClass());
            return response()->json($responcearray, 400);
        }
        $photoURL = '';

        $post['image'] = '';
        $filename = time()."profileImage.jpg";
        $path = $request->file('image')->move(public_path("/imageUpload"), $filename);
        $photoURL = url('/imageUpload/'.$filename);
        $post['image'] = (!empty($photoURL)?$photoURL:'');
        $post['user_id'] = $request->user_id;
        $data = [
            'image' => $post['image'],
            'user_id' => $post['user_id']
        ];
        $photowall = DB::table('t_user_images')->insert($data);
        if($photowall){
            $photowall = DB::table('t_user_images')->where('user_id', $request->user_id)->get();
            $responcearray = array('status' => 200, "success" => true, "message" =>"User photowall added", "result" =>$photowall);
            return response()->json($responcearray, 200);
        }else{
            $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
            return response()->json($responcearray, 400);
        }
        
    }
    public function deletePhotowall(Request $request)
    {
        $post = $request->all();

        $data = array();
          
        $rules = array(
            "id" => 'required',
        );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" => new \stdClass());
            return response()->json($responcearray, 400);
        }

        $photowall = DB::table('t_user_images')->whereIn('id', $request->id)->delete();
        if($photowall){
            $photowall = DB::table('t_user_images')->where('user_id', $request->user_id)->get();
            $responcearray = array('status' => 200, "success" => true, "message" =>"User photowall deleted", "result" =>$photowall);
            return response()->json($responcearray, 200);
        }else{
            $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
            return response()->json($responcearray, 400);
        }
    }

    public function getUserPhotowall($id)
    {
        if(empty($id))
        {
            
            $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>array());
            return response()->json($responcearray, 404);
        }
        $photowall = DB::table('t_user_images')->where('user_id', $id)->get();
        $responcearray = array('status' => 200, "success" => true, "message" =>"User photowall get successful", "result" =>$photowall);
                return response()->json($responcearray, 200);
    }

    public function addRemoveFavoriteDrink(Request $request)
    {
        $post = $request->all();

        $data = array();
          
        $rules = array(
            "user_id" => 'required',
            "bar_id" => 'required',
            "menu_id" => 'required'
        );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" => new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {
            $param = array(
                "user_id" => $post['user_id'],
                "bar_id" => $post['bar_id'],
                "menu_id" => $post['menu_id']
            ); 


            $get = UserDrinkFavourite::select('*')
                                ->where('user_id', '=', $post['user_id'])
                                ->where('bar_id', '=', $post['bar_id'])
                                ->where('menu_id', '=', $post['menu_id'])
                                ->get();
            $count = $get->count();

            if($count > 0)
            {
                $UserDrinkFav = UserDrinkFavourite::where('user_id', '=', $post['user_id'])
                                      ->where('bar_id', '=', $post['bar_id'])
                                      ->where('menu_id', '=', $post['menu_id'])
                                      ->delete();
                $result['is_favorite']=false;
                $responcearray = array('status' => 200, "success" => true, "message" =>DRINK_REMOVED, "result" =>$result);
                return response()->json($responcearray, 200);
            }
            else
            {
                $UserDrinkFav = UserDrinkFavourite::create($param);
                $UserDrinkFav['is_favorite']=true;
                $responcearray = array('status' => 200, "success" => true, "message" =>DRINK_ADDED, "result" =>$UserDrinkFav);
                return response()->json($responcearray, 200);
            }

            if($UserDrinkFav)
            {      
                $responcearray = array('status' => 200, "success" => true, "message" =>DRINK_ADDED, "result" =>$UserDrinkFav);          
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
                return response()->json($responcearray, 400);
            }
        }
    }

     public function updateDrunkLevel(Request $request)
    {
        $post = $request->all();        
          
        $rules = array(

            "user_id" => 'required',
            "drunk_level" => 'required'
        );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" => new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {
            $param = array(
                "user_id" => $post['user_id'],
                "drunk_level" => $post['drunk_level'],
                'updated_at'=> Date("Y-m-d H:i:s")               
            ); 


            $UpdateStatus = AuthenticationModel::where('user_id', $post['user_id'])
                ->update($param);

            if($UpdateStatus)
            {  

                $getData = AuthenticationModel::where('user_id', $post['user_id'])
                ->first();

                $UserChekin = UserChekinModel::where('user_id', '=', $getData['user_id'])
                                              ->get()->first();
                if (!empty($UserChekin)) 
                {

                    $getBar = BarModel::where('bar_id',$UserChekin['bar_id'])->get()->first();

                    if(!empty($getBar)){

                        $UserChekin['bar_name'] = Controller::getBarDetails($UserChekin['bar_id'])->name;
                        $UserChekin['time'] = date("h:i:s A", strtotime($UserChekin['created_at']));
                        unset($UserChekin['created_at']);
                        unset($UserChekin['updated_at']);
                        unset($UserChekin['id']);
                        $getData['checkinDetail'] =$UserChekin;   

                    }else{
                        $getData['checkinDetail'] =null;

                    }

                }
                else
                {
                    $getData['checkinDetail'] =null;                    
                }

                $responcearray = array('status' => 200, "success" => true, "message" =>USER_DRUNK_UPDATED, "result" => $getData);             
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" => new \stdClass());
                return response()->json($responcearray, 400);
            }
        }
    }

     public function acceptOrRejectFriendRequest(Request $request)
    {
        $updateStatus =  new \stdClass();
        $post = $request->all();
          
        $rules = array(
                "user_id" => "required",                 
                "senders_id" => "required", 
                "is_accepted" => "required", 
            );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {     
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>$updateStatus);
            return response()->json($responcearray, 400);
        }
        else
        {
            // $post['order_id']= explode(',', $post['order_id']);
            $updateData = array(
                'request_status'=>$post['is_accepted'],
                'updated_at'=> Date("Y-m-d H:i:s")
            );

            $updateStatus = tap(UserRequestModel::where('user_id', $post['senders_id'])
                        ->where('request_user_id', $post['user_id'])                         
                        ->where('request_type','=', 6))
            ->update($updateData)
            ->first();
                 

            if($updateStatus)
            {
                  
                $getRequest = UserRequestModel::select('*')
                                      ->where('user_id', '=', $post['senders_id'])
                                      ->where('request_user_id', '=', $post['user_id'])
                                      ->first();
                $notification = NotificationModel::where('frined_request_id', '=', $getRequest->request_id)->delete();

                
                if ($updateStatus->request_status == 1) {
                    
                    $param =array(
                        "user_id"=>$updateStatus->user_id,
                        "friend_user_id"=>$updateStatus->request_user_id,
                        "request_status"=>'1'
                    );                

                    UserFriendModel::updateOrCreate($param);

                    $UserDetails = Controller::getUserDetails($post['user_id']);


                    $NotificationData['title']                          = "Friend Request Accepted";          

                    $NotificationData['body']                           = "".$UserDetails['full_name']." has Accepted your friend request.";   

                    $NotificationData['description']                    =  $NotificationData['body'];   

                    $NotificationData['device_token']                   =  Controller::getUserDetails($post['senders_id'])->device_token;   
                    $NotificationData['user_id']                        =  $post['user_id'];   
                    $NotificationData['request_type']                   =  0;   //Friend Request
                    $NotificationData['request_user_id']                =  $post['senders_id'];   
                    $NotificationData['notfication_sendto_user_id']     =  $post['senders_id'];   
                    $NotificationData['request_status']                 =  0;   
                    $NotificationData['bar_id']                         =  null;   
                    $NotificationData['order_id']                       =  null;  
                    $NotificationData['event_id']                       =  null;   
                    $NotificationData['notification_type']              =  'accepte_request';   
                            
                    
                    $NotificationData['data']                           =  array(
                                                                            "senders_name" => $UserDetails['full_name'],
                                                                            "senders_id" => $UserDetails['user_id'],
                                                                            "senders_image" => $UserDetails['profileImage'],
                                                                            "is_accepted" =>false,
                                                                            );              

                    $friendUser = Controller::sendUserRequest($NotificationData);
                    $result['is_friend']=true;
                    
                    $responcearray = array('status' => 200, "success" => true, "message" =>FRIEND_ACCEPT, "result" => new \stdClass());

                }elseif ($updateStatus->request_status == 2) {

                    $getRequest = UserRequestModel::select('*')
                                      ->where('user_id', '=', $post['senders_id'])
                                      ->where('request_user_id', '=', $post['user_id'])
                                      ->delete();
                    
                    $responcearray = array('status' => 200, "success" => true, "message" =>FRIEND_REJECTED, "result" => new \stdClass());

                }else{

                    $responcearray = array('status' => 400, "success" => false, "message" =>WENT_WRONG, "result" => new \stdClass());

                }
                
                return response()->json($responcearray, 200);
            }
            else
            {
               $responcearray = array('status' => 400, "success" => false, "message" =>WENT_WRONG, "result" => new \stdClass());
                return response()->json($responcearray, 400); 
            }   
        }
    }
    public function seachUserByName(Request $request)
    {
        $post = $request->all();
          
        $rules = array(        
            "search" => 'required',         
            "user_id" => 'required',         
        );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>array());
            return response()->json($responcearray, 400);
        }
        else
        {
            $users = AuthenticationModel::select('*')
                            ->where('t_user.full_name', 'LIKE', "%{$post['search']}%")
                            ->get();
            $count = $users->count();
            if($count > 0)
            {
                $result = array();
                foreach ($users as $key => $value) {  

                $userData['is_blocked']= Controller::getBlockUser($post['user_id'],$value['user_id']);
                if($value['is_blocked'] == true){
                         unset($value[$key]);

                }                   

                    $result[] = $value;   
                }


                if(!empty($result))
                {
                   $responcearray = array('status' => 200, "success" => true, "message" => "Data get successfully", "result" =>$result); 
                }
                else
                {
                    $responcearray = array('status' => 404, "success" => false, "message" =>NOUSER_FOUND, "result" => new \stdClass());
                }     

            }          
            else
            {
                $responcearray = array('status' => 404, "success" => false, "message" =>NOUSER_FOUND, "result" => new \stdClass());
            }     

            return response()->json($responcearray, 200);
                
        }
    }

    public function seachUserByEmail(Request $request)
    {
        $post = $request->all();
          
        $rules = array(        
            "search" => 'required'           
        );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>array());
            return response()->json($responcearray, 400);
        }
        else
        {
            $users = AuthenticationModel::select("user_id","username","full_name","email","dob","ageRange","password","gender","relationship_status","age","profileImage","paymentMode","favourite_drink","interests","about","rating","mood_at_bar","drunk_level","orientation","profile_completed" )
                            ->where('t_user.email', 'LIKE', "%{$post['search']}%")
                            ->get()->first();
           
           
            if(!empty($users))
            {
               $responcearray = array('status' => 200, "success" => true, "message" => "Data get successfully", "result" =>$users); 
            }
            else
            {
                $responcearray = array('status' => 404, "success" => false, "message" =>NOUSER_FOUND, "result" => new \stdClass());
            }                 
             

            return response()->json($responcearray, 200);
                
        }
    }

    public function userCheckInCheckOut(Request $request)
    {

        $post = $request->all();

        $data = array();
          
        $rules = array(
            "bar_id" => 'required',
            "user_id" => 'required',
            "flag" => 'required'
        );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" => new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {

            
                if($post['flag'] == false)
                {
                    $User = UserChekinModel::where('user_id', '=', $post['user_id'])
                                          ->where('bar_id', '=', $post['bar_id'])                                      
                                          ->delete();
                    
                    $responcearray = array('status' => 200, "success" => true, "message" =>"User has been checkout successfully.", "result" =>new \stdClass());
                }
                elseif($post['flag'] == true)
                {   

                    $UserAlready = UserChekinModel::where('user_id', '=', $post['user_id'])
                                              ->where('bar_id', '=', $post['bar_id'])
                                              ->get()->first();

                    if (!empty($UserAlready)) 
                    {
                            $responcearray = array('status' => 400, "success" => false, "message" =>"User already checked in.", "result" =>new \stdClass());
                            return response()->json($responcearray, 400);        exit;                           
                    }

                    $delete = UserChekinModel::where('user_id', '=', $post['user_id'])->delete();

                    unset($post['flag']);

                    $User = UserChekinModel::create($post);                    

                    $User['bar_name'] = Controller::getBarDetails($User['bar_id'])->name;
                    $User['time'] = date("h:i:s A", strtotime($User['created_at']));

                    unset($User['created_at']);
                    unset($User['updated_at']);
                    unset($User['id']);
                    $event_id = BareventModel::where('bar_id', $request->bar_id)->first();
                    
                    if(!empty($event_id)){
                        $data = [
                            'user_id' => $request->user_id,
                            'bar_id' => $request->bar_id,
                            'event_id' => $event_id->event_id,
                            'checkin_date' => Date("Y-m-d"),
                            'checkin_time' => Date("H:i:s"),
                        ];
                        
                        $eventdata = DB::table('t_user_event_checkin')->insert($data); 
                    }  

                    $responcearray = array('status' => 200, "success" => true, "message" =>"User has been check in successfully.", "result" =>$User);
                }   

                if($User)
                {                
                    return response()->json($responcearray, 200);
                }
                else
                {
                    $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
                    return response()->json($responcearray, 400);
                }
                                         
        }
    }

//public function sendnotification($devicetoken){
//    $fields = array
//    (
//        'to' =>$devicetoken,
//        // 'to' => 'csPKzyMUTaW5Dzfh6pjtgO:APA91bFupdjOOVutjoGCn1yh2R-Ky2p2ZMUJpq73q85rnUs21nFPm3r7NmWY5QrCw0JrCyjfeQJDX55kFEuqpDJqyKCPS3BtREGPUOhLtyzPKoNEpqcMjoL3VIuWkb-KpO_O0ZtQd0TK',
//        'notification'  => $msg,
//        'data' => $request->payload
//    );
//    $headers = array
//    (
//        'Authorization: key=' . SERVER_KEY,
//        'Content-Type: application/json'
//    );
//
//    $ch = curl_init();
//    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
//    curl_setopt( $ch,CURLOPT_POST, true );
//    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
//    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
//    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
//    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
//    $result = curl_exec($ch );
//    if ($result === FALSE)
//    {
//        $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
//        return response()->json($responcearray, 400);
//    }
//    curl_close( $ch );
//
//    $getNotify = json_decode($result);
//
//    \Log::info("game", array('msg' => $getNotify));
//
//
//
//}
    public function requestDrink(Request $request)
    {
        
     // return $users = AuthenticationModel::where('user_id', $request->to_user_id)->first();
     // return $Requestusers = AuthenticationModel::where('user_id', $request->from_user_id)->first(); 

        $post = $request->all();
        $bar=BarModel::where('bar_id',$request->bar_id)->first();
    	$rules = array(

            'from_user_id' => 'required',
            'to_user_id' => 'required',
            "items" => "required",
            
        );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {
            $ids=array();
            foreach ($request->items as $items) {


                $data = [
                    'from_user_id' => $request->from_user_id,
                    'to_user_id' => $request->to_user_id,
                    'drink_id' => $items['item_id'],
                    'qty' => $items['qty'],
                    'status' => 0
                ];
                $save  = RequestDrink::create($data);
                $ids[] =$save->id;


            }
           $ids=  json_encode($ids);

            $param = array(
                "title" => 'Request For items',
                "bar_id" => $request->bar_id,
                "request_drink_id" => $ids,
                "user_id"=>$request->to_user_id,
                "description" => '',
                "notification_type"=>'Drink'
            );
            $data =NotificationModel::create($param);
            if($save){
                $Requestusers = AuthenticationModel::where('user_id', $request->from_user_id)->first();
               $users = AuthenticationModel::where('user_id', $request->to_user_id)->first();
               
                // $barname=BarModel::where('bar_id',$request->bar_id)->first();
                $notifyData = array(
                    "title"=> "Request for items",
                    "body"=> $Requestusers->full_name. " send you items from ".$bar->name. " Bar" ,
                    "device_token"=>$users->device_token,
                     
                    'data'=>[]
                );
                if ($users->device_type == "android") 
                {


                    $getNotify = $this->android($notifyData);   
                }
                elseif ($users->device_type == "ios") 
                {
                    // $getNotify = $this->ios($notifyData);
                    $getNotify = Controller::notificationApn($notifyData);
                    
                }
                    $responcearray = array('status' => 200, "success" => true, "message" =>'Request send successfully');
                    return response()->json($responcearray, 200);
                }else{
                    $responcearray = array('status' => 400, "success" => false, "message" => 'somthing went wrong', "result" => new Doors());
                    return response()->json($responcearray, 400);
                }
        }
    }
    public function sendDrink(Request $request)
    {
        $post = $request->all();

    	$rules = array(

            'user_id' => 'required',
            "request_id" => "required", 
            
        );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {
            $data = [
                'status' => 1
            ];
            $save = DB::table('request_drink')->where('id',$request->request_id)->update($data);
            if($save){
                
                    $responcearray = array('status' => 200, "success" => true, "message" =>'Drink send successfully', "result" => $save);
                    return response()->json($responcearray, 200);
                }else{
                    $responcearray = array('status' => 400, "success" => false, "message" => 'somthing went wrong', "result" => new Doors());
                    return response()->json($responcearray, 400);
                }
        }
    }

    public function requestDrinkList($id)
    {
        $list =  DB::table('request_drink')->where('from_user_id', $id)->get();
        if(!empty($list)){
                
            $responcearray = array('status' => 200, "success" => true, "message" =>'Requested drink list get successfully', "result" => $list);
            return response()->json($responcearray, 200);
        }else{
            $responcearray = array('status' => 400, "success" => false, "message" => 'somthing went wrong', "result" => new Doors());
            return response()->json($responcearray, 400);
        }
    }
    public function sendDrinkList($id)
    {
        $list =  DB::table('request_drink')->where('to_user_id', $id)->get();
        if(!empty($list)){
                
            $responcearray = array('status' => 200, "success" => true, "message" =>'send drink list get successfully', "result" => $list);
            return response()->json($responcearray, 200);
        }else{
            $responcearray = array('status' => 400, "success" => false, "message" => 'somthing went wrong', "result" => new Doors());
            return response()->json($responcearray, 400);
        }
    }
    public function android($parms) {        

        $msg = array
        (
            'title'     => $parms['title'],
            'body'      => $parms['body'],
            'vibrate'   => 1,
            'sound'     => 1,
            'largeIcon' => 'large_icon',
            'smallIcon' => 'small_icon'
        );

        $fields = array
        (
            'to' => $parms['device_token'],
            'notification'  => $msg,
//            'data' => $parms['data']
        );

//        print_r(json_encode( $fields ));die;

        $headers = array
        (
            'Authorization: key=' . SERVER_KEY,
            'Content-Type: application/json'
        ); 

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );

        if ($result === FALSE) 
        {
               die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close( $ch );
        
        return json_decode($result);
    }

    public function ios($parms)
    {
       
        // $apnsPem = resource_path('ios_apns/cert.pem');
        // $passphrase = resource_path('ios_apns/cert.p12');


            $deviceToken = $parms['device_token']; //  iPad 5s Gold prod


                        // Put your private key's passphrase here:
            $passphrase = '1234';
            $pemfilename = resource_path('ios_apns/cert.pem');
            $body['aps'] = array(
            'alert' => array(
            'title' => $parms['title'],
            'body' => $parms['body'],
            'data' => $parms['data']
            ),
            // 'badge' => $parms['badgeCount'],
            'sound' => 'default',
            ); 
            // Create the payload body            ////////////////////////////////////////////////////////////////////////////////            

            $ctx = stream_context_create();
            stream_context_set_option($ctx, 'ssl', 'local_cert', $pemfilename);
            stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);           
            $fp = stream_socket_client(
            'ssl://gateway.sandbox.push.apple.com:2195', $err,
            $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx); // Open a connection to the APNS server
            if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);
            'Connected to APNS' . PHP_EOL;
            $payload = json_encode($body); // Encode the payload as JSON
            $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload; // Build the binary notification
            $result = fwrite($fp, $msg, strlen($msg)); // Send it to the server
            if (!$result)
            return false;
            else
            return array("status"=>1);

            fclose($fp); // Close the connection to the server  
       
    }
    public function getUserDoor(Request $request)
    {
        $updateStatus =  new \stdClass();
        $post = $request->all();
          
        $rules = array(
                "user_id" => "required",     
            );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>$updateStatus);
            return response()->json($responcearray, 400);
        }
        else
        {
            $UpdateStatus = AuthenticationModel::where('user_id', $post['user_id'])->first();
            $doors = UserDoors::where('user_id', $UpdateStatus->id)->get();
            if(!$doors->isEmpty()){
                $responcearray = array('status' => 200, "success" => true, "message" =>'Doors get successfully', "result" =>$doors);
                return response()->json($responcearray, 200);
            }else{
                $responcearray = array('status' => 400, "success" => false, "message" => 'somthing went wrong', "result" => new Doors());
                return response()->json($responcearray, 400);
            }

        }
    }
    public function addDoor(Request $request)
    {

    	$post = $request->all();

    	$rules = array(

            'user_id' => 'required',
            "door_id" => "required|exists:doors,id", 
            'stripeToken' => 'required',
            'totalPrice' => 'required',
            'currency' => 'required',
        );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {        	

			    
		        $statusMsg = ''; 
				// Check whether stripe token is not empty 
				if(!empty($post)){ 
				     
				    // Retrieve stripe token, card and user info from the submitted form data 
				    $token  = $post['stripeToken']['tokenId'];  
			        // Convert price to cents 
			        $itemPriceCents = ($post['totalPrice']*100); 

			        $currency = $post['currency'];
			        
			        $description = "test example";
	
				    if($token){  
				         
				       
				    try {  

				  		// Set API key 
				   		 \Stripe\Stripe::setApiKey('sk_test_51HXuykItWqDMUx2bghadvw0rk9RekGmleEYqQTmcXnyHaJ7IULXPy5pMcxahi4vcNKLYyo5gkLg8txC7hUiRlczf00aSfMw1G5');
				           
				        $charge = \Stripe\Charge::create(array( 
				                'card' => $token, 
				                'amount'   => $itemPriceCents, 
				                'currency' => $currency, 
				                'description' => $description
				        ));

				        }catch(\Stripe\Exception\CardException $e) {
						  // Since it's a decline, \Stripe\Exception\CardException will be caught
						  $api_error['Status is'] = $e->getHttpStatus();
						  $api_error['Type is'] = $e->getError()->type;
						  $api_error['Code is'] = $e->getError()->code;
						  // param is '' in this case
						  $api_error['Param is'] = $e->getError()->param;
						  $api_error['Message is'] = $e->getError()->message;
						} catch (\Stripe\Exception\RateLimitException $e) {
						  // Too many requests made to the API too quickly
						  $api_error = $e->getMessage();
						} catch (\Stripe\Exception\InvalidRequestException $e) {
						  // Invalid parameters were supplied to Stripe's API
						  $api_error = $e->getMessage();
						} catch (\Stripe\Exception\AuthenticationException $e) {
						  // Authentication with Stripe's API failed
						  // (maybe you changed API keys recently)
						  $api_error = $e->getMessage();
						} catch (\Stripe\Exception\ApiConnectionException $e) {
						  // Network communication with Stripe failed
						  $api_error = $e->getMessage();
						} catch (\Stripe\Exception\ApiErrorException $e) {
						  // Display a very generic error to the user, and maybe send
						  // yourself an email
						  $api_error = $e->getMessage();
						} catch (Exception $e) {
						  // Something else happened, completely unrelated to Stripe
						  $api_error = $e->getMessage();
						}
				         
				        if(empty($api_error) && $charge){ 
				         
				            // Retrieve charge details 
				            $chargeJson = $charge->jsonSerialize(); 
				         
				            // Check whether the charge is successful 
				            if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){ 
				                // Transaction details  
				                $transactionID = $chargeJson['balance_transaction']; 
				                $paidAmount = $chargeJson['amount']; 
				                $paidAmount = ($paidAmount/100); 
				                $paidCurrency = $chargeJson['currency']; 
				                $payment_status = $chargeJson['status']; 
				                 
				                // Include database  
				                $payementData = array(
				                	"user_id"=>$post['user_id'],
				                	"bar_id"=>0,
				                	"bar_id"=>$post['door_id'],
									"transaction_id"=>$transactionID,
									"amount"=>$paidAmount
				                );


				                $PayementSave =  PaymentModel::create($payementData);
				                $payment_id =  $PayementSave->id;

				                $order_pin= $this->generateNumericOTP(4);
								
				                // If the order is successful 
				                if($payment_status == 'succeeded'){ 
				                    
					                $UpdateStatus = AuthenticationModel::where('user_id', $post['user_id'])->first();
                                    $UserDoors = new UserDoors();
                                    $UserDoors->user_id = $UpdateStatus->id;
                                    $UserDoors->door_id = $request->door_id;
                                    if($UserDoors->save()){
                                        $doors = UserDoors::where('user_id', $UpdateStatus->id)->get();
                                        $responcearray = array('status' => 200, "success" => true, "message" =>'Doors Save successfully', "result" =>$doors);
                                        return response()->json($responcearray, 200);
                                    }else{
                                        $responcearray = array('status' => 400, "success" => false, "message" => 'somthing went wrong', "result" => new Doors());
                                        return response()->json($responcearray, 400);
                                    }

				                }else{ 
				                    $statusMsg = "Your Payment has Failed!"; 
				                    $responcearray = array('status' => 400, "success" => false, "message" =>$statusMsg, "result" =>$chargeJson);
				                } 
				            }else{ 
				                $statusMsg = "Transaction has been failed!"; 
				                $responcearray = array('status' => 400, "success" => false, "message" =>$statusMsg, "result" =>$chargeJson);
				            } 
				        }else{ 
				            $statusMsg = "Charge creation failed";  
				            $responcearray = array('status' => 400, "success" => false, "message" =>$statusMsg, "result" =>$api_error);
				        } 
				    }else{  
				        $statusMsg = "Invalid card details."; 
				        $responcearray = array('status' => 400, "success" => false, "message" =>$statusMsg, "result" =>$api_error); 
				    } 
				}else{ 
				    $statusMsg = "Error on form submission."; 
				    $responcearray = array('status' => 400, "success" => false, "message" =>$statusMsg, "result" =>$api_error);
				} 
		    return response()->json($responcearray, 400);
		}
	}

    public function generateNumericOTP($n) 
    {     
        
        $generator = "1357902468";         

        $result = ""; 

        for ($i = 1; $i <= $n; $i++) { 
        $result .= substr($generator, (rand()%(strlen($generator))), 1); 
        } 
     
        return $result; 

    }    



    public function notification()
    {
        // $apnsPem = resource_path('ios_apns/cert.pem');
        // $passphrase = resource_path('ios_apns/cert.p12');
        $msg = [
            'aps' => [
                'alert' => [
                    'body' => "test Msg"
                ],
                'sound' => 'default',
                'badge' => 1

            ],
            'extraPayLoad' => [
                'custom' => "No page"
            ]
            ];
            $message = json_encode($msg);

        $keyfile = app_path().'/ios_apns/AuthKey_C63QBQ8Y7T.p8';               # <- Your AuthKey file
        $keyid = 'C63QBQ8Y7T';                            # <- Your Key ID
        $teamid = '2ZRFJYMMPY';                           # <- Your Team ID (see Developer Portal)
        $bundleid = 'com.canopus.dronelogbook';                # <- Your Bundle ID
        $url = 'https://api.development.push.apple.com';  # <- development url, or use http://api.push.apple.com for production environment
        $token = "7843D6031210F27581F67AE85B129CE92397B9FDCDDEE6B7B84E8C2E3611315B";              # <- Device Token
        
        $key = openssl_pkey_get_private('file://'.$keyfile);
      
        $header = ['alg'=>'ES256','kid'=>$keyid];
        $claims = ['iss'=>$teamid,'iat'=>time()];
      
        $header_encoded = $this->base64($header);
        $claims_encoded = $this->base64($claims);
      
        $signature = '';
        openssl_sign($header_encoded . '.' . $claims_encoded, $signature, $key, 'sha256');
        $jwt = $header_encoded . '.' . $claims_encoded . '.' . base64_encode($signature);
        if (!defined('CURL_HTTP_VERSION_2_0')) {
            define('CURL_HTTP_VERSION_2_0', 3);
        }
      
        $http2ch = curl_init();
        curl_setopt_array($http2ch, array(
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
          CURLOPT_URL => "$url/3/device/$token",
          CURLOPT_PORT => 443,
          CURLOPT_HTTPHEADER => array(
            "apns-topic: {$bundleid}",
            "authorization: bearer $jwt"
          ),
          CURLOPT_POST => TRUE,
          CURLOPT_POSTFIELDS => $message,
          CURLOPT_RETURNTRANSFER => TRUE,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HEADER => 1
        ));
      
        $result = curl_exec($http2ch);
        // return $result;
        // \Log::info('sent');
        dd($result);
        return $result;
    }
    function base64($data) {
        return rtrim(strtr(base64_encode(json_encode($data)), '+/', '-_'), '=');
    }


     public function moodAtBar(Request $request)
    {
        $post = $request->all();
          
        $rules = array(
                    "mood_at_bar" => "required",
                );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {

            $users = AuthenticationModel::where('user_id', $post['user_id'])->update($post);

            if($users)
            {
               
                // $responcearray = array('status' => 200, "success" => true, "message" =>USER_PROFILE_UPDATE, "result" =>$users);
                $user = AuthenticationModel::select('*')
                                ->where('user_id', '=', $post['user_id'])
                                ->get()->first();
                $count = $user->count();
                if($count > 0)
                {

                    $UserChekin = UserChekinModel::where('user_id', '=', $user['user_id'])
                                              ->get()->first();
                    if (!empty($UserChekin)) 
                    {

                        $getBar = BarModel::where('bar_id',$UserChekin['bar_id'])->get()->first();

                        if(!empty($getBar)){

                            $UserChekin['bar_name'] = Controller::getBarDetails($UserChekin['bar_id'])->name;
                            $UserChekin['time'] = date("h:i:s A", strtotime($UserChekin['created_at']));
                            unset($UserChekin['created_at']);
                            unset($UserChekin['updated_at']);
                            unset($UserChekin['id']);
                            $user['checkinDetail'] =$UserChekin;   

                        }else{
                            $user['checkinDetail'] =null;

                        }

                    }
                    else
                    {
                        $user['checkinDetail'] =null;                    
                    }

                    $responcearray = array('status' => 200, "success" => true, "message" =>USERALL_PROFILE_GET, "result" =>$user);
                    return response()->json($responcearray, 200);
                }
                else
                {
                    $responcearray = array('status' => 400, "success" => false, "message" =>INVAILID_ID, "result" => new \stdClass());
                    return response()->json($responcearray, 400);
                }
            }
            else
            {
               $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" => new \stdClass());
                return response()->json($responcearray, 400); 
            }
        }
    }



}

