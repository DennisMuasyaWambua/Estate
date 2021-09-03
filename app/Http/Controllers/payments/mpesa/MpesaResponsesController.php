<?php

namespace App\Http\Controllers\payments\mpesa;

use App\Http\Controllers\Controller;
use App\Models\Payments;
use App\Models\Occupant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MpesaResponsesController extends Controller
{
    //
    public function validation(Request $request){
        Log::info('validation end point hit');
        Log::info($request->all());
        return [
            'ResultCode'=>0,
            'ResultDesc'=>'Accept Service',
            'ThirdPartyTransID' => rand(3000, 10000)
        ];
    }

    public function stkPush(Request $request){
        Log::info('Stk end point hit');
        toastr()->success('Stk received successfully');
        Log::info($request->all());
        Log::info($request->Body['stkCallback']['ResultDesc']);

        $response = json_encode($request->all());
        $data = json_decode($response,true);
        $amount = $data['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'];
        $receiptNumber = $data['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
        $Amount = json_encode($amount);
        $ReceiptNumber = json_encode($receiptNumber); 
        Log::info($Amount);
        Log::info($ReceiptNumber);

        $acceptance = $request->Body['stkCallback']['ResultDesc'];
        if($acceptance=='The service request is processed successfully.'){
            // getting logged in users email
            $user = Auth::user();
            $email = $user->email;
            //sql queries to get occupant_id and caretaker_id from the occupants table 
            $occupant_id = DB::table('occupant')->select('id')->where('email','=',$email)->get();
            $caretaker_id = DB::table('occupant')->select('caretakerID')->where('email','=',$email)->get();
    
    
            $store = DB::table('create_occupant_payments')->insert(['sender_id'=>$occupant_id,'recepient_id'=>$caretaker_id,'receipt_id'=>$ReceiptNumber,'amount'=>$Amount]);
            return $store;
        }else{
            Log::info($acceptance);
            return $acceptance;
        }

        
       

    }

    public function confirmation(Request $request){
        Log::info('confirmation end point hit');
        Log::info($request->all());
        return [
            'ResultCode'=>0,
            'ResultDesc'=>'Accept Service',
            'ThirdPartyTransID' => rand(3000, 10000)
        ];
    }
}
