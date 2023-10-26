<?php

namespace App\Imports;

use App\Models\UserOrg;
use App\Models\UserDetailsOrg;
use App\Models\User;
use App\Models\User_detail;
use App\Models\Rank;
// use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow; 
use Carbon\Carbon;

class ImportUsers implements ToCollection, WithHeadingRow
{
    public function headingRow(): int
    {
        return 1;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $hasuser = User_detail::where('sponsor_code', $row['dva_code'])->first();

            if(empty($hasuser->sponsor_code)) {
                // Rank check
                $rank = Rank::where('short_code', $row['dva_position'])->first();
                if(empty($rank->id)) {
                    $rank_id = Rank::create([
                        'short_code' => $row['dva_position'],
                        'rank_seq' => 0
                    ])->id;
                } else {
                    $rank_id = $rank->id;
                }
                // insert user
                $user_id = User::create([
                'name' => ($row['name'] != '') ? $row['name'] : '',
                'email' => ($row['email'] != '') ? $row['email'] : '',
                'phone_no' => ($row['mobile'] != '') ? $row['mobile'] : '',
                'password' => Hash::make($row['mobile'])
                ])->id;
                // insert user details
                User_detail::create([
                    'associate_name' => ($row['name'] != '') ? $row['name'] : '',
                    'user_id' => $user_id,
                    'sponsor_code' => ($row['dva_code'] != '') ? $row['dva_code'] : '',
                    'rank' => $rank_id,
                    'guardians_name' => ($row['fathers_or_husband_name'] != '') ? $row['fathers_or_husband_name'] : '',
                    'phone_no' => ($row['mobile'] != '') ? $row['mobile'] : '',
                    'address_line1' => ($row['address'] != '') ? $row['address'] : '',
                    'address_line2' => ($row['location'] != '') ? $row['location'] : '',
                    'aadhar_no' => ($row['id_proof_aadhaar'] != '') ? $row['id_proof_aadhaar'] : '',
                    'nominee_Name' => ($row['nominee_name'] != '') ? $row['nominee_name'] : '',
                    'relation_with_nominee' => ($row['nominee_details'] != '') ? $row['nominee_details'] : '',
                    'dob' => (isset($row['dob']) && $row['dob'] != '') ? date('Y-m-d', strtotime($row['dob'])) : NULL,
                    'referred_by' => ($row['sponser_code'] != '') ? $row['sponser_code'] : '',
                ]);
            }
        }
   }
}
