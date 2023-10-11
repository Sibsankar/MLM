<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 
use App\Models\User_detail; 
use Illuminate\Support\Facades\DB;
use PDF;

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
        $StateData= DB::table('all_states')->get();
        $cityData= DB::table('all_cities')->get();
        //dd($StateData);
        $getRanks = [];       
        $userData = \Auth::user();
        $getSponsorDetails = DB::table('user_details')->select('user_details.associate_name','user_details.sponsor_code','user_details.rank','ranks.rank_name','ranks.rank_seq')
        ->leftJoin('ranks as ranks', 'user_details.rank', '=', 'ranks.id')
                        ->where('user_details.user_id', '=', $userData->details[0]->referred_by)
                        ->get();
    
        $getRanks = DB::table('ranks')
                                    ->where('rank_seq', '=', $userData->details[0]->rank)
                                    ->first();
                            
        
        return view('home')->with(['user' => \Auth::user(),'sponsorDetails' =>$getSponsorDetails,'rankData'=>$getRanks,'StateData'=>$StateData,'cityData'=>$cityData ]);
    }
    public function getCities(Request $request){

        $getCitiesdata = DB::table('all_cities')
                        ->where('state_code', '=', $request->state_code)
                        ->get();

      
        if(!empty($getCitiesdata)){

            $dropdowns = '<option value="">Select Your City</option>';
            foreach ($getCitiesdata as $row)
            {
              
                $dropdowns .= '<option value="' . $row->city_code . '"' . ($request->cityId==$row->city_code ? ' selected' : '') . '>'.$row->city_name.'</option>';
            }

            return  $dropdowns;
        }else{
            return '0';
        }      
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
         
    $getAssociatesDetails = DB::table('user_details as ud1')->select('ud1.*','ud1.rank','ranks.rank_seq','ranks.rank_name',)
    ->leftJoin('ranks as ranks', 'ud1.rank', '=', 'ranks.id') 
    ->where('ud1.referred_by', \Auth::user()->id)
    ->get();
    //dd($getAssociatesDetails);

        return view('myassociate')->with(['user' => \Auth::user(),'associatesDetails' =>$getAssociatesDetails ]);
    }

public function viewProfile($id){
    $getAssociatesDetails = DB::table('user_details as ud1')->select('ud1.*','ud1.rank','ranks.rank_seq','ranks.rank_name',)
    ->leftJoin('ranks as ranks', 'ud1.rank', '=', 'ranks.id') 
    ->where('ud1.user_id', $id)
    ->first();
    //dd($getAssociatesDetails);
    return view('view_profile')->with(['user' => \Auth::user(),'associate' =>$getAssociatesDetails ]);

}


    public function generatePdf() {
        $StateData= DB::table('all_states')->get();
        $cityData= DB::table('all_cities')->get();
        //dd($StateData);
        $getRanks = [];       
        $userData = \Auth::user();
        $getSponsorDetails = DB::table('user_details')->select('user_details.associate_name','user_details.sponsor_code','user_details.rank','ranks.rank_name','ranks.rank_seq')
        ->leftJoin('ranks as ranks', 'user_details.rank', '=', 'ranks.id')
                        ->where('user_details.user_id', '=', $userData->details[0]->referred_by)
                        ->get();
    
        $getRanks = DB::table('ranks')
                                    ->where('rank_seq', '=', $userData->details[0]->rank)
                                    ->first();

        $pdf=PDF::loadView('home', ['user' => \Auth::user(),'sponsorDetails' =>$getSponsorDetails,'rankData'=>$getRanks,'StateData'=>$StateData,'cityData'=>$cityData ]);
        $pdf->setOptions(['isPhpEnabled', true]);
        $pdf->setPaper('L', 'landscape');
        return $pdf->stream('test_pdf.pdf'); 
         
       

}

    public function updateProfile(Request $request) {
        // dd($request->all());

        $rules = [
            'associate_name' => 'required',
            'email' => 'required|email',           
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
            "aadhar_no" => $request->aadhar_no,
            "pan_no" => $request->pan_no,
            "gender" => $request->gender,
            "guardians_name" =>$request->district,
            "district" =>$request->district,
            "nominee_Name" =>$request->nominee_Name,
            "relation_with_nominee" =>$request->relation_with_nominee,
            "account_holder_name" =>$request->account_holder_name,
            "bank_name" =>$request->bank_name,
            "branch_name" =>$request->branch_name,
            "account_number" =>$request->account_number,
            "ifc_code" =>$request->ifc_code,
            "city_name" =>$request->city_name,
            "pin" =>$request->pin,
            "country_name" =>$request->country_name,
            "state_name" =>$request->state_name,
            "address_line1" =>$request->address_line1,
            "address_line2" =>$request->address_line2
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
