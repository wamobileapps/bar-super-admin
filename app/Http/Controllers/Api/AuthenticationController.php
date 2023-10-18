<?php

namespace App\Http\Controllers\Api;
// use Illuminate\Support\Facades\Request;
// use Illuminate\Foundation\Http\FormRequest;


use Twilio\Rest\Client;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\ChatGrant;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use App\Models\AuthenticationModel;
use App\Models\UserChekinModel;
use App\Models\BarModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Session;
const LOGIN ="Login successfully";
const UserRegister ="User has been registered Successfully";
const WENTWRONG="Something went wrong";
const INVALIDEMAILPASSWORD="Invalid email or password";
const Vailid_time = '+20 minutes';
const Forget_password = "Forgot password link send your registered email address";
const INVAILID_LINK="Invalid Link";
const LINKEXPIRED="Link Expired";
const SESSION_TIMEOUT = "Session Expired ";
const CHANGE_PASSWORD="Password changed successfully.";
const NOT_REGISTER="Email does not exist.";
const USER_BLOCKED="your account is blocked contact admin if issue continues";

const NOUSER_FOUND="No user found!";

//require_once "Twilio/autoload.php";
class AuthenticationController extends Controller
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
       


        $user =  new \stdClass();
        $post = $request->all();
          
        $rules = array( 
            "email" => 'required', 
            "password" => 'required',
            "device_type" => 'required', 
            "device_token" => 'required'
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
            $password = md5($post['password']);
            $email = $post['email'];

              $blocked_user = AuthenticationModel::where('email', '=', $email)
                                        ->where('status', '=',"1")
                                        ->first();
               if($blocked_user) 
               {

                $responcearray = array('status' => 400, "success" => false, "message" =>"Your account is blocked, contact admin if issue continues");
                return response()->json($responcearray, 200);
               

               }                        


            $user = AuthenticationModel::select('*', 'full_name AS name')
                                        ->where('password', '=', $password)
                                        ->where('email', '=', $email)
                                        ->where('status', '=',"0")
                                        ->get()->first();
            if($user)
            {

                unset($user['full_name']);
                $param = array(
                    "device_type" => $post['device_type'],
                    "device_token" => $post['device_token'],
                    "updated_at" => Date('Y-m-d H:i:s')
                );
            
                $user["device_type"] = $post['device_type'];
                $user["device_token"] = $post['device_token'];
                $user["updated_at"] = Date('Y-m-d H:i:s');

                $user["login_signup_type"] = 'normal';


                $user["chat"] = $this->userChate($user['user_id']);

                AuthenticationModel::where('user_id', $user['user_id'])->update($param);


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



                $responcearray = array('status' => 200, "success" => true, "message" =>LOGIN, "result" =>$user);
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 400, "success" => false, "message" =>INVALIDEMAILPASSWORD, "result" =>new \stdClass());
                return response()->json($responcearray, 400);
            }   
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

   
    public function create(Request $request)
    {
     
        $users =  new \stdClass();
        $post = $request->all();
          
        $rules = array(
            "full_name" => 'required|unique:t_user', 
            "email" => 'required|unique:t_user',
            "password" => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[@!$#%]).*$/', 
            // "gender" => 'min:0|max:2',  
            // "relationship_status" => 'min:1|max:4',
            "favourite_drink" => 'required',  
            "device_type" => 'required', 
            "device_token" => 'required',
          
            // "login_signup_type" => 'required|in:normal,google,facebook,twitter'
        );

         $customMessages = [
            'regex' => ' The :attribute must contain uppercase, lowercase, digits and Non-alphanumeric.'
        ];

         $validator = Validator::make($post, $rules, $customMessages);

        // $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
     
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>$users);
            return response()->json($responcearray, 400);
        }
        else
        {
            // print_r($post); die;
            
            $photoURL = '';

            if(isset($post['profileImage']) && !empty($post['profileImage']) )
            {
                $filename = time()."profileImage.jpg";
                $path = $request->file('profileImage')->move(public_path("/imageUpload"), $filename);
                $photoURL = url('/imageUpload/'.$filename);
            }
                  
            $post['user_id'] = md5(time().json_encode($post));
            $post['password'] = md5($post['password']);
            $post['username'] = $post['email'];
            $post['full_name'] = $post['full_name'];

            unset($post['name']);
            $post['profileImage'] = (!empty($photoURL)?$photoURL:'');

            $users = AuthenticationModel::create($post);
                
            $email_data= array(
                    'name' => $post['full_name'],
                    'email' => $post['email']
                );

            if($users)
            {   
                    Mail::send('welcome_email', $email_data, function ($message) use ($email_data) {
                        $message->to($email_data['email'], $email_data['name'])
                            ->subject('Welcome')
                            ->from('developer1607@gmail.com');
                    });


                $responcearray = array('status' => 200, "success" => true, "message" =>UserRegister, "result" =>$users);
                return response()->json($responcearray, 200);
            }
            else
            {
               $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" => new \stdClass());
                return response()->json($responcearray, 400); 
            }
            
        }
    }
    public function socialLogin(Request $request){
   
  
// return $request->all();
  $email='';
  $post = $request->all();
if($user=AuthenticationModel::where('provider_id', '=', $request->provider_id)->first())
        {
        $email=$user->email;
        $name=$user->name;
        $provider_name=$user->provider_name;
        $provider_id=$request->provider_id;
        $device_type=$user->device_type;
        $device_token=$user->device_token;
        $fcm_token=$user->fcm_token;

    }
else{

      $email=$request->email;
      $name=$request->name;
      $provider_name=$request->provider_name;
      $provider_id=$request->provider_id;
      $device_type=$request->device_type;
      $device_token=$request->device_token;
      $fcm_token=$request->fcm_token;
    }

    if (AuthenticationModel::where('email', '=', $email)->count() > 0) {

        $ex = AuthenticationModel::where('email',$email)->first();

        if ($ex->provider_name == Null) {

            $email = $email;
            $password = md5($request->password);

           return $this->socialloginwith($device_type,$device_token,$fcm_token);
        }


      elseif (AuthenticationModel::where('provider_id', '=', $provider_id)->count() > 0) {
        
            // $email = $request->email;
            $password = md5($request->password);
            return $this->socialloginwith($device_type,$device_token,$fcm_token);
      }

     else{
                 AuthenticationModel::where('email', $email)
        ->update(['provider_id' => $provider_id,'provider_name' => $provider_name]);

            $email = $email;
            $password = md5($request->password);

           return $this->socialloginwith($device_type,$device_token,$fcm_token);
        }
          
        }
   
else{

   if (AuthenticationModel::where('provider_id', '=', $provider_id)->count() > 0) {
            $email = $email;
            $password = md5($request->password);
            return $this->socialloginwith($device_type,$device_token,$fcm_token);
    }
    else{
  $post['email']=$email;
  $rules = array( 
            "email" => 'required|unique:t_user', 
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

      $user = AuthenticationModel::create([
      'full_name' => $request->full_name,
      'username'=>$request->email,
      'email' => $request->email,
      'provider_id' => $request->provider_id,
      'provider_name' => $request->provider_name,
      'password' => md5($request->password),
      'device_type' => $request->device_type,
      'device_token' => $request->device_token,
      'fcm_token'=>$request->fcm_token,
      'user_id' => md5(time().json_encode($post)),
      ]);
      $email = $request->email;
      $password = $request->password;
      
      return $this->index($request);
      }
    }
            
        }
   
   }
   public function socialloginwith($device_type,$device_token,$fcm_token)
    {
       $credentials = request(['provider_id', 'password']);
      
       

       if (!$check = AuthenticationModel::where('provider_id', '!=', null)->where('provider_id', '=', $credentials['provider_id'])
                                        ->where('status', '=',"0")
                                        ->first()) 
       {
                

         $data['message'] = "This email address is already registered with Barconnex";
         $data['status'] = 200;
         $data['success'] = false;
        
               return response()->json($data);
                // return response()->json(['error' => 'Unauthorized'], 401);
         }
         

       $user=AuthenticationModel::where('provider_id', $credentials['provider_id'])->first();
       $user->login_signup_type = request('provider_name');
       $user->update(['device_type' => $device_type,'device_token' => $device_token,'fcm_token' => $fcm_token]);
       $user->updated_at = Date('Y-m-d H:i:s');
       
       $user->name=$user->full_name;
       $user->chat = $this->userChate($user->id);
       $UserChekin = UserChekinModel::where('user_id', '=', $user->id)->get()->first();
                if (!empty($UserChekin)) 
                {

                    $getBar = BarModel::where('bar_id',$UserChekin['bar_id'])->get()->first();

                    if(!empty($getBar)){

                        $UserChekin['bar_name'] = Controller::getBarDetails($UserChekin['bar_id'])->name;
                        $UserChekin['time'] = date("h:i:s A", strtotime($UserChekin['created_at']));
                        unset($UserChekin['created_at']);
                        unset($UserChekin['updated_at']);
                        unset($UserChekin['id']);
                        $user->checkinDetail =$UserChekin;   

                    }else{
                        $user->checkinDetail=null;

                    }

                }
                else
                {
                    $user->checkinDetail =null;                    
                }                                              

       
            return $this->respondWithToken($user);
    }

