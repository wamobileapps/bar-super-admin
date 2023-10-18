<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use App\Models\BargameModel;
use App\Models\ActivityModel;
use App\Models\BarCategoryModel;
use App\Models\GameModel;
use App\Models\BargameFavouriteModel;
use App\Models\BarModel;
use Illuminate\Support\Facades\Validator;
use Redirect;
const LOGIN ="Login successfully";
const BAR_ADD ="Bar game created successfully";
const BAR_GET ="Bars game data get successfully";
const BAR_GET_single ="Bar game data get successfully";
const BAR_GET_UPDATE ="Bar game data update successfully";
const BAR_GET_DELETE ="Bar game data delete successfully";
const BAR_NOT_DELETE ="Bar game data not delete successfully";
const WENTWRONG="Something went wrong";
const DATA_NOT="Bars game not available";
const INVAILID_ID="Invalid id";


class BargameController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $Bar = BargameModel::get();

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

    public function getActivityById($id){
        $categories=BarCategoryModel::select('t_game.*','t_bar_category.description as bardescription','t_bar_category.activity_id')->join('t_game','t_bar_category.activity_id','=','t_game.id')->where('t_bar_category.id',$id)->first();

        return response()->json([
            'status'=>true,
            "data" => $categories
        ]);
    }

    public function getGameById($id){
        $categories=GameModel::find($id);

        return response()->json([
            'status'=>true,
            "data" => $categories
        ]);
    }


    public function updateBardata(Request $request ,$id){


        $updatebar =BarCategoryModel::find($id);
        $updatebar->description=$request->description;
        $updatebar->save();
        return response()->json([
            'status'=>true,
            "data" => $updatebar
        ]);
    }



     public function activities($id)
  {
      $activities=GameModel::join('t_bar_category','t_bar_category.activity_id','=','t_game.id')->
      where('t_bar_category.bar_id',$id)->get();

//       $activities=GameModel::all();

               return response()->json([
                           'status'=>true,
                            "activities" => $activities,

                              ]);

    }
    public function selectactivities($id)
    {


       $activities=GameModel::select('t_game.id','t_game.name')->join('t_bar_category','t_bar_category.activity_id','=','t_game.id')->
       where('t_bar_category.bar_id','=',$id)->get();
        $ids =array();
   foreach ($activities as $act ){
       $ids[] =$act->id;

   }
    $game =GameModel::whereNotIn('id',$ids)->get();
        return response()->json([
            'status'=>true,
            "activities" => $game,

        ]);

    }
    public function selectCategory(Request $request)
  {
       


       $category=BarCategoryModel::updateOrCreate([
           'bar_id'=>$request->bar_id,
           'activity_id'=>$request->activity_id,
           'description'=>$request->description,

    ]);
              
    return response()->json([
                           'status'=>true,
                            "data" => $category
    ]);

         
   //  $post=$request->all() ;                   

   // $supergame=GameModel::where('id',$post['category_id'])->first();
           
   //      if(($supergame->bar_id!="")|| ($supergame->bar_id!=null))
   //      {
   //        $bar_ids=explode(',',$supergame->bar_id);  
        
   //        if(!in_array($post['bar_id'],$bar_ids))
   //        {
   //          array_push($bar_ids,$post['bar_id']);

   //        }

   //         $bar_id=implode(',',$bar_ids); 
   //       }


   //        else{

   //          $bar_id=$post['bar_id'];
   //        }  
            
            
   //          $supergame->bar_id=$bar_id;
   //          $supergame->save();

   //         return response()->json([
   //                          'status'=>true,
   //                           "activity" => $supergame,
   //                           "message"=>'category saved successfully',
   //  ]);

    } 

    public function RemoveBarFromActivity(Request $request)
    {
       ;
        

        $category=BarCategoryModel::where([
           'id'=>$request->activity_id,
           'bar_id'=>$request->bar_id,

    ])->first();
     if($category)
     {
        $category->delete();
                          return response()->json([
                           'status'=>true,
                            "message" => 'Bar removed from activity successfully', 
    ]);


     }
     else
     {

            return response()->json([
                           'status'=>true,
                            "message" => "Bar doesn't exist in this activity", 
                        ]);


     }
              
    




    }

     public function myFunction()
    {
       // return view('StripeMessage');
       
      $url=env('LOGIN_BARADMIN');
       return Redirect::to($url); 
    }


