<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\User_detail;
use App\Models\Ranks;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@gmail.com';
        $admin->phone_no = '9999999999';
        $admin->type = 'admin';
        $admin->password = bcrypt('admin');
        $admin->save();

        $rank = Ranks::where('rank_name', 'Business Development Executive')->first();

        $admin_detail = new User_detail();
        $admin_detail->associate_name = 'Admin';
        $admin_detail->sponsor_code = '00000';
        $admin_detail->dob = '2000-01-01';
        $admin_detail->user_id = $admin->id;
        $admin_detail->referred_by = 0;
        $admin_detail->rank = (isset($rank->id)) ? $rank->id : 0;
        $admin_detail->save();
    }
}
