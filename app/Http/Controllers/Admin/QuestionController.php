<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Validator;
use Redirect;
use App\Question;

class QuestionController extends Controller
{
    public function __construct()
    {
        
        // $this->middleware(function ($request, $next){
        //     $user_id = session()->get('adminEmail');

        //     if(empty($user_id))
        //     {
        //         return redirect()->to('login');
        //     }

        //     return $next($request);
        // });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        
        return view("question.index", compact('questions'));
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
