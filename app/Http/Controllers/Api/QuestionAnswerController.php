<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Validator;
use Redirect;
use App\Question;
use App\Questions_answer;

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

class QuestionAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $user_id = '')
    {

        if(empty($user_id))
        {
            
            $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>array());
            return response()->json($responcearray, 404);
        }
        else
        {
            $user = AuthenticationModel::select('*')
                                ->where('user_id', '=', $user_id)
                                ->get()->first();
                                
            // $questions = Questions_answer::where('user_id', $request->user_id)->get();
            $questions = DB::table('questions_answers')
            ->join('questions', 'questions.id', '=', 'questions_answers.question_id')
            ->where('user_id', $user->id)
            ->select('questions_answers.*', 'questions.id as questions_id', 'questions.questionnaire_title', 'questions.first_question', 'questions.sec_question')
            ->get();
            $responcearray = array('status' => 200, "success" => true, "message" =>QUESTION_GET, "result" =>$questions);
            return response()->json($responcearray, 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'question_id' => 'required',
            'user_id' => 'required',
            'answer' => 'required',
        ]);
       
        if($validator->fails())
        {
     
            $errorString = implode(",",$validator->messages()->all());
            $responcearray = array('status' => 400, "success" => false, "message" =>$errorString, "result" =>new \stdClass());
            return response()->json($responcearray, 400);
        }
        $Questions_answer_alredy = Questions_answer::where('user_id', $request->user_id)->where('question_id', $request->question_id)->first();
        if(!empty($Questions_answer_alredy)){
            $responcearray = array('status' => 400, "success" => false, "message" =>"Alredy Submitted This", "result" =>new \stdClass());
            return response()->json($responcearray, 400);
        }
        $questions = new Questions_answer;
        $questions->question_id = $request->question_id;
        $questions->user_id = $request->user_id;
        $questions->answer = $request->answer;
        if($questions->save()){
            $responcearray = array('status' => 200, "success" => true, "message" =>"Answer Submitted", "result" =>$questions);
            return response()->json($responcearray, 200); 
        }else{
            $responcearray = array('status' => 400, "success" => false, "message" =>"Somthing went wrong", "result" =>new \stdClass());
            return response()->json($responcearray, 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $user_id)
    {
        if(empty($user_id))
        {
            
            $responcearray = array('status' => 404, "success" => false, "message" =>INVAILID_ID, "result" =>array());
            return response()->json($responcearray, 404);
        }
        else
        {
            // $questions = Questions_answer::where('user_id', $request->user_id)->get();
            $questions = DB::table('questions_answers')
            ->join('questions', 'questions.id', '=', 'questions_answers.question_id')
            ->where('questions.id', $request->question_id)
            ->select('questions_answers.*', 'questions.id as questions_id', 'questions.questionnaire_title', 'questions.first_question', 'questions.sec_question')
            ->get();
            $responcearray = array('status' => 200, "success" => true, "message" =>QUESTION_GET, "result" =>$questions);
            return response()->json($responcearray, 200);
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
