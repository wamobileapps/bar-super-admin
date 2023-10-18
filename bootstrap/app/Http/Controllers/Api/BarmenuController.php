<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use App\Models\BarmenuModel;
use Illuminate\Support\Facades\Validator;
const LOGIN ="Login successfully";
const BAR_ADD ="Bar menu created successfully";
const BAR_GET ="Bars menu data get successfully";
const BAR_GET_single ="Bar menu data get successfully";
const BAR_GET_UPDATE ="Bar menu data update successfully";
const BAR_GET_DELETE ="Bar menu data delete successfully";
const BAR_NOT_DELETE ="Bar menu data not delete successfully";
const WENTWRONG="Something went wrong";
const DATA_NOT="Bars not available";
const INVAILID_ID="Invalid id";

class BarmenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Bar = BarmenuModel::get();

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
            "category_id" => "required", 
            "name" => "required|unique:t_bar_menu", 
            "description" => "required",  
            "price" => "required"
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
            
            $bar = BarmenuModel::create($request->all());
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
            
            $bar = BarmenuModel::select('*')
                            ->where('menu_id', '=', $id)
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
                    "category_id" => "required", 
                    "name" => "required", 
                    "description" => "required",  
                    "price" => "required"
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
                    
                    $bars = BarmenuModel::where('menu_id', $id)->update($post);

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
    public function destroy($id)
    {
        if(empty($id))
        {
            
            $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>new \stdClass());
            return response()->json($responcearray, 404);
        }
        else
        {
             $bars = BarmenuModel::where('menu_id', $id)->delete();

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
