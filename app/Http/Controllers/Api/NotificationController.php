<?php

namespace App\Http\Controllers\Api;
// use Illuminate\Support\Facades\Request;
// use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use App\Models\AuthenticationModel;
use App\Models\UserRequestModel;
use App\Models\NotificationModel;
use App\Models\BareventModel;
use App\Models\BarorderModel;
use App\Models\BarModel;
use App\Models\GameModel;
use App\Models\BargameModel;
use App\Models\BarmenuModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Session;

    const EVENT_NOT_FOUND="Event Not Found";
    const NOTIFY_SUCCESS="Notification  Sent Successfully";
    const IVALID_SENDTO="Invalid Send Option";
    const WENT_WRONG="Something Went Wrong";
    const NOTIFY_GOT="Notification Get Successfully";
    const NOT_DATA_FOUND=" No Data Found. ";
    const FRIEND_REJECTED ="Game request rejected successfully";




class NotificationController extends Controller
{
    public function __construct()
    {
       
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    { 

        $post = $request->all();


        $rules = array(
            
            "bar_id" => "required",            
            "event" => "required",
            "send_to"=>"required"            
        );

       // print_r($post);exit;

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
     
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {


            $post['send_to'] = explode(',', $post['send_to']);
           // $post['event_id'] = explode(',', $post['event_id']);

            $create =array();
            foreach ($post['send_to'] as $key => $sentTo) {


                switch ($sentTo) {
                  case "0":
                  $table ='t_possible_checked_in';                    
                    break;
                  case "1":                    
                  $table ='t_checked_in_user';                    
                    break;
                  case "2":                    
                  $table ='t_user_favourite';                    
                    break;
                  default:
                  $responcearray = array('status' => 400, "success" => false, "message" =>IVALID_SENDTO, "result" =>new \stdClass());
                  return response()->json($responcearray, 400);
                }



                $users = DB::table($table)
                ->select('*')
                ->join('t_user', 't_user.user_id', '=', $table.'.user_id')
                ->get();
                

                 $event = BareventModel::select('name','image')
                ->get()->first();


                $getNotify =array();
                foreach ($users as $key => $value) {
                  
                  foreach ($post['event'] as $key => $EventValue) {
                      

                        $notifyData = array(
                            "title"=> $EventValue['event_title'],
                            "body"=> $EventValue['description'],
                            "device_token"=>$value->device_token,
                            'data'=>$event
                        );
                        
                        if ($value->device_type == "android") 
                        {

                            $getNotify = $this->android($notifyData);   
                        }
                        elseif ($value->device_type == "ios") 
                        {
                            // $getNotify = $this->ios($notifyData);
                            $getNotify = Controller::notificationApn($notifyData);
                            
                        }

                        if (!empty($getNotify) && isset($getNotify->success) && $getNotify->success == 1) 
                        {
                            $param = array(
                                "title" => $EventValue['event_title'],
                                "bar_id" => $post['bar_id'],
                                "event_id" => $EventValue['event_id'],
                                "user_id"=>$value->user_id,
                                "description" => $EventValue['description'],
                                "notification_type"=>'Event'
                            ); 

                            $create[] = NotificationModel::create($param);
                        }            
                  }
                }
                
            }



            if (!empty($create))
            {
                $responcearray = array('status' => 200, "success" => true, "message" =>NOTIFY_SUCCESS, "result" =>$create);
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 404, "success" => false, "message" =>WENT_WRONG, "result" => $create);
                return response()->json($responcearray, 404);
            }  
            
        }
           
    }

