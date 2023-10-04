<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ranks;
use App\Models\Commission_categories;
use App\Models\Commision_type;
use App\Models\Rankconfig;

class RankConfigController extends Controller
{
    public function rankList() {
        $ranks = Ranks::all();

        return view('rank_config/rank_list')->with(['ranks' => $ranks]);
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

    public function addConfig($rank_id = NULL) {
        $rank = Ranks::find($rank_id);
        $comm_cats = Commission_categories::all();
        $comm_types = Commision_type::all();

        return view('rank_config/add_config')->with(['rank' => $rank, 'categories' => $comm_cats, 'types' => $comm_types]);

    }

    public function addRankConfig(Request $request) {
        dd($request->all());
        // need to check validation
        $rank = Ranks::find($request->rank_id);
        $comm_cats = Commission_categories::all();
        $comm_types = Commision_type::all();

        $hasPerformance_target = Rankconfig::where('rank_id', $request->rank_id)->where('performance_target', '<>', '')->first();
        if ($hasPerformance_target) {
            $hasPerformance_target->update([
                'performance_target' => $request->performance_target,
                'multiple_by' => $request->multiple_by
            ]);
        } else {
            Rankconfig::create([
                'rank_id' => $request->rank_id,
                'performance_target' => $request->performance_target,
                'multiple_by' => $request->multiple_by
            ]);
        }

        $hasGuaranteed_prize = Rankconfig::where('rank_id', $request->rank_id)->where('guaranteed_prize', '<>', '')->first();
        if ($hasGuaranteed_prize) {
            $hasGuaranteed_prize->update([
                'guaranteed_prize' => $request->guaranteed_prize
            ]);
        } else {
            Rankconfig::create([
                'rank_id' => $request->rank_id,
                'guaranteed_prize' => $request->guaranteed_prize
            ]);
        }

        $hasConveyance = Rankconfig::where('rank_id', $request->rank_id)->where('conveyance', '<>', '')->first();
        if ($hasConveyance) {
            $hasConveyance->update([
                'conveyance' => $request->conveyance
            ]);
        } else {
            Rankconfig::create([
                'rank_id' => $request->rank_id,
                'conveyance' => $request->conveyance
            ]);
        }

        if (!empty($request->category_id) && !empty($request->type_id) && !empty($request->percentage)) {
            foreach ($request->category_id as $key => $cat_id) {
                $type_id = $request->type_id[$key];
                $percentage = ($request->percentage[$key]) ? $request->percentage[$key] : 0;
                $hasCommConfig = Rankconfig::where(['commission_cat' => $request->commission_cat, 'commission_type' => $request->commission_type])->first();
                if ($hasCommConfig) {
                    $hasCommConfig->update([
                        'percentage' => $request->percentage[$key]
                    ]);
                } else {
                    Rankconfig::create([
                        'commission_cat' => $cat_id,
                        'commission_type' => $request->type_id[$key],
                        'percentage' => $request->percentage[$key]
                    ]);
                }
                
            }
        }

        return view('rank_config/add_config')->with(['rank' => $rank, 'categories' => $comm_cats, 'types' => $comm_types, 'successmessage' => 'Updated successfully.']);
    }
}
