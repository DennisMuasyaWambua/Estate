<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\caretaker;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CaretakerController extends Controller
{
    //controll caretaker functionality
    public function caretakerIndex(){
      $users = User::all();
      return view('caretaker.dashboard')->with('users',$users);
    }
}
