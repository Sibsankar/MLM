<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Phase;

class PhaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $phase = new Phase();
        $phase->name = 'Phase 1';
        $phase->start_date = '2023-04-01';
        $phase->end_date = '2023-09-30';
        $phase->save();

        $phase = new Phase();
        $phase->name = 'Phase 2';
        $phase->start_date = '2023-10-01';
        $phase->end_date = '2023-03-31';
        $phase->save();
    }
}
