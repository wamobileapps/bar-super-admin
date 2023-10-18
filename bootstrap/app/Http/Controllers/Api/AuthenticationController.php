<?php

namespace App\Http\Controllers\Api;
// use Illuminate\Support\Facades\Request;
// use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use App\Models\AuthenticationModel;
use Illuminate\Support\Facades\Validator;
const LOGIN ="Login successfully";
const UserRegister ="User has been registered Successfully";
const WENTWRONG="Something went wrong";
const INVALIDEMAILPASSWORD="Invalid email or password";
class AuthenticationController extends Controller
{
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
            $user = AuthenticationModel::select('*')
                                        ->where('password', '=', $password)
                                        ->where('email', '=', $email)
                                        ->get()->first();

            if($user)
            {
                $param = array(
                        "device_type" => $post['device_type'],
                        "device_token" => $post['device_token'],
                        "updated_at" => Date('Y-m-d H:i:s')
                    );
                
                $user["device_type"] = $post['device_type'];
                $user["device_token"] = $post['device_token'];
                $user["updated_at"] = Date('Y-m-d H:i:s');

                AuthenticationModel::where('user_id', $user['user_id'])->update($param);

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
            "name" => 'required', 
            "email" => 'required|unique:t_user', 
            "password" => 'required', 
            "gender" => 'required',  
            "age" => 'required',  
            "device_type" => 'required', 
            "device_token" => 'required'
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
            
            $post['user_id'] = md5(time().json_encode($post));
            $post['password'] = md5($post['password']);

            $users = AuthenticationModel::create($post);

            if($users)
            {
                $responcearray = array('status' => 200, "success" => true, "message" =>UserRegister, "result" =>$users);
                return response()->json($responcearray, 200);
            }
            else
            {
               $responcearray = array('status' => 200, "success" => true, "message" =>UserRegister, "result" =>$users);
                return response()->json($responcearray, 200); 
            }
            
        }
    }

    



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
    public function update(Request $request, $id)
    {
        $post = $request->all();
          
        $rules = array(
            "name" => 'required', 
            "email" => 'required', 
            "password" => 'required', 
            "gender" => 'required',  
            "age" => 'required',  
            "device_type" => 'required', 
            "device_token" => 'required'
        );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
            $responcearray = array('status' => 400, "success" => false, "message" => $this->displayValidation($validator->errors()), "result" => new stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {
            
            $post['user_id'] = md5(date('Ymdihis'));
            $post['password'] = md5($post['password']);
            $country = AuthenticationModel::create($post);
            return response()->json($country, 201);
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
}
