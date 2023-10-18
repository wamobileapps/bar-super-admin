<?php

namespace App\Http\Controllers\Api;

use App\Doors;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doors = Doors::get();
        if(!$doors->isEmpty()){
            $statusMsg = "Doors get successfully."; 
			$responcearray = array('status' => 200, "success" => true, "message" =>$statusMsg, "result" =>$doors);
            return response()->json($responcearray, 200);
        }else{
            $statusMsg = "No Doors Available."; 
			$responcearray = array('status' => 400, "success" => false, "message" =>$statusMsg, "result" => new Doors());
            return response()->json($responcearray, 400);
		} 
	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Doors  $doors
     * @return \Illuminate\Http\Response
     */
    public function show(Doors $doors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Doors  $doors
     * @return \Illuminate\Http\Response
     */
    public function edit(Doors $doors)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doors  $doors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doors $doors)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doors  $doors
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doors $doors)
    {
        //
    }
}
