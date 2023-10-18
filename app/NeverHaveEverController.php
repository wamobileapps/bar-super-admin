<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Validator;
use Redirect;
use App\never_have_ever;

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
        return view("neverHaveIEver.index", compact('never_have_evers'));
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
            
            return view("NeverHaveEver.edit", compact('question'));
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