    public function android($parms) {        
       
        $msg = array
        (
            'title'     => $parms['title'],
            // 'title'     => 'test',
            'body'      => $parms['body'],
            // 'body'      => 'test nitesh',
            'vibrate'   => 1,
            'sound'     => 1,
            'largeIcon' => 'large_icon',
            'smallIcon' => 'small_icon'
        );

        $fields = array
        (
            'to' => $parms['device_token'],
            // 'to' => 'csPKzyMUTaW5Dzfh6pjtgO:APA91bFupdjOOVutjoGCn1yh2R-Ky2p2ZMUJpq73q85rnUs21nFPm3r7NmWY5QrCw0JrCyjfeQJDX55kFEuqpDJqyKCPS3BtREGPUOhLtyzPKoNEpqcMjoL3VIuWkb-KpO_O0ZtQd0TK',
            'notification'  => $msg,
            'data' => $parms['data']
            // 'data' => 'fff',
        );

        // print_r($fields);exit;

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
            $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx); // Open a connection to the APNS server
            if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);
            'Connected to APNS' . PHP_EOL;
            $payload = json_encode($body); // Encode the payload as JSON
            $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload; // Build the binary notification
            $result = fwrite($fp, $msg, strlen($msg)); // Send it to the server\

            if (!$result)
            return false;
            else
            return array("status"=>1);

            fclose($fp); // Close the connection to the server  
       
    }

    public function gameNotification(Request $request)
    {
       
        // $apnsPem = resource_path('ios_apns/cert.pem');
        // $passphrase = resource_path('ios_apns/cert.p12');

        Log::info('test-game', $request->all());
        // Log::info('user_id-get', $request->payload->userID_1);
        $user = AuthenticationModel::where('user_id', $request->user_id)->first();
        $sender = AuthenticationModel::where('user_id', $request->sender_id)->first();

        if($user->device_type == "ios"){
            
            $deviceToken = $user->device_token; //  iPad 5s Gold prod

            $msg = [
            'aps' => [
                'alert' => [
                    'title' => $sender->full_name. " want to play 21 Questions",
                    'body' => $sender->full_name. " Invite you to play game",
                ],
                'sound' => 'default',
                // 'badge' => 1
                'data' => $request->payload

            ],
            'extraPayLoad' => [
                'custom' => "No page"
            ]
            ];

         $getNotify = $this->gameApn($msg, $deviceToken); 

        }else{
            $msg = array
            (
                
                'title' => $sender->full_name. " want to play 21 Questions",
                'body' => $sender->full_name. " Invite you to play game",
                'vibrate'   => 1,
                'sound'     => 1,
                'largeIcon' => 'large_icon',
                'smallIcon' => 'small_icon'
            );

            $fields = array
            (
                'to' => $deviceToken = $user->device_token,
                // 'to' => 'csPKzyMUTaW5Dzfh6pjtgO:APA91bFupdjOOVutjoGCn1yh2R-Ky2p2ZMUJpq73q85rnUs21nFPm3r7NmWY5QrCw0JrCyjfeQJDX55kFEuqpDJqyKCPS3BtREGPUOhLtyzPKoNEpqcMjoL3VIuWkb-KpO_O0ZtQd0TK',
                'notification'  => $msg,
                'data' => $request->payload
            );

            // print_r($fields);exit;

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
                $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
                return response()->json($responcearray, 400);
            }
            curl_close( $ch );
            
            $getNotify = json_decode($result);
            
            \Log::info("game", array('msg' => $getNotify));      

        }

        // $data = array(
        //             "user_id"=>$request->sender_id,
        //             "request_type"=>2,
        //             "request_user_id"=>$request->user_id,
        //             "request_status"=>0,

        //         );

        // $UserRequest = UserRequestModel::create($data);

        $notifyData = array(
            "title" => $sender->full_name. " want to play 21 Questions",
            "bar_id" => null,
            "event_id" => null,
            "user_id"=> $request->user_id,
            "description" => $sender->full_name. " Invite you to play game",
            "notification_type"=>"Game"
        ); 

        $InsertNotify = NotificationModel::create($notifyData);

        if($InsertNotify)
        {    
            $responcearray = array('status' => 200, "success" => true, "message" =>"Invitation Send Successfully", "result" => new \stdClass());            
            return response()->json($responcearray, 200);
        }
        else
        {   
            
            $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
            return response()->json($responcearray, 400);
        }
  
    }

    public function barGameNotification(Request $request)
    {

         $post = $request->all();
            $data = array();

            Log::info('bar-game-notification', $post);

            $rules = array(
                "user_ids" => 'required',
                "sender_id" => 'required',
                "game_id" => 'required|integer'
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

                $users=(explode(",",$request->user_ids));
                foreach($users as $user_id){
              
               $user = AuthenticationModel::where('user_id', $user_id)->first();
                $sender = AuthenticationModel::where('user_id', $request->sender_id)->first();
                $game = GameModel::where('id', $request->game_id)->first();

                $bar = BarModel::select('name')->where('bar_id', $game->bar_id)->first();

                $requestData = UserRequestModel::where('user_id', $request->sender_id)->where('request_user_id', $request->user_id)->where('request_type', 2)->first();
                if($requestData){
                    UserRequestModel::where('request_id', '=', $requestData->request_id)->delete();
                    NotificationModel::where('frined_request_id', '=', $requestData->request_id)->delete();
                }

                if($user->device_type == "ios"){
            
                    $deviceToken = $user->device_token; //  iPad 5s Gold prod

                    $msg = [
                        'aps' => [
                            'alert' => [
                                'title' => $sender->full_name. " Invite you to play Game",
                                'body' => $sender->full_name. " has send you an invite ". $bar->name." to play ".$game->name,
                            ],
                            'sound' => 'default',
                            'data' => $request->payload

                        ],
                        'extraPayLoad' => [
                            'custom' => "No page"
                        ]
                    ];

                    $getNotify = $this->gameApn($msg, $deviceToken); 

                }else{
                    $msg = array
                    (
                        
                        'title' => $sender->full_name. " Invite you to play Game",
                        'body' => $sender->full_name. " has send you an invite ". $bar->name." to play ".$game->name,
                        'vibrate'   => 1,
                        'sound'     => 1,
                        'largeIcon' => 'large_icon',
                        'smallIcon' => 'small_icon'
                    );

                    $fields = array
                    (
                        'to' => $deviceToken = $user->device_token,
                        // 'to' => 'csPKzyMUTaW5Dzfh6pjtgO:APA91bFupdjOOVutjoGCn1yh2R-Ky2p2ZMUJpq73q85rnUs21nFPm3r7NmWY5QrCw0JrCyjfeQJDX55kFEuqpDJqyKCPS3BtREGPUOhLtyzPKoNEpqcMjoL3VIuWkb-KpO_O0ZtQd0TK',
                        'notification'  => $msg,
                        'data' => $request->payload
                    );

                    // print_r($fields);exit;

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
                        $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
                        return response()->json($responcearray, 400);
                    }
                    curl_close( $ch );
                    
                    $getNotify = json_decode($result);
                    
                    \Log::info("game", array('msg' => $getNotify));      

                }



                 $data = array(
                        "user_id"=>$request->sender_id,
                        "request_type"=>2,
                        "request_user_id"=>$user_id,
                        "request_status"=>0,
                        "bar_id"=>$game->bar_id,
                        "order_id"=>null,

                );

                $UserRequest = UserRequestModel::create($data);
                $UserRequestId = $UserRequest->id;

                $notifyData = array(
                    "title" => $sender->full_name. " Invite you to play Game",
                    "bar_id" => $game->bar_id,
                    "game_id" => $game->id,
                    "user_id"=> $user_id,
                    "description" => $sender->full_name. " has send you an invite ". $bar->name." to play ".$game->name,
                    "notification_type"=>"Game",
                    "frined_request_id"=>$UserRequestId
                ); 

                $InsertNotify = NotificationModel::create($notifyData);

              }
            } 
             if($InsertNotify)
                {    
                    $responcearray = array('status' => 200, "success" => true, "message" =>"Invitation Send Successfully", "result" => new \stdClass());            
                    return response()->json($responcearray, 200);
                }
                else
                {   
                    
                    $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
                    return response()->json($responcearray, 400);
                }     
  
    }

    public function acceptOrRejectFGame(Request $request)
    {
        $updateStatus =  new \stdClass();
        $post = $request->all();
        Log::info('bar-game-accept', $post);
          
        $rules = array(
                "user_id" => "required",                 
                "sender_id" => "required", 
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

            $getRequest = UserRequestModel::select('*')
                                  ->where('user_id', '=', $request->sender_id)
                                  ->where('request_user_id', '=', $request->user_id)
                                  ->where('request_type', '=', 2)
                                  ->first();
            if(!$getRequest)
            {
                $responcearray = array('status' => 400, "success" => false, "message" =>"Request not found.", "result" =>$updateStatus);
                return response()->json($responcearray, 400);
            }

            $requestId = $getRequest->request_id;

            $notification = NotificationModel::where('frined_request_id', '=', $requestId)->first();

            if ($request->is_accepted == 1) {

                $user = AuthenticationModel::where('user_id', $request->sender_id)->first();
                $sender = AuthenticationModel::where('user_id', $request->user_id)->first();

                if($user->device_type == "ios"){
            
                    $deviceToken = $user->device_token; //  iPad 5s Gold prod

                    $msg = [
                        'aps' => [
                            'alert' => [
                                'title' => "Game Request Accepted",
                                'body' => $sender->full_name. " has Accepted your game request.",
                            ],
                            'sound' => 'default',
                            'data' => $request->payload

                        ],
                        'extraPayLoad' => [
                            'custom' => "No page"
                        ]
                    ];

                    $getNotify = $this->gameApn($msg, $deviceToken); 

                }else{
                    $msg = array
                    (
                        
                        'title' => "Game Request Accepted",
                        'body' => $sender->full_name. " has Accepted your game request.",
                        'vibrate'   => 1,
                        'sound'     => 1,
                        'largeIcon' => 'large_icon',
                        'smallIcon' => 'small_icon'
                    );

                    $fields = array
                    (
                        'to' => $deviceToken = $user->device_token,
                        // 'to' => 'csPKzyMUTaW5Dzfh6pjtgO:APA91bFupdjOOVutjoGCn1yh2R-Ky2p2ZMUJpq73q85rnUs21nFPm3r7NmWY5QrCw0JrCyjfeQJDX55kFEuqpDJqyKCPS3BtREGPUOhLtyzPKoNEpqcMjoL3VIuWkb-KpO_O0ZtQd0TK',
                        'notification'  => $msg,
                        'data' => $request->payload
                    );

                    // print_r($fields);exit;

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
                        $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
                        return response()->json($responcearray, 400);
                    }
                    curl_close( $ch );
                    
                    $getNotify = json_decode($result);
                    
                    \Log::info("game", array('msg' => $getNotify));
                }

                $notifyData = array(
                            "title" => "Game Request Accepted",
                            "bar_id" => $request->bar_id,
                            "user_id"=> $request->sender_id,
                            "game_id"=> $notification->game_id,
                            "description" => $sender->full_name. " has Accepted your game request.",
                            "notification_type"=>"Game",
                            "accepte_by"=>$request->user_id
                        );

                $InsertNotify = NotificationModel::create($notifyData);


                $request = UserRequestModel::where('request_id', '=', $getRequest->request_id)->delete();

                 $notification = NotificationModel::where('id', '=', $notification->id)->delete();
            
            
                $responcearray = array('status' => 200, "success" => true, "message" =>"Game request accepted successfully", "result" => new \stdClass());

            }elseif ($request->is_accepted == 2) {

                $notification = NotificationModel::where('frined_request_id', '=', $getRequest->request_id)->delete();

                $request = UserRequestModel::where('request_id', '=', $getRequest->request_id)->delete();
                
                $responcearray = array('status' => 200, "success" => true, "message" =>FRIEND_REJECTED, "result" => new \stdClass());

            }else{

                $responcearray = array('status' => 400, "success" => false, "message" =>WENT_WRONG, "result" => new \stdClass());
                return response()->json($responcearray, 400);

            }
            
            return response()->json($responcearray, 200);
               
        }
    }
    
    public function getAllNotifications($user_id){

        $result =array();
        $get = NotificationModel::select('*')
                        ->where('t_bar_notification.user_id', '=', $user_id)                  
                        ->get();


         $senderData=[];

        if (!empty($get->first())) 
        {
            foreach ($get as $key => $value) {
                 $bar=BarModel::where('bar_id',$value['bar_id'])->first(); 
                 if($bar)
                 {  
                 $value->bar_name=$bar->name;
                 }
                if ($value['notification_type'] == 'Event') 
                {
                    $event = BareventModel::select('name as name','description','image','event_type')
                        ->where('event_id', '=', $value['event_id'])                        
                        ->get()->first();

                   $checked = BarModel::select('t_user.user_id','t_user.full_name as fullName','t_user.status','t_user.favourite_drink')
                                ->from('t_checked_in_user')
                                ->join('t_user', 't_checked_in_user.user_id', '=', 't_user.user_id')
                                ->where('t_checked_in_user.bar_id', '=', $value['event_id'])
                                ->get();

                   $value->people_in = $checked->count();
                   $value->possible_in = $checked->count();
                    
                    $value['data']   = $event;
                    
                }elseif ($value['notification_type'] == 'User') {
                    
                    $event = AuthenticationModel::select('full_name as name','email','profileImage as image')
                        ->where('user_id', '=', $value['user_id'])                        
                        ->get()->first();

                    $value['data']   = $event;
                
                }elseif ($value['notification_type'] == 'gift_request') {
                    

                    $gift_request = BarorderModel::select('t_user.full_name as senders_name','t_user.profileImage as image' ,'t_user.user_id as senders_id','t_order.drink_name','t_order.bar_name','t_order.order_id','t_order.bar_id')
                                
                                ->where('t_order.senders_id', '=', $value['gift_sender_id'])

                                ->join('t_user', 't_user.user_id', '=', 't_order.senders_id')
                                ->get()->first();

                        $sender   = AuthenticationModel::where('user_id',$user_id)->first();
                         $senderData = [
                            'senders_name' => $sender->full_name,
                            'image' => $sender->profileImage,
                            'senders_email' => $sender->email,
                            'senders_id' => $sender->user_id,
                         ];

                    $value['data']   = $gift_request;

                }elseif ($value['notification_type'] == 'friend_request') {
                    // return $value['user_id'];
                    $checkRequestStatus = UserRequestModel::where('request_id',$value['frined_request_id'])->where('request_type', 6)->first();
                    
                    if(!empty($checkRequestStatus)){
                        if($checkRequestStatus->request_status == 1){
                            $value->title = 'Friend Request Accepted';
                            $value->notification_type = 'friend_request_accepted';
                        }elseif($checkRequestStatus->request_status == 2){  
                            $value->title = 'Friend Request Rejected';
                            $value->notification_type = 'friend_request_rejected';
                        }
                         $sender   = AuthenticationModel::where('user_id', $checkRequestStatus->user_id)->first();
                         $senderData = [
                            'senders_name' => $sender->full_name,
                            'image' => $sender->profileImage,
                            'senders_email' => $sender->email,
                            'senders_id' => $sender->user_id,
                         ];
                         $value['data'] = $senderData;
                         $value['is_friend'] = false;
                         
                    }
                    
                    
                    
                }elseif ($value['notification_type'] == 'accepte_request') {
                    // return $value['user_id'];
                    $checkRequestStatus = UserRequestModel::where('request_id',$value['frined_request_id'])->first();
                    // dd($checkRequestStatus);
                    
                   $sender   = AuthenticationModel::where('user_id', $value['accepte_by'])->first();

                     $senderData = [
                        'senders_name' => $sender->full_name,
                        'image' => $sender->profileImage,
                        'senders_email' => $sender->email,
                        'senders_id' => $sender->user_id,
                     ];
                     $value['data'] = $senderData;
                     $value['is_friend'] = true;
                    
                    
                    
                }elseif ($value['notification_type'] == 'Game') {


                    if( $value['title']== "Game Request Accepted") {
 
                         
                        $sender   = AuthenticationModel::where('user_id', $value['accepte_by'])->first();
                         $senderData = [
                            'senders_name' => $sender->full_name,
                            'image' => $sender->profileImage,
                            'senders_email' => $sender->email,
                            'senders_id' => $sender->user_id,
                         ]; 

                    }
                    else {

                        $checkRequestStatus = UserRequestModel::where('request_id',$value['frined_request_id'])->where('request_type', 2)->first();
                    
                        if(!empty($checkRequestStatus)){
                            
                             $sender   = AuthenticationModel::where('user_id', $checkRequestStatus->user_id)->first();
                             $senderData = [
                                'senders_name' => $sender->full_name,
                                'image' => $sender->profileImage,
                                'senders_email' => $sender->email,
                                'senders_id' => $sender->user_id,
                             ];
                             
                        }

                    }

                    
                    $value['data'] = $senderData;
                                          
                }elseif ($value['notification_type'] == 'Drink') {

                        $sender   = AuthenticationModel::where('user_id', $value['user_id'])->first();
                        $ids =json_decode($value['request_drink_id']);
                    $item = BarmenuModel::select('t_bar_menu.*','request_drink.qty')->join('request_drink','request_drink.drink_id','=','t_bar_menu.menu_id')->whereIn('request_drink.id',$ids)->get();
                         $price=0;
                         foreach($item as $itm)
                         {
                            
                            $price=$price+$itm->price*$itm->qty;

                            $res=DB::table('t_user_drink_favourite')->where(['user_id'=>$user_id,'menu_id'=>$itm->menu_id])->first();
                             
                            if($res){
                                $itm->is_favourite=true;
                            }
                            else{
                                $itm->is_favourite=false;
                            }

                         }



                         $senderData = [
                            'senders_name' => $sender->full_name,
                            'image' => $sender->profileImage,
                            'senders_email' => $sender->email,
                            'senders_id' => $sender->user_id,
                            'total_price'=>$price,
                             'item'=>$item
                         ]; 
                        $value['data'] = $senderData;

                    }

                $result[]=$value;
            }
        }

                        
      
        if(!empty($get->first()))
        {
            $responcearray = array('status' => 200, "success" => true, "message" =>NOTIFY_GOT, "result" =>$result);
            return response()->json($responcearray, 200);
        }
        else
        {
            $responcearray = array('status' => 400, "success" => false, "message" =>NOT_DATA_FOUND, "result" => new \stdClass());
            return response()->json($responcearray, 400);
        }
        
    }


     public function gameApn($msg, $deviceToken)
    {

        $message = json_encode($msg);

        $keyfile = app_path().'/apns/AuthKey_C63QBQ8Y7T.p8';               # <- Your AuthKey file
        $keyid = 'C63QBQ8Y7T';                            # <- Your Key ID
        $teamid = '2ZRFJYMMPY';                           # <- Your Team ID (see Developer Portal)
        $bundleid = 'org.reactjs.native.example.BarConnex';                # <- Your Bundle ID
        $url = 'https://api.push.apple.com';  # <- development url, or use http://api.push.apple.com for production environment
        $token = $deviceToken;              # <- Device Token
        // $token = "e8f8e49ffcb6e32d6e811f021ca8e7390a7dfb664e1c30a7afedc1a3cc0b4e61";              # <- Device Token

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

        return $result;
    }
    function base64($data) {
        return rtrim(strtr(base64_encode(json_encode($data)), '+/', '-_'), '=');
    }

    private function displayValidation($error) 
    {
        $error = str_replace("</p>", "", $error);
        $error = str_replace("<p>", "", $error);
        $error = str_replace("\n", " ", $error);
        return $error;
    }

    public function deleteNotification($notID)
    {
        $res=DB::table('t_bar_notification')->where('id',$notID)->delete();
       
        if(isset($res))
        {
        $responcearray = array('status' => 200, "success" => True, "message" =>"Notification Deleted Successfully", "result" =>new \stdClass());
            return response()->json($responcearray, 200);
        }
    }
}
