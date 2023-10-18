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

const LOGIN ="Login successfully";
const INVALIDEMAILPASSWORD="Invalid email or password";
const BAR_ADD ="Bar created successfully";
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

class BarController extends Controller
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
                $lat = $request->latitude;
                $lng = $request->longitude;
                $result = array();
                $results = array();
                $stdate = date("Y-m-d", strtotime('monday this week'));
                $etdate = date("Y-m-d", strtotime('sunday this week'));
                $bar = BarModel::select(['*', DB::raw('( 0.621371 * 3959 * acos( cos( radians('.$lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians(latitude) ) ) ) AS distance')])->orderBy('distance')
                    ->where('status', '=', 1)
                    ->get();

                $count = $bar->count();
                if($count > 0)
                {

                    foreach ($bar as $key => $value) {


                        $value->distance = number_format($value->distance, 2, '.', ',');
                        $barUpdate = BarModel::select('*')
                                    ->from('t_bar')
                                    ->join('t_user_favourite', 't_bar.bar_id', '=', 't_user_favourite.favourite_bar_id')
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

                    $barAllGame = BarModel::select(['t_bar.name as bar_name', 't_bar.bar_id as bar_id', 't_bar_game.id as gameID','t_bar_game.name as gameName','t_bar_game.description','t_bar_game.image AS image', DB::raw('( 0.621371 * 3959 * acos( cos( radians('.$lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians(latitude) ) ) ) AS distance')])
                                    ->from('t_bar')
                                    ->join('t_bar_game', 't_bar.bar_id', '=', 't_bar_game.bar_id')
                                    ->take(10)->get();

                    // $barAllGame = GameModel::select('id as game_id','name','description','image')->get();
                    $results['activities'] = $barAllGame;

                    $weekEvent = BarModel::select('t_bar_event.event_id', 't_bar.name as bar_name', 't_bar_event.name', 't_bar_event.description', 't_bar_event.icon', 't_bar_event.image', 't_bar_event.color', 't_bar_event.start_date', 't_bar_event.start_time', 't_bar_event.end_date', 't_bar_event.end_time')
                                    ->from('t_bar')
                                    ->join('t_bar_event', 't_bar.bar_id', '=', 't_bar_event.bar_id')
                                    ->where('start_date', '>=', $stdate)
                                    ->Where('end_date', '>=', $etdate)
                                    ->get();


                    $results['WeekOFEvent'] = $weekEvent;

                    $featured = BarModel::select(['t_bar_event.event_id', 't_bar.name as bar_name', 't_bar.bar_id', 't_bar_event.name', 't_bar_event.description', 't_bar_event.icon', 't_bar_event.image', 't_bar_event.color', 't_bar_event.start_date', 't_bar_event.start_time', 't_bar_event.end_date', 't_bar_event.end_time', DB::raw('( 0.621371 * 3959 * acos( cos( radians('.$lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians(latitude) ) ) ) AS distance')])
                                    ->from('t_bar')
                                    ->join('t_bar_event', 't_bar.bar_id', '=', 't_bar_event.bar_id')
                                    // ->where('t_bar.bar_id', '=', $value['bar_id'])
                                    ->where('t_bar_event.start_date', '=', Carbon::now()->format('Y-m-d'))
                                    ->get();
                    if ($featured) {
                        foreach ($featured as $key1 => $value1) {

                           $value1['people_in'] = UserEventModel::where('event_id', $value1['event_id'])->get()->count();
                           $value1['possible_in'] = UserEventAddModel::where('event_id', $value1['event_id'])->get()->count();
                              

                            $value1['start_time'] = date('h:i A', strtotime($value1['start_time']));
                            $value1['end_time'] = date('h:i A', strtotime($value1['end_time']));

                            if ($value1['start_date'] == Carbon::now()->format('Y-m-d')) {
                                $value1['day'] = "Today";
                            } elseif ($value1['start_date'] == Carbon::tomorrow()->format('Y-m-d')) {
                                $value1['day'] = "Tomorrow";
                            }else{
                                $value1['day'] = Carbon::createFromFormat("Y-m-d", $value1['start_date'])->format('m/d/Y');
                            }
                        }  
                    }
                    $results['featured'] = $featured ?? [];

                    // foreach ($bar as $key => $value) {
                    //     $featured = BarModel::select('t_bar_event.event_id', 't_bar.name as bar_name', 't_bar.bar_id', 't_bar_event.name', 't_bar_event.description', 't_bar_event.icon', 't_bar_event.image', 't_bar_event.color', 't_bar_event.start_date', 't_bar_event.start_time', 't_bar_event.end_date', 't_bar_event.end_time')
                    //                     ->from('t_bar')
                    //                     ->join('t_bar_event', 't_bar.bar_id', '=', 't_bar_event.bar_id')
                    //                     ->where('t_bar.bar_id', '=', $value['bar_id'])
                    //                     // ->where('t_bar_event.start_date', '=', Carbon::now()->format('Y-m-d'))
                    //                     ->first();
                    //     if ($featured) {

                    //         $featured['start_time'] = date('h:i A', strtotime($featured['start_time']));
                    //         $featured['end_time'] = date('h:i A', strtotime($featured['end_time']));

                    //         if ($featured['start_date'] == Carbon::now()->format('Y-m-d')) {

                    //             $featured['day'] = "Today";

                    //         } elseif ($featured['start_date'] == Carbon::tomorrow()->format('Y-m-d')) {

                    //             $featured['day'] = "Tomorrow";

                    //         }else{

                    //             $featured['day'] = Carbon::createFromFormat("Y-m-d", $featured['start_date'])->format('m/d/Y');
                    //         }
                            
                    //         $barfeatured[] = $featured;
                    //     }
                    // }
                    // $results['featured'] = $barfeatured ?? [];
                  
                    
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
    public function getBarMenu(Request $request)
    {
        $post = $request->all();

        $data = array();
          
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

            
            $category = MenucategoryModel::select('name', 'id','menu_type')
                              ->where('bar_id', '=', $bar_id)
                              ->get();
            
            $data=array();
            foreach ($category as $key => $value) {

                if ($value['menu_type'] =='drink') {

                    $drink_menu = array();
                    $drink = BarmenuModel::select('menu_id', 'name','image','price')
                              ->where('category_id', '=', $value['id'])
                              ->where('bar_id', '=', $bar_id)
                              ->get();

                    foreach ($drink as $key => $drink_value) {
                    $drink_value['is_favorite']= Controller::getUserFavDrink($post['user_id'],$post['bar_id'],$drink_value['menu_id']);
                    
                     $drink_value['qty']=0;
                     $drink_menu[] = $drink_value;
                    }          
                    $value['menu'] = $drink_menu;
                    $data['Drink'][]=$value;

                } elseif($value['menu_type']=='food') {

                    $food_menu = array();
                    $food = BarmenuModel::select('menu_id', 'name','image','price')
                              ->where('category_id', '=', $value['id'])
                              ->where('bar_id', '=', $bar_id)
                              ->get();

                    foreach ($food as $key => $food_value) {
                    $food_value['is_favorite']= Controller::getUserFavDrink($post['user_id'],$post['bar_id'],$food_value['menu_id']);
                    
                     $food_value['qty']=0;
                     $food_menu[] = $food_value;
                    } 
                    $value['menu'] = $food_menu;
                    $data['Food'][]=$value;
                }              
            } 

            $data['Drink'] =  $data['Drink'] ?? [];
            $data['Food'] =   $data['Food'] ?? [];           


            if (!empty($category->first()))
            {
                $responcearray = array('status' => 200, "success" => true, "message" =>GET_MENU_API, "result" =>$data);
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

                $barData = BarModel::select('*')->where('bar_id', '=', $bar_id)->where('status', '=', 1)->get()->first();
    
                $bar = BarModel::select('*')
                                  ->where('bar_id', '=', $bar_id)
                                  ->where('status', '=', 1)
                                  ->get()->first();

                $bar['close_time'] = date('h:i A', strtotime($bar['close_time']));
                $bar['open_time'] = date('h:i A', strtotime($bar['open_time']));
                $count = $bar->count();
                if($count > 0)
                {

                        $barFevourite = BarModel::select('*')
                                    ->from('t_bar')
                                    ->join('t_user_favourite', 't_bar.bar_id', '=', 't_user_favourite.favourite_bar_id')
                                    ->where('user_id', '=', $user_id)
                                    ->where('bar_id', '=', $bar['bar_id'])
                                    ->get();

                        $bar['isFavourite'] = ($barFevourite->count()>0?true:false);
                        $bar['rating'] = 3.5;
                        $events = BareventModel::select('t_bar_event.event_id', 't_bar.name as bar_name', 't_bar_event.name', 't_bar_event.description', 't_bar_event.icon', 't_bar_event.image', 't_bar_event.color', 't_bar_event.start_date', 't_bar_event.start_time', 't_bar_event.end_date', 't_bar_event.end_time', 't_user_event_favourite.favourite_id AS isFavourite')
                                    ->from('t_bar_event')
                                    ->join('t_bar', 't_bar.bar_id', '=', 't_bar_event.bar_id')
                                    ->leftJoin('t_user_event_favourite', 't_bar_event.event_id', '=', 't_user_event_favourite.favourite_id')
                                    ->where('t_bar_event.bar_id', '=', $bar['bar_id'])
                                    ->get();

                        $count = $events->count();

                        if($count > 0)
                        {
                            foreach ($events as $value) {
                               $value['isFavourite'] = ($value['isFavourite'] > 0?true:false);
                               $event[] = $value;
                            }
                        }
                        else
                        {
                            $event = array();
                        }

                        $bar['Events'] = $event;
                        $bar['Menu'] = array(); //favouriteUser

                        $sql = 'SELECT 0';
                        $barGame = BarModel::select('t_user.user_id','t_user.full_name as fullName','t_user.status','t_user.favourite_drink')->selectSub($sql, 'checkedInBar')
                                    ->from('t_user_favourite')
                                    ->join('t_user', 't_user_favourite.user_id', '=', 't_user.user_id')
                                    ->where('t_user_favourite.favourite_bar_id', '=', $bar['bar_id'])
                                    ->get();
                        $bar['favouriteUser'] = $barGame;

                        $Game = BargameModel::select('t_bar.name as bar_name', 't_bar.bar_id as bar_id', 't_bar_game.id as gameID', 't_bar_game.name as gameName', 't_bar_game.description', 't_bar_game.image')
                                    ->from('t_bar_game')
                                    ->join('t_bar', 't_bar.bar_id', '=', 't_bar_game.bar_id')
                                    // ->leftJoin('t_user_game_favourite', 't_bar_game.id', '=', 't_user_game_favourite.favourite_id')
                                    ->where('t_bar_game.bar_id', '=', $bar['bar_id'])
                                    ->get();


                        
                        $count = $Game->count();

                        if($count > 0)
                        {
                            foreach ($Game as $value1) {

                              $value['isFavourite'] = ($value['isFavourite'] > 0?true:false);

                               $Games[] = $value1;
                            }
                        }
                        else
                        {
                            $Games = array();
                        }
                        $defaultGame = GameModel::select('id as gameID', 'name as gameName', 'description', 'image')
                            ->get();
                        foreach ($defaultGame as $value1) {
                               $value1['isFavourite'] = false;
                               $defaultGames[] = $value1;
                        }

                        $bar['Games'] = $Games;
                        $bar['defaultGames'] = $defaultGames;

                        $possible = BarModel::select('t_user.user_id','t_user.full_name as fullName','t_user.status','t_user.favourite_drink')
                                    ->from('t_possible_checked_in')
                                    ->join('t_user', 't_possible_checked_in.user_id', '=', 't_user.user_id')
                                    ->where('t_possible_checked_in.bar_id', '=', $bar['bar_id'])
                                    ->get();

                        $bar['possibleCheckedIn'] = $possible;

                        $checked = BarModel::select('t_user.user_id','t_user.full_name as fullName','t_user.status','t_user.favourite_drink')
                                    ->from('t_checked_in_user')
                                    ->join('t_user', 't_checked_in_user.user_id', '=', 't_user.user_id')
                                    ->where('t_checked_in_user.bar_id', '=', $bar['bar_id'])
                                    ->get();

                        $bar['checkedIn'] = $checked;
                        $bar['people_in'] = $checked->count();

                        $photo = BarModel::select('t_bar_photo_wall.image as link')
                                    ->from('t_bar_photo_wall')
                                    ->where('t_bar_photo_wall.bar_id', '=', $bar['bar_id'])
                                    ->get();
                        $bar['photoWall'] = $photo;
                        // $bar['barUrl'] = url('bar', $bar_id);
                        $bar['barUrl'] = "https://x61mh.test-app.link/".$bar_id;
                    

                    
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
    public function sendMailBardetails(Request $request)
    {
        $post = $request->all();
          
        $rules = array(
            "name" => 'required',
            "location" => 'required',
            "email" => 'required',
            "phone_number" => 'required',
            "name_of_owner" => "required",
            "hours_of_opration" => "required"
        );

        $validator = Validator::make($post, $rules);

        if($validator->fails())
        {
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" => new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {
            $mail = \Mail::to('barconnex@gmail.com')->send(new \App\Mail\SendBardetails($post));

             $responcearray = array('status' => 200, "success" => true, "message" =>"Bar details send successfully", "result" => new \stdClass());
                return response()->json($responcearray, 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function barUpdate(Request $request, $id)
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
                    "bar_type" => 'required',
                    "bar_hours" => 'required'
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
                    
                    
                    if(isset($post['cover_image']) && !empty($post['cover_image']))
                    {
                        // $imagename = time().uniqid()."_barimage";
                        // $imageName = $imagename.'.'.$request->cover_image->extension();  
                        // $request->cover_image->move(public_path('Uploads/bar/'), $imageName);
                        // $post['cover_image'] = url('Uploads/bar/'.$imageName);

                        $image = explode(",", $post['cover_image']);
                        $image = base64_decode(end($image));
                        $imagename = md5(time())."_barimage".".png";
                        file_put_contents(public_path("Uploads/bar/").$imagename, $image);
                        $post['cover_image'] = url('Uploads/bar/'.$imagename);
                    }
                    $bar = BarModel::where('bar_id', $id)->update($post);

                    if($bar)
                    {
                        $bar = BarModel::where('bar_id', $id)->get()->first();
                        $responcearray = array('status' => 200, "success" => true, "message" =>BAR_GET_UPDATE, "result" =>$bar);
                        return response()->json($responcearray, 200);
                    }
                    else
                    {
                        $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
                        return response()->json($responcearray, 400);
                    }
                }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function addEventUser(Request $request)
    {
        $post = $request->all();
                  
        $rules = array(
            "user_id" => 'required',
            "bar_id" => 'required',
            "event_id" => 'required'
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
            $bar = UserEventModel::create($post);

            if($bar)
            {
                $responcearray = array('status' => 200, "success" => true, "message" =>"Add event user successfully", "result" =>new \stdClass());
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
                return response()->json($responcearray, 400);
            }
        }
    }

    public function getUserEvents(Request $request)
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
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>new \stdClass());
            return response()->json($responcearray, 400);
        }
        else
        {
            $result = array();
            $user = AuthenticationModel::select('t_user.user_id','t_user.full_name as name','t_user.profileImage')
                                ->from('t_user')
                                ->join('t_user_block', 't_user.user_id', '=', 't_user_block.block_user_id')
                                ->where('t_user_block.user_id', '=', $user_id)
                                ->get();

            foreach ($user as $key => $value) {
            $value['is_blocked']= Controller::getBlockUser($user_id,$value['user_id']);
            $value['is_friend']= Controller::getUserFriend($user_id,$value['user_id']);
            $result[]    = $value;
            }                       

            
            if(!empty($user->first()))
            {
                $responcearray = array('status' => 200, "success" => true, "message" =>USER_PROFILE_GET, "result" =>$result);
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 400, "success" => false, "message" =>NOT_DATA_FOUND, "result" => array());
                return response()->json($responcearray, 400);
            }
        }
    }

    public function userEventPossible(Request $request)
    {
        $post = $request->all();
                  
        $rules = array(
            "user_id" => 'required',
            "bar_id" => 'required',
            "event_id" => 'required'
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

            $user = UserEventAddModel::where('user_id', $post['user_id'])->where('event_id', $post['event_id'])->first();
            if($user)
            {
                $responcearray = array('status' => 200, "success" => true, "message" =>"Already add event possible successfully", "result" =>$user);
                return response()->json($responcearray, 200);
            }
            
            $bar = UserEventAddModel::create($post);

            if($bar)
            {
                $responcearray = array('status' => 200, "success" => true, "message" =>"Add event possible successfully", "result" =>$bar);
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
                return response()->json($responcearray, 400);
            }
        }
    }

    public function getGuestByBar(Request $request)
    {
        $post = $request->all();

        $data = array();
                  
        $rules = array(
            "user_id" => 'required',
            "bar_id" => 'required'
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
            $userDetails = array();
            $possibleCheckedIn = array();
            $our_favorites = array();
            $doors = [];
            $checkinDetail = null;
            $get_userDetails = BarModel::select('*')
                                    ->from('t_checked_in_user')
                                    ->join('t_user', 't_checked_in_user.user_id', '=', 't_user.user_id')
                                    ->where('t_checked_in_user.bar_id', '=', $post['bar_id'])
                                    ->where('t_checked_in_user.user_id', '!=', $post['user_id'])
                                    ->get();
            if(!empty($get_userDetails)){
                foreach ($get_userDetails as $key => $value) {
                
                    $get_userDetails[$key]->doors  =  UserDoors::where('user_id', $value->id)->get();
                    $UserChekin = UserChekinModel::where('user_id', $value->user_id)->first();


                    
                    if (!empty($UserChekin)) 
                    {
                        $getBar = BarModel::where('bar_id',$UserChekin['bar_id'])->first();
                        if (!empty($getBar)) {

                            $UserChekin['bar_name'] = Controller::getBarDetails($UserChekin['bar_id'])->name;
                            $UserChekin['time'] = date("h:i:s A", strtotime($UserChekin['created_at']));
                            unset($UserChekin['created_at']);
                            unset($UserChekin['updated_at']);
                            unset($UserChekin['id']);
                        
                        } else { 

                            $UserChekin =null; 
                        }
                        
                        
                    }
                    else
                    {
                        $UserChekin =null;                    
                    }  

                    $get_userDetails[$key]->checkinDetail  = $UserChekin;
                }
                
            }
            
            $get_possibleCheckedIn = BarModel::select('*')
                                    ->from('t_possible_checked_in')
                                    ->join('t_user', 't_possible_checked_in.user_id', '=', 't_user.user_id')
                                    ->where('t_possible_checked_in.bar_id', '=', $post['bar_id'])
                                    ->where('t_possible_checked_in.user_id', '!=', $post['user_id'])
                                    ->get();
            if(!empty($get_possibleCheckedIn)){
                foreach ($get_possibleCheckedIn as $key => $value) {
                
                    $get_possibleCheckedIn[$key]->doors  =  UserDoors::where('user_id', $value->id)->get();
                    $UserChekin = UserChekinModel::where('user_id', '=', $value->user_id)
                                              ->get()->first();
                    if (!empty($UserChekin)) 
                    {
                        $getBar = BarModel::where('bar_id',$UserChekin['bar_id'])->first();
                        if (!empty($getBar)) {

                             $UserChekin['bar_name'] = Controller::getBarDetails($UserChekin['bar_id'])->name;
                            $UserChekin['time'] = date("h:i:s A", strtotime($UserChekin['created_at']));
                            unset($UserChekin['created_at']);
                            unset($UserChekin['updated_at']);
                            unset($UserChekin['id']);

                        } else {

                            $UserChekin =null;   
                        }
                        
                    }
                    else
                    {
                        $UserChekin =null;                    
                    } 
 
                    $get_possibleCheckedIn[$key]->checkinDetail  = $UserChekin;
                }
                
            }
            $get_our_favorites = BarModel::select('*')
                                    ->from('t_user_favourite')
                                    ->join('t_user', 't_user_favourite.user_id', '=', 't_user.user_id')
                                    ->where('t_user_favourite.user_id', '=', $post['user_id'])
                                    ->where('t_user_favourite.favourite_bar_id', '=', $post['bar_id'])
                                    ->get();

            if(!empty($get_our_favorites)){
                foreach ($get_our_favorites as $key => $value) {
                
                    $get_our_favorites[$key]->doors  =  UserDoors::where('user_id', $value->id)->get();
                    $UserChekin = UserChekinModel::where('user_id', '=', $value->user_id)
                                              ->get()->first();
                    if (!empty($UserChekin)) 
                    {

                        $getBar = BarModel::where('bar_id',$UserChekin['bar_id'])->first();
                        if (!empty($getBar)) {

                            $UserChekin['bar_name'] = Controller::getBarDetails($UserChekin['bar_id'])->name;
                            $UserChekin['time'] = date("h:i:s A", strtotime($UserChekin['created_at']));
                            unset($UserChekin['created_at']);
                            unset($UserChekin['updated_at']);
                            unset($UserChekin['id']);

                        } else {

                            $UserChekin =null;  

                        }
                        
                    }
                    else
                    {
                        $UserChekin =null;                    
                    } 
                    $get_our_favorites[$key]->checkinDetail  = $UserChekin;
                }
                
            }
            foreach ($get_userDetails as $key => $value) {
            $value['is_blocked']= Controller::getBlockUser($post['user_id'],$value['user_id']);
            $value['is_friend']= Controller::getUserFriend($post['user_id'],$value['user_id']);
            $value['is_favourite']= Controller::getUserFav($post['user_id'],$value['user_id']);
            if($value['is_blocked'] == true){
                    unset($value[$key]);

            }
            $userDetails[]    = $value;
            }   

            foreach ($get_possibleCheckedIn as $key => $value) {
            $value['is_blocked']= Controller::getBlockUser($post['user_id'],$value['user_id']);
            $value['is_friend']= Controller::getUserFriend($post['user_id'],$value['user_id']);
            $value['is_favourite']= Controller::getUserFav($post['user_id'],$value['user_id']);
            if($value['is_blocked'] == true){
                    unset($value[$key]);

            }
            $possibleCheckedIn[]    = $value;
            }   

            foreach ($get_our_favorites as $key => $value) {
            $value['is_blocked']= Controller::getBlockUser($post['user_id'],$value['user_id']);
            $value['is_friend']= Controller::getUserFriend($post['user_id'],$value['user_id']);
            $value['is_favourite']= Controller::getUserFav($post['user_id'],$value['user_id']);
            if($value['is_blocked'] == true){
                    unset($value[$key]);

            }
            $our_favorites[]    = $value;
            }     

             

            //$count = $userDetails->count();
            if(!empty($get_userDetails->first()))
            {
                $data['checked_in'] = $userDetails;
                $data['possible_checked_in'] = $possibleCheckedIn;
                $data['our_favorites'] = $our_favorites;
                $responcearray = array('status' => 200, "success" => true, "message" => "User ", "result" =>$data);
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 400, "success" => false, "message" => "Data not found", "result" =>array());
                return response()->json($responcearray, 400);
            }
        }
    }

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

    public function getSearch(Request $request)
    {
        $post = $request->all();
          
        $rules = array(
            "user_id" => "required",
            "search" => 'required',
            "type" => 'required'
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
            $type = ucfirst(strtolower($post['type']));
            if($type=='Bar')
            {
                $bar = BarModel::select('*')
                                ->where('t_bar.name', 'LIKE', "%{$post['search']}%")
                                ->where('status', '=', 1)
                                ->get();
                $count = $bar->count();
                if($count > 0)
                {
                    $result = array();
                    foreach ($bar as $key => $value) {

                        $barUpdate = BarModel::select('*')
                                    ->from('t_bar')
                                    ->join('t_user_favourite', 't_bar.bar_id', '=', 't_user_favourite.favourite_bar_id')
                                    ->where('user_id', '=', $post['user_id'])
                                    ->where('bar_id', '=', $value['bar_id'])
                                    ->get();

                        $value['isFavourite'] = ($barUpdate->count()>0?true:false);

                        $value['favorite_count'] = FavouriteModel::where('favourite_bar_id', $value['bar_id'])->get()->count();

                        $value['event'] = BarModel::select('t_bar_event.event_id', 't_bar.name as bar_name', 't_bar_event.name', 't_bar_event.description', 't_bar_event.icon', 't_bar_event.image', 't_bar_event.color', 't_bar_event.start_date', 't_bar_event.start_time', 't_bar_event.end_date', 't_bar_event.end_time')
                                    ->from('t_bar')
                                    ->join('t_bar_event', 't_bar.bar_id', '=', 't_bar_event.bar_id')
                                    ->where('t_bar.bar_id', '=', $value['bar_id'])
                                    ->get();

                        $barGame = BarModel::select('t_bar.name as bar_name','t_bar_game.id as game_id','t_bar_game.name','t_bar_game.description','t_bar_game.image AS barImage')
                                    ->from('t_bar')
                                    ->join('t_bar_game', 't_bar.bar_id', '=', 't_bar_game.bar_id')
                                    ->where('t_bar.bar_id', '=', $value['bar_id'])
                                    ->get();
                        $value['game'] = $barGame;


                        $value['rating'] = 0;

                        $checked = BarModel::select('t_user.user_id','t_user.full_name as fullName','t_user.status','t_user.favourite_drink')
                                    ->from('t_checked_in_user')
                                    ->join('t_user', 't_checked_in_user.user_id', '=', 't_user.user_id')
                                    ->where('t_checked_in_user.bar_id', '=', $value['bar_id'])
                                    ->get();

                        // $bar['checkedIn'] = $checked;
                        $value['people_in'] = $checked->count();

                        $result[] = $value;   
                    }

                    $getData = $result;

                    if(!empty($getData))
                    {
                       $responcearray = array('status' => 200, "success" => true, "message" =>BAR_GET, "result" =>$getData); 
                    }
                    else
                    {
                        $responcearray = array('status' => 404, "success" => false, "message" =>DATA_NOT, "result" =>array());
                    }                        
                }
                else
                {
                    $getData = array();
                }
                   
            }
            elseif($type=='Event')
            {

                $getData = BareventModel::select('t_bar_event.event_id', 't_bar_event.bar_id as bar_name', 't_bar_event.name', 't_bar_event.description', 't_bar_event.icon', 't_bar_event.image', 't_bar_event.color', 't_bar_event.start_date', 't_bar_event.start_time', 't_bar_event.end_date', 't_bar_event.end_time')
                                    ->where('t_bar_event.name', 'LIKE', "%{$post['search']}%")
                                    ->where('t_bar_event.start_date', '>=', Carbon::now()->format('Y-m-d'))
                                    ->get();

                
                foreach ($getData as $key => $value) {
                        
                $value->start_time = date('h:i A', strtotime($value->start_time));
                            $value->end_time = date('h:i A', strtotime($value->end_time));

                            if ($value->start_date == Carbon::now()->format('Y-m-d')) {
                                $value->day = "Today";
                            } elseif ($value->start_date == Carbon::tomorrow()->format('Y-m-d')) {
                                $value->day = "Tomorrow";
                            }else{
                                $value->day = Carbon::createFromFormat("Y-m-d", $value->start_date)->format('m/d/Y');
                            }




                   $bar = BarModel::where('bar_id', $value->bar_name)->where('status', '=', 1)->first();


                   // $checked = BarModel::select('t_user.user_id','t_user.full_name as fullName','t_user.status','t_user.favourite_drink')
                   //              ->from('t_checked_in_user')
                   //              ->join('t_user', 't_checked_in_user.user_id', '=', 't_user.user_id')
                   //              ->where('t_checked_in_user.bar_id', '=', $value->bar_name)
                   //              ->get();

                   // $value->people_in = $checked->count();
                   // $value->possible_in = $checked->count();
                   $value->people_in = UserEventModel::where('event_id', $value['event_id'])->get()->count();
                   $value->possible_in = UserEventAddModel::where('event_id', $value['event_id'])->get()->count();

                   if ($bar) {
                      $value->bar_name = $bar->name;
                      $value->bar_id = $bar->bar_id;
                   } else {
                      $value->bar_name = null;
                      $value->bar_id = null;
                   }
                   
                }
                if(!($getData->isEmpty()))
                {
                   
                    $responcearray = array('status' => 200, "success" => true, "message" =>"Event data get successfully", "result" =>$getData);
                }else{

                    $responcearray = array('status' => 400, "success" => true, "message" =>"Event data not found", "result" =>array());

                }

            }
            else
            {
                $getData =  $barAllGame = BargameModel::select('t_bar_game.bar_id as bar_name','t_bar_game.id as gameID','t_bar_game.name as gameName','t_bar_game.description','t_bar_game.image AS image')
                                    ->where('t_bar_game.name', 'LIKE', "%{$post['search']}%")
                                    ->get();

                foreach ($getData as $key => $value) {
                    $bar = BarModel::where('bar_id', $value->bar_name)->where('status', '=', 1)->first();
                    if ($bar) {
                      $value->bar_name = $bar->name;
                      $value->bar_id = $bar->bar_id;
                   } else {
                      $value->bar_name = null;
                      $value->bar_id = null;
                   }
                    
                }
                if(!($getData->isEmpty()))
                {
                    $responcearray = array('status' => 200, "success" => true, "message" =>"Game data get successfully", "result" =>$getData);
                }else {

                    $responcearray = array('status' => 400, "success" => true, "message" =>"Game data not found", "result" =>array());

                }
            }

            if(!empty($getData))
            {
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 404, "success" => false, "message" =>DATA_NOT, "result" =>array());
                return response()->json($responcearray, 404);
            }
                
        }
    }

    

    public function getAllTypeBarUser($bar_id)
    {
        if(empty($bar_id))
        {
            
            $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>new \stdClass());
            return response()->json($responcearray, 404);
        }
        else
        {
            // $chekcedIn = array();
            // $possibleCheckedIn = array();
            // $our_favorites = array();

            $chekcedIn = BarModel::select('*')
                                    ->from('t_checked_in_user')
                                    ->join('t_user', 't_checked_in_user.user_id', '=', 't_user.user_id')
                                    ->where('t_checked_in_user.bar_id', '=', $bar_id)
                                    ->get();

            $possibleCheckedIn = BarModel::select('*')
                                    ->from('t_possible_checked_in')
                                    ->join('t_user', 't_possible_checked_in.user_id', '=', 't_user.user_id')
                                    ->where('t_possible_checked_in.bar_id', '=', $bar_id)
                                    ->get();

            $our_favorites = BarModel::select('*')
                                    ->from('t_user_favourite')
                                    ->join('t_user', 't_user_favourite.user_id', '=', 't_user.user_id')
                                    ->where('t_user_favourite.favourite_bar_id', '=', $bar_id)
                                    ->get();

            // foreach ($get_chekcedIn as $key => $value) {
            // $value['is_blocked']= Controller::getBlockUser($post['user_id'],$value['user_id']);
            // $value['is_friend']= Controller::getUserFriend($post['user_id'],$value['user_id']);
            // $chekcedIn[]    = $value;
            // }   

            // foreach ($get_possibleCheckedIn as $key => $value) {
            // $value['is_blocked']= Controller::getBlockUser($post['user_id'],$value['user_id']);
            // $value['is_friend']= Controller::getUserFriend($post['user_id'],$value['user_id']);
            // $possibleCheckedIn[]    = $value;
            // }   

            // foreach ($get_our_favorites as $key => $value) {
            // $value['is_blocked']= Controller::getBlockUser($post['user_id'],$value['user_id']);
            // $value['is_friend']= Controller::getUserFriend($post['user_id'],$value['user_id']);
            // $our_favorites[]    = $value;
            // }     


            //$count = $chekcedIn->count();
            if(!empty($chekcedIn->first()))
            {
                $data['checked_in'] = $chekcedIn;
                $data['possible_checked_in'] = $possibleCheckedIn;
                $data['our_favorites'] = $our_favorites;
                $responcearray = array('status' => 200, "success" => true, "message" => "Data Get successfully ", "result" =>$data);
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 400, "success" => false, "message" => "Data not found", "result" =>array());
                return response()->json($responcearray, 400);
            }
        }
    }



    public function addBarPhotoWall(Request $request)
    {
        $rules = array(
            "user_id" => "required",
            "bar_id" => 'required',
            // "photo" => 'required|mimes:jpeg,jpg,png,gif',
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
                $creat_date = date_format($date,"d/m/Y");
                
                $getData[$key]->date = $creat_date;
            }
            $responcearray = array('status' => 200, "success" => true, "message" =>"Added photowall successfully", "result" =>$getData);
            return response()->json($responcearray, 200);
        }else{
            $responcearray = array('status' => 404, "success" => false, "message" =>WENTWRONG, "result" =>array());
            return response()->json($responcearray, 404);
        }
    

    
    }

    public function getBarPhotoWall($bar_id)
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
    public function deleteBarPhotowall(Request $request)
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
                $creat_date = date_format($date,"d/m/Y");
                
                $getData[$key]->date = $creat_date;
            }
            $responcearray = array('status' => 200, "success" => true, "message" =>"Bar photowall deleted", "result" =>$photowall);
            return response()->json($responcearray, 200);
        }else{
            $responcearray = array('status' => 400, "success" => false, "message" =>WENTWRONG, "result" =>new \stdClass());
            return response()->json($responcearray, 400);
        }
    }





    public function BarLogin(Request $request)
    {
        $user =  new \stdClass();
        $post = $request->all();
          
        $rules = array( 
            "email" => 'required', 
            "password" => 'required', 
            "device_type" => 'required', 
            "device_token" => 'required',
            // "login_signup_type" => 'required|in:normal,google,facebook,twitter'
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
            $user = BarModel::where('password', $password)->where('email', $email)->get()->first();
            
            if($user){
                $responcearray = array('status' => 200, "success" => true, "message" =>LOGIN, "result" =>$user);
                return response()->json($responcearray, 200);
            }else{
                $responcearray = array('status' => 400, "success" => false, "message" =>INVALIDEMAILPASSWORD, "result" =>new \stdClass());
                return response()->json($responcearray, 400);
            }   
        }
    }

    public function forgetPassword(Request $request)
    {
        $user =  new \stdClass();
        $post = $request->all();
          
        $rules = array( 
            "email" => 'required',
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

            $user = BarModel::select('*')
                            ->where('email', '=', $email)
                            ->get()->first();
           


            $user1 = $user;
            if(COUNT((array)$user1) > 0)
            {
                $forgetpassword_link = md5(time().json_encode($user));
                $array = array('forgetpassword_link' => $forgetpassword_link, 'email' => $user['email'], 'name' => $user['name']);

                \Mail::to($user['email'])->send(new \App\Mail\BarEmail($array));

                $param = array(
                    'forgetpassword_link' => $forgetpassword_link,
                    'is_password_link_valid' => date('Y-m-d H:i:s',strtotime(Vailid_time)),
                    "updated_at" => Date('Y-m-d H:i:s')
                );
               
                BarModel::where('bar_id', $user['bar_id'])->update($param);
               

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
     * resetPassword the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(Request $request)
    {  
        $post = $request->all();
        $passwordToken = $post['passwordToken'];
          
        $rules = array( 
            'password' => 'required|confirmed', 
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
            $userData = BarModel::where('forgetpassword_link', $passwordToken)->first();

            if (empty($userData->is_password_link_valid)) {
                $responcearray = array('status' => 400, "success" => false, "message" =>LINKEXPIRED, "result" =>new \stdClass());
                return response()->json($responcearray, 400);  
            }
            
            $param = array(
                    "password" => md5($post['password']),
                    "is_password_link_valid" => NULL,
                    "updated_at" => Date('Y-m-d H:i:s')
                );
            
            $update = BarModel::where('forgetpassword_link', $passwordToken)->update($param);
            if($update)
            {
                $responcearray = array('status' => 200, "success" => true, "message" =>CHANGE_PASSWORD, "result" =>new \stdClass());
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test(Request $request)
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
                $lat = $request->latitude;
                $lng = $request->longitude;
                $result = array();
                $results = array();
                $stdate = date("Y-m-d", strtotime('monday this week'));
                $etdate = date("Y-m-d", strtotime('sunday this week'));
                $bar = BarModel::select(['*', DB::raw('( 0.621371 * 3959 * acos( cos( radians('.$lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians(latitude) ) ) ) AS distance')])->orderBy('distance')
                    ->where('status', '=', 1)
                    ->get();

                $count = $bar->count();
                if($count > 0)
                {

                    foreach ($bar as $key => $value) {


                        $value->distance = number_format($value->distance, 2, '.', ',');
                        $barUpdate = BarModel::select('*')
                                    ->from('t_bar')
                                    ->join('t_user_favourite', 't_bar.bar_id', '=', 't_user_favourite.favourite_bar_id')
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

                    // $barAllGame = BarModel::select('t_bar.name as bar_name','t_bar_game.id as game_id','t_bar_game.name','t_bar_game.description','t_bar_game.image AS barImage')
                    //                 ->from('t_bar')
                    //                 ->join('t_bar_game', 't_bar.bar_id', '=', 't_bar_game.bar_id')
                    //                 ->get();

                    $barAllGame = GameModel::select('id as game_id','name','description','image')->get();
                    $results['activities'] = $barAllGame;

                    $weekEvent = BarModel::select('t_bar_event.event_id', 't_bar.name as bar_name', 't_bar_event.name', 't_bar_event.description', 't_bar_event.icon', 't_bar_event.image', 't_bar_event.color', 't_bar_event.start_date', 't_bar_event.start_time', 't_bar_event.end_date', 't_bar_event.end_time')
                                    ->from('t_bar')
                                    ->join('t_bar_event', 't_bar.bar_id', '=', 't_bar_event.bar_id')
                                    ->where('start_date', '>=', $stdate)
                                    ->Where('end_date', '>=', $etdate)
                                    ->get();


                    $results['WeekOFEvent'] = $weekEvent;

                    $featured = BarModel::select(['t_bar_event.event_id', 't_bar.name as bar_name', 't_bar.bar_id', 't_bar_event.name', 't_bar_event.description', 't_bar_event.icon', 't_bar_event.image', 't_bar_event.color', 't_bar_event.start_date', 't_bar_event.start_time', 't_bar_event.end_date', 't_bar_event.end_time', DB::raw('( 0.621371 * 3959 * acos( cos( radians('.$lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians(latitude) ) ) ) AS distance')])
                                    ->from('t_bar')
                                    ->join('t_bar_event', 't_bar.bar_id', '=', 't_bar_event.bar_id')
                                    // ->where('t_bar.bar_id', '=', $value['bar_id'])
                                    ->where('t_bar_event.start_date', '=', Carbon::now()->format('Y-m-d'))
                                    ->get();
                    if ($featured) {
                        foreach ($featured as $key1 => $value1) {
                            $value1['start_time'] = date('h:i A', strtotime($value1['start_time']));
                            $value1['end_time'] = date('h:i A', strtotime($value1['end_time']));

                            if ($value1['start_date'] == Carbon::now()->format('Y-m-d')) {
                                $value1['day'] = "Today";
                            } elseif ($value1['start_date'] == Carbon::tomorrow()->format('Y-m-d')) {
                                $value1['day'] = "Tomorrow";
                            }else{
                                $value1['day'] = Carbon::createFromFormat("Y-m-d", $value1['start_date'])->format('m/d/Y');
                            }
                        }  
                    }
                    $results['featured'] = $featured ?? [];
                    
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

     
}