public function getActivity($id)
  {
      
 $bars=array();

 $categories=BarCategoryModel::where('category_id',$id)->get(); 
 
 $bars=array();
if($categories)

{

foreach($categories as $category)
{
  
$bar=BarModel::where('bar_id',$category->bar_id)->first();

array_push($bars,$bar);

}
return response()->json([
                            'status'=>true,
                             "bars" => $bars,

                              ]);

}

else{

return response()->json([
                           'status'=>false,
                            "Message" => "No Bars",

                              ]);


}

//  $bar_ids=explode(',',$activity->bar_id);

// if($activity->bar_id!="")
// {
// foreach($bar_ids as $bar_id)
// {  



//  $bar=BarModel::where('bar_id',$bar_id)->first();

//  array_push($bars, $bar);

// }
// return response()->json([
//                            'status'=>true,
//                             "bars" => $bars,

//                               ]);
// }
// else{
//     return response()->json([
//                            'status'=>false,
//                             "Message" => "No Bars",

//                               ]);
        
              
    } 

    public function supergame()
    {
        $Bar = GameModel::get();
        $data=array();
        foreach($Bar as $value)
        {
           $bars=explode(',',$value->bar_id);

            foreach($bars as $barValue)
            {
                $data[]=BarModel::select("bar_id","name","description","bar_hours","cover_image","address","close_time","open_time")->where('bar_id',$barValue)->first();
                  
            }
            $value->bar_id=$data;
        }
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

    public function playInvite($userID)
    {
        $user =User::where('id',$userID)->first();
        $Notify= sendPushNotification(''.$user->name.'New Song was uploaded','New Song was uploaded by the artist',$user->fcm_token, $notiid=null);
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
            "description" => "required"
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
            $getgame = BargameModel::where('bar_id', $post['bar_id'])->where('name', $post['name'])->first();
            if ($getgame) {
               $responcearray = array('status' => 400, "success" => false, "message" =>"The name has already been taken.", "result" =>new \stdClass());
               return response()->json($responcearray, 400);
            }

            if(isset($post['image']) && !empty($post['image']) )
            {
                $image = explode(",", $post['image']);
                $image = base64_decode(end($image));
                $imagename = md5(time())."_barimage".".png";
                file_put_contents(public_path("Uploads/bargame/").$imagename, $image);
                $post['image'] = url('Uploads/bargame/'.$imagename);
            }
            else
            {
                $post['image'] = NULL;
            }

            $post['no_of_players'] = (isset($post['no_of_players']) && !empty($post['no_of_players']) ) ? $post['no_of_players']:'';
            

            $bar = BargameModel::create($post);

            // $category=BarCategoryModel::create([
            //        'bar_id'=>$post['bar_id'],
            //        'category_id'=>$post['category_id'],
            //        'game_id'=>$bar->id,


            // ]);

          // $supergame=GameModel::where('id',$post['category_id'])->first();
           
          // $bar_ids=explode(',',$supergame->bar_id);  

          // if(!in_array($post['bar_id'],$bar_ids))
          // {
          //   array_push($bar_ids,$post['bar_id']);

          // }   
            
          //   $bar_id=implode(',',$bar_ids); 
          //   $supergame->bar_id=$bar_id;
          //   $supergame->save();


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
        if(empty($id))
        {
            
            $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>new \stdClass());
            return response()->json($responcearray, 404);
        }
        else
        {
            
            $bar = BargameModel::select('*')
                            ->where('bar_id', '=', $id)
                            ->get();

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
    public function update(Request $request)
    {
        
        $post = $request->all();
          
        $rules = array(
            "id" => "required",
            "bar_id" => "required", 
            "name" => "required", 
            "description" => "required"
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

            $getgame = BargameModel::where('bar_id', $post['bar_id'])->where('id','!=', $post['id'])->where('name', $post['name'])->first();

            if ($getgame) {
               $responcearray = array('status' => 400, "success" => false, "message" =>"The name has already been taken.", "result" =>new \stdClass());
               return response()->json($responcearray, 400);
            }
            
            $bars = BargameModel::where('id', $post['id'])->update($post);

            $responcearray = array('status' => 200, "success" => true, "message" =>BAR_GET_UPDATE, "result" =>$bars);
            return response()->json($responcearray, 200);
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
        if(empty($id))
        {
            
            $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>new \stdClass());
            return response()->json($responcearray, 404);
        }
        else
        {
             $bars = BargameModel::where('id', $id)->delete();

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getBarGame(Request $request)
    {

        $post = $request->all();
          
        $rules = array(
            "user_id" => "required",
            "bar_id" => "required", 
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
            
//           $bar = BargameModel::select('*')join
//                            ->where('bar_id', '=', $post['bar_id'])
//                            ->get();
            $bar = GameModel::join('t_bar_category','t_bar_category.activity_id','=','t_game.id')
            ->where('t_bar_category.bar_id', '=', $post['bar_id'])
            ->get();
           

            $count = $bar->count();

            if($count > 0)
            {
            foreach ($bar as $value1) {
                  
             $userFavourite=BargameFavouriteModel::where('user_id', $post['user_id'])->get();

           
            if($userFavourite){
                
            foreach($userFavourite as $favourite)
                 {
              
               $barfavgames = BargameModel::where('id', $favourite->favourite_id)
                            ->first();

                if( $barfavgames)
                {
               if($barfavgames->name==$value1->name)
               {

                // $barfavgame = BargameModel::where('id', $value1)
                //             ->where('name', 'like','%' . $barfavgames->name . '%')
                //             ->first();

                // if($barfavgame){
    
                    $value1['isFavourite'] = true;
                      
                  }else{

                    $value1['isFavourite'] = false;

                  }
              }
              }

                
            }
        }
    }

            else
            {
                $bar = array();
            }

            if($bar)
            {
               
                $responcearray = array('status' => 200, "success" => true, "message" =>BAR_GET_single, "result" =>$bar);
                return response()->json($responcearray, 200);
            }
            else
            {
                $responcearray = array('status' => 400, "success" => false, "message" =>"Game not found.", "result" =>new \stdClass());
                return response()->json($responcearray, 400);
            }   
        }
    }


}
