<?php

namespace App\Http\Controllers\payments\mpesa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Occupant;
use App\Models\Payments;

use Session;

class MpesaController extends Controller
{
    //getting access token
    public function getAccessToken(){
        $url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
        $curl = curl_init($url);
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_HTTPHEADER => ['Content-Type: application/json; charset = utf8'],
                CURLOPT_RETURNTRANSFER =>true,
                CURLOPT_HEADER => false,
                CURLOPT_USERPWD=>env('MPESA_CONSUMER_KEY'). ':' .env('MPESA_CONSUMER_SECRET')
            )
        );
        $response = json_decode(curl_exec($curl));
        curl_close($curl);
        return $response->access_token;
    }
    //stk push
    public function stkPush(Request $request){
        $timestamp = date('YmdHis');
        $password = base64_encode(env('MPESA_SHORTCODE').env('MPESA_PASS_KEY').$timestamp);
        $curl_post_data = array(
            'BusinessShortCode' => env('MPESA_SHORTCODE'),
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $request->amount,
            'PartyA' => $request->phone,
            'PartyB' => env('MPESA_SHORTCODE'),
            'PhoneNumber' => $request->phone,
            'CallBackURL' => env('MPESA_TEST_URL').'/api/stkpush',
            'AccountReference' => $request->account,
            'TransactionDesc' => $request->account
          );
          $url = '/stkpush/v1/processrequest';

          $response = $this->makeHttp($url, $curl_post_data);
          $data = json_decode($response,true);
          $checkout = $data['CheckoutRequestID'];
          $email = Auth::user()->email;
         
          
          
          $amount = $request->amount;
          $sender_id = DB::table('occupants')->select('id')->where('email','=', $email)->value('id');
      
        //   $sender_id = json_decode($sender_id,true);
        //  $sEmail = Occupant::find($sender_id);
      
          $recepient_id = DB::table('occupants')->select('caretakerId')->where('email','=', $email)->value('id');
          //storing transaction instance in the database
         $store =  DB::table('payments')->insert(['checkout_id'=>$checkout,'sender_id'=>$sender_id,'recepient_id'=>$recepient_id,'amount'=>$amount]);
         
      
        
        return $response;

    }
    public function getPayments(){
        $payments = DB::table('payments')->select('status')->where('status','=','paid')->count();
        return $payments;
   }
   public function getPendingpayments(){
    $payments = DB::table('payments')->select('status')->where('status','=','pending')->count();
    return $payments;
   }
    //simulate transaction
    public function simulateTransaction(Request $request){
        $body = array(
            'ShortCode'=>env('MPESA_SHORTCODE'),
            'Msisdn'=>254708374149,
            'Amount'=>$request->amount,
            'BillRefNumber'=>$request->account,
            'CommandID'=>'CustomerPayBillOnline' 
        );
        $url='/c2b/v1/simulate';
        $response = $this->makeHttp($url,$body);
        return $response;
    }
    //Register URL
    public function registerURL(){
        $body = array(
            'ShortCode' => env('MPESA_SHORTCODE'),
            'ResponseType' => 'Completed',
            'ConfirmationURL' => env('MPESA_TEST_URL').'/api/confirmation',
            'ValidationURL' => env('MPESA_TEST_URL').'/api/validation'
        );
        $url = '/c2b/v1/registerurl';
        $response = $this->makeHttp($url, $body);
        return $response;
    }
    public function makeHttp($url, $body){
        $url = 'https://sandbox.safaricom.co.ke/mpesa/'.$url;
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                    CURLOPT_URL => $url,
                    CURLOPT_HTTPHEADER => array('Content-Type:application/json','Authorization:Bearer '.$this->getAccessToken()),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => json_encode($body)
                )
        );
        $curl_response = curl_exec($curl);
        curl_close($curl);
        return $curl_response;
    }
}