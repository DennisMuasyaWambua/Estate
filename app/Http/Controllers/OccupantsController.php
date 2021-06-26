<?php

namespace App\Http\Controllers;

use App\Models\occupants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OccupantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ->with('occupants',$occupants)
        $occupants = occupants::all();
        return view('caretaker.dashboard')->with('occupants',$occupants);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $id = Auth::id();
        // //create a new occupant
        // $occpant = new Occupants();
        // $occupant->caretakerId = $id;
        // $occpant->name = request('name');
        // $occupant->email = request('email');
        // $occupant->phone = request('phone');
        // $occupant->estate = request('estate');
        // $occupant->blockNumber = request('blockNumber');
        // $occupant->flatNumber = request('flatNumber');
        // $occupant->save();
        // return redirect('/Dashboard');
        return view('Dashboard');
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
        // $id = Auth::id();
        // $occpant = new Occupants();
        // $occupant->caretakerId = $id;
        // $occpant->name = $request->name;
        // $occupant->email = $request->email;
        // $occupant->phone = $request->phone;
        // $occupant->estate = $request->estate;
        // $occupant->blockNumber = $request->blockNumber;
        // $occupant->flatNumber = $request->flatNUmber;
        // $occpant->save();
        // return redirect('/Dashboard');
        $occupant = occupants::create($request->except('_token'));
        return redirect(route('Dashboard.allOccupants'));
        //dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\occupants  $occupants
     * @return \Illuminate\Http\Response
     */
    public function show(occupants $occupants)
    {
        //
       $occupants = occupants::all();
       return view('caretaker.dashboard')->with('occupants',$occupants);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $occupants = occupants::find($id);
        return view('caretaker.dashboard')->with('occupants',$occupants);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\occupants  $occupants
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, occupants $occupants)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //deleting an occupant 
        occupants::destroy($id);
        return redirect(route('Dashboard.allOccupants'));
        // dd($id);
    }

    public function occupants(){
        $occupants = occupants::all();
        return view('caretaker.dashboard')->with('occupants',$occupants);
    }
}
