<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        $this->call(CategorySeeder::class);
        $this->call(ColourSeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(BuyingTransactionSeeder::class);
        $this->call(BuyingTransactionItemSeeder::class);
        $this->call(SellingTransactionSeeder::class);
        $this->call(SellingTransactionItemSeeder::class);
        $this->call(ReportSeeder::class);
        $this->call(ReportBuyingTransactionSeeder::class);
        $this->call(ReportSellingTransactionSeeder::class);
        $this->call(CalculateReportTable::class);
        $this->call(MessageSeeder::class);
        $this->call(TestLoginUserSeeder::class);
        $this->call(StoreInfoSeeder::class);
    }
}
