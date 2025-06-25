<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CalculateReportTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $reports = DB::table('reports')->get();

    foreach ($reports as $report) {
        $totalBuying = DB::table('report_buying_transactions')
            ->join('buying_transactions', 'report_buying_transactions.buying_transaction_id', '=', 'buying_transactions.id')
            ->where('report_buying_transactions.report_id', $report->id)
            ->sum('buying_transactions.total_amount');

        $totalBoughtCount = DB::table('report_buying_transactions')
            ->join('buying_transactions', 'report_buying_transactions.buying_transaction_id', '=', 'buying_transactions.id')
            ->where('report_buying_transactions.report_id', $report->id)
            ->sum('buying_transactions.total_count');

        $totalSelling = DB::table('report_selling_transactions')
            ->join('selling_transactions', 'report_selling_transactions.selling_transaction_id', '=', 'selling_transactions.id')
            ->where('report_selling_transactions.report_id', $report->id)
            ->sum('selling_transactions.total_amount');

        $totalSoldCount = DB::table('report_selling_transactions')
            ->join('selling_transactions', 'report_selling_transactions.selling_transaction_id', '=', 'selling_transactions.id')
            ->where('report_selling_transactions.report_id', $report->id)
            ->sum('selling_transactions.total_count');

        $other_cost = rand(500000, 1000000);
        $cashFlow = $totalSelling - $totalBuying - $other_cost;

        DB::table('reports')->where('id', $report->id)->update([
            'total_buying' => $totalBuying,
            'total_selling' => $totalSelling,
            'total_bought_count' => $totalBoughtCount,
            'total_sold_count' => $totalSoldCount,
            'cash_flow' => $cashFlow,
            'other_cost'=> $other_cost,
        ]);
    }
    }
}
