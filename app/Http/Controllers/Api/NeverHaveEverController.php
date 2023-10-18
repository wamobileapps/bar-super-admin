<?php

namespace App\Http\Controllers\Api;

use App\never_have_ever;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Validator;
use Redirect;
use App\Question;
use Session;
use DB;
use App\Models\AuthenticationModel;
use App\Models\BlockuserModel;
use App\Models\InviteUser;
use App\Models\UserEventModel;
use App\Models\UserFriendModel;
use App\Models\UserDrinkFavourite;
const LOGIN ="Login successfully";
const UserComplete ="User profile has been complete Successfully";
const USER_PROFILE_IMAGE ="User profile image has been uploaded successfully";
const USER_PROFILE_UPDATE ="User profile has been updated successfully";
const USER_PROFILE_GET ="User profile has been get Successfully";
const USERALL_PROFILE_GET ="All user profile has been get Successfully";
const WENTWRONG="Something went wrong";
const INVALIDEMAILPASSWORD="Invalid email or password";
const Vailid_time = '+20 minutes';
const Forget_password = "Forgot password link send your registered email address";
const INVAILID_ID="Invalid Id";
const LINKEXPIRED="Link Expired";
const SESSION_TIMEOUT = "Session Expired ";
const CHANGE_PASSWORD="Password changed successfully.";
const NOT_REGISTER="Email does not exist.";
const USER_ID_ERROR="User id is required.";
const BLOCK_USER="User block successfully";
const UNBLOCK_USER="User unblock successfully";
const FRIEND_ADDED="Friend added successfully";
const UNFRIEND="Unfriend  successfully";
const DRINK_ADDED="Drink added to favorites.";
const DRINK_REMOVED="Drink removed from favorites.";
const FRIEND_LISTED="Friend list get successfully";
const NOT_DATA_FOUND=" No Data Found. ";
const UNSAVED_EVENT=" Event removed successfully.";
const EVENT_SAVED="Event Saved Successfully";
const USER_EVENT_LIST="User events get successfully";
const QUESTION_GET = "Question get successfully";
const NeverHaveIEver = "Never Have I Ever get successfully";


class NeverHaveEverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $never_have_evers = never_have_ever::all();
        $responcearray = array('status' => 200, "success" => true, "message" =>NeverHaveIEver, "result" =>$never_have_evers);
        return response()->json($responcearray, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("neverHaveIEver.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'questions' => 'required|unique:never_have_evers',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)
                        ->withInput();
        }
        $never_have_ever = new never_have_ever;
        $never_have_ever->questions = $request->questions;
        if($never_have_ever->save()){
            return redirect('NeverHaveEver')->with('Success', 'Never Have I Ever added successfully');   
        }else{
            return Redirect::back()->with(['Error', 'Somthing went wrong']);
        }
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
        
        try {
            $question = never_have_ever::find($id);
            
            return view("neverHaveIEver.edit", compact('question'));
        } catch (Exception $e) {
            return Redirect::back()->with(['Error', 'Somthing Went wrong']);
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
        $validator = Validator::make($request->all(), [
            'questions' => 'required|unique:never_have_evers',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)
                        ->withInput();
        }
        $never_have_ever = never_have_ever::find($id);
        $never_have_ever->questions = $request->questions;
        if($never_have_ever->save()){
            return redirect('NeverHaveEver')->with('Success', 'Never Have I Ever updated successfully');   
        }else{
            return Redirect::back()->with(['Error', 'Never Have I Ever not updated']);
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
        try {
            $question = never_have_ever::find($id);
            
            if($question->delete()){
                return redirect('NeverHaveEver')->with('Success', 'Never Have I Ever Deleted successfully');   
            }else{
                return Redirect::back()->with(['Error', 'Somthing Went wrong']);
            }
            
        } catch (Exception $e) {
            return Redirect::back()->with(['Error', 'Somthing Went wrong']);
        }
    }
}
