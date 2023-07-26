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

        $first_nm = substr($request->associate_name, 0, 5);
        $string = str_replace('/', '', $request->dob);
        $tempPass=$first_nm.'@'.$string;



        $regiserUserId= User::create([
            'name' => $request->associate_name,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'password' => Hash::make($tempPass),
        ])->id;
        //dd($regiserUser);

        $userDetails = new User_detail;        
        $request->sponsor_code="DVA".$first_nm.''.$string;
        $userDetails->associate_name = $request->associate_name;
        $userDetails->email = $request->email;
        $userDetails->user_id = $regiserUserId;
        $userDetails->sponsor_code = $request->sponsor_code;
        $userDetails->rank = $request->rank;
        $userDetails->dob = date('Y-m-d', strtotime($request->dob));
        $userDetails->aadhar_no = $request->aadhar_no;
        $userDetails->referred_by = $request->referred_by;
        $userDetails->phone_no = $request->phone_no;
       
        if($userDetails->save()){
            return redirect('/login');
        }

        

    }

    public function getSponser(Request $request){
//echo 'Sponsor code --'.$request->spcode;exit;
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
