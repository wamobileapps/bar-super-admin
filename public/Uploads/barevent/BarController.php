<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use App\Models\BarModel;
use App\Models\BareventModel;
use Illuminate\Support\Facades\Validator;
const LOGIN ="Login successfully";
const BAR_ADD ="Bar created successfully";
const BAR_GET ="Bars data get successfully";
const BAR_GET_single ="Bar data get successfully";
const BAR_GET_UPDATE ="Bar data update successfully";
const BAR_GET_DELETE ="Bar data delete successfully";
const BAR_NOT_DELETE ="Bar data not delete successfully";
const WENTWRONG="Something went wrong";
const DATA_NOT="Bars not available";
const INVAILID_ID="Invalid id";

class BarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $post = $request->all();
          
        $rules = array(
            "user_id" => 'required',
            "latitude" => 'required',
            "longitude" => 'required'
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

                $user_id = $post['user_id'];

                $result = array();
                $results = array();
                $stdate = date("Y-m-d", strtotime('monday this week'));
                $etdate = date("Y-m-d", strtotime('sunday this week'));
                $bar = BarModel::select('*')
                                  ->get();
                $count = $bar->count();
                if($count > 0)
                {
                    foreach ($bar as $key => $value) {

                        $barUpdate = BarModel::select('*')
                                    ->from('t_bar')
                                    ->join('t_user_favourite', 't_bar.bar_id', '=', 't_user_favourite.favourite_id')
                                    ->where('favourite_type', '=', '2')
                                    ->where('user_id', '=', $user_id)
                                    ->where('bar_id', '=', $value['bar_id'])
                                    ->get();

                        $value['isFavourite'] = ($barUpdate->count()>0?true:false);

                        $barGame = BarModel::select('t_bar.name as bar_name','t_bar_game.id as game_id','t_bar_game.name','t_bar_game.description','t_bar_game.image AS barImage')
                                    ->from('t_bar')
                                    ->join('t_bar_game', 't_bar.bar_id', '=', 't_bar_game.bar_id')
                                    ->where('t_bar.bar_id', '=', $value['bar_id'])
                                    ->get();
                        $value['activities'] = $barGame;
                        $value['rating'] = 0;

                        $result[] = $value;   
                    }

                    $results['bars'] = $result;

                    $barAllGame = BarModel::select('t_bar.name as bar_name','t_bar_game.id as game_id','t_bar_game.name','t_bar_game.description','t_bar_game.image AS barImage')
                                    ->from('t_bar')
                                    ->join('t_bar_game', 't_bar.bar_id', '=', 't_bar_game.bar_id')
                                    ->get();
                    $results['activities'] = $barAllGame;

                    $weekEvent = BarModel::select('t_bar_event.event_id', 't_bar.name as bar_name', 't_bar_event.name', 't_bar_event.description', 't_bar_event.icon', 't_bar_event.image', 't_bar_event.color', 't_bar_event.start_date', 't_bar_event.start_time', 't_bar_event.end_date', 't_bar_event.end_time')
                                    ->from('t_bar')
                                    ->join('t_bar_event', 't_bar.bar_id', '=', 't_bar_event.bar_id')
                                    ->where('start_date', '>=', $stdate)
                                    ->Where('end_date', '>=', $etdate)
                                    ->get();


                    $results['WeekOFEvent'] = $weekEvent;

                   // echo BarModel::toSql();
                    
                    $responcearray = array('status' => 200, "success" => true, "message" =>BAR_GET, "result" =>$results);
                    return response()->json($responcearray, 200);
                }
                else
                {
                    $responcearray = array('status' => 404, "success" => false, "message" =>DATA_NOT, "result" =>array());
                    return response()->json($responcearray, 404);
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
        
        $post = $request->all();
          
        $rules = array(
            "name" => 'required|unique:t_bar',
            "address" => 'required',
            "latitude" => 'required',
            "longitude" => 'required'
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
            

            if(isset($post['cover_image']) && !empty($post['cover_image']) )
            {
                $image = explode(",", $post['cover_image']);
                $image = base64_decode(end($image));
                $imagename = md5(time())."_barimage".".png";
                file_put_contents(public_path("Uploads/bar/").$imagename, $image);
                $post['cover_image'] = url('Uploads/bar/'.$imagename);
            }
            else
            {
                $post['cover_image'] = NULL;
            }

            $bar = BarModel::create($post);

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
    public function show(Request $request)
    {
        
        $post = $request->all();
          
        $rules = array(
            "user_id" => 'required',
            "bar_id" => 'required'
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
            
                $user_id = $post['user_id'];
                $bar_id = $post['bar_id'];

                
                $bar = BarModel::select('*')
                                  ->where('bar_id', '=', $bar_id)
                                  ->get()->first();
                $count = $bar->count();
                if($count > 0)
                {


                        $barFevourite = BarModel::select('*')
                                    ->from('t_bar')
                                    ->join('t_user_favourite', 't_bar.bar_id', '=', 't_user_favourite.favourite_id')
                                    ->where('favourite_type', '=', '2')
                                    ->where('user_id', '=', $user_id)
                                    ->where('bar_id', '=', $bar['bar_id'])
                                    ->get();

                        $bar['isFavourite'] = ($barFevourite->count()>0?true:false);
                        $bar['rating'] = 0;
                        $events = BareventModel::select('t_bar_event.event_id', 't_bar.name as bar_name', 't_bar_event.name', 't_bar_event.description', 't_bar_event.icon', 't_bar_event.image', 't_bar_event.color', 't_bar_event.start_date', 't_bar_event.start_time', 't_bar_event.end_date', 't_bar_event.end_time', 'IF(t_user_favourite.favourite_id > 0, true, false) AS isFavourite')
                                    ->from('t_bar_event')
                                    ->join('t_bar', 't_bar.bar_id', '=', 't_bar_event.bar_id')
                                    ->Join('t_user_favourite', 't_bar_event.event_id', '=', 't_user_favourite.favourite_id')
                                    ->where('t_user_favourite.favourite_type', '=', '4')
                                    ->where('t_bar_event.bar_id', '=', $bar['bar_id'])
                                    ->get();
                                    //->join('t_user_favourite', 't_bar_event.event_id', '=', 't_user_favourite.favourite_id')
                                    //->where('favourite_type', '=', '4')
                                    
                        
                        $bar['Events'] = $events;
                        // $barGame = BarModel::select('t_bar.name as bar_name','t_bar_game.id as game_id','t_bar_game.name','t_bar_game.description','t_bar_game.image')
                         //             ->from('t_bar')
                        //             ->join('t_bar_game', 't_bar.bar_id', '=', 't_bar_game.bar_id')
                        //             ->where('t_bar.bar_id', '=', $bar['bar_id'])
                        //             ->get();
                        // $bar['activities'] = $barGame;
                        

                          
                    

                    // $barAllGame = BarModel::select('t_bar.name as bar_name','t_bar_game.id as game_id','t_bar_game.name','t_bar_game.description','t_bar_game.image')
                    //                 ->from('t_bar')
                    //                 ->join('t_bar_game', 't_bar.bar_id', '=', 't_bar_game.bar_id')
                    //                 ->get();
                    // $results['activities'] = $barAllGame;

                    // $weekEvent = BarModel::select('t_bar_event.event_id', 't_bar.name as bar_name', 't_bar_event.name', 't_bar_event.description', 't_bar_event.icon', 't_bar_event.image', 't_bar_event.color', 't_bar_event.start_date', 't_bar_event.start_time', 't_bar_event.end_date', 't_bar_event.end_time')
                    //                 ->from('t_bar')
                    //                 ->join('t_bar_event', 't_bar.bar_id', '=', 't_bar_event.bar_id')
                    //                 ->where('start_date', '>=', $stdate)
                    //                 ->Where('end_date', '>=', $etdate)
                    //                 ->get();


                    // $results['WeekOFEvent'] = $weekEvent;

                   // echo BarModel::toSql();
                    
                    $responcearray = array('status' => 200, "success" => true, "message" =>BAR_GET, "result" =>$bar);
                    return response()->json($responcearray, 200);
                }
                else
                {
                    $responcearray = array('status' => 404, "success" => false, "message" =>DATA_NOT, "result" => new \stdClass());
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
        if(empty($id))
        {
            
            $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>new \stdClass());
            return response()->json($responcearray, 404);
        }
        else
        {
                $post = $request->all();
                  
                $rules = array(
                    "name" => 'required',
                    "address" => 'required',
                    "latitude" => 'required',
                    "longitude" => 'required'
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
                    
                    $bars = BarModel::where('bar_id', $id)->update($post);

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
             $bars = BarModel::where('bar_id', $id)->delete();

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
}
