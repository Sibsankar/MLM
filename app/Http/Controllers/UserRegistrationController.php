<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Twilio\Rest\Client;

class UserRegistrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $receiverNumber = "+918617827510";
        $message = "Chol ghumote hobe ebar!!!";
  
        try {
  
            $account_sid = getenv("TWILIO_ACCOUNT_SID");
            $auth_token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_number = getenv("TWILIO_SMS_FROM");
  
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);
  
            dd('SMS Sent Successfully.');
  
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
        
        return view('home');
    }

    public function registration()
    {
        
        return view('general/registration');

    }
}
