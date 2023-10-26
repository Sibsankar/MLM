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
            ['rank_name' => 'Sr. Business Development Manager I', 'short_code' => 'SBDMI'],
            ['rank_name' => 'Sr. Business Development Manager II', 'short_code' => 'SBDMII'],
            ['rank_name' => 'Sr. Business Development Manager III', 'short_code' => 'SBDMIII'],
            ['rank_name' => 'Sr. Business Development Manager IV', 'short_code' => 'SBDMIV'],
            ['rank_name' => 'Sr. Business Development Manager V', 'short_code' => 'SBDMV'],
            ['rank_name' => 'Vice President - Business Development -1', 'short_code' => 'VPBD1'],
            ['rank_name' => 'Vice President - Business Development -2', 'short_code' => 'VPBD2'],
            ['rank_name' => 'Vice President - Business Development -3', 'short_code' => 'VPBD3'],
            ['rank_name' => 'Vice President - Business Development -4', 'short_code' => 'VPBD4'],
            ['rank_name' => 'Sr. vice President - Business Development - 1', 'short_code' => 'SVPBD1'],
            ['rank_name' => 'Sr. vice President - Business Development - 2', 'short_code' => 'SVPBD2'],
            ['rank_name' => 'Sr. vice President - Business Development - 3', 'short_code' => 'SVPBD3'],
            ['rank_name' => 'Sr. vice President - Business Development - 4', 'short_code' => 'SVPBD4'],
            ['rank_name' => 'President - Business Development - 1', 'short_code' => 'PBD1'],
            ['rank_name' => 'President - Business Development - 2', 'short_code' => 'PBD2'],
            ['rank_name' => 'President - Business Development - 3', 'short_code' => 'PBD3'],
            ['rank_name' => 'President - Business Development - 4', 'short_code' => 'PBD4'],
            ['rank_name' => 'Executive Director - Business Development - 1', 'short_code' => 'EDBD1'],
            ['rank_name' => 'Executive Director - Business Development - 2	', 'short_code' => 'EDBD2'],
            ['rank_name' => 'Executive Director - Business Development - 3', 'short_code' => 'EDBD3'],
            ['rank_name' => 'Executive Director - Business Development - 4', 'short_code' => 'EDBD4'],
            ['rank_name' => 'Director - Business Development - 1', 'short_code' => 'DBD1'],
            ['rank_name' => 'Director - Business Development - 2', 'short_code' => 'DBD2'],
            ['rank_name' => 'Director - Business Development - 3', 'short_code' => 'DBD3'],
            ['rank_name' => 'Director - Business Development - 4', 'short_code' => 'DBD4']
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
