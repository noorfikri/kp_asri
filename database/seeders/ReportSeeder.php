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
                'report_date' => now()->subMonths(rand(1, 12)),
                'type' => rand(0, 1) ? 'monthly' : 'yearly',
                'total_buying' => rand(100000, 1000000),
                'total_selling' => rand(100000, 1000000),
                'cash_flow' => rand(-500000, 500000),
                'creator_id' => $users[array_rand($users)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
