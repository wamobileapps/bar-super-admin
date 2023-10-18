<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\BarModel;
use App\Models\BareventModel;
use App\Models\BargameModel;
use App\Models\MenucategoryModel;
use App\Models\BarmenuModel;
use App\Models\UserEventModel;
use App\Models\UserEventAddModel;
use App\Models\FavouriteModel;
use App\Models\GameModel;
use Illuminate\Support\Facades\Validator;
use App\Models\AuthenticationModel;
use App\Models\BarPhotowall;
use App\UserDoors;
use App\Models\UserChekinModel;

const INVALIDEMAILPASSWORD="Invalid email or password";
const BAR_GET ="Bars data get successfully";
const BAR_GET_single ="Bar data get successfully";
const BAR_GET_UPDATE ="Bar data update successfully";
const BAR_GET_DELETE ="Bar data delete successfully";
const BAR_NOT_DELETE ="Bar data not delete successfully";
const WENTWRONG="Something went wrong";
const DATA_NOT="Bars not available";
const INVAILID_ID="Invalid id";
const GET_MENU_API="Get menu and category successfully";
const Vailid_time = '+20 minutes';
const Forget_password = "Forgot password link send your registered email address";
const INVAILID_LINK="Invalid Link";
const LINKEXPIRED="Link Expired";
const SESSION_TIMEOUT = "Session Expired ";
const CHANGE_PASSWORD="Password changed successfully.";
const NOT_REGISTER="Email does not exist.";

const NOUSER_FOUND="No user found!";

class BarPhotoWallController extends Controller
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
        
        //......  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $rules = array(
            "user_id" => "required",
            "bar_id" => 'required',
            "photo" => 'required|mimes:jpeg,jpg,png,gif',
            "description" => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        {
     
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>array());
            return response()->json($responcearray, 400);
        }
        
        $photoURL = '';

        $post['profileImage'] = '';
        $filename = time()."profileImage.jpg";
        $path = $request->file('photo')->move(public_path("/imageUpload"), $filename);
        $photoURL = url('/imageUpload/'.$filename);
        $photo = (!empty($photoURL)?$photoURL:'');
        $barPhoto = new BarPhotowall;
        $barPhoto->user_id = $request->user_id;
        $barPhoto->bar_id = $request->bar_id;
        $barPhoto->photo = $photo;
        $barPhoto->title = "Title";
        $barPhoto->description = $request->description;

        if($barPhoto->save())
        {
            $getData = BarPhotowall::where('bar_id', $request->bar_id)->orderByDesc('id')->get();
            foreach ($getData as $key => $value) {
                $value->user_id;
                
                $user = AuthenticationModel::where('user_id', $value->user_id)->first();
                $getData[$key]->user_name = (!empty($user->full_name)) ? $user->full_name : "" ;
                $date = date_create($value->created_at);
                $creat_date = date_format($date,"m/d/Y");
                
                $getData[$key]->date = $creat_date;
            }
            $responcearray = array('status' => 200, "success" => true, "message" =>"Added photowall successfully", "result" =>$getData);
            return response()->json($responcearray, 200);
        }else{
            $responcearray = array('status' => 404, "success" => false, "message" =>WENTWRONG, "result" =>array());
            return response()->json($responcearray, 404);
        }
    }

   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($bar_id)
    {
        
        if(!empty($bar_id))
        {
            $getData = BarPhotowall::where('bar_id', $bar_id)->orderByDesc('id')->get();
            BarPhotowall::where('created_at', '<', Carbon::now()->subHours(12))->delete();
            foreach ($getData as $key => $value) {
                // dd($value);
                $value->user_id;
                $user = AuthenticationModel::where('user_id', $value->user_id)->first();
                $getData[$key]->user_name = (!empty($user->full_name)) ? $user->full_name : "" ;
                $getData[$key]->profileImage = (!empty($user->profileImage)) ? $user->profileImage : "" ;
                $date = date_create($value->created_at);
                $creat_date = date_format($date,"m/d/Y");
                
                $getData[$key]->date = $creat_date;
            }
            $responcearray = array('status' => 200, "success" => true, "message" =>"Bar Photo Wall get successfully", "result" =>$getData);
            return response()->json($responcearray, 200);
        }else{
            $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>new \stdClass());
            return response()->json($responcearray, 404);
        }
    }

   

 

    public function destroy(Request $request)
    {
        $post = $request->all();

        $data = array();
          
        $rules = array(
            "id" => 'required',
            "bar_id" => 'required',
        );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" => new \stdClass());
            return response()->json($responcearray, 400);
        }

        $photowall = BarPhotowall::whereIn('id', $request->id)->delete();
        if($photowall){
            $photowall = BarPhotowall::where('bar_id', $request->bar_id)->orderByDesc('id')->get();
            foreach ($photowall as $key => $value) {
                $value->user_id;
                $user = AuthenticationModel::where('user_id', $value->user_id)->first();
                
                $photowall[$key]->user_name = (!empty($user->full_name)) ? $user->full_name : "" ;
                $date = date_create($value->created_at);
                $creat_date = date_format($date,"m/d/Y");
                
                $getData[$key]->date = $creat_date;
            }
            $responcearray = array('status' => 200, "success" => true, "message" =>"Bar photowall deleted", "result" =>$photowall);
            return response()->json($responcearray, 200);
        }else{
            $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
            return response()->json($responcearray, 400);
        }
    }



    

    public function getBarPhotoWall($bar_id)
    {
        
        
    }
    public function deleteBarPhotowall(Request $request)
    {
        
    }
     
}
