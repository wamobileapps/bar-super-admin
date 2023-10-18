<?php

namespace App\Http\Controllers\Api;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BareventModel;
use App\Models\UserEventModel;
use App\Models\UserEventAddModel;
use App\Models\AuthenticationModel;
use Illuminate\Support\Facades\Validator;
const LOGIN ="Login successfully";
const BAR_ADD ="Bar event created successfully";
const BAR_GET ="Bars event data get successfully";
const BAR_GET_single ="Bar event data get successfully";
const BAR_GET_UPDATE ="Bar event data update successfully";
const BAR_GET_DELETE ="Bar event data delete successfully";
const BAR_NOT_DELETE ="Bar event data not delete successfully";
const WENTWRONG="Something went wrong";
const DATA_NOT="Bars event not available";
const USER_NOT="User not available";
const INVAILID_ID="Invalid id";

class BareventController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $Bar = BareventModel::get();

        if($Bar)
        {
            
            $responcearray = array('status' => 200, "success" => true, "message" =>BAR_GET, "result" =>$Bar);
            return response()->json($responcearray, 200);
        }
        else
        {
            $responcearray = array('status' => 404, "success" => false, "message" =>DATA_NOT, "result" =>array());
            return response()->json($responcearray, 404);
        }       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $post = $request->all();

        $rules = array(
            "bar_id" => "required", 
            "name" => "required", 
            "description" => "required", 
            "event_type" => "required", 
            "start_date" => "required", 
            "start_time" => "required", 
//            "end_date" => "required",
            // "end_time" => "required"
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

//            $getgame = BareventModel::where('bar_id', $post['bar_id'])->where('name', $post['name'])->first();
//            if ($getgame) {
//               $responcearray = array('status' => 400, "success" => false, "message" =>"The name has already been taken.", "result" =>new \stdClass());
//               return response()->json($responcearray, 400);
//            }

            if(isset($post['image']) && !empty($post['image']) )
            {
                $image = explode(",", $post['image']);
                $image = base64_decode(end($image));
                $imagename = md5(time())."_eventimage".".png";
                file_put_contents(public_path("Uploads/barevent/").$imagename, $image);
                $post['image'] = url('Uploads/barevent/'.$imagename);
            }
            else
            {
                $post['image'] = url('img/bar-default-image.png');
            }

            $bar = BareventModel::create($post);

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
    public function show($id = '')
    {
        
        if(empty($id))
        {
            
            $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>new \stdClass());
            return response()->json($responcearray, 404);
        }
        else
        {
            
            $bar = BareventModel::select('*')
                            ->where('event_id', '=', $id)
                            ->get()->first();

            if($bar)
            {
               
                $responcearray = array('status' => 200, "success" => true, "message" =>BAR_GET_single, "result" =>$bar);
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>new \stdClass());
                return response()->json($responcearray, 404);
            }   
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEventsByBar(Request $request)
    {

        $post = $request->all();
          
        $rules = array(
            "bar_id" => "required", 
            "user_id" => "required"
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

            $sql = 'SELECT IF("t_user_event_favourite.favourite_id", "true", "false")';

            $user = BareventModel::select('t_bar_event.event_id','t_bar_event.name as eventName','t_bar_event.image','t_bar_event.description','t_bar_event.start_date','t_bar_event.start_time','t_bar_event.end_date','t_bar_event.end_time')
                                ->selectSub($sql, 'isFavourite')
                                ->from('t_bar_event')
                                ->join('t_bar', 't_bar_event.bar_id', '=', 't_bar.bar_id')
                                ->leftJoin('t_user_event_favourite', 't_bar_event.event_id', '=', 't_user_event_favourite.favourite_id')
                                ->where('t_bar_event.bar_id', '=', $post['bar_id'])
                                ->whereDate('start_date', '>=', Carbon::now()->format('Y-m-d'))
                                ->get();


            foreach ($user as $key => $value) {

                $value['people_in'] = UserEventModel::where('event_id', $value['event_id'])->get()->count();
                $value['possible_in'] = UserEventAddModel::where('event_id', $value['event_id'])->get()->count();

                $value['start_time'] = date('h:i A', strtotime($value['start_time']));
                $value['end_time'] = date('h:i A', strtotime($value['end_time']));

                if ($value['start_date'] == Carbon::now()->format('Y-m-d')) {
                    $value['day'] = "Today";
                } elseif ($value['start_date'] == Carbon::tomorrow()->format('Y-m-d')) {
                    $value['day'] = "Tomorrow";
                }else{
                    $value['day'] = Carbon::createFromFormat("Y-m-d", $value['start_date'])->format('m/d/Y');
                }
            }
            
            

            $count = $user->count();
            if($count > 0)
            {
                $responcearray = array('status' => 200, "success" => true, "message" =>BAR_GET, "result" =>$user);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        if(empty($id))
        {
            
            $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>new \stdClass());
            return response()->json($responcearray, 404);
        }
        else
        {
                $post = $request->all();
                  
                $rules = array(
                    "bar_id" => "required", 
                    "name" => "required", 
                    "description" => "required", 
                    "event_type" => "required", 
                    "start_date" => "required", 
                    "start_time" => "required", 
                    "end_date" => "required", 
                    "end_time" => "required"
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

                    $getgame = BareventModel::where('bar_id', $post['bar_id'])->where('event_id','!=', $id)->where('name', $post['name'])->first();

                    if ($getgame) {
                       $responcearray = array('status' => 400, "success" => false, "message" =>"The name has already been taken.", "result" =>new \stdClass());
                       return response()->json($responcearray, 400);
                    }
                    
                    $bars = BareventModel::where('event_id', $id)->update($post);

                    $responcearray = array('status' => 200, "success" => true, "message" =>BAR_GET_UPDATE, "result" =>$bars);
                    return response()->json($responcearray, 200);
                }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id='')
    {
        if(empty($id))
        {
            
            $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>new \stdClass());
            return response()->json($responcearray, 404);
        }
        else
        {
             $bars = BareventModel::where('event_id', $id)->delete();

             if($bars)
             {
                $responcearray = array('status' => 200, "success" => true, "message" =>BAR_GET_DELETE, "result" =>$bars);
                return response()->json($responcearray, 200);
             }
             else
             {
                $responcearray = array('status' => 400, "success" => false, "message" =>BAR_NOT_DELETE, "result" =>$bars);
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
    public function getPossibleUserList(Request $request)
    {
        $post = $request->all();
          
        $rules = array(
            "bar_id" => "required", 
            "event_id" => "required",
            "user_id" => "required"
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
            
            $possibleIn = UserEventModel::where('event_id', $post['event_id'])
                                                  ->where('bar_id', $post['bar_id'])->get();


            foreach ($possibleIn as $key => $value) {

                $users[] = AuthenticationModel::select('user_id', 'username', 'full_name', 'email', 'profileImage')->where('user_id', $value['user_id'])->first();

                $userData['is_blocked']= Controller::getBlockUser($post['user_id'],$value['user_id']);
                if($value['is_blocked'] == true){
                         unset($value[$key]);

                }

            }

            if(!empty($users))
            {
                $responcearray = array('status' => 200, "success" => true, "message" =>BAR_GET, "result" =>$users);
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 400, "success" => false, "message" =>USER_NOT, "result" => array());
                return response()->json($responcearray, 400);
            }
        }            
    }
}
