<?php

namespace App\Http\Controllers\Api;

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

class QuestionController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
            $questions = Question::all();
            $responcearray = array('status' => 200, "success" => true, "message" =>QUESTION_GET, "result" =>$questions);
            return response()->json($responcearray, 200);
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("question.create");
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
            'questionnaire_title' => 'required',
            'first_question' => 'required',
            'sec_question' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)
                        ->withInput();
        }
        $Question = new Question;
        $Question->questionnaire_title = $request->questionnaire_title;
        $Question->first_question = $request->first_question;
        $Question->sec_question = $request->sec_question;
        if($Question->save()){
            return redirect('question')->with('Success', 'Questionnaire added successfully');   
        }else{
            return Redirect::back()->with(['Error', 'Questionnaire not added']);
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
            $question = Question::findOrFail($id);
            return view("question.edit", compact('question'));
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
            'questionnaire_title' => 'required',
            'first_question' => 'required',
            'sec_question' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)
                        ->withInput();
        }
        $Question = Question::find($id);
        $Question->questionnaire_title = $request->questionnaire_title;
        $Question->first_question = $request->first_question;
        $Question->sec_question = $request->sec_question;
        if($Question->save()){
            return redirect('question')->with('Success', 'Questionnaire updated successfully');   
        }else{
            return Redirect::back()->withErrors(['Error', 'Questionnaire not updated']);
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
            $question = Question::find($id);
            
            if($question->delete()){
                return redirect('question')->with('Success', 'Questionnaire Deleted successfully');   
            }else{
                return Redirect::back()->with(['Error', 'Somthing Went wrong']);
            }
            
        } catch (Exception $e) {
            return Redirect::back()->with(['Error', 'Somthing Went wrong']);
        }
    }
}
