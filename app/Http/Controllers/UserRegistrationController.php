<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Twilio\Rest\Client;
use App\Models\User; 
use App\Models\User_detail; 
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Redirect;

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


    public function addUser(Request $request)
    {
        //dd($request->all());

        $rules = [
            'associate_name' => 'required',
            'email' => 'required|email',
            'phone_no' => 'required|min:10|max:10',
            'referred_by' => 'required',
            'rank' => 'required',
            'dob' => 'required',
            'aadhar_no' => 'required',
            // 'pan_no' => 'required',
            // 'gender' => 'required',
        ];
    
        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];

        $validator = \Validator::make( $request->all(), $rules, $customMessages );

        if ( $validator->fails() ) {
            return Redirect::back()->withErrors($validator->errors());
        }
    


        if(strlen($request->phone_no)<10 || strlen($request->phone_no)>10){
            return Redirect::back()->withErrors(['msg' => 'Please enter valid 10 digit phone number']);
        }

        $getPhoneNumber = DB::table('user_details')
                        ->where('phone_no', '=', $request->phone_no)
                        ->first();

        if(!empty($getPhoneNumber)){
            return Redirect::back()->withErrors(['msg' => 'This phone number is already registered with us. Please login']);
        }

        $getEmail = DB::table('user_details')
        ->where('email', '=', $request->email)
        ->first();

        if(!empty($getEmail)){
            return Redirect::back()->withErrors(['msg' => 'This email is already registered with us. Please login']);
        }




        $first_nm = substr($request->associate_name, 0, 5);
        $string = str_replace('/', '', $request->dob);
        $tempPass=$first_nm.'@'.$string;
        $associateCode = "DVA".$first_nm.''.$string;
        //send sms
        $message = "Welcome to DVA Mortnet Ltd. Your Associate Code is ".$associateCode. ". Login using your register mobile number and password ".$tempPass; 
        if ($this->sendSMS($request->phone_no, $message)) {

            $regiserUserId= User::create([
                'name' => $request->associate_name,
                'email' => $request->email,
                'phone_no' => $request->phone_no,
                'password' => Hash::make($tempPass),
            ])->id;
            //dd($regiserUser);

            $userDetails = new User_detail;        
            $request->sponsor_code=$associateCode;
            $userDetails->associate_name = $request->associate_name;
            $userDetails->email = $request->email;
            $userDetails->user_id = $regiserUserId;
            $userDetails->sponsor_code = $request->sponsor_code;
            $userDetails->rank = $request->rank;
            $userDetails->dob = date('Y-m-d', strtotime($request->dob));
            $userDetails->aadhar_no = $request->aadhar_no;
            $userDetails->phone_no = $request->phone_no;
            // $userDetails->gender = $request->gender;
            // $userDetails->pan_no = $request->pan_no;

            $userDetails->referred_by = ($request->referred_by != '') ? $request->referred_by: '';

            //dd($userDetails);
            $userDetails->save();
            
            return redirect()->route('registration')->with('successmessage','You are successfully registered.');
        }
    }

    public function sendSMS ($number, $message) {
        $receiverNumber = "+919733962148"; // change to $number
  
        try {
  
            $account_sid = getenv("TWILIO_ACCOUNT_SID");
            $auth_token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_number = getenv("TWILIO_SMS_FROM");
  
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);
  
            return true;
  
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }


    public function getSponser(Request $request){
        $getUserData = DB::table('user_details')
                        ->where('sponsor_code', '=', $request->spcode)
                        ->first();
                        if(!empty($getUserData)){
                            return  $getUserData;
                        }else{
                            return '0';
                        }      
        
               
        
            }


}
