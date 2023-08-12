<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 
use App\Models\User_detail; 
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       //dd(\Auth::user()->id);  
    
    $getSponsorDetails = DB::table('user_details as ud1')  
    ->join('user_details as ud2','ud1.referred_by', '=', 'ud2.user_id') 
    ->where('ud1.user_id', \Auth::user()->id)
    ->select('ud1.associate_name','ud1.rank','ud1.sponsor_code','ud1.user_id','ud1.referred_by')->get();
     //dd($getSponsorDetails);


     $getUserData = DB::table('user_details')
                        ->where('user_id', '=', $getSponsorDetails[0]->referred_by)
                        ->first();
//dd($getUserData);
       $getRanks = DB::table('ranks')
                                ->where('rank_seq', '<', $getUserData->rank)
                                ->get();
                               // dd($getRanks);
        return view('home')->with(['user' => \Auth::user(),'sponsorDetails' =>$getSponsorDetails,'rankData'=>$getRanks ]);
    }

    public function changePwd(Request $request) {
        // dd($request->all());
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
            $user = User::find($request->user_id);
            $user->update([
                'password' => Hash::make($request->password),
                'pwd_status' => '1'
            ]);
        } else {
            return redirect()->route('home')->withErrors(['Password and Confirm Password does not match.']);
        }
        
        return redirect()->route('home')->with('successmessage','Password updated successfully');
    }

    public function myassociate()
    {
       
         
    $getSponsorDetails = DB::table('user_details as ud1')  
    ->join('user_details as ud2','ud1.referred_by', '=', 'ud2.user_id') 
    ->where('ud1.user_id', \Auth::user()->id)
    ->select('ud2.associate_name','ud2.rank','ud2.sponsor_code','ud2.user_id')->get();
       // dd($getSponsorDetails[0]->associate_name);
        return view('myassociate')->with(['user' => \Auth::user(),'sponsorDetails' =>$getSponsorDetails ]);
    }

    public function updateProfile(Request $request) {
        // dd($request->all());

        $rules = [
            'associate_name' => 'required',
            'email' => 'required|email',
            //'phone_no' => 'required|min:10|max:10',
            'referred_by' => 'required',
            'rank' => 'required',
            'dob' => 'required',
            'aadhar_no' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg|max:2048',
            'pan_no' => 'required',
            'gender' => 'required',
        ];
    
        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];

        $validator = \Validator::make( $request->all(), $rules, $customMessages );

        if ( $validator->fails() ) {
            return \Redirect::back()->withErrors($validator->errors());
        }

        $user_details_data = [
            "associate_name" => $request->associate_name,
            "email" =>  $request->email,
            "dob" => date('Y-m-d', strtotime($request->dob)),
            "rank" => $request->rank,
            "aadhar_no" => $request->aadhar_no,
            "pan_no" => $request->pan_no,
            "gender" => $request->gender
        ];

        if(!empty($request->image)) {
            $imageName = time().'.'.$request->image->extension();

            // Public Folder
            $request->image->move(public_path('images'), $imageName);
            $user_details_data['image'] = $imageName;
        }

        $user_data = [
            "email" =>  $request->email
        ];

        $user = User::find($request->user_id)->update($user_data);
        $user_details = User_detail::where('user_id', $request->user_id)->first();
        $user_details->update($user_details_data);

        return redirect()->route('home')->with('successmessage','Profile updated successfully');

    }
}
