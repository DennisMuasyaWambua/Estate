<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\caretaker;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CaretakerController extends Controller
{
    //bring the caretakers dashboard into view 
    public function index(){
      $users = DB::table('role_user')->where('role_id','=',6)
      ->join('roles', 'role_user.role_id', '=', 'roles.id')
      ->join('users', 'role_user.role_id', '=', 'users.id')
      ->select('users.name','users.email', 'roles.display_name')
      ->get();
      return view('caretaker.dashboard')->with('users',$users);
    }
    //controll caretaker functionality
    
  
    //function to make a user to be an occupant
    public function makeUserOccupant($email){
      $occupant = User::find($email);
      $occupant->attachRole('occupant');
    }

    //to search for a user
    public function searchforUser($name){
      $user = User::find($name);
      return view('caretaker.dashboard')->with('user',$user);
    }
    
}
