<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1;$i<3;$i++){
            for($j=1;$j<3;$j++){
                for($k=1;$k<3;$k++){
                    for($l=1;$l<3;$l++){
                        DB::table('items')->insert([
                            'name'=> Str::random(5),
                            'price'=>rand(10000,1000000),
                            'stock'=>rand(100,10000),
                            'note'=>Str::random(100),
                            'category_id'=>$k,
                            'colour_id'=>$j,
                            'size_id'=>$i,
                            'brand_id'=>$l
                        ]);
                    }
                }
            }
        }
    }
}
