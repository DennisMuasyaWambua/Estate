<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
      
        if(Auth::user()->hasRole('admin')){
            return view('admin.dashboard');
        }elseif(Auth::user()->hasRole('landlord')){
            return view('landlord.dashboard');
        }elseif(Auth::user()->hasRole('caretaker')){
            return view('caretaker.dashboard');
        }elseif(Auth::user()->hasRole('tenant')){
            return view('tenant.dashboard');
        }elseif(Auth::user()->hasRole('user')){
            return view('user.dashboard');
        }elseif(Auth::user()->hasRole('occupant')){
            return view('occupant.dashboard');
        }
       
    }
    //return dashboard view
    public function dashboard(){
        return view('dashboard.accountdashboard');
    }

    public function registerCaretaker(){
        return view('auth.caretakerRegister');
    }
    public function loginCareTaker(){
        return view('auth.caretakerLogin');
    }

    public function userLogin(){
        return view('auth.userLogin');
    }
    
    public function userRegister(){
        return view('auth.userRegister8');
    }
}
