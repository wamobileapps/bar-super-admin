<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use App\Models\AuthenticationModel;
use App\Models\BareventModel;
use App\Models\BargameModel;
use App\Models\BarModel;
use App\Models\FavouriteModel;
use App\Models\BargameFavouriteModel;
use App\Models\BareventFavouriteModel;
use App\Models\BarEventSaveModel;
use Illuminate\Support\Facades\Validator;
const LOGIN ="Login successfully";
const BAR_ADD ="User game created successfully";
const BAR_GET ="Bars game data get successfully";
const FAVOURITE_GAME ="Get user favourite game successfully";
const SAVE_EVENT ="Get user saved event successfully";
const FAVOURITE_BAR ="Get user favourite bar successfully";
const FAVOURITE_EVENT ="Get user favourite event successfully";
const FAVOURITE_GAME_ADD ="Add user favourite game successfully";
const FAVOURITE_BAR_ADD ="Add user favourite bar successfully";
const FAVOURITE_BAR_REMOVE ="Removed user favourite bar successfully";
const FAVOURITE_GAME_REMOVE ="Removed user favourite game successfully";
const FAVOURITE_EVENT_ADD ="Add user favourite event successfully";
const BAR_GET_UPDATE ="User game data update successfully";
const BAR_GET_DELETE ="User game data delete successfully";
const BAR_NOT_DELETE ="User game data not delete successfully";
const DELETE_SAVED_EVENT ="Saved event data deleted successfully";
const WENTWRONG="Something went wrong";
const DATA_NOT="Users game not available";
const INVAILID_ID="Invalid id";

// GetFavouriteGames

class UserfavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id = '')
    {
        

        if(empty($user_id))
        {
            
            $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>array());
            return response()->json($responcearray, 404);
        }
        else
        {
            
           return $Bargame = BargameModel::select('t_bar_game.id as gameId','t_bar_game.name as gameName', 't_bar_game.image as image')
                            ->from('t_bar_game')
                            // ->join('t_bar', 't_bar.bar_id', '=', 't_bar_game.bar_id')
                            ->join('t_user_game_favourite', 't_user_game_favourite.favourite_id', '=', 't_bar_game.id')
                            ->where('t_user_game_favourite.user_id', '=', $user_id)
                            ->get();

            if($Bargame)
            {
               
                $responcearray = array('status' => 200, "success" => true, "message" =>FAVOURITE_GAME, "result" =>$Bargame);
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>array());
                return response()->json($responcearray, 404);
            }   
        }
    }


    public function GetFavouriteBars($user_id = '')
    {
        if(empty($user_id))
        {
            
            $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>array());
            return response()->json($responcearray, 404);
        }
        else
        {

            $sql = 'SELECT true';
            // $Bargame = BargameModel::select('t_bar.bar_id as barID','t_bar.name as barName','t_bar.latitude as barLattitude','t_bar.longitude as barLongitude','cover_image as barImage')->selectSub($sql, 'isFavourite')
            //                 ->from('t_bar_game')
            //                 ->join('t_bar', 't_bar.bar_id', '=', 't_bar_game.bar_id')
            //                 ->join('t_user_favourite', 't_user_favourite.favourite_bar_id', '=', 't_bar_game.id')
            //                 ->where('t_user_favourite.user_id', '=', $user_id)
            //                 ->get();

             $Bargame = BargameModel::select('t_bar.bar_id as barID','t_bar.name as barName','t_bar.close_time as close_time',  't_bar.open_time as open_time', 't_bar.address as bar_address', 't_bar.latitude as barLattitude','t_bar.longitude as barLongitude','cover_image as barImage')->selectSub($sql, 'isFavourite')
                            ->from('t_user_favourite')
                            ->join('t_bar', 't_bar.bar_id', '=', 't_user_favourite.favourite_bar_id')
                            ->join('t_user', 't_user.user_id', '=', 't_user_favourite.user_id')
                            ->where('t_user_favourite.user_id', '=', $user_id)
                            ->get();
                            
            foreach ($Bargame as $key => $value) {
               $value['close_time'] = date('h:i A', strtotime($value['close_time']));
               $value['open_time'] = date('h:i A', strtotime($value['open_time']));
            }

            if($Bargame)
            {
               
                $responcearray = array('status' => 200, "success" => true, "message" =>FAVOURITE_BAR, "result" =>$Bargame);
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>array());
                return response()->json($responcearray, 404);
            }   
        }
    }
    public function GetFavouriteBarsorcheckin($user_id = '')
    {
        if(empty($user_id))
        {

            $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>array());
            return response()->json($responcearray, 404);
        }
        else
        {




            $first = DB::table('t_user_favourite')->select('favourite_bar_id as bar_id')->where('user_id',$user_id)->get();
            $second = DB::table('t_checked_in_user')->select('bar_id')->where('user_id',$user_id)->get();
          $first = json_decode(json_encode($first),true);
            $second = json_decode(json_encode($second),true);
            $final =array_merge($first,$second);
            $Bargame = DB::table('t_bar')->whereIn('bar_id',$final)->get();
           foreach ($Bargame as $bar){
               $fav = DB::table('t_user_favourite')->where('favourite_bar_id',$bar->bar_id)->where('user_id',$user_id)->count();
               $bar->isfavourite= $fav;
           }
            if($Bargame)
            {

                $responcearray = array('status' => 200, "success" => true, "message" =>FAVOURITE_BAR, "result" =>$Bargame);
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>array());
                return response()->json($responcearray, 404);
            }
        }
    }

    

    public function GetFavouriteEvents($user_id = '')
    {
        if(empty($user_id))
        {
            
            $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>array());
            return response()->json($responcearray, 404);
        }
        else
        {
            
            $Bargame = BargameModel::select('t_bar_event.bar_id as barID','t_bar.name as barName','t_bar_event.event_id as eventId','t_bar_event.name as eventName','t_bar_event.start_date','t_bar_event.start_time','t_bar_event.end_date','t_bar_event.end_time', 't_bar.address as bar_address', 't_bar.latitude as barLattitude','t_bar.longitude as barLongitude')
                            ->from('t_bar_event')
                            ->join('t_bar', 't_bar.bar_id', '=', 't_bar_event.bar_id')
                            ->join('t_user_event_favourite', 't_user_event_favourite.favourite_id', '=', 't_bar_event.event_id')
                            ->where('t_user_event_favourite.user_id', '=', $user_id)
                            ->get();

            if($Bargame)
            {
               
                $responcearray = array('status' => 200, "success" => true, "message" =>FAVOURITE_EVENT, "result" =>$Bargame);
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>array());
                return response()->json($responcearray, 404);
            }   
        }
    }



     public function getSavedEvent($user_id = '')
    {
        if(empty($user_id))
        {
            
            $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>array());
            return response()->json($responcearray, 404);
        }
        else
        {
            
           $saved_event = BarEventSaveModel::where('user_id', '=', $user_id)
                            ->get();

            if($saved_event)
            {
               
                $responcearray = array('status' => 200, "success" => true, "message" =>SAVE_EVENT, "result" =>$saved_event);
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>array());
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
                    "user_id" => "required", 
                    "game_id" => "required"
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
            $param = array(
                "user_id" => $post['user_id'],
                "favourite_id" => $post['game_id']
            ); 

            $get = BargameFavouriteModel::select('*')
                                ->where('user_id', '=', $post['user_id'])
                                ->where('favourite_id', '=', $post['game_id'])
                                ->get();
            $count = $get->count();

            if($count > 0)
            {
                $game = BargameFavouriteModel::where('user_id', '=', $post['user_id'])
                                      ->where('favourite_id', '=', $post['game_id'])
                                      ->delete();

                $responcearray = array('status' => 200, "success" => true, "message" =>FAVOURITE_GAME_REMOVE, "result" =>new \stdClass());
                return response()->json($responcearray, 200);
            }
            else
            {
                $game = BargameFavouriteModel::create($param);
                $game['isFavourite'] = true;
            }

            if($game)
            {
                $responcearray = array('status' => 200, "success" => true, "message" =>FAVOURITE_GAME_ADD, "result" =>$game);
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
                return response()->json($responcearray, 400);
            }


        }
    }


    public function createFavouriteBars(Request $request)
    {
        $post = $request->all();
          
        $rules = array(
                    "user_id" => "required", 
                    "bar_id" => "required"
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
            $param = array(
                "user_id" => $post['user_id'],
                "favourite_bar_id" => $post['bar_id']
            ); 

            $get = FavouriteModel::select('*')
                                ->where('user_id', '=', $post['user_id'])
                                ->where('favourite_bar_id', '=', $post['bar_id'])
                                ->get();
            $count = $get->count();

            if($count > 0)
            {
                $game = FavouriteModel::where('user_id', '=', $post['user_id'])
                                      ->where('favourite_bar_id', '=', $post['bar_id'])
                                      ->delete();
                $responcearray = array('status' => 200, "success" => true, "message" =>FAVOURITE_BAR_REMOVE, "result" =>$game);
            }
            else
            {
                $game = FavouriteModel::create($param);
                $responcearray = array('status' => 200, "success" => true, "message" =>FAVOURITE_BAR_ADD, "result" =>$game);
            }

            if($game)
            {
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
                return response()->json($responcearray, 400);
            }


        }
    }


    public function createFavouriteEvent(Request $request)
    {
        $post = $request->all();
          
        $rules = array(
                    "user_id" => "required", 
                    "event_id" => "required"
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
            $param = array(
                "user_id" => $post['user_id'],
                "favourite_id" => $post['event_id']
            ); 

            $get = BareventFavouriteModel::select('*')
                                ->where('user_id', '=', $post['user_id'])
                                ->where('favourite_id', '=', $post['event_id'])
                                ->get();
            $count = $get->count();

            if($count > 0)
            {
                $game = BareventFavouriteModel::where('user_id', '=', $post['user_id'])
                                      ->where('favourite_id', '=', $post['event_id'])
                                      ->delete();
            }
            else
            {
                $game = BareventFavouriteModel::create($param);
            }

            if($game)
            {
                $responcearray = array('status' => 200, "success" => true, "message" =>FAVOURITE_EVENT_ADD, "result" =>$game);
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
                return response()->json($responcearray, 400);
            }


        }
    }



    public function saveEvent(Request $request)
    {
        $post = $request->all();
          
        $rules = array(
                    "user_id" => "required", 
                    "event_id" => "required",
                    "bar_id" => "required",
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
            $param = array(
                "user_id" => $post['user_id'],
                "event_id" => $post['event_id'],
                "bar_id" => $post['bar_id']
            ); 

            $get = BarEventSaveModel::select('*')
                                ->where('user_id', '=', $post['user_id'])
                                ->where('event_id', '=', $post['event_id'])
                                ->where('bar_id', '=', $post['bar_id'])
                                ->get();
            $count = $get->count();

            if($count > 0)
            {
                $event = BarEventSaveModel::where('user_id', '=', $post['user_id'])
                                      ->where('event_id', '=', $post['event_id'])
                                      ->where('bar_id', '=', $post['bar_id'])
                                      ->delete();
                    $responcearray = array('status' => 200, "success" => true, "message" =>DELETE_SAVED_EVENT, "result" =>$event);
                return response()->json($responcearray, 200);
            }
            else
            {
                $event = BarEventSaveModel::create($param);
                $event['is_saved']=true;
            }

            if($event)
            {
                $responcearray = array('status' => 200, "success" => true, "message" =>SAVE_EVENT, "result" =>$event);
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
        //
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
        //
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
        //
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
}