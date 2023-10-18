<?php 
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\AdminModel;
use App\Models\BarModel;
use App\Models\BareventModel;
use App\Models\BargameModel;
use App\Models\MenucategoryModel;
use App\Models\BarmenuModel;
use App\Models\UserEventModel;
use App\Models\BannerModel;
use App\Models\PhotoWallModel;
use App\Models\PossibleModel;
use App\Models\BarorderModel;
use App\Models\AuthenticationModel;
use App\Models\UserEventAddModel;
use App\Models\BargameFavouriteModel;
use App\Models\PaymentModel;
use App\Models\RemovedImage;
use Session;
use App\Models\NotificationModel;

class UserController extends Controller
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
    
	public function index()
    {
        $month = date('m');
        $date = date('Y-m-d');
        $users = AuthenticationModel::select('*')->where('type','!=','admin')
                          ->get();

        $users->totalRevenue = PaymentModel::sum('amount');
        $users->todayRevenue = PaymentModel::whereDate('created_at', '=', $date)->sum('amount');

        return view("userManager", compact('users'));
    }

    public function addUser()
    {
        return view("addUser");
    }


    public function userSave(Request $request)
    {
        $post = $request->all();

        $rules = array( 
            "full_name" => 'required', 
            "email" => 'required|unique:t_user', 
            "dob" => 'required|date', 
            "ageRange" => 'required|numeric', 
            "password" => 'required', 
            "gender" => 'required|numeric', 
            "relationship_status" => 'required|numeric', 
            "age" => 'required|numeric', 
            "profileImage" => 'required|image|mimes:jpeg,png,jpg',  
            "favourite_drink" => 'required', 
            "interests" => 'required', 
            "about" => 'required',  
            "rating" => 'required|numeric', 
            "mood_at_bar" => 'required', 
            "orientation" => 'required', 
            "profile_completed" => 'required|numeric',
        );

        $validator = Validator::make($post, $rules);

        if ($validator->fails()) {
            
            return redirect('addUser')
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {

            unset($post['_token']);

            if(isset($post['profileImage']) && !empty($post['profileImage']))
            {
                $imagename = time().uniqid()."profileImage";

                $imageName = $imagename.'.'.$request->profileImage->extension();  

                $request->profileImage->move(public_path('Uploads/profile/'), $imageName);
                $post['profileImage'] = url('Uploads/profile/'.$imageName);
            }
            else
            {
                $post['profileImage'] = url('img/bar-default-image.png');
            }

            $post['user_id'] = md5(time().json_encode($post));
            $post['password'] = md5($post['password']);
            $post['username'] = $post['email'];

            $user = AuthenticationModel::create($post);

            if($user)
            {
                session::flash('BarSuccess','User has been created successfully');
                return redirect('User');
            }
            else
            {
                session::flash('BarError','Something went wrong.');
                return redirect('User');
            }
        }
    }

    public function editUser($id='')
    {
        if(!empty($id))
        {
            $user = AuthenticationModel::select('*')
                            ->where('user_id', '=', $id)
                            ->get()->first();

            if($user)
            {
                return view("editUser", compact("user"));
            }
            else
            {
                session::flash('BarError','Invailid ID');
                return redirect('User');
            }   
        }
        else
        {
                session::flash('BarError','Invailid ID');
                return redirect('User');
        }
    }

    public function userUpdate(Request $request, $id='')
    {
        $post = $request->all();

        $rules = array(    
            "full_name" => 'required', 
            "email" => 'required', 
            "dob" => 'required|date', 
            "ageRange" => 'required|numeric',  
            "gender" => 'required|numeric', 
            "relationship_status" => 'required|numeric', 
            "age" => 'required|numeric',  
            "favourite_drink" => 'required', 
            "interests" => 'required', 
            "about" => 'required',  
            "rating" => 'required|numeric', 
            "mood_at_bar" => 'required', 
            "orientation" => 'required', 
            "profile_completed" => 'required|numeric',
        );

        $validator = Validator::make($post, $rules);

        if ($validator->fails()) {
            
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {

            unset($post['_token']);

            if(isset($post['profileImage']) && !empty($post['profileImage']))
            {
                $imagename = time().uniqid()."profileImage";

                $imageName = $imagename.'.'.$request->profileImage->extension();  

                $request->profileImage->move(public_path('Uploads/profile/'), $imageName);
                $post['profileImage'] = url('Uploads/profile/'.$imageName);
            }

            $post['username'] = $post['email'];

            $user = AuthenticationModel::where('user_id', $id)->update($post);

            if($user)
            {
                session::flash('BarSuccess','User has been updated successfully');
                return redirect('User');
            }
            else
            {
                session::flash('BarError','User has been not updated');
                return redirect('User');
            }
        }
    }

    public function deleteUser($id='')
    {
        if(!empty($id))
        {
            $delete = AuthenticationModel::where('id', $id)->delete();

            if($delete)
            {
                session::flash('BarSuccess','Bar user has been deleted successfully');
                return back();
            }
            else
            {
                session::flash('BarError','Something went wrong');
                return back();
            }
            
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return back();
        }
    }

    public function userDetails($id='')
    {
        $month = date('m');
        $date = date('Y-m-d');
        $user = AuthenticationModel::select('*')
                        ->where('user_id', '=', $id)
                        ->get()->first();

        if($user)
        {

            $user->photowall = PhotoWallModel::select('*')
                            ->where('user_id', '=', $user->user_id)
                            ->orderBy('id', 'DESC')
                            ->limit(5)
                            ->get();

            $user->orders = BarorderModel::select('*')
                            ->join('t_bar', 't_bar.bar_id', '=', 't_order.bar_id')
                            ->where('t_order.user_id', '=', $user->user_id)
                            ->orderBy('order_id', 'DESC')
                            ->limit(5)
                            ->get();

            $user->totalAmount = BarorderModel::select('*')
                            ->where('t_order.user_id', '=', $user->user_id)
                            ->sum('price');

            $user->fusers = AuthenticationModel::select('*')
                            ->join('t_user_friends', 't_user_friends.friend_user_id', '=', 't_user.user_id')
                            ->where('t_user_friends.user_id', '=', $user->user_id)
                            ->orderBy('t_user_friends.id', 'DESC')
                            ->limit(5)
                            ->get();

            $user->games = BargameModel::select('*')
                            ->join('t_user_game_favourite', 't_user_game_favourite.favourite_id', '=', 't_bar_game.id')
                            ->where('t_user_game_favourite.user_id', '=', $user->user_id)
                            ->orderBy('t_bar_game.id', 'DESC')
                            ->limit(5)
                            ->get();

            $user->events = BareventModel::select('*')
                            ->join('t_add_user_event', 't_add_user_event.event_id', '=', 't_bar_event.event_id')
                            ->join('t_bar', 't_bar.bar_id', '=', 't_bar_event.bar_id')
                            ->where('t_add_user_event.user_id', '=', $user->user_id)
                            ->orderBy('t_bar_event.event_id', 'DESC')
                            ->limit(5)
                            ->get();

            $user->busers = AuthenticationModel::select('*')
                            ->join('t_user_block', 't_user_block.block_user_id', '=', 't_user.user_id')
                            ->where('t_user_block.user_id', '=', $user->user_id)
                            ->limit(5)
                            ->get();

            $user->totalRevenue = PaymentModel::where('user_id', '=', $user->user_id)->sum('amount');
            $user->todayRevenue = PaymentModel::whereDate('created_at', '=', $date)->where('user_id', '=', $user->user_id)->sum('amount');
        
            return view("userDetails", compact('user'));
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return redirect('User');
        }
        // return view("userDetails");
    }


    public function userOrders($id='')
    {
        $data = new \stdClass();
        $user = AuthenticationModel::select('*')
                        ->where('user_id', '=', $id)
                        ->get()->first();
        
        $data->user_id = $id;
        if(!empty($id))
        {
            $data->orders = BarorderModel::select('*', 't_order.price', 't_order.created_at', 't_bar.name as nameBar')
                            ->leftJoin('t_user', 't_user.user_id', '=', 't_order.user_id')
                            ->leftJoin('t_bar', 't_bar.bar_id', '=', 't_order.bar_id')
                            ->leftJoin('t_bar_menu', 't_bar_menu.menu_id', '=', 't_order.menu_id')
                            ->where('t_order.user_id', '=', $id)
                            ->orderBy('t_order.order_id', 'DESC')
                            ->get();

           return view("userOrders", compact('data'));
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return redirect('User');
        }
    }

    public function userPhotoWall($id='')
    {
        $data = new \stdClass();
        $data->user_id = $id;
        $user = AuthenticationModel::select('*')
                        ->where('user_id', '=', $id)
                        ->get()->first();
        if(!empty($id))
        {
            $data->photowalls = PhotoWallModel::select('*', 't_bar.name as nameBar')
                            ->leftJoin('t_bar', 't_bar.bar_id', '=', 't_bar_photo_wall.bar_id')
                            ->where('t_bar_photo_wall.user_id', '=', $id)
                            ->orderBy('t_bar_photo_wall.id', 'DESC')
                            ->get();

           return view("userPhotoWall", compact('data'));
        }
        else{
            session::flash('BarError','Invailid ID');
            return back();
        }
    }

    public function deleteUserPhotoWall($id='')
    {
        if(!empty($id))
        {
            $delete = PhotoWallModel::where('id', $id)->delete();

            if($delete)
            {
                session::flash('BarSuccess','User photo has been deleted successfully');
                return back();
            }
            else
            {
                session::flash('BarError','Something went wrong');
                return back();
            }
            
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return back();
        }
    }

    public function userEvents($id='')
    {
        $data = new \stdClass();
        $user = AuthenticationModel::select('*')
                        ->where('user_id', '=', $id)
                        ->get()->first();

        if(!empty($id) && $user)
        {
                $data->user_id = $id;
                $data->events = BareventModel::select('*')
                        ->join('t_add_user_event', 't_add_user_event.event_id', '=', 't_bar_event.event_id')
                        ->where('t_add_user_event.user_id', '=', $id)
                        ->get();

            return view("userEvents", compact('data'));   
        }
        else{
            session::flash('BarError','Invailid ID');
            return back();
        }
    }

    public function deleteUserEvent($id='')
    {
        if(!empty($id))
        {
            $delete = UserEventAddModel::where('id', $id)->delete();

            if($delete)
            {
                session::flash('BarSuccess','User event has been deleted successfully');
                return back();
            }
            else
            {
                session::flash('BarError','Something went wrong');
                return back();
            }   
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return back();
        }
    }

    public function userGames($id='')
    {
        $data = new \stdClass();
        $user = AuthenticationModel::select('*')
                        ->where('user_id', '=', $id)
                        ->get()->first();

        if(!empty($id) && $user)
        {
            $data->user_id = $id;
            $data->games = BargameModel::select('*')
                            ->join('t_user_game_favourite', 't_user_game_favourite.favourite_id', '=', 't_bar_game.id')
                            ->where('t_user_game_favourite.user_id', '=', $user->user_id)
                            ->get();

            return view("userGame", compact('data'));   
        }
        else{
            session::flash('BarError','Invailid ID');
            return back();
        }
    }

    public function deleteUserGames($id='')
    {
        if(!empty($id))
        {
            $delete = BargameFavouriteModel::where('id', $id)->delete();

            if($delete)
            {
                session::flash('BarSuccess','User game has been deleted successfully');
                return back();
            }
            else
            {
                session::flash('BarError','Something went wrong');
                return back();
            }   
        }
        else
        {
            session::flash('BarError','Invailid ID');
            return back();
        }
    }

    public function userFriends($id='')
    {
        $data = new \stdClass();
        $user = AuthenticationModel::select('*')
                        ->where('user_id', '=', $id)
                        ->get()->first();

        if(!empty($id) && $user)
        {
            $data->user_id = $id;
            $data->friends = AuthenticationModel::select('*')
                            ->join('t_user_friends', 't_user_friends.friend_user_id', '=', 't_user.user_id')
                            ->where('t_user_friends.user_id', '=', $user->user_id)
                            ->get();

            return view("userFriends", compact('data'));   
        }
        else{
            session::flash('BarError','Invailid ID');
            return back();
        }
    }

    public function userblock($id='')
    {
        $data = new \stdClass();
        $user = AuthenticationModel::select('*')
                        ->where('user_id', '=', $id)
                        ->get()->first();

        if(!empty($id) && $user)
        {
            $data->user_id = $id;
            $data->friends = AuthenticationModel::select('*')
                            ->join('t_user_block', 't_user_block.block_user_id', '=', 't_user.user_id')
                            ->where('t_user_block.user_id', '=', $user->user_id)
                            ->get();

            return view("userBlock", compact('data'));   
        }
        else{
            session::flash('BarError','Invailid ID');
            return back();
        }
    }

    public function userChangeStatus($id='')
    {
        $data = new \stdClass();
        $user = AuthenticationModel::select('*')
                        ->where('user_id', '=', $id)
                        ->get()->first();

        if(!empty($id) && $user)
        {
            
          $status = ($user->status > 0)?0:1;
          $message = ($user->status > 0)?"Your barconex account is active":"Your barconex account is suspended";

          $update = AuthenticationModel::where('user_id', $user->user_id)->update(array('status'=>$status));

          if($update)
          {
            if(!empty($user->device_token)){
                
                $notifyData = array(
                    "title"=> "Notification From admin",
                    "body"=> $message,
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
                    $getNotify = $this->iosNotofication($notifyData);  
                }
                    $param = array(
                        "title" => "Notification From admin",
                        "user_id"=>$user->user_id,
                        "description" =>$message,
                        "notification_type"=>'Admin Notification'
                    ); 

                    $create[] = NotificationModel::create($param);
                
            }            

            $array = array('message' => $message, 'email' => $user->email, 'name' => $user->full_name);

            \Mail::to($user->email)->send(new \App\Mail\SuspendEmail($array));

            session::flash('BarSuccess','Status changed successfully');
            return back();
          }
          else
          {
            session::flash('BarError','status changed failed');
            return back();
          }



            // return view("userFriends", compact('data'));   
        }
        else{
            session::flash('BarError','Invailid ID');
            return back();
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

 public function removeUserImage(Request $request )
    {
       
        $request->all();
         $id = $request->user_id;
         $user = AuthenticationModel::where('id', '=', $id)->first();
        
        $user->imageStatus='1';

        $user->save();

        $removeImageSave=RemovedImage::updateOrCreate([
            'user_id'=>$id,
            'reason'=>$request->reason,

        ]);

         if($removeImageSave)
         {
          
          $responcearray = array('status' => 200, "success" => true, "message" =>"Image Removed successfully");
            return response()->json($responcearray, 200);

         }
         else{
            $responcearray = array('status' => 400, "success" => false, "message" =>"Something went wrong");
            return response()->json($responcearray, 400);

         }

    }

public function addBackImage(Request $request )
    {
       
        $request->all();
         $id = $request->user_id;
         $user = AuthenticationModel::where('id', '=', $id)->first();
        
        $user->imageStatus='0';

        $user->save();

        $removeImageSave=RemovedImage::where('user_id',$id)->delete();
           
          
          $responcearray = array('status' => 200, "success" => true, "message" =>"Image added back successfully" ,'user'=>$user);
            return response()->json($responcearray, 200);

    

    }







}