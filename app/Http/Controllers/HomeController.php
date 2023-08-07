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
        //  $getPhoneNumber = DB::table('user_details')
        //  ->where('user_id', '=', \Auth::user()->id)
        //  ->first();
        //  dd($getPhoneNumber);
         
    $getSponsorDetails = DB::table('user_details as ud1')  
    ->join('user_details as ud2','ud1.referred_by', '=', 'ud2.user_id') 
    ->where('ud1.user_id', \Auth::user()->id)
    ->select('ud2.associate_name','ud2.rank','ud2.sponsor_code','ud2.user_id')->get();
       // dd($getSponsorDetails[0]->associate_name);
        return view('home')->with(['user' => \Auth::user(),'sponsorDetails' =>$getSponsorDetails ]);
    }

    public function changePwd(Request $request) {
        // dd($request->all());
        if($request->password === $request->cpassword) {
            $user = User::find($request->user_id);
            $user->update([
                'password' => Hash::make($request->password),
                'pwd_status' => '1'
            ]);
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
        // $request->validate([
        //     'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        // ]);

        $user_details_data = [
            "associate_name" => $request->associate_name,
            "email" =>  $request->email,
            "dob" => $request->dob,
            "rank" => $request->rank,
            "aadhar_no" => $request->aadhar_no,
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
