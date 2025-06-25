<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $users = DB::table('users')->pluck('id')->toArray();
    for ($i = 1; $i <= 5; $i++) {
        DB::table('reports')->insert([
            'report_date' => now()->subDays(rand(1, 60)),
            'type' => (rand(0, 1) ? 'monthly' : 'yearly'),
            'creator_id' => $users[array_rand($users)],
            'total_buying' => 0,
            'total_selling' => 0,
            'total_bought_count' => 0,
            'total_sold_count' => 0,
            'other_cost' => 0,
            'cash_flow' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    }
}
