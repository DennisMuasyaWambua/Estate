<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\caretaker;
use App\Models\occupants;
use App\Models\User;
use App\Models\Occupant;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index(Request $request){
        if(Auth::user()->hasRole('admin')){
            return view('admin.dashboard');
        }elseif(Auth::user()->hasRole('landlord')){
            return view('landlord.dashboard');
        }elseif(Auth::user()->hasRole('caretaker')){

                 $id = Auth::id();
                 //dd($id);
                $occupant = Occupant::where('caretakerId',$id)->get();
                
         
       
                $monthly_amount = DB::table('caretaker_accounts')->select('service_charge_amount')->where('caretaker_id','=', $id)->value('service_charge_amount');
                $yearly_amount = $monthly_amount*12;
                
                //calculating someones balance
                $occupants_balances = DB::table('occupant_payments')->join('occupants','occupant_payments.sender_id','=','occupants.id')->join('caretaker_accounts','occupant_payments.recepient_id','=','caretaker_accounts.caretaker_id')->select('occupants.name','occupants.phone','occupants.estate','occupants.blockNumber','occupants.flatNumber',DB::raw("'$yearly_amount'-occupant_payments.amount as amount"))->where('occupant_payments.recepient_id','=',$id)->where('occupant_payments.amount','<',$yearly_amount)->groupBy('occupants.id')->get();
                //dd($occupants_balances);
                $balances= json_decode($occupants_balances,true);

                return view('caretaker.dashboard',compact('occupant','balances'));
          
        }elseif(Auth::user()->hasRole('tenant')){
            return view('tenant.dashboard');
        }elseif(Auth::user()->hasRole('user')){
            return view('user.dashboard');
        }elseif(Auth::user()->hasRole('occupant')){
            $id = Auth::id();
            session(['occupant-id'=>$id]);
            $value = $request->cookie('token');
          
            return view('occupant.dashboard');
        }elseif(Auth::user()->hasRole('null')){
            return redirect('/');
        }else{
            return redirect('/');
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
    public function userDashboard(){
        return view('user.userDashboard');
    }
    
    
    
}
