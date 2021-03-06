<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\caretaker;
use App\Models\landlord;
use App\Models\occupant;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index(){
        if(Auth::user()->hasRole('admin')){
            return view('admin.dashboard');
        }elseif(Auth::user()->hasRole('landlord')){
            return view('landlord.dashboard');
        }elseif(Auth::user()->hasRole('caretaker')){
            $occupants = occupant::paginate(5);
            return view('caretaker.dashboard',compact('occupants'));
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

    //authenticate caretaker
    public function registerCaretaker(){
        return view('auth.caretakerRegister');
    }
    public function loginCareTaker(){
        return view('auth.caretakerLogin');
    }

    //authenticate landlord
    public function registerLandlord(){
        return view('auth.landlordRegister');
    }
    public function loginLandLord(){
        return view('auth.landlordLogin');
    }

    //common auth login
    public function login(){
        return view('auth.login');
    }

    public function register(){
        return view('auth.register');
    }

    //authenticate user
    public function userLogin(){
        return view('auth.userLogin');
    }
    
    public function userRegister(){
        return view('auth.userRegister');
    }

    public function caretakerDashboard(){
        return view('caretaker.dashboard');
    }

    public function landlordDashboard(){
        return view('landlord.dashboard');
    }

    public function userDashboard(){
        return view('user.userDashboard');
    }
    
}
