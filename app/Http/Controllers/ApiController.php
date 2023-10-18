<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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



class ApiController extends Controller
{
    public function register(Request $request)
    {
        $users =  new \stdClass();
        $data = $request->only('full_name', 'email', 'password');
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

        //Request is valid, create new user
        $post['user_id'] = md5(time().json_encode($post));
            $post['password'] = md5($post['password']);
            $post['username'] = $post['email'];
            $post['full_name'] = $post['full_name'];

        $users = User::create($post);
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

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        //valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        $user = User::where('email',$request->email)->first();
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
         $blocked_user = User::where('email', '=', $request->email)
                                        ->where('status', '=',"1")
                                        ->get()->first();
               if($blocked_user) 
               {

            $responcearray = array('status' => 200, "success" => true, "message" =>USER_BLOCKED);
                return response()->json($responcearray, 200);
               

               }                        
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
            return $credentials;
            return response()->json([
                'success' => false,
                'message' => 'Could not create token.',
            ], 500);
        }

        //Token created, return with success response and jwt token
        return response()->json([
            'success' => true,
            'token' => $token,
             'user'=>$user,
        ]);
    }

    public function logout(Request $request)
    {
        //valid credential
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is validated, do logout
        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function get_user(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);

        return response()->json(['user' => $user]);
    }

public function socialLogin(Request $request){
   
  
// return $request->all();
  $email='';
  $post = $request->all();
if($user=User::where('provider_id', '=', $request->provider_id)->first())
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

    if (User::where('email', '=', $email)->count() > 0) {

        $ex = User::where('email',$email)->first();

        if ($ex->provider_name == Null) {

            $email = $email;
            $password = Hash::make($request->password);

           return $this->socialloginwith($device_type,$device_token,$fcm_token);
        }


      elseif (User::where('provider_id', '=', $provider_id)->count() > 0) {
        
            // $email = $request->email;
            $password = Hash::make($request->password);
            return $this->socialloginwith($device_type,$device_token,$fcm_token);
      }

     else{
                 User::where('email', $email)
        ->update(['provider_id' => $provider_id,'provider_name' => $provider_name]);

            $email = $email;
            $password = Hash::make($request->password);

           return $this->socialloginwith($device_type,$device_token,$fcm_token);
        }
          
        }
   
else{

   if (User::where('provider_id', '=', $provider_id)->count() > 0) {
      $email = $email;
            $password = Hash::make($request->password);
            return $this->socialloginwith($device_type,$device_token,$fcm_token);
    }
    else{
     
     

     $user = User::create([
      'full_name' => $request->full_name,
      'username'=>$request->email,
      'email' => $request->email,
      'provider_id' => $request->provider_id,
      'provider_name' => $request->provider_name,
      'password' => Hash::make($request->password),
      'device_type' => $request->device_type,
      'device_token' => $request->device_token,
      'fcm_token'=>$request->fcm_token,
      'user_id' => md5(time().json_encode($post)),
      ]);
      $email = $request->email;
      $password = $request->password;
      
      return $this->authenticate($request);
    }
            
        }
   
   }
   public function socialloginwith($device_type,$device_token,$fcm_token)
    {
       $credentials = request(['provider_id', 'password']);
      
       

       if (!$token = JWTAuth::attempt($credentials)) {

               
                return response()->json(['error' => 'Unauthorized'], 401);
         }

 $user=User::where('provider_id', $credentials['provider_id'])->first();
      
          $user->update(['device_type' => $device_type,'device_token' => $device_token,'fcm_token' => $fcm_token]);
            return $this->respondWithToken($token,$user);
    }

protected function respondWithToken($token,$user)
    {

         $data['message'] = "Login Successfully";
         $data['status'] = 200;
         $data['data'] = [
        'access_token' => $token,
        'token_type' => 'bearer',
        'user_details'=>$user
        // 'expires_in' => auth('api')->factory()->getTTL() * 60
    ];

        return response()->json($data);
    }






}