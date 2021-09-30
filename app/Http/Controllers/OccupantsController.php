<?php
namespace App\Http\Controllers;
use App\Models\Occupant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use DataTables;
use Validator;



class OccupantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $occupant = Occupant::all();
      return route('Dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Auth::id();
        //create a new occupant
        $occpant = new Occupant();
        $occupant->caretakerId = request('caretakerId');
        $occpant->name = request('name');
        $occupant->email = request('email');
        $occupant->phone = request('phone');
        $occupant->estate = request('estate');
        $occupant->blockNumber = request('blockNumber');
        $occupant->flatNumber = request('flatNumber');
        $occupant->save();
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
        
       $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'estate'=>'required',
            'blockNumber'=>'required',
            'flatNumber'=>'required',
        ]);
        if(!$validator->passes()){
            //dd('niko hapa');
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            
            $id = Auth::id();
           //dd($id);
            //create a new occupant
            
            $occupant = new Occupant();
            $occupant->caretakerId = $id;
            $occupant->name = request('name');
            $occupant->email = request('email');
            $occupant->phone = request('phone');
            $occupant->estate = request('estate');
            $occupant->blockNumber = request('blockNumber');
            $occupant->flatNumber = request('flatNumber');
            $occupant->save();
            User::create([
                'name'=>$occupant->name, 
                'email'=> $occupant->email,
                'password'=>Hash::make('password')
            ])->attachRole('occupant');
            Password::sendResetLink($request->only(['email']));
            toastr()->success('Occupant added successfully');

           
          
            // return redirect('/Dashboard');
            return redirect(route('Dashboard'));
            // $occupant->caretakerId = $request->caretakerId;
            // $occupant->name = $request->name;
            // $occupant->email = $request->email;
            // $occupant->phone = $request->phone;
            // $occupant->estate = $request->estate;
            // $occupant->blockNumber = $request->blockNumber;
            // $occupant->flatNumber = $request->flatNumber;
            // $query = $occupant->create($request->except('_token'));
            // if(!$query){
            //     return response()->json(['code'=>0,'msg'=>'Something went wrong']);
            // }else{
            //     return response()->json(['code'=>1,'msg'=>'New Country has been successfully saved']);
            // }

        }
        // $occupant = occupants::create($request->except('_token'));
        // return redirect(route('Dashboard.allOccupants'));
        //dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $Occupant = Occupant::find($id);
       return view('partials.update',compact('Occupant'));
    }

    public function deleteShow($id){
        $delete = Occupant::find($id);
        return view('partials.delete',compact('delete'));
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
        $Occupant = Occupant::all();
        $Occupant = $Occupant->find($id);
        //dd($occupant);
        return view('partials.update',compact('Occupant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        
        $Occupant = Occupant::find($request->id);
        $Occupant->name = $request->name;
        $Occupant->email = $request->email;
        $Occupant->phone = $request->phone;
        $Occupant->estate = $request->estate;
        $Occupant->blockNumber = $request->blockNumber;
        $Occupant->flatNumber = $request->flatNumber;
        $Occupant->save();
        return redirect(route("Dashboard"));
        //return redirect(route('Dashboard'));


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
        Occupant::destroy($id);
        return redirect(route('Dashboard'));
        // dd($id);
    }

  
}