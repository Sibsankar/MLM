<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use App\Models\Ranks;
use App\Models\Commission_categories;
use App\Models\Commision_type;
use App\Models\Rankconfig;
use App\Models\Phase;
use App\Models\RankConfigCommission;

class RankConfigController extends Controller
{
    public function rankList() {
        $ranks = Ranks::all();
        $phases = Phase::all();

        return view('rank_config/rank_list')->with(['ranks' => $ranks, 'phases' => $phases]);
    }

    public function getCommcats() {
        $cats = Commission_categories::all();
        return \Response::json( $cats );
    }

    public function getCommTypeByCatId($cat_id = NULL) {
        if($cat_id != '') {
            $types = Commision_type::where('category_id', $cat_id)->get();
			return \Response::json( $types );
        }
    }

    public function addConfig($rank_id = NULL, $phase_id = NULL) {
        $rank = Ranks::find($rank_id);
        $phase = Phase::find($phase_id);
        $comm_cats = Commission_categories::all();
        $comm_types = Commision_type::all();

        $hasData = Rankconfig::with('commissions')->where(['rank_id' => $rank_id, 'phase_id' => $phase_id])->first();
        // dd($hasData);

        return view('rank_config/add_config')->with(['rank' => $rank, 'phase' => $phase, 'categories' => $comm_cats, 'types' => $comm_types, 'data' => $hasData]);

    }

    public function addRankConfig(Request $request) {
        // dd($request->all());
        // need to check validation
        $rules = [
            'rank_id' => 'required',
            'phase_id' => 'required',
            'performance_target' => 'required',
            'guaranteed_prize' => 'required',
            'conveyance' => 'required',
            'commission_cat.*' => 'required',
            'commission_type.*' => 'required',
            'percentage.*' => 'required'
        ];
    
        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];

        $validator = \Validator::make( $request->all(), $rules, $customMessages );

        if ( $validator->fails() ) {
            return Redirect::back()->withErrors($validator->errors());
        }



        $rank = Ranks::find($request->rank_id);
        $phase = Phase::find($request->phase_id);
        $comm_cats = Commission_categories::all();
        $comm_types = Commision_type::all();

        $hasData = Rankconfig::where(['rank_id' => $request->rank_id, 'phase_id' => $request->phase_id])->first();

        if ($hasData) {
            $hasData->update([
                'performance_target' => $request->performance_target,
                'multiple_by' => ($request->multiple_by) ? $request->multiple_by : 1,
                'guaranteed_prize' => $request->guaranteed_prize,
                'conveyance' => $request->conveyance,
                'amount' => ($request->multiple_by && $request->performance_target) ? ($request->performance_target * $request->multiple_by) : ($request->performance_target * 1)
            ]);

        } else {
            Rankconfig::create([
                'rank_id' => $request->rank_id,
                'phase_id' => $request->phase_id,
                'performance_target' => $request->performance_target,
                'multiple_by' => ($request->multiple_by) ? $request->multiple_by : 1,
                'guaranteed_prize' => $request->guaranteed_prize,
                'conveyance' => $request->conveyance,
                'amount' => ($request->multiple_by && $request->performance_target) ? ($request->performance_target * $request->multiple_by) : ($request->performance_target * 1) //*************************************** need to calculate ********************************************************
            ]);
        }

        if (!empty($request->category_id) && !empty($request->type_id) && !empty($request->percentage)) {
            RankConfigCommission::where(['rank_id' => $request->rank_id, 'phase_id' => $request->phase_id])->delete();
            foreach ($request->category_id as $key => $cat_id) {
                $type_id = $request->type_id[$key];
                RankConfigCommission::create([
                    'rank_id' => $request->rank_id,
                    'phase_id' => $request->phase_id,
                    'commission_cat' => $cat_id,
                    'commission_type' => $request->type_id[$key],
                    'percentage' => ($request->percentage[$key]) ? $request->percentage[$key] : 0,
                    'amount' => 0 //*************************************** need to calculate ********************************************************
                ]);
                
            }
        }

        return redirect()->back()->with('successmessage', 'Updated successfully.');   
        // return view('rank_config/add_config')->with(['rank' => $rank, 'phase' => $phase, 'categories' => $comm_cats, 'types' => $comm_types, 'data' => $hasData, 'successmessage' => 'Updated successfully.']);
    }
}
