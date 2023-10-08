<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Twilio\Rest\Client;
use App\Models\User; 
use App\Models\User_detail; 
use App\Models\Ranks; 
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Redirect;
use App\Service\SmsServiceInterface;

class UserRegistrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SmsServiceInterface $smsService)
    {
        //$this->middleware('auth');
        $this->smsService = $smsService;
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

        // dd($this->smsService->sendSMS());
        $getRanks = DB::table('ranks')->get();
        
        return view('general/registration')->with(['rankData'=>$getRanks]);

    }


    public function addUser(Request $request)
    {
        //dd($request->all());

        $rules = [
            'associate_name' => 'required',
            'email' => 'required|email',
            'phone_no' => 'required|min:10|max:10',
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

        $first_nm = substr($request->associate_name, 0, 2);
        $string = substr(str_replace('/', '', $request->dob), 0, 4);
        $tempPass=$first_nm.'@'.$string;
        $associateCode = "DVA".$first_nm.''.$string;
        
        $rank = Ranks::find($request->rank);
        // $rank = substr($rank->rank_name, 0, 25);
        $rank = $rank->short_code;
        //send sms
        $message = "Welcome to DML. Your Assocode- ".$associateCode. " & Rank- ".$rank.", Login Id- ".$request->phone_no." and Password- ".$tempPass.", -DVA Martnet Ltd."; 
        if ($this->smsService->sendSMS($request->phone_no, $message)) {

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

           // dd($userDetails);
            $userDetails->save();
            
            return redirect()->route('registration')->with('successmessage','You are successfully registered.')->with('temppassword','Your auto generated password is - '.$tempPass.'. Please change your password after first login. Thank you');
        }
    }

    // public function sendSMS ($number, $message) {
    //     $receiverNumber = "+919733962148"; // change to $number
  
    //     try {
  
    //         $account_sid = getenv("TWILIO_ACCOUNT_SID");
    //         $auth_token = getenv("TWILIO_AUTH_TOKEN");
    //         $twilio_number = getenv("TWILIO_SMS_FROM");
  
    //         $client = new Client($account_sid, $auth_token);
    //         $client->messages->create($receiverNumber, [
    //             'from' => $twilio_number, 
    //             'body' => $message]);
  
    //         return true;
  
    //     } catch (Exception $e) {
    //         dd("Error: ". $e->getMessage());
    //     }
    // }


    public function getSponser(Request $request){
        $getUserData = DB::table('user_details')->select('user_details.associate_name','user_details.user_id','user_details.rank','ranks.rank_name','ranks.rank_seq')
        ->leftJoin('ranks as ranks', 'user_details.rank', '=', 'ranks.id')
                        ->where('user_details.sponsor_code', '=', $request->spcode)
                        ->first();

                        if(!empty($getUserData)){
                            return  $getUserData;
                        }else{
                            return '0';
                        }      
        
               
        
    }

    public function getRankbySp(Request $request){

        $getRanksdata = DB::table('ranks')
                        ->where('id', '=', $request->rank_id)
                        ->first();

        $getRankByspRank = DB::table('ranks')
                        ->where('rank_seq', '<', $getRanksdata->rank_seq)
                        ->get();
        if(!empty($getRankByspRank)){

            $dropdowns = '<option value="">Select Your Rank</option>';
            foreach ($getRankByspRank as $row)
            {
                $dropdowns .= '<option value="'.$row->id.'">'.$row->rank_name.'</option>';
            }



            return  $dropdowns;
        }else{
            return '0';
        }      
    }

    // Forgot password ------------------------------------------
    public function forgot_password() {
        return view('auth.forgotPwd.reset_pwd');
    }

    public function send_otp(Request $request) {
        // dd($request->all());
        $user = User::where('phone_no', $request->phone_no)->first();
        if(!empty($user)){
            $reset_otp = random_int(100000, 999999);
            $message = "Your reset password OTP is ".$reset_otp. "."; 
            $message = "Hi ".$user->name.". Your OTP is ".$reset_otp." to change password in case of forget password in DVA Marnet portal. Don't share this OTP to anyone. -DVA Marnet Ltd"; 
            // echo $message;
            // if ($this->smsService->sendSMS($request->phone_no, $message)) {
                $user->update(['remember_token' => $reset_otp]);
                $encPhone = $this->encryptStr($request->phone_no);
                return redirect()->route('verify_otp', ['token' => $encPhone])->with('successmessage','OTP sent successfully - '.$reset_otp);
            // }
        } else {
            return \Redirect::back()->withErrors(['Phone number not registered.']);
        }
    }

    public function verify_otp(Request $request, $token=NULL) {
        if ($request->isMethod('post')) {
            // dd($request->all());
            $decPhone = $this->decryptStr($request->token);
            $user = User::where(['phone_no' => $decPhone, 'remember_token' => $request->remember_token])->first();
            if(!empty($user)){
                $encPhone = $this->encryptStr($decPhone.'~'.$request->remember_token);
                return redirect()->route('reset_pwd', ['token' => $encPhone]);
            } else {
                return \Redirect::back()->withErrors(['Phone number and OTP not match.']);
            }
        }
        if ($request->isMethod('get')) {
            return view('auth.forgotPwd.verify_otp')->with(['token' => $request->token]);
        }
    }

    public function reset_pwd($token) {
        $decPhone = $this->decryptStr($token);
        $data = explode("~", $decPhone);
        $user = User::where(['phone_no' => $data[0], 'remember_token' => $data[1]])->first();
        if(!empty($user)){
            return view('auth.forgotPwd.update_pwd')->with(['token' => $token]);
        } else {
            return \Redirect::back()->withErrors(['Phone number and OTP not match.']);
        }
    }
    
    public function update_pwd(Request $request){
        // dd($request->all());
        $decPhone = $this->decryptStr($request->token);
        $data = explode("~", $decPhone);
        $user = User::where(['phone_no' => $data[0], 'remember_token' => $data[1]])->first();
        if(!empty($user)){
            $rules = [
                'password' => 'required|min:6',
                'cpassword' => 'required|min:6'
            ];
        
            $customMessages = [
                'required' => 'The :attribute field is required.'
            ];

            $validator = \Validator::make( $request->all(), $rules, $customMessages );

            if ( $validator->fails() ) {
                return \Redirect::back()->withErrors($validator->errors());
            }

            if($request->password === $request->cpassword) {
                $user->update([
                    'password' => Hash::make($request->password),
                    'pwd_status' => '1',
                    'remember_token' => NULL
                ]);
            } else {
                return \Redirect::back()->withErrors(['Password and Confirm Password does not match.']);
            }
            
            return redirect()->route('login')->with('successmessage','Password updated successfully');
        }
    }

    public function encryptStr($str) {
        // Store the cipher method
        $ciphering = "AES-128-CTR";
        
        // Use OpenSSl Encryption method
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        
        // Non-NULL Initialization Vector for encryption
        $encryption_iv = '1234567891011121';
        
        // Store the encryption key
        $encryption_key = "MLMPro";
        
        // Use openssl_encrypt() function to encrypt the data
        $encryption = openssl_encrypt($str, $ciphering,
                    $encryption_key, $options, $encryption_iv);

        return $encryption;
    }

    public function decryptStr($str) {
        // Store the cipher method
        $ciphering = "AES-128-CTR";
        
        // Use OpenSSl Encryption method
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;

        // Non-NULL Initialization Vector for decryption
        $decryption_iv = '1234567891011121';
        
        // Store the decryption key
        $decryption_key = "MLMPro";
        
        // Use openssl_decrypt() function to decrypt the data
        $decryption=openssl_decrypt ($str, $ciphering,
                $decryption_key, $options, $decryption_iv);

        return $decryption;
    }

    public function artisan_cmd($cmd=NULL) {
        if(isset ($cmd) && ($cmd != '')){
            \Artisan::call($cmd);
        } else {
            return redirect()->route('login')->with('successmessage','Please send artisan command');
        }

        return redirect()->route('login')->with('successmessage', $cmd.' - executed successfully');

    }

    public function sendSMS() {
        
        $apiKey = urlencode('N2EzODQyNmY2ZTVhNTc2YTU0MzM0NjU0Njk0MTMyNTI=');
	
        // Message details
        $numbers = urlencode('917001493650'); //Mobile number on which you want to send message
        $sender = urlencode('DVAML'); 
        $message = rawurlencode('Welcome to DML. Your Assocode- A001 & Rank- R001 , Login Id- L001  and Password- P001, -DVA Martnet Ltd.');

        // $numbers = implode(',', $numbers);
 
        // Prepare data for POST request
        $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message, $test=1);

        // Send the POST request with cURL
        $ch = curl_init('https://api.textlocal.in/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        // Process your response here
        echo $response;
        

    }


}
