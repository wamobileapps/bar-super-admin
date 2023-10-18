<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Validator;
use Redirect;
use App\Models\NotificationModel;
use App\Models\AuthenticationModel;
use App\Models\AdminNotificationModel;
const EVENT_NOT_FOUND="Event Not Found";
const NOTIFY_SUCCESS="Notification  Sent Successfully";
const IVALID_SENDTO="Invalid Send Option";
const WENT_WRONG="Something Went Wrong";
const NOTIFY_GOT="Notification Get Successfully";
const NOT_DATA_FOUND=" No Data Found. ";

class NotificationController extends Controller
{
    public function __construct()
    {
        
        // $this->middleware(function ($request, $next){
        //     $user_id = session()->get('adminEmail');

        //     if(empty($user_id))
        //     {
        //         return redirect()->to('login');
        //     }

        //     return $next($request);
        // });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = AdminNotificationModel::all();
        return view("notificationManager", compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("addNotificationManager");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'notification' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)
                        ->withInput();
        }
        $users = AuthenticationModel::all();
        $adminNotification = new AdminNotificationModel();
        $adminNotification->notification = $request->notification;
        $adminNotification->save();
        $create = [];
        foreach ($users as $key => $user) {
            if(!empty($user->device_token)){
                
                $notifyData = array(
                    "title"=> "Notification From admin",
                    "body"=> $request->notification,
                    "device_token"=>$user->device_token,
                    'data'=>[

                    ]
                );
                if ($user->device_type == "android") 
                {
                    $getNotify = $this->android($notifyData);          
                }
                elseif ($user->device_type == "ios") 
                {
                    // $getNotify = $this->iosNotofication($notifyData); 
                    $getNotify = Controller::notificationApn($notifyData); 
                }
                    $param = array(
                        "title" => "Notification From admin",
                        "user_id"=>$user->user_id,
                        "description" => $request->notification,
                        "notification_type"=>'Admin Notification'
                    ); 

                    $create[] = NotificationModel::create($param);
                
            }
            
            
        }
        
        if (!empty($create)){
            return redirect('Notification')->with('Success', 'Notification send successfully');   
        }else{
            return Redirect::back()->with(['Error', 'Somthing went wrong']);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminNotificationModel $AdminNotificationModel)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $AdminNotification = AdminNotificationModel::find($id);    
        
        if ($AdminNotification->delete()){
            return redirect('Notification')->with('Success', 'Notification Deleted successfully');   
        }else{
            return Redirect::back()->with(['Error', 'Somthing went wrong']);
        }
        
    }
    public function iosNotofication($parms)
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
        
        return json_decode($result);
    }
}
