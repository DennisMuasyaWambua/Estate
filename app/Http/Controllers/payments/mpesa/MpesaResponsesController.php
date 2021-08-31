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
        //inserting the record into the database
        $id = Auth::id(); 
        $caretakerId = DB::table('occupants')->where('id',$id);
        $json = json_encode($request->all());
        $data = json_decode($json,true);
        Log::info($json);

       $payment =  DB::table('payments')->insert([
            'Sender_id'=>$id,
            'Recepient_id'=>$caretakerId,
            'Mpesa_recipient_number'=>$data['stkCallback']['CallbackMetadata']['Item'][1]['value'],
            'Amount'=>$data['stkCallback']['CallbackMetadata']['Item'][0]['value']
        ]);

        // Log::info($request->Body['CallbackMetadata']['Item']['o']['Value']);
        // Log::info($request->Body->CallbackMetadata->Item->1->Value);
        return $payment;
    
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
