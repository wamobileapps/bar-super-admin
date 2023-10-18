<?php 

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\AdminModel;
use Session;
use Auth;
use Hash;
use App\User;



class LoginController extends Controller
{

	public function __construct()
    {
    	
    	//   $this->middleware(function ($request, $next){
     //   		$user_id = session()->get('adminEmail');

     //   		if(!empty($user_id))
     //   		{
     //   			return redirect()->to('dashboard');
     //   		}

	    //     return $next($request);
	    // });
    }

	public function index()
	{
	  return view("login");
	} 

	public function loginProcess(Request $request)
	{
		$user =  new \stdClass();
	    $post = $request->all();
	      
	    $rules = array( 
	        "email" => 'required', 
	        "password" => 'required',
	    );

	    $validator = Validator::make($post, $rules);

		if ($validator->fails()) {
			
			return redirect('login')
			            ->withErrors($validator)
			            ->withInput();
		}
		else
		{
			// print_r($post);

			$password = md5($post['password']);
	        $email = $post['email'];
	        $admin = AdminModel::select('*')
	                                    ->where('password', '=', $password)
	                                    ->where('email', '=', $email)
	                                    ->get()->first();

	        if($admin)
	        {
	        	

	        	session()->put('adminId', $admin['id']);
	        	session()->put('adminEmail', $admin['email']);
	        	session()->put('adminName', $admin['name']);

	        	//dd(session());

	        	return redirect()->to('dashboard');	
	        }
	        else
	        {
	        	session::flash('LoginError','Invalid credentials');
	        	return redirect('login');
	        }
		}
		//return redirect('dashboard');
	} 

	Public function ResetPassword()
	{
		return view('reset-password');
	}
    
    Public function Reset(Request $request)
	{
		 $message = array(
            'current_password.required'=>'The Current Password field is required',
            'password.required' => 'The email field is required.',
            'password.min' => 'Password must be 6 characters long',
            'password.regex' => 'Password must contain atleast one uppercase, one lowercase,one digit and one special character.',
    );
		 $rules = array( 
	        "current_password"=>'required',
	        "password" => 'required|string|min:6|confirmed|regex:((?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$&*]))',
	    );

		 $post=$request->all();

	    $validator = Validator::make($post, $rules,$message);

		if ($validator->fails()) {
			
			return redirect('reset-password')
			            ->withErrors($validator)
			            ->withInput();
		}
		
		if (Hash::check($request->current_password, Auth::user()->password)) {
             
             User::whereId(Auth::user()->id)->update(['password'=>bcrypt($request->password)]);
         
            session::flash('Success','Updated Successfully');
	        	return redirect('reset-password');
        }
        else{
               
                session::flash('Error','Current Password Does Not Match');
	        	return redirect('reset-password');
            }

	}

}


