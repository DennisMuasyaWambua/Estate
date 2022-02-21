<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\caretaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CaretakerController extends Controller
{
    //this controller brings into view the different caretakers registerd in the system to the admin and various caretaker operations
    public function viewCaretakers(){
      $caretakers = DB::table('role_user')->where('role_id','=','3')->get();
      return $caretakers;
    }

    //adding mpesa account number and paybill number
    public function getAccountDetails(Request $request){
      $accountNumber = $request->accountNumber;
      $paybillNumber = $request->paybillNumber;
      $id = Auth::id();
      //checking whether the caretaker is present in the database
      $dup = DB::table('caretaker_accounts')->select('caretaker_id')->get();
      //storing the accountDetails
      $store = DB::table('caretaker_accounts')->insert(['caretaker_id'=>$id,'account_number'=>$accountNumber,'paybill_number'=>$paybillNumber,"created_at" =>  date('Y-m-d H:i:s'),"updated_at" => date('Y-m-d H:i:s'),]);
      return redirect(route('Dashboard'));
    }
    //setting the service charge amount
    public function setServiceChargeAmount(Request $request){
      $id = Auth::id();
      $serviceChargeAmount = $request->service_amount;
      $setAmount = DB::table('caretaker_accounts')->where('caretaker_id','=', $id)->update(['service_charge_amount'=>$serviceChargeAmount]);
      return redirect(route('Dashboard'));
    }

     public function deleteCaretaker(Request $request){
      //deleting the caretaker by the admin
     }
     //to view all the caretakers in the system
     public function readCaretakers(Request $request){
        //perform sql joins on the role_user table to  get the list of caretakers
      
     } 

}