protected function respondWithToken($user)
    {

         $data['message'] = "Login Successfully";
         $data['status'] = 200;
         $data['success'] = true;
         $data['result'] = $user;
        // 'expires_in' => auth('api')->factory()->getTTL() * 60
          

        return response()->json($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store($id='')
    {
        $data['forgetpassword_link']=$id;
        $response = "";
        if(!empty($id))
        {
            $user = AuthenticationModel::select('*')
                            ->where('forgetpassword_link', '=', $id)
                            ->get()->first();
            $user1 = $user;
            if(COUNT((array)$user1) > 0)
            {
                if(!empty($user['is_password_link_valid']))
                {
                    $is_password_link_valid = $user['is_password_link_valid'];
                }
                else
                {
                    $is_password_link_valid = '';
                }

                if(empty($user['is_password_link_valid']) || $user['is_password_link_valid'] < date('Y-m-d H:i:s'))
                {
                    // echo $user['is_password_link_valid'];
                    $data['success'] = "";
                    $data['response'] = SESSION_TIMEOUT;
                    return view("emails.changePassword", $data);
                }
                else
                {
                    $data['success'] = "";
                    $data['response'] = "";
                    return view("emails.changePassword", $data);
                }
            }
            else
            {
                $data['success'] = "";
                $data['response'] = LINKEXPIRED;
                return view("emails.changePassword", $data);
            }
        }
        else
        {
            $data['success'] = "";
            $data['response'] = LINKEXPIRED;
            return view("emails.changePassword", $data);
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request)
    {
        $user =  new \stdClass();
        $post = $request->all();
          
        $rules = array( 
            "email" => 'required'
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
            
            $email = $post['email'];

            $user = AuthenticationModel::select('*')
                                        ->where('email', '=', $email)
                                        ->get()->first();


            $user1 = $user;
            if(COUNT((array)$user1) > 0)
            {
                $forgetpassword_link = md5(time().json_encode($user));

                $array = array('forgetpassword_link' => $forgetpassword_link, 'email' => $user['email'], 'name' => $user['name']);

                \Mail::to($user['email'])->send(new \App\Mail\DemoEmail($array));

 
                $param = array(
                    'forgetpassword_link' => $forgetpassword_link,
                    'is_password_link_valid' => date('Y-m-d H:i:s',strtotime(Vailid_time)),
                    "updated_at" => Date('Y-m-d H:i:s')
                );
         
                AuthenticationModel::where('user_id', $user['user_id'])->update($param);

                $responcearray = array('status' => 200, "success" => true, "message" =>Forget_password, "result" =>new \stdClass());
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 400, "success" => false, "message" =>NOT_REGISTER, "result" =>new \stdClass());
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

    public function edit(Request $request)
    {
        $post = $request->all();
        // $filename = time()."user_pic.jpg";

        // $path = $request->file('photo')->move(public_path("/imageUpload"), $filename);
        // $photoURL = url('/imageUpload/'.$filename);
        // return response()->json(['photo'=>$photoURL], 200);
        
        $photoURL = '';
        if (isset($post['profile_pic']) && !empty($post['profile_pic']) )
        {
            $image = explode(",", $post['profile_pic']);
            $image = base64_decode(end($image));
            $imagename = md5(rand())."_profile_pic".".png";
            file_put_contents(public_path("/imageUpload/").$imagename, $image);
            $photoURL = url('/imageUpload/'.$imagename);
        }

                   
         return response()->json(['photo'=>$photoURL], 200);
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
        $post = $request->all();
        $data['forgetpassword_link'] = $post['forgetpassword_link'];
          
        $rules = array( 
            "new_password" => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[@!$#%]).*$/', 
        );

        $customMessages = [
            'regex' => ' The :attribute must contain uppercase, lowercase, digits and Non-alphanumeric.'
        ];

        $validator = Validator::make($post, $rules, $customMessages);

        // $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
            $data['success'] = "";
            $data['response'] = "";
            return view("emails.changePassword", $data);
        }
        else
        {
            
            $param = array(
                    "password" => md5($post['new_password']),
                    "is_password_link_valid" => NULL,
                    "updated_at" => Date('Y-m-d H:i:s')
                );
            
            $update = AuthenticationModel::where('forgetpassword_link', $data['forgetpassword_link'])->update($param);
            if($update)
            {
                $data['success'] = CHANGE_PASSWORD;
                $data['response'] = "";
                return view("emails.changePassword", $data);
            }
            else
            {
                $data['success'] = "";
                $data['response'] = WENTWRONG;
                return view("emails.changePassword", $data);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        //
    }

    private function displayValidation($error) 
    {
        $error = str_replace("</p>", "", $error);
        $error = str_replace("<p>", "", $error);
        $error = str_replace("\n", " ", $error);
        return $error;
    }


    public function createToken(Request $request)
    {
        $twilioAccountSid = 'AC21254c8d77ce543d8bfa377d3ea4a285';
        $twilioApiKey = 'SK9db1007ae0a8203fabf64c534e27485d';
        $twilioApiSecret = '5GdkdVs1AoXH7lMubEtHdUXCNi6zihXR';

        // Required for Chat grant
        $serviceSid = 'IS1015e85edd4247299dc1f9586935ae2f';
        // choose a random username for the connecting user
        $identity = $request->userEmail;

        // Create access token, which we will serialize and send to the client
        $token = new AccessToken(
            $twilioAccountSid,
            $twilioApiKey,
            $twilioApiSecret,
            3600,
            $identity
        );

        // Create Chat grant
        $chatGrant = new ChatGrant();
        $chatGrant->setServiceSid($serviceSid);

        // Add grant to token
        $token->addGrant($chatGrant);

        // render token to string
        // echo $token->toJWT();
        $responcearray = array('status' => 200, "success" => true, "message" =>"Token created successfully", "result" => $token->toJWT());
        return response()->json($responcearray, 200);
    }


    public function createChannel(Request $request)
    {

    
        $sid = "AC21254c8d77ce543d8bfa377d3ea4a285";
        $token = "f01ee154463eba99dd0d60258bd816c6";
        $twilio = new Client($sid, $token);

        $channel_name = $request->firstUser."".$request->secUser;
        $channel1 = $request->firstUser."".$request->secUser;
        $channel2 = $request->secUser."".$request->firstUser;
        $friendlyName = $request->firstUserName."".$request->secUserName;


        $userDetail = AuthenticationModel::where('user_id',$request->secUser)->first();

        // $friendlyName = $userDetail->username;
        if (empty($userDetail->profileImage)) {
            $profileImage = "https://i.pinimg.com/originals/bd/70/22/bd702201a2b6d8960734f60f34a22754.jpg";
        }else{
            $profileImage = $userDetail->profileImage;
        }

        $channels = $twilio->chat->v2->services("IS1015e85edd4247299dc1f9586935ae2f")
                             ->channels
                             ->read([]);
        foreach ($channels as $record) {
            if($record->uniqueName == $channel1 || $record->uniqueName == $channel2){

                // $url = $record->links['last_message'];
                // $massegeSid = basename($url);
                // $message = $twilio->chat->v2->services("IS1015e85edd4247299dc1f9586935ae2f")
                //             ->channels($record->sid)->messages($massegeSid)->fetch();
                
                $chat = $this->userChate($request->firstUser);
                $result = [
                    'serviceSid' => $record->serviceSid,
                    'sid' => $record->sid,
                    'channelName' => $record->uniqueName,
                    'name' => $userDetail->full_name,
                    'profileImage' => $profileImage,
                    // 'lastMessage' => $message->body,
                    'firstUser' => $request->firstUser,
                    'secUser' => $request->secUser,
                    'chat' => $chat,
                ];
                $responcearray = array(
                    'status' => 400, 
                    "success" => false, 
                    "message" =>"Channel ". $record->uniqueName ." already exists", 
                    "result" =>$result);
                return response()->json($responcearray, 400);
            }
        }
        $channel = $twilio->chat->v2->services("IS1015e85edd4247299dc1f9586935ae2f")
                                    ->channels
                                    ->create(array("friendlyName" => $friendlyName, "uniqueName"=>$channel_name));
        if($channel){

            $member1 = $twilio->chat->v2->services("IS1015e85edd4247299dc1f9586935ae2f")
                ->channels($channel->sid)
                ->members
                ->create($request->firstUser);
            $member2 = $twilio->chat->v2->services("IS1015e85edd4247299dc1f9586935ae2f")
                        ->channels($channel->sid)
                        ->members
                        ->create($request->secUser);

            $chat = $this->userChate($request->firstUser);

            $result = [
                'serviceSid' => $channel->serviceSid,
                'sid' => $channel->sid,
                'channelName' => $channel->uniqueName,
                'name' => $userDetail->full_name,
                'profileImage' => $profileImage,
                'firstUser' => $request->firstUser,
                'secUser' => $request->secUser,
                'chat' => $chat,
            ];
            $responcearray = array('status' => 200, "success" => true, "message" =>"Channel created successfully", "result" => $result);
            return response()->json($responcearray, 200);
        }
    }

    public function getUserChannel(Request $request){

        $sid = "AC21254c8d77ce543d8bfa377d3ea4a285";
        $token = "f01ee154463eba99dd0d60258bd816c6";
        $services = "IS1015e85edd4247299dc1f9586935ae2f";
        $twilio = new Client($sid, $token);
        $result = [];
        $userChannels = $twilio->chat->v2->services($services)
                                        ->users($request->user)
                                        ->userChannels
                                        ->read();

        foreach ($userChannels as $key => $record) {

            $channel = $twilio->chat->v2->services($services)
                                        ->channels($record->channelSid)
                                        ->fetch();
            $message = $twilio->chat->v2->services($services)
                                        ->channels($record->channelSid)
                                        ->messages(basename($channel->links['last_message']))
                                        ->fetch();

            $members = $twilio->chat->v2->services($services)
                                        ->channels($record->channelSid)
                                        ->members
                                        ->read([]);
            foreach($members as $member){
                if ($member->identity != $request->user) {
                    $userDetail = AuthenticationModel::where('user_id',$member->identity)->first();

                    if (empty($userDetail->profileImage)) {
                        $profileImage = "https://i.pinimg.com/originals/bd/70/22/bd702201a2b6d8960734f60f34a22754.jpg";
                    }else{
                        $profileImage = $userDetail->profileImage;
                    }
                    // dd($userDetail);
                    if ($userDetail) {
                        $result[] = [
                            'id' => $record->channelSid,
                            'name' => $userDetail->full_name,
                            'profileImage' => $profileImage,
                            'lastMessage' => $message->sid ? $message->body : null,
                            'dateCreated' => $message->sid ? $message->dateCreated->format('Y-m-d H:i:s') : null,
                            'time' => $message->sid ? $message->dateCreated->format('H:i') : null,
                        ];
                    }

                }
                
            }
            
        }

        \Log::error("Cron is working fine!");
        \Log::info(["Request"=> $result]);

        if ($result) {
            $responcearray = array('status' => 200, "success" => true, "message" =>"Channel get successfully", "result" => $result);
            return response()->json($responcearray, 200);
        }

        $responcearray = array('status' => 400, "success" => false, "message" =>NOUSER_FOUND, "result" =>new \stdClass());
        return response()->json($responcearray, 400);
    }


    public function userChate($user_id = null)
    {
        $sid = "AC21254c8d77ce543d8bfa377d3ea4a285";
        $token = "f01ee154463eba99dd0d60258bd816c6";
        $services = "IS1015e85edd4247299dc1f9586935ae2f";
        $twilio = new Client($sid, $token);
        $result = [];

        $userChannels = $twilio->chat->v2->services($services)
                                        ->users($user_id)
                                        ->userChannels
                                        ->read();

        foreach ($userChannels as $key => $record) {

            $channel = $twilio->chat->v2->services($services)
                                        ->channels($record->channelSid)
                                        ->fetch();
            $message = $twilio->chat->v2->services($services)
                                        ->channels($record->channelSid)
                                        ->messages(basename($channel->links['last_message']))
                                        ->fetch();

            $members = $twilio->chat->v2->services($services)
                                        ->channels($record->channelSid)
                                        ->members
                                        ->read([]);
            foreach($members as $member){
                if ($member->identity != $user_id) {
                    $userDetail = AuthenticationModel::where('user_id',$member->identity)->first();

                    if (empty($userDetail->profileImage)) {
                        $profileImage = "https://i.pinimg.com/originals/bd/70/22/bd702201a2b6d8960734f60f34a22754.jpg";
                    }else{
                        $profileImage = $userDetail->profileImage;
                    }
                    // dd($userDetail);
                    if ($userDetail) {
                        $result[] = [
                            'id' => $record->channelSid,
                            'name' => $userDetail->full_name,
                            'profileImage' => $profileImage,
                            'lastMessage' => $message->sid ? $message->body : null,
                            'dateCreated' => $message->sid ? $message->dateCreated->format('Y-m-d H:i:s') : null,
                            'time' => $message->sid ? $message->dateCreated->format('H:i') : null,
                        ];
                    }

                }
                
            }
            
        }


        return $result;

    }


// public function socialLogin(Request $request){
   
//   $email='';

// if($user=User::where('provider_id', '=', $request->provider_id)->first())
//         {
//         $email=$user->email;
//         $name=$user->name;
//         $provider_name=$user->provider_name;
//         $provider_id=$request->provider_id;
//         $device_type=$user->device_type;
//         $device_token=$user->device_token;
//         $fcm_token=$user->fcm_token;

//     }
// else{

//       $email=$request->email;
//       $name=$request->name;
//       $provider_name=$request->provider_name;
//       $provider_id=$request->provider_id;
//       $device_type=$request->device_type;
//       $device_token=$request->device_token;
//       $fcm_token=$request->fcm_token;
//     }

//     if (User::where('email', '=', $email)->count() > 0) {

//         $ex = User::where('email',$email)->first();

//         if ($ex->provider_name == Null) {

//             $email = $email;
//             $password = Hash::make($request->password);

//            return $this->socialloginwith($device_type,$device_token,$fcm_token);
//         }


//       elseif (User::where('provider_id', '=', $provider_id)->count() > 0) {
        
//             // $email = $request->email;
//             $password = Hash::make($request->password);
//             return $this->socialloginwith($device_type,$device_token,$fcm_token);
//       }

//      else{
//                  User::where('email', $email)
//         ->update(['provider_id' => $provider_id,'provider_name' => $provider_name]);

//             $email = $email;
//             $password = Hash::make($request->password);

//            return $this->socialloginwith($device_type,$device_token,$fcm_token);
//         }
          
//         }
   
// else{

//    if (User::where('provider_id', '=', $provider_id)->count() > 0) {
//       $email = $email;
//             $password = Hash::make($request->password);
//             return $this->socialloginwith($device_type,$device_token,$fcm_token);
//     }
//     else{
     
//      $user = User::create([
//       'name' => $request->name,
//       'email' => $request->email,
//       'provider_id' => $request->provider_id,
//       'provider_name' => $request->provider_name,
//       'password' => Hash::make($request->password),
//       'device_type' => $request->device_type,
//       'device_token' => $request->device_token,
//        'fcm_token'=>$request->fcm_token,
//       ]);
//       $email = $request->email;
//       $password = $request->password;
      
//       return $this->login();
//     }
            
//         }
   
//    }
//    public function socialloginwith($device_type,$device_token,$fcm_token)
//     {
//        $credentials = request(['provider_id', 'password']);
      
       

//        if (!$token = JWTAuth::attempt($credentials)) {

               
//                 return response()->json(['error' => 'Unauthorized'], 401);
//          }

//  $user=User::where('provider_id', $credentials['provider_id'])->first();
      
//           $user->update(['device_type' => $device_type,'device_token' => $device_token,'fcm_token' => $fcm_token]);
//             return $this->respondWithToken($token,$user);
//     }

// protected function respondWithToken($token,$user)
//     {

//          $data['message'] = "Login Successfully";
//          $data['status'] = 200;
//          $data['data'] = [
//         'access_token' => $token,
//         'token_type' => 'bearer',
//         'user_details'=>$user
//         // 'expires_in' => auth('api')->factory()->getTTL() * 60
//     ];

//         return response()->json($data);
//     }


    


 }
