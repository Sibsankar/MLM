<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use App\Models\Rank;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $table_name = app(Rank::class)->getTable();
        Rank::truncate();
        DB::statement("ALTER TABLE `$table_name` AUTO_INCREMENT = 1;");
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $ranks = [
            ['rank_name' => 'Business Development Executive', 'short_code' => 'BDE'],
            ['rank_name' => 'Business Development Officer', 'short_code' => 'BDO'],
            ['rank_name' => 'Business Development Supervisor', 'short_code' => 'BDS'],
            ['rank_name' => 'Business Development Inspector', 'short_code' => 'BDI'],
            ['rank_name' => 'Business Development Manager', 'short_code' => 'BDM'],
            ['rank_name' => 'Sr. Business Development Manager I', 'short_code' => 'SR. BDM-I'],
            ['rank_name' => 'Sr. Business Development Manager II', 'short_code' => 'SR. BDM-II'],
            ['rank_name' => 'Sr. Business Development Manager III', 'short_code' => 'SR. BDM-III'],
            ['rank_name' => 'Sr. Business Development Manager IV', 'short_code' => 'SR. BDM-IV'],
            ['rank_name' => 'Sr. Business Development Manager V', 'short_code' => 'SR. BDM-V'],
            ['rank_name' => 'Vice President - Business Development -1', 'short_code' => 'VP. BD-1'],
            ['rank_name' => 'Vice President - Business Development -2', 'short_code' => 'VP. BD-2'],
            ['rank_name' => 'Vice President - Business Development -3', 'short_code' => 'VP. BD-3'],
            ['rank_name' => 'Vice President - Business Development -4', 'short_code' => 'VP. BD-4'],
            ['rank_name' => 'Sr. vice President - Business Development - 1', 'short_code' => 'SR. VP. BD-1'],
            ['rank_name' => 'Sr. vice President - Business Development - 2', 'short_code' => 'SR. VP. BD-2'],
            ['rank_name' => 'Sr. vice President - Business Development - 3', 'short_code' => 'SR. VP. BD-3'],
            ['rank_name' => 'Sr. vice President - Business Development - 4', 'short_code' => 'SR. VP. BD-4'],
            ['rank_name' => 'President - Business Development - 1', 'short_code' => 'PRES. BD-1'],
            ['rank_name' => 'President - Business Development - 2', 'short_code' => 'PRES. BD-2'],
            ['rank_name' => 'President - Business Development - 3', 'short_code' => 'PRES. BD-3'],
            ['rank_name' => 'President - Business Development - 4', 'short_code' => 'PRES. BD-4'],
            ['rank_name' => 'Executive Director - Business Development - 1', 'short_code' => 'ED. BD-1'],
            ['rank_name' => 'Executive Director - Business Development - 2	', 'short_code' => 'ED. BD-2'],
            ['rank_name' => 'Executive Director - Business Development - 3', 'short_code' => 'ED. BD-3'],
            ['rank_name' => 'Executive Director - Business Development - 4', 'short_code' => 'ED. BD-4'],
            ['rank_name' => 'Director - Business Development - 1', 'short_code' => 'DIR. BD-1'],
            ['rank_name' => 'Director - Business Development - 2', 'short_code' => 'DIR. BD-2'],
            ['rank_name' => 'Director - Business Development - 3', 'short_code' => 'DIR. BD-3'],
            ['rank_name' => 'Director - Business Development - 4', 'short_code' => 'DIR. BD-4']
        ];
        
        foreach ($ranks as $key => $rank) {
            // dd($rank);
            Rank::create([
                'rank_name' => $rank['rank_name'],
                'short_code' => $rank['short_code'],
                'rank_seq' => $key+1
            ]);
        }
    }
}
