<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 
use App\Models\Commission_categories; 
use App\Models\Commision_type; 
use Illuminate\Support\Facades\DB;

class RankController extends Controller
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


    public function addCommissionCategory(){
        //dd('addCommissionCategory');
        $catData = DB::table('commission_categories')->get();
        //dd($catData);
        $userData = \Auth::user();
        return view('category.list')->with(['user' => \Auth::user(),'catData'=>$catData]);
    }

    public function addCategory(Request $request){

       // dd($request->all());

        if(empty($request->update_cat_id)){
            $rules = [
                'name' => 'required'
            ];
        
            $customMessages = [
                'required' => 'The :attribute field is required.'
            ];
    
            //dd($request->all());
            $catObj = new Commission_categories;
            $catObj->name = $request->name;
            $catObj->status = $request->status;
            $catObj->save();
    
            return redirect()->route('addCommissionCategory')->with('successmessage','You have successfully added the commission category.');
        }else{

            $rules = [
                'name' => 'required'
            ];
        
            $customMessages = [
                'required' => 'The :attribute field is required.'
            ];
    
            $catArr = [
                "name" => $request->name,
                "status" => $request->status,
            ];
            $catUpData = Commission_categories::where('id', $request->update_cat_id)->first();
            $catUpData->update($catArr);
    
            return redirect()->route('addCommissionCategory')->with('successmessage','You have successfully updated the commission category.');
        }
        
       
       
    }
    
    public function addCommissionType(){
        //dd('addCommissionCategory');
        $catData = DB::table('commission_categories')->get();
        //$typeData = DB::table('commision_type')->get();
        $typeData = Commision_type::all();
       // dd($typeData->commisionTypes());
       $typeData = DB::table('commision_type')->select('commision_type.id','commision_type.category_id','commision_type.type_name','commision_type.status','commission_categories.name as catName')
        ->leftJoin('commission_categories', 'commision_type.category_id', '=', 'commission_categories.id')
                        ->get($typeData);
                        //dd($typeData);
        $userData = \Auth::user();
        return view('commision_type.list')->with(['user' => \Auth::user(),'catData'=>$catData,'typeData'=>$typeData]);
    }

    public function addType(Request $request){

         //dd($request->update_Type_id);
        // echo $request->update_Type_id;exit;
 
         if(empty($request->update_Type_id)){
            //dd('kdgfkdsghkjfsdkjfh');
             $rules = [
                 'type_name' => 'required'
             ];
         
             $customMessages = [
                 'required' => 'The :attribute field is required.'
             ];
     
             //dd($request->all());
             $catObj = new Commision_type;
             $catObj->type_name = $request->type_name;
             $catObj->category_id  = $request->category_id ;
             $catObj->status = $request->status;
             $catObj->save();
     
             return redirect()->route('addCommissionType')->with('successmessage','You have successfully added the Commission type.');
         }else{
           
             $rules = [
                 'type_name' => 'required'
             ];
         
             $customMessages = [
                 'required' => 'The :attribute field is required.'
             ];
     
             $catArr = [
                 "type_name" => $request->type_name,
                 "category_id" => $request->category_id,
                 "status" => $request->status,
             ];
             //dd($catArr);
             $upId = $request->update_Type_id;
             //dd($request->update_Type_id);
             //$catUpData = DB::table('commision_type')->where('id', $upId)->first();
             $catUpData = Commision_type::where('id', $upId)->first();
             //dd($catUpData);
             $catUpData->update($catArr);
     
             return redirect()->route('addCommissionType')->with('successmessage','You have successfully updated the commission type.');
         }
         
        
        
     }

}
