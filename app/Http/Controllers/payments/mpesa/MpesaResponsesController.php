<?php

namespace App\Http\Controllers\payments\mpesa;

use JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\Payments;
use App\Models\Occupant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;

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
        $prosperity = $request->Body['stkCallback']['ResultDesc'];
       
        
        $response = json_encode($request->all()); 
        $data = json_decode($response,true);
        $amount = $data['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'];
        $receiptNumber = $data['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
        $Amount = json_encode($amount);
        $ReceiptNumber = json_encode($receiptNumber);
       
        Log::info($Amount);
        Log::info($ReceiptNumber);

        $acceptance = $request->Body['stkCallback']['ResultDesc'];
        $checkoutID = $request->Body['stkCallback']['CheckoutRequestID'];
        //evaluating acceptance
            if($acceptance =='The service request is processed successfully.'){
                $confirmed = DB::table('payments')->where('checkout_id',$checkoutID)->update(['status'=>'paid']);
               
                 $sender_id = DB::table('payments')->select('sender_id')->where('checkout_id','=',$checkoutID)->get();
                 Log::info($sender_id[0]->sender_id);
                 $s_id = $sender_id[0]->sender_id;
                 $email=DB::table('occupants')->select('email')->where('id','=',$sender_id[0]->sender_id)->get();
                 Log::info($email[0]->email);
                 $mail = $email[0]->email;
                 $password = DB::table('occupants')->select('password')->where('id','=',$sender_id[0]->sender_id)->get();
                 Log::info($password[0]->password); 

                

                $occupant_id = DB::table('occupants')->select('id')->where('email','=',$mail)->get();
                $o_id = $occupant_id[0]->id;
                Log::info($o_id);
                $caretaker_id = DB::table('occupants')->select('caretakerId')->where('email','=',$mail)->get();
                $c_id = $caretaker_id[0]->caretakerId;
                Log::info($c_id);
        
        
                $store = DB::table('occupant_payments')->insert(['checkout_id'=>$checkoutID,'sender_id'=>$o_id,'recepient_id'=>$c_id,'receipt_id'=>$ReceiptNumber,'amount'=>$Amount,'created_at'=>DB::raw('CURRENT_TIMESTAMP')]);
                Log::info($store);  



            
           

          
            
            
            //$store = DB::table('occupant_payments')->insert(['checkout_id'=>$checkoutID,'sender_id'=>$o_id,'recepient_id'=>$c_id,'receipt_id'=>$ReceiptNumber,'amount'=>$Amount]);
                return $store;
            }else{
                return $response;
            }
        return $response;
       

    }
    public function createToken(){
        $email=DB::table('occupants')->select('email')->where('id','=',$sender_id[0]->sender_id)->get();
        Log::info($email[0]->email);
        $mail = $email[0]->email;
        $password = DB::table('occupants')->select('password')->where('id','=',$sender_id[0]->sender_id)->get();
        Log::info($password[0]->password);
        $pass =$password[0]->password;

         $credentials = array($mail,$pass);

         try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                	'success' => false,
                	'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
    	return $credentials;
            return response()->json([
                	'success' => false,
                	'message' => 'Could not create token.',
                ], 500);
        }
 	
 		//Token created, return with success response and jwt token
        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
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

    public function getCookie(Request $request){
        
        $token = $request->cookie('token');
     
       dd($token);
        
        return $token;
    }
   

   
   
}
