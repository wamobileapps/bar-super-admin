<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\AuthenticationModel;
use App\Models\BlockuserModel;
use App\Models\UserFriendModel;
use App\Models\UserEventModel;
use App\Models\UserDrinkFavourite;
use App\Models\UserRequestModel;
use App\Models\BarModel;
use App\Models\NotificationModel;

define('SERVER_KEY', 'AAAAuPcnDnY:APA91bE_IjAyJMulkMJ3lNenQqvEoolZOTw4iMLAICchQvOQJttSQ2GvEFAFD8_eq4I8O-fudp5VVTWKFovOdqTIs-QlCzOfnbWRNh0qmpBB-a8pW7eAqPJwRnOf_dO_zmChAgD3GjDY' );

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getBlockUser($user_id,$block_user_id){
    	$get = BlockuserModel::select('*')
			->where('user_id', '=', $user_id)
			->where('block_user_id', '=', $block_user_id)
			->get()->first();

        if (!empty($get)) {
            return true;          	   
        }else{

            return false;          	   
        }                        
    }

    public function getUserFriend($user_id,$friend_user_id){
    	$get = UserFriendModel::select('*')
			->where('user_id', '=', $user_id)
			->where('friend_user_id', '=', $friend_user_id)
			->get()->first();

        if(empty($get)){

            $get = UserFriendModel::select('*')
                ->where('user_id', '=', $friend_user_id)
                ->where('friend_user_id', '=', $user_id)
                ->get()->first();

        }

        if (!empty($get)) {
            return true;          	   
        }else{

            return false;          	   
        }                        
    }

    public function getUserFriendRequest($user_id,$friend_user_id){
        $get = UserRequestModel::select('*')
            ->where('user_id', '=', $user_id)
            ->where('request_user_id', '=', $friend_user_id)->where('request_status',0)
            ->get()->first();

        if(empty($get)){

            $get = UserRequestModel::select('*')
                ->where('user_id', '=', $friend_user_id)
                ->where('request_user_id', '=', $user_id)
                ->get()->first();

        }

        if (!empty($get)) {
            return true;               
        }else{

            return false;              
        }                        
    }
    public function getUserFav($user_id,$friend_user_id){
        
    	$get = DB::table('t_user_favourite_user')->select('*')
			->where('user_id', '=', $user_id)
			->where('favourite_user_id', '=', $friend_user_id)
			->get()->first();

        if (!empty($get)) {
            return true;          	   
        }else{

            return false;          	   
        }                        
    }

    

    public function getUserEvent($user_id){
      
        $get = UserEventModel::select('*')
            ->where('user_id', '=', $user_id)->first();
        if (!empty($get)) {
            return true;               
        }else{

            return false;              
        }                        
    }

    public function getBarDetails($bar_id){
        $get = BarModel::select('*')
            ->where('bar_id', '=', $bar_id)           
            ->get()->first();

        if (!empty($get)) {
            return $get;               
        }else{

            return false;              
        }                        
    }

    public function getUserDetails($user_id){
        $get = AuthenticationModel::select('*')
            ->where('user_id', '=', $user_id)           
            ->get()->first();

        if (!empty($get)) {
            return $get;               
        }else{

            return false;              
        }                        
    }

    public function getUserFavDrink($user_id,$bar_id,$menu_id){
        $get = UserDrinkFavourite::select('*')
            ->where('user_id', '=', $user_id)           
            ->where('bar_id', '=', $bar_id)           
            ->where('menu_id', '=', $menu_id)           
            ->get()->first();

        if (!empty($get)) {
            return true;               
        }else{

            return false;              
        }                        
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
    
    public function sendUserRequest($parms){

        
        $userDeviceCheck =  AuthenticationModel::where('user_id', $parms['notfication_sendto_user_id'])->first();

        $parms['device_type'] = $userDeviceCheck->device_type;
        if (!empty($parms)) 
        {
            if($parms['device_type'] == "ios"){
                // $getNotify = $this->ios($parms);
                $getNotify = $this->notificationApn($parms);   
            }else{
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
                    // 'to' => 'csPKzyMUTaW5Dzfh6pjtgO:APA91bFupdjOOVutjoGCn1yh2R-Ky2p2ZMUJpq73q85rnUs21nFPm3r7NmWY5QrCw0JrCyjfeQJDX55kFEuqpDJqyKCPS3BtREGPUOhLtyzPKoNEpqcMjoL3VIuWkb-KpO_O0ZtQd0TK',
                    'notification'  => $msg,
                    'data' => $parms['data']
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
                
                $getNotify = json_decode($result);

            }

            


            // if (!empty($getNotify) && ( $getNotify->status == 1)) 
            // {

                if (isset($parms['save_request']) && $parms['save_request'] == 1) {
                    
                    $data = array(
                        "user_id"=>$parms['user_id'],
                        "request_type"=>$parms['request_type'],
                        "request_user_id"=>$parms['request_user_id'],
                        "request_status"=>$parms['request_status'],
                        "bar_id"=>(isset($parms['bar_id']))?$parms['bar_id']:null,
                        "order_id"=>(isset($parms['order_id']))?$parms['order_id']:null,

                    );


                    $UserRequest = UserRequestModel::create($data);
                    $UserRequestId = $UserRequest->id;
                }
                
                if ($parms['notification_type'] == 'gift_request') {
                    
                    $parms['gift_sender_id'] = $parms['user_id'];
                }

                $accepte_by = null;
                if (isset($parms['notification_type']) && $parms['notification_type'] == 'accepte_request') {

                    $accepte_by = $parms['user_id'];
                }


                $notifyData = array(
                                "title" => $parms['title'],
                                "bar_id" => ($parms['bar_id'])?$parms['bar_id']:null,
                                "event_id" => ($parms['event_id'])?$parms['event_id']:null,
                                "user_id"=> $parms['notfication_sendto_user_id'],
                                "description" => $parms['description'],
                                "notification_type"=>$parms['notification_type'],
                                "frined_request_id"=>$UserRequestId ?? null,
                                "gift_sender_id"=> $parms['gift_sender_id'] ?? null,
                                "accepte_by"=>$accepte_by ?? null
                            );


                $InsertNotify = NotificationModel::create($notifyData);

                if (!empty($UserRequest)  && !empty($InsertNotify)) 
                {
                    return TRUE;
                }
                else
                {
                    return FALSE;
                }
            // }
            // else
            // {
            //     return FALSE;
            // }
            
        }
        else
        {
            return FALSE;
        }

    }




    public function notificationApn($parms)
    {

        $msg = [
            'aps' => [
                'alert' => [
                    'title' => $parms['title'],
                    'body' => $parms['body'],
                ],
                'sound' => 'default',
                // 'badge' => 1
                'data' => $parms['data']

            ],
            'extraPayLoad' => [
                'custom' => "No page"
            ]
            ];

        $message = json_encode($msg);

        $keyfile = app_path().'/apns/AuthKey_C63QBQ8Y7T.p8';               # <- Your AuthKey file
        $keyid = 'C63QBQ8Y7T';                            # <- Your Key ID
        $teamid = '2ZRFJYMMPY';                           # <- Your Team ID (see Developer Portal)
        $bundleid = 'org.reactjs.native.example.BarConnex';                # <- Your Bundle ID
        $url = 'https://api.push.apple.com';  # <- development url, or use http://api.push.apple.com for production environment
        // $token = $parms['device_token'];              # <- Device Token
        $token = "84c8be48f302b73a1a4ae0bb51ba56dd2eebd1de73a96e4f0feb596d5814bec1";              # <- Device Token

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
}
