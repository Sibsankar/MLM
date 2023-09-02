<?php

namespace App\Imports;

use App\Models\UserOrg;
use App\Models\UserDetailsOrg;
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
            $hasuser = UserDetailsOrg::where('sponsor_code', $row['code'])->first();
            if(empty($hasuser->sponsor_code)) {
                $user_id = UserOrg::create([
                'name' => $row['name'],
                'password' => Hash::make($row['code']),
                'phone_no' => ($row['phone_no'] != '') ? $row['phone_no'] : ''
                ])->id;
                
                UserDetailsOrg::create([
                    'associate_name' => $row['name'],
                    'user_id' => $user_id,
                    'sponsor_code' => $row['code'],
                    'rank' => $row['rank_id'],
                    'dob' => ($row['dob'] != '') ? date('Y-m-d', strtotime($row['dob'])) : NULL,
                    'referred_by' => $row['sponser_code']
                ]);
            }
        }
   }
}
